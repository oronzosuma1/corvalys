<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessSurvey;
use Illuminate\Http\Request;

class BusinessSurveyAdminController extends Controller
{
    /**
     * List all completed business surveys with filters.
     */
    public function index(Request $request)
    {
        $query = BusinessSurvey::completed();

        // Filters
        if ($request->filled('sector')) {
            $query->bySector($request->sector);
        }
        if ($request->filled('company_size')) {
            $query->bySize($request->company_size);
        }
        if ($request->filled('country')) {
            $query->byCountry($request->country);
        }
        if ($request->filled('cluster')) {
            $query->byCluster($request->cluster);
        }

        $surveys = $query->orderByDesc('completed_at')->paginate(25)->withQueryString();

        // Filter options
        $sectors = BusinessSurvey::sectorLabels();
        $sizes = BusinessSurvey::sizeLabels();
        $clusters = BusinessSurvey::clusterLabels();
        $countries = BusinessSurvey::completed()
            ->whereNotNull('country')
            ->distinct()
            ->pluck('country')
            ->sort()
            ->values();

        return view('admin.business-survey.index', compact(
            'surveys', 'sectors', 'sizes', 'clusters', 'countries'
        ));
    }

    /**
     * Show full detail of a single survey response.
     */
    public function show(BusinessSurvey $survey)
    {
        return view('admin.business-survey.show', compact('survey'));
    }

    /**
     * Analytics dashboard with aggregated data.
     */
    public function analytics()
    {
        $completedSurveys = BusinessSurvey::completed()->get();
        $totalResponses = $completedSurveys->count();
        $totalLeads = $completedSurveys->where('is_lead', true)->count();

        if ($totalResponses === 0) {
            return view('admin.business-survey.analytics', [
                'totalResponses' => 0,
                'totalLeads' => 0,
                'avgPainScore' => 0,
                'avgAutomation' => 0,
                'avgReadiness' => 0,
                'topFrustrations' => [],
                'topDelegateTasks' => [],
                'bySector' => [],
                'bySize' => [],
                'byCountry' => [],
                'clusterDistribution' => [],
                'readinessDistribution' => [],
                'concernsDistribution' => [],
                'outcomesDistribution' => [],
            ]);
        }

        // Averages
        $avgPainScore = round($completedSurveys->avg('pain_score') ?? 0, 1);
        $avgAutomation = round($completedSurveys->avg('automation_potential') ?? 0, 1);
        $avgReadiness = round($completedSurveys->avg('commercial_readiness') ?? 0, 1);

        // Tally JSON array fields → associative arrays
        $topFrustrations = $this->tallyArrayField($completedSurveys, 'frustration_areas')->toArray();
        $topDelegateTasks = $this->tallyArrayField($completedSurveys, 'top_delegate_tasks')->toArray();
        $concernsDistribution = $this->tallyArrayField($completedSurveys, 'ai_concerns')->toArray();
        $clusterDistribution = $this->tallyArrayField($completedSurveys, 'opportunity_clusters')->toArray();

        // Responses by sector → associative array [sector_key => count]
        $bySector = BusinessSurvey::completed()
            ->whereNotNull('sector')
            ->selectRaw('sector, COUNT(*) as count')
            ->groupBy('sector')
            ->orderByDesc('count')
            ->pluck('count', 'sector')
            ->toArray();

        // Responses by company size → associative array with avg scores
        $bySize = [];
        $sizeGroups = $completedSurveys->whereNotNull('company_size')->groupBy('company_size');
        foreach ($sizeGroups as $size => $surveys) {
            $bySize[$size] = [
                'count' => $surveys->count(),
                'avg_pain' => round($surveys->avg('pain_score') ?? 0, 1),
                'avg_readiness' => round($surveys->avg('commercial_readiness') ?? 0, 1),
            ];
        }

        // Responses by country (top 10) → associative array [country => count]
        $byCountry = BusinessSurvey::completed()
            ->whereNotNull('country')
            ->selectRaw('country, COUNT(*) as count')
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit(10)
            ->pluck('count', 'country')
            ->toArray();

        // Readiness statement distribution → associative array [key => count]
        $readinessDistribution = BusinessSurvey::completed()
            ->whereNotNull('readiness_statement')
            ->selectRaw('readiness_statement, COUNT(*) as count')
            ->groupBy('readiness_statement')
            ->orderByDesc('count')
            ->pluck('count', 'readiness_statement')
            ->toArray();

        // Preferred outcomes distribution → associative array [key => count]
        $outcomesDistribution = BusinessSurvey::completed()
            ->whereNotNull('preferred_outcome')
            ->selectRaw('preferred_outcome, COUNT(*) as count')
            ->groupBy('preferred_outcome')
            ->orderByDesc('count')
            ->pluck('count', 'preferred_outcome')
            ->toArray();

        return view('admin.business-survey.analytics', compact(
            'totalResponses', 'totalLeads',
            'avgPainScore', 'avgAutomation', 'avgReadiness',
            'topFrustrations', 'topDelegateTasks',
            'bySector', 'bySize', 'byCountry', 'clusterDistribution',
            'readinessDistribution', 'concernsDistribution', 'outcomesDistribution'
        ));
    }

