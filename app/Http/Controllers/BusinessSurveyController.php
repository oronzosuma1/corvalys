<?php

namespace App\Http\Controllers;

use App\Models\BusinessSurvey;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BusinessSurveyController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Business Survey — Corvalys');
        SEOTools::setDescription('What is slowing down your business? Take this 3-minute survey to identify where AI could save you time.');
        return view('pages.business-survey');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_size' => 'nullable|string|in:1_5,6_20,21_50,51_200,200_plus',
            'sector' => 'nullable|string|in:retail,manufacturing,logistics,food_hospitality,consulting,other',
            'country' => 'nullable|string|max:100',
            'respondent_role' => 'nullable|string|max:50',
            'frustration_areas' => 'nullable|array',
            'frustration_areas.*' => 'string|max:100',
            'main_pain_driver' => 'nullable|string|max:100',
            'pain_frequency' => 'nullable|string|in:daily,several_weekly,weekly,monthly,rarely',
            'time_wasted_weekly' => 'nullable|string|in:under_1h,1_3h,3_5h,5_10h,over_10h',
            'pain_severity' => 'nullable|integer|between:1,5',
            'repetitive_tasks' => 'nullable|array',
            'repetitive_tasks.*' => 'string|max:100',
            'top_delegate_tasks' => 'nullable|array|max:3',
            'top_delegate_tasks.*' => 'string|max:100',
            'preferred_outcome' => 'nullable|string|max:100',
            'current_ai_usage' => 'nullable|string|in:none,tried_once,use_occasionally,use_regularly',
            'ai_concerns' => 'nullable|array',
            'ai_concerns.*' => 'string|max:100',
            'readiness_statement' => 'nullable|string|in:ready_now,open_to_it,curious,skeptical,not_interested',
            'preferred_ai_areas' => 'nullable|array',
            'preferred_ai_areas.*' => 'string|max:100',
            'preferred_support_model' => 'nullable|string|max:50',
            'preferred_start_method' => 'nullable|string|max:50',
            'trust_factors' => 'nullable|array',
            'trust_factors.*' => 'string|max:100',
            'contact_name' => 'nullable|string|max:100',
            'contact_company' => 'nullable|string|max:100',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:30',
            'contact_country' => 'nullable|string|max:100',
            'wants_insights' => 'nullable|boolean',
            'wants_solutions_contact' => 'nullable|boolean',
            'wants_pilot' => 'nullable|boolean',
            'gdpr_consent' => 'nullable|boolean',
        ]);

        // Determine if this is a lead
        $isLead = !empty($validated['contact_email']) || !empty($validated['contact_phone']);
        $validated['is_lead'] = $isLead;
        $validated['session_id'] = $request->session()->getId();
        $validated['preferred_language'] = app()->getLocale();
        $validated['completed_at'] = now();

        $survey = BusinessSurvey::create($validated);

        // Compute scores
        try {
            $survey->computeAllScores();
        } catch (\Throwable $e) {
            Log::warning('Business survey scoring failed for #' . $survey->id . ': ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'id' => $survey->id,
        ]);
    }
}
