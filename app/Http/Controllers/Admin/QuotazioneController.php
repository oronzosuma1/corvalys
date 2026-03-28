<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\QuotationAssessment;
use App\Services\ClaudeService;
use Illuminate\Http\Request;

class QuotazioneController extends Controller
{
    /**
     * Stand-alone quotation page (no lead required).
     */
    public function index()
    {
        $lastAssessment = QuotationAssessment::latest()->first();
        $leads = Lead::orderBy('created_at', 'desc')->get();
        return view('admin.quotazione.index', compact('lastAssessment', 'leads'));
    }

    /**
     * Generate quotation without a specific lead.
     */
    public function generateStandalone(Request $request)
    {
        $answers = $request->validate([
            'service_type' => 'required|string',
            'sector' => 'required|string',
            'complexity' => 'required|integer|min:1|max:5',
            'domain_expertise' => 'required|string',
            'output_type' => 'required|string',
            'timeline' => 'required|string',
            'hours_estimate' => 'required|string',
            'client_team' => 'required|string',
            'budget_alignment' => 'required|string',
            'scope_clarity' => 'required|string',
            'risk_flags' => 'nullable|string',
            'notes' => 'nullable|string',
            'client_description' => 'nullable|string',
        ]);

        $clientDescription = $answers['client_description'] ?? '';
        unset($answers['client_description']);

        try {
            $claude = app(ClaudeService::class);
            $result = $claude->generateQuotation($answers, $clientDescription);

            // Optionally link to a lead if one was selected
            $leadId = $request->input('lead_id');

            $assessment = QuotationAssessment::create([
                'lead_id' => $leadId ?: null,
                'user_id' => auth()->id(),
                'answers' => $answers,
                'result' => $result,
            ]);

            if ($leadId) {
                Lead::where('id', $leadId)->update([
                    'quoted_min' => $result['min_eur'] ?? null,
                    'quoted_max' => $result['max_eur'] ?? null,
                    'quoted_confidence' => $result['confidence'] ?? null,
                ]);
            }

            return redirect()->route('admin.quotazione.index')
                ->with('success', 'Quotazione generata con successo!');
        } catch (\Exception $e) {
            return redirect()->route('admin.quotazione.index')
                ->with('error', 'Errore: ' . $e->getMessage());
        }
    }

    /**
     * Quotation page for a specific lead.
     */
    public function show(Lead $lead)
    {
        $lastAssessment = $lead->quotationAssessments()->latest()->first();
        return view('admin.quotazione.show', compact('lead', 'lastAssessment'));
    }

    /**
     * Generate quotation for a specific lead.
     */
    public function generate(Request $request, Lead $lead)
    {
        $answers = $request->validate([
            'service_type' => 'required|string',
            'sector' => 'required|string',
            'complexity' => 'required|integer|min:1|max:5',
            'domain_expertise' => 'required|string',
            'output_type' => 'required|string',
            'timeline' => 'required|string',
            'hours_estimate' => 'required|string',
            'client_team' => 'required|string',
            'budget_alignment' => 'required|string',
            'scope_clarity' => 'required|string',
            'risk_flags' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        try {
            $claude = app(ClaudeService::class);
            $result = $claude->generateQuotation($answers, $lead->project_description ?? '');

            QuotationAssessment::create([
                'lead_id' => $lead->id,
                'user_id' => auth()->id(),
                'answers' => $answers,
                'result' => $result,
            ]);

            $lead->update([
                'quoted_min' => $result['min_eur'] ?? null,
                'quoted_max' => $result['max_eur'] ?? null,
                'quoted_confidence' => $result['confidence'] ?? null,
            ]);

            return redirect()->route('admin.quotazione.show', $lead)
                ->with('success', 'Quotazione generata con successo.');
        } catch (\Exception $e) {
            return redirect()->route('admin.quotazione.show', $lead)
                ->with('error', 'Errore: ' . $e->getMessage());
        }
    }
}
