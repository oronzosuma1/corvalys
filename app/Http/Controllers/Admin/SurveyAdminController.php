<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyAdminController extends Controller
{
    /**
     * List all survey responses.
     */
    public function index(Request $request)
    {
        $query = SurveyResponse::whereNotNull('completed_at');

        // Filters
        if ($request->filled('size')) {
            $query->where('company_size', $request->size);
        }
        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }
        if ($request->filled('level')) {
            $query->where(function ($q) use ($request) {
                match ($request->level) {
                    'excellent' => $q->where('overall_score', '>=', 4.5),
                    'good' => $q->where('overall_score', '>=', 3.5)->where('overall_score', '<', 4.5),
                    'moderate' => $q->where('overall_score', '>=', 2.5)->where('overall_score', '<', 3.5),
                    'low' => $q->where('overall_score', '>=', 1.5)->where('overall_score', '<', 2.5),
                    'very_low' => $q->where('overall_score', '<', 1.5),
                    default => null,
                };
            });
        }

        $surveys = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get filter options
        $industries = SurveyResponse::whereNotNull('completed_at')
            ->distinct()
            ->pluck('industry')
            ->sort()
            ->values();

        return view('admin.survey.index', compact('surveys', 'industries'));
    }

    /**
     * Show individual survey response detail.
     */
    public function show(SurveyResponse $survey)
    {
        return view('admin.survey.show', compact('survey'));
    }

    /**
     * Analytics / statistical dashboard.
     */
    public function analytics()
    {
        $total = SurveyResponse::whereNotNull('completed_at')->count();

        if ($total === 0) {
            return view('admin.survey.analytics', [
                'total' => 0,
                'stats' => null,
                'bySize' => collect(),
                'byIndustry' => collect(),
                'dimensionAverages' => [],
                'weakestAreas' => [],
                'needsAnalysis' => [],
                'recentSurveys' => collect(),
                'scoreDistribution' => [],
            ]);
        }

        // Overall averages
        $stats = SurveyResponse::whereNotNull('completed_at')
            ->selectRaw('
                AVG(avg_leadership) as avg_leadership,
                AVG(avg_data) as avg_data,
                AVG(avg_technology) as avg_technology,
                AVG(avg_culture) as avg_culture,
                AVG(avg_process) as avg_process,
                AVG(avg_compliance) as avg_compliance,
                AVG(overall_score) as avg_overall,
                MIN(overall_score) as min_overall,
                MAX(overall_score) as max_overall,
                COUNT(*) as total_count
            ')
            ->first();

        // Distribution by company size
        $bySize = SurveyResponse::whereNotNull('completed_at')
            ->selectRaw('company_size, COUNT(*) as count, AVG(overall_score) as avg_score')
            ->groupBy('company_size')
            ->orderByRaw("CASE company_size WHEN '1-9' THEN 1 WHEN '10-49' THEN 2 WHEN '50-249' THEN 3 WHEN '250+' THEN 4 END")
            ->get();

        // Distribution by industry
        $byIndustry = SurveyResponse::whereNotNull('completed_at')
            ->selectRaw('industry, COUNT(*) as count, AVG(overall_score) as avg_score')
            ->groupBy('industry')
            ->orderByDesc('count')
            ->limit(15)
            ->get();

        // Dimension averages for radar chart
        $dimensionAverages = [
            'Leadership' => round($stats->avg_leadership ?? 0, 1),
            'Data' => round($stats->avg_data ?? 0, 1),
            'Technology' => round($stats->avg_technology ?? 0, 1),
            'Culture' => round($stats->avg_culture ?? 0, 1),
            'Process' => round($stats->avg_process ?? 0, 1),
            'Compliance' => round($stats->avg_compliance ?? 0, 1),
        ];

        // Find weakest individual criteria across all responses
        $weakestAreas = $this->computeWeakestCriteria();

        // Needs analysis: what companies need most based on low scores
        $needsAnalysis = $this->computeNeedsAnalysis();

        // Score distribution (histogram buckets)
        $scoreDistribution = $this->computeScoreDistribution();

        // Consultation interest
        $wantsConsultation = SurveyResponse::whereNotNull('completed_at')
            ->where('wants_consultation', true)->count();

        $recentSurveys = SurveyResponse::whereNotNull('completed_at')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('admin.survey.analytics', compact(
            'total', 'stats', 'bySize', 'byIndustry',
            'dimensionAverages', 'weakestAreas', 'needsAnalysis',
            'scoreDistribution', 'wantsConsultation', 'recentSurveys'
        ));
    }

    /**
     * Compute the weakest individual criteria across all responses.
     */
    private function computeWeakestCriteria(): array
    {
        $criteria = $this->getCriteriaMap();
        $totals = [];
        $counts = [];

        $surveys = SurveyResponse::whereNotNull('completed_at')->get();

        foreach ($surveys as $survey) {
            foreach (['leadership', 'data', 'technology', 'culture', 'process', 'compliance'] as $dim) {
                $scores = $survey->{"scores_$dim"};
                if (is_array($scores)) {
                    foreach ($scores as $key => $score) {
                        $fullKey = "{$dim}.{$key}";
                        $totals[$fullKey] = ($totals[$fullKey] ?? 0) + $score;
                        $counts[$fullKey] = ($counts[$fullKey] ?? 0) + 1;
                    }
                }
            }
        }

        $averages = [];
        foreach ($totals as $key => $total) {
            $avg = round($total / $counts[$key], 2);
            [$dim, $criterion] = explode('.', $key);
            $label = $criteria[$dim][$criterion] ?? $criterion;
            $averages[] = [
                'key' => $key,
                'dimension' => $dim,
                'criterion' => $criterion,
                'label' => $label,
                'avg' => $avg,
                'count' => $counts[$key],
            ];
        }

        usort($averages, fn($a, $b) => $a['avg'] <=> $b['avg']);

        return array_slice($averages, 0, 15);
    }

    /**
     * Analyze what companies need based on low-score reasons.
     */
    private function computeNeedsAnalysis(): array
    {
        $needs = [
            'leadership' => ['count' => 0, 'reasons' => []],
            'data' => ['count' => 0, 'reasons' => []],
            'technology' => ['count' => 0, 'reasons' => []],
            'culture' => ['count' => 0, 'reasons' => []],
            'process' => ['count' => 0, 'reasons' => []],
            'compliance' => ['count' => 0, 'reasons' => []],
        ];

        $surveys = SurveyResponse::whereNotNull('completed_at')->get();

        foreach ($surveys as $survey) {
            foreach (array_keys($needs) as $dim) {
                // Count surveys where dimension average is below 3
                $avg = $survey->{"avg_$dim"};
                if ($avg !== null && $avg < 3.0) {
                    $needs[$dim]['count']++;
                }

                // Collect all low-score reasons
                $reasons = $survey->{"low_reasons_$dim"};
                if (is_array($reasons)) {
                    foreach ($reasons as $reason) {
                        if (!empty($reason)) {
                            $needs[$dim]['reasons'][] = $reason;
                        }
                    }
                }
            }
        }

        // Sort by count descending
        uasort($needs, fn($a, $b) => $b['count'] <=> $a['count']);

        return $needs;
    }

    /**
     * Compute score distribution (histogram).
     */
    private function computeScoreDistribution(): array
    {
        $buckets = [
            '1.0-1.9' => 0,
            '2.0-2.9' => 0,
            '3.0-3.9' => 0,
            '4.0-5.0' => 0,
        ];

        $surveys = SurveyResponse::whereNotNull('completed_at')
            ->whereNotNull('overall_score')
            ->pluck('overall_score');

        foreach ($surveys as $score) {
            if ($score < 2.0) $buckets['1.0-1.9']++;
            elseif ($score < 3.0) $buckets['2.0-2.9']++;
            elseif ($score < 4.0) $buckets['3.0-3.9']++;
            else $buckets['4.0-5.0']++;
        }

        return $buckets;
    }

    /**
     * Map of all criteria keys to labels.
     */
    private function getCriteriaMap(): array
    {
        return [
            'leadership' => [
                'L1' => 'AI Vision',
                'L2' => 'Executive Sponsorship',
                'L3' => 'Strategic Alignment',
                'L4' => 'Investment Commitment',
                'L5' => 'Risk Tolerance',
                'L6' => 'Change Leadership',
                'L7' => 'Industry Awareness',
            ],
            'data' => [
                'D1' => 'Data Availability',
                'D2' => 'Data Quality',
                'D3' => 'Data Accessibility',
                'D4' => 'Data Volume',
                'D5' => 'Data Variety',
                'D6' => 'Data Governance',
                'D7' => 'Data Cataloguing',
                'D8' => 'Data Security',
            ],
            'technology' => [
                'T1' => 'Core Systems',
                'T2' => 'Cloud Readiness',
                'T3' => 'Integration Capability',
                'T4' => 'Computational Resources',
                'T5' => 'Network Infrastructure',
                'T6' => 'Security Posture',
                'T7' => 'IT Support Capability',
            ],
            'culture' => [
                'C1' => 'Digital Literacy',
                'C2' => 'Change Readiness',
                'C3' => 'AI Awareness',
                'C4' => 'Data Literacy',
                'C5' => 'Learning Culture',
                'C6' => 'Innovation Mindset',
                'C7' => 'Collaboration',
                'C8' => 'AI/Data Skills',
            ],
            'process' => [
                'P1' => 'Process Documentation',
                'P2' => 'Process Standardization',
                'P3' => 'Process Measurement',
                'P4' => 'Process Automation',
                'P5' => 'Process Optimization',
                'P6' => 'Process Ownership',
            ],
            'compliance' => [
                'G1' => 'GDPR Awareness',
                'G2' => 'Data Protection Practices',
                'G3' => 'Privacy Policies',
                'G4' => 'EU AI Act Awareness',
                'G5' => 'Governance Framework',
                'G6' => 'Risk Management Practices',
                'G7' => 'Regulatory Monitoring',
            ],
        ];
    }

    /**
     * Export responses as CSV.
     */
    public function export()
    {
        $surveys = SurveyResponse::whereNotNull('completed_at')
            ->orderByDesc('created_at')
            ->get();

        $filename = 'ai-readiness-survey-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($surveys) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, [
                'ID', 'Date', 'Company', 'Size', 'Industry', 'Country',
                'Contact', 'Email', 'Role',
                'Leadership', 'Data', 'Technology', 'Culture', 'Process', 'Compliance',
                'Overall Score', 'Readiness Level', 'Wants Consultation',
            ]);

            foreach ($surveys as $s) {
                fputcsv($file, [
                    $s->id,
                    $s->completed_at?->format('Y-m-d H:i'),
                    $s->company_name,
                    $s->company_size,
                    $s->industry,
                    $s->country,
                    $s->contact_name,
                    $s->contact_email,
                    $s->contact_role,
                    $s->avg_leadership,
                    $s->avg_data,
                    $s->avg_technology,
                    $s->avg_culture,
                    $s->avg_process,
                    $s->avg_compliance,
                    $s->overall_score,
                    $s->readiness_level,
                    $s->wants_consultation ? 'Yes' : 'No',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
