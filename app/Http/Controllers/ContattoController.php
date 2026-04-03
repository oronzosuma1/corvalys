<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContattoRequest;
use App\Mail\ConfermaContattoMail;
use App\Mail\NuovoLeadMail;
use App\Models\Lead;
use App\Services\ClaudeService;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContattoController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Contact Us — Corvalys');
        SEOTools::setDescription('Get in touch with Corvalys. Tell us about your project — we respond within 24 hours.');
        return view('pages.contatto');
    }

    public function store(ContattoRequest $request)
    {
        $validated = $request->validated();

        // Ensure boolean fields default to false when not submitted
        foreach (['uses_erp', 'uses_excel', 'uses_database', 'has_it_team', 'uses_cloud', 'has_api_integrations'] as $field) {
            if (!isset($validated[$field])) {
                $validated[$field] = false;
            }
        }

        // Build readiness scores JSON from individual fields
        $readinessScores = [];
        $readinessReasons = [];
        $dimensions = ['leadership', 'data', 'technology', 'culture', 'process', 'compliance'];
        foreach ($dimensions as $dim) {
            $score = $validated["readiness_$dim"] ?? null;
            if ($score) {
                $readinessScores[$dim] = (int) $score;
            }
            $reason = $validated["readiness_reason_$dim"] ?? null;
            if ($reason) {
                $readinessReasons[$dim] = $reason;
            }
            // Remove individual fields from validated data
            unset($validated["readiness_$dim"], $validated["readiness_reason_$dim"]);
        }

        if (!empty($readinessScores)) {
            $validated['readiness_scores'] = $readinessScores;
            $validated['readiness_reasons'] = !empty($readinessReasons) ? $readinessReasons : null;
        }

        $lead = Lead::create($validated + ['source' => $request->source ?? 'website']);

        // Calculate and save tech maturity score + readiness overall
        $updateData = ['tech_maturity_score' => $lead->calculateTechMaturityScore()];
        $readinessOverall = $lead->computeReadinessOverall();
        if ($readinessOverall !== null) {
            $updateData['readiness_overall'] = $readinessOverall;
        }
        $lead->update($updateData);

        // Send notification emails (non-blocking: lead is saved even if email fails)
        try {
            Mail::to(config('corvalys.enzo_email'))->send(new NuovoLeadMail($lead));
            Mail::to($lead->email)->send(new ConfermaContattoMail($lead->name));
        } catch (\Throwable $e) {
            Log::warning('Email send failed for lead #' . $lead->id . ': ' . $e->getMessage());
        }

        // Auto-assess with Claude (non-blocking: lead is saved even if this fails)
        try {
            $claudeService = app(ClaudeService::class);
            $assessment = $claudeService->autoAssessLead($lead);
            $lead->update([
                'claude_auto_assessment' => $assessment,
                'claude_auto_assessed_at' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::warning('Auto-assess failed for lead #' . $lead->id . ': ' . $e->getMessage());
        }

        return redirect()->route('contatto')
            ->with('success', 'Grazie ' . $lead->name . '! Ti rispondo entro 24 ore.');
    }
}
