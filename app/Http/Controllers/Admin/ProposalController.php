<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function generate(Request $request, Lead $lead)
    {
        $request->validate([
            'language' => 'required|in:en,it,fr,de,es',
        ]);

        $language = $request->language;
        $assessment = $lead->claude_auto_assessment;

        if (!$assessment) {
            return back()->with('error', 'Auto-assessment richiesto prima di generare la proposta.');
        }

        $pdf = Pdf::loadView('pdf.proposal', [
            'lead' => $lead,
            'assessment' => $assessment,
            'language' => $language,
        ]);

        $filename = 'proposals/proposal-' . $lead->id . '-' . time() . '.pdf';
        Storage::disk('public')->put($filename, $pdf->output());

        $lead->update([
            'proposal_pdf_path' => $filename,
            'proposal_status' => 'draft',
            'proposal_language' => $language,
        ]);

        return back()->with('success', 'Proposta PDF generata con successo.');
    }

    public function download(Lead $lead)
    {
        if (!$lead->proposal_pdf_path || !Storage::disk('public')->exists($lead->proposal_pdf_path)) {
            return back()->with('error', 'PDF non trovato.');
        }

        return Storage::disk('public')->download($lead->proposal_pdf_path, 'Corvalys-Proposal-' . $lead->company . '.pdf');
    }

    public function approve(Lead $lead)
    {
        $lead->update([
            'proposal_status' => 'approved',
            'proposal_approved_at' => now(),
        ]);

        Mail::send('emails.proposal-approved', [
            'lead' => $lead,
        ], function ($message) use ($lead) {
            $message->to($lead->email, $lead->name)
                    ->subject('Your Corvalys Proposal Has Been Approved')
                    ->attach(Storage::disk('public')->path($lead->proposal_pdf_path));
        });

        return back()->with('success', 'Proposta approvata e inviata al cliente.');
    }

    public function send(Lead $lead)
    {
        if (!$lead->proposal_pdf_path) {
            return back()->with('error', 'Genera prima la proposta PDF.');
        }

        Mail::send('emails.proposal-sent', [
            'lead' => $lead,
        ], function ($message) use ($lead) {
            $message->to($lead->email, $lead->name)
                    ->subject('Corvalys - Your Proposal')
                    ->attach(Storage::disk('public')->path($lead->proposal_pdf_path));
        });

        $lead->update([
            'proposal_status' => 'sent',
            'proposal_sent_at' => now(),
        ]);

        return back()->with('success', 'Proposta inviata a ' . $lead->email);
    }
}
