<?php

namespace App\Http\Controllers;

use App\Models\SurveyResponse;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('AI Readiness Assessment — Corvalys');
        SEOTools::setDescription('Discover how ready your business is for AI adoption. Free assessment covering leadership, data, technology, culture, processes and compliance.');

        return view('pages.survey');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Company info
            'company_name' => 'required|string|max:255',
            'company_size' => 'required|in:1-9,10-49,50-249,250+',
            'industry' => 'required|string|max:255',
            'country' => 'nullable|string|max:100',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_role' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:50',

            // Nested scores, notes, low_reasons
            'scores' => 'required|array',
            'scores.leadership' => 'required|array',
            'scores.data' => 'required|array',
            'scores.technology' => 'required|array',
            'scores.culture' => 'required|array',
            'scores.process' => 'required|array',
            'scores.compliance' => 'required|array',
            'notes' => 'nullable|array',
            'low_reasons' => 'nullable|array',

            // Additional
            'additional_comments' => 'nullable|string|max:2000',
            'wants_consultation' => 'nullable|boolean',
        ]);

        $dimensions = ['leadership', 'data', 'technology', 'culture', 'process', 'compliance'];

        // Flatten nested structure into model fields
        $data = [
            'company_name' => $validated['company_name'],
            'company_size' => $validated['company_size'],
            'industry' => $validated['industry'],
            'country' => $validated['country'] ?? null,
            'contact_name' => $validated['contact_name'],
            'contact_email' => $validated['contact_email'],
            'contact_role' => $validated['contact_role'] ?? null,
            'contact_phone' => $validated['contact_phone'] ?? null,
            'additional_comments' => $validated['additional_comments'] ?? null,
            'wants_consultation' => $validated['wants_consultation'] ?? false,
            'preferred_language' => app()->getLocale(),
            'completed_at' => now(),
        ];

        foreach ($dimensions as $dim) {
            // Scores: filter out 0-values (unanswered)
            $scores = $validated['scores'][$dim] ?? [];
            $data["scores_$dim"] = array_filter($scores, fn($v) => $v > 0);

            // Notes
            $notes = $validated['notes'][$dim] ?? [];
            $data["notes_$dim"] = array_filter($notes, fn($v) => !empty($v));

            // Low score reasons
            $reasons = $validated['low_reasons'][$dim] ?? [];
            $data["low_reasons_$dim"] = array_filter($reasons, fn($v) => !empty($v));
        }

        $survey = SurveyResponse::create($data);
        $survey->computeAverages();
        $survey->save();

        return response()->json([
            'success' => true,
            'id' => $survey->id,
            'results' => [
                'overall_score' => $survey->overall_score,
                'readiness_level' => $survey->readiness_level,
                'dimensions' => [
                    'leadership' => $survey->avg_leadership,
                    'data' => $survey->avg_data,
                    'technology' => $survey->avg_technology,
                    'culture' => $survey->avg_culture,
                    'process' => $survey->avg_process,
                    'compliance' => $survey->avg_compliance,
                ],
                'weak_dimensions' => $survey->weak_dimensions,
                'strong_dimensions' => $survey->strong_dimensions,
            ],
        ]);
    }
}
