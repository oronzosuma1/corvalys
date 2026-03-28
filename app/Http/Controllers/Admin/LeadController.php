<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ProposalMail;
use App\Models\Lead;
use App\Services\ClaudeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Lead::query()
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->when($request->service_type, fn($q, $s) => $q->where('service_type', $s))
            ->when($request->search, fn($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('company', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            }))
            ->latest()
            ->paginate(20);

        return view('admin.leads.index', compact('leads'));
    }

    public function show(Lead $lead)
    {
        $lead->load('quotationAssessments');
        $lastAssessment = $lead->quotationAssessments()->latest()->first();

        return view('admin.leads.show', compact('lead', 'lastAssessment'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,in_proposta,converted,lost,spam',
            'urgency' => 'nullable|in:esploriamo,importante,prioritario,urgente,critico',
            'internal_notes' => 'nullable|string|max:5000',
        ]);

        $lead->update($validated);

        if ($validated['status'] === 'contacted' && !$lead->contacted_at) {
            $lead->update(['contacted_at' => now()]);
        }

        return redirect()->route('admin.leads.show', $lead)
            ->with('success', 'Lead aggiornato.');
    }

    public function addNota(Request $request, Lead $lead)
    {
        $request->validate(['nota' => 'required|string|max:2000']);

        $existing = $lead->internal_notes ?? '';
        $timestamp = now()->format('d/m/Y H:i');
        $newNote = "[{$timestamp}] {$request->nota}";
        $lead->update(['internal_notes' => $existing ? "{$existing}\n\n{$newNote}" : $newNote]);

        return redirect()->route('admin.leads.show', $lead)->with('success', 'Nota aggiunta.');
    }

    public function sendProposal(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string|max:10000',
            'include_assessment' => 'nullable|boolean',
        ]);

        $includeAssessment = (bool) ($validated['include_assessment'] ?? false);

        Mail::to($lead->email)->queue(new ProposalMail(
            lead: $lead,
            proposalSubject: $validated['subject'],
            bodyText: $validated['body'],
            includeAssessment: $includeAssessment,
        ));

        // Log the proposal in internal notes
        $existing = $lead->internal_notes ?? '';
        $timestamp = now()->format('d/m/Y H:i');
        $newNote = "[{$timestamp}] Proposta inviata a {$lead->email} - Oggetto: {$validated['subject']}";
        $lead->update(['internal_notes' => $existing ? "{$existing}\n\n{$newNote}" : $newNote]);

        return redirect()->route('admin.leads.show', $lead)->with('success', 'Proposta inviata a ' . $lead->email);
    }

    public function autoAssess(Lead $lead)
    {
        try {
            $claudeService = app(ClaudeService::class);
            $assessment = $claudeService->autoAssessLead($lead);
            $lead->update([
                'claude_auto_assessment' => $assessment,
                'claude_auto_assessed_at' => now(),
            ]);

            return redirect()->route('admin.leads.show', $lead)->with('success', 'Auto-assessment generato con successo.');
        } catch (\Throwable $e) {
            Log::error('Auto-assess failed for lead #' . $lead->id . ': ' . $e->getMessage());
            return redirect()->route('admin.leads.show', $lead)->with('error', 'Errore nella generazione: ' . $e->getMessage());
        }
    }
}