    /**
     * Export all completed surveys as CSV.
     */
    public function export()
    {
        $surveys = BusinessSurvey::completed()->orderByDesc('completed_at')->get();

        $filename = 'business-survey-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($surveys) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, [
                'ID', 'Date', 'Company Size', 'Sector', 'Country', 'Role',
                'Frustration Areas', 'Main Pain Driver', 'Pain Frequency',
                'Time Wasted Weekly', 'Pain Severity',
                'Repetitive Tasks', 'Top Delegate Tasks', 'Preferred Outcome',
                'Current AI Usage', 'AI Concerns', 'Readiness Statement',
                'Preferred AI Areas', 'Preferred Support Model', 'Preferred Start Method',
                'Trust Factors',
                'Pain Score', 'Automation Potential', 'Commercial Readiness',
                'Opportunity Clusters',
                'Contact Name', 'Contact Company', 'Contact Email', 'Contact Phone',
                'Contact Country',
                'Wants Insights', 'Wants Solutions Contact', 'Wants Pilot',
                'GDPR Consent', 'Is Lead', 'Language',
            ]);

            foreach ($surveys as $s) {
                fputcsv($file, [
                    $s->id,
                    $s->completed_at?->format('Y-m-d H:i'),
                    $s->company_size,
                    $s->sector,
                    $s->country,
                    $s->respondent_role,
                    $this->arrayToPipe($s->frustration_areas),
                    $s->main_pain_driver,
                    $s->pain_frequency,
                    $s->time_wasted_weekly,
                    $s->pain_severity,
                    $this->arrayToPipe($s->repetitive_tasks),
                    $this->arrayToPipe($s->top_delegate_tasks),
                    $s->preferred_outcome,
                    $s->current_ai_usage,
                    $this->arrayToPipe($s->ai_concerns),
                    $s->readiness_statement,
                    $this->arrayToPipe($s->preferred_ai_areas),
                    $s->preferred_support_model,
                    $s->preferred_start_method,
                    $this->arrayToPipe($s->trust_factors),
                    $s->pain_score,
                    $s->automation_potential,
                    $s->commercial_readiness,
                    $this->arrayToPipe($s->opportunity_clusters),
                    $s->contact_name,
                    $s->contact_company,
                    $s->contact_email,
                    $s->contact_phone,
                    $s->contact_country,
                    $s->wants_insights ? 'Yes' : 'No',
                    $s->wants_solutions_contact ? 'Yes' : 'No',
                    $s->wants_pilot ? 'Yes' : 'No',
                    $s->gdpr_consent ? 'Yes' : 'No',
                    $s->is_lead ? 'Yes' : 'No',
                    $s->preferred_language,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Tally values across a JSON array field on all surveys.
     * Returns a sorted collection of [value => count].
     */
    private function tallyArrayField($surveys, string $field): \Illuminate\Support\Collection
    {
        $counts = [];

        foreach ($surveys as $survey) {
            $values = $survey->{$field};
            if (is_array($values)) {
                foreach ($values as $value) {
                    if (!empty($value)) {
                        $counts[$value] = ($counts[$value] ?? 0) + 1;
                    }
                }
            }
        }

        arsort($counts);

        return collect($counts);
    }

    /**
     * Convert an array to pipe-separated string for CSV export.
     */
    private function arrayToPipe($value): string
    {
        if (is_array($value)) {
            return implode('|', $value);
        }

        return '';
    }
}
