<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $fillable = [
        'company_name', 'company_size', 'industry', 'country',
        'contact_name', 'contact_email', 'contact_role', 'contact_phone',
        'scores_leadership', 'scores_data', 'scores_technology',
        'scores_culture', 'scores_process', 'scores_compliance',
        'notes_leadership', 'notes_data', 'notes_technology',
        'notes_culture', 'notes_process', 'notes_compliance',
        'low_reasons_leadership', 'low_reasons_data', 'low_reasons_technology',
        'low_reasons_culture', 'low_reasons_process', 'low_reasons_compliance',
        'avg_leadership', 'avg_data', 'avg_technology',
        'avg_culture', 'avg_process', 'avg_compliance',
        'overall_score', 'additional_comments', 'wants_consultation',
        'preferred_language', 'completed_at',
    ];

    protected $casts = [
        'scores_leadership' => 'array',
        'scores_data' => 'array',
        'scores_technology' => 'array',
        'scores_culture' => 'array',
        'scores_process' => 'array',
        'scores_compliance' => 'array',
        'notes_leadership' => 'array',
        'notes_data' => 'array',
        'notes_technology' => 'array',
        'notes_culture' => 'array',
        'notes_process' => 'array',
        'notes_compliance' => 'array',
        'low_reasons_leadership' => 'array',
        'low_reasons_data' => 'array',
        'low_reasons_technology' => 'array',
        'low_reasons_culture' => 'array',
        'low_reasons_process' => 'array',
        'low_reasons_compliance' => 'array',
        'avg_leadership' => 'decimal:1',
        'avg_data' => 'decimal:1',
        'avg_technology' => 'decimal:1',
        'avg_culture' => 'decimal:1',
        'avg_process' => 'decimal:1',
        'avg_compliance' => 'decimal:1',
        'overall_score' => 'decimal:1',
        'wants_consultation' => 'boolean',
        'completed_at' => 'datetime',
    ];

    /**
     * Compute dimension averages from raw scores and set overall_score.
     */
    public function computeAverages(): void
    {
        $dimensions = ['leadership', 'data', 'technology', 'culture', 'process', 'compliance'];

        $total = 0;
        $count = 0;

        foreach ($dimensions as $dim) {
            $scores = $this->{"scores_$dim"};
            if (is_array($scores) && count($scores) > 0) {
                $avg = round(array_sum($scores) / count($scores), 1);
                $this->{"avg_$dim"} = $avg;
                $total += $avg;
                $count++;
            }
        }

        if ($count > 0) {
            $this->overall_score = round($total / $count, 1);
        }
    }

    /**
     * Get readiness level label based on overall score.
     */
    public function getReadinessLevelAttribute(): string
    {
        $score = $this->overall_score;

        if ($score === null) return 'N/A';

        return match (true) {
            $score >= 4.5 => 'Excellent',
            $score >= 3.5 => 'Good',
            $score >= 2.5 => 'Moderate',
            $score >= 1.5 => 'Low',
            default => 'Very Low',
        };
    }

    /**
     * Get readiness color for UI.
     */
    public function getReadinessColorAttribute(): string
    {
        $score = $this->overall_score;

        if ($score === null) return 'gray';

        return match (true) {
            $score >= 4.5 => 'green',
            $score >= 3.5 => 'blue',
            $score >= 2.5 => 'amber',
            $score >= 1.5 => 'orange',
            default => 'red',
        };
    }

    /**
     * Get the weakest dimensions (below 3.0).
     */
    public function getWeakDimensionsAttribute(): array
    {
        $weak = [];
        $labels = [
            'leadership' => 'Leadership & Strategy',
            'data' => 'Data Foundations',
            'technology' => 'Technology Infrastructure',
            'culture' => 'Culture & Skills',
            'process' => 'Process Maturity',
            'compliance' => 'Compliance & Governance',
        ];

        foreach ($labels as $key => $label) {
            $avg = $this->{"avg_$key"};
            if ($avg !== null && $avg < 3.0) {
                $weak[$key] = ['label' => $label, 'score' => $avg];
            }
        }

        uasort($weak, fn($a, $b) => $a['score'] <=> $b['score']);
        return $weak;
    }

    /**
     * Get the strongest dimensions (>= 3.5).
     */
    public function getStrongDimensionsAttribute(): array
    {
        $strong = [];
        $labels = [
            'leadership' => 'Leadership & Strategy',
            'data' => 'Data Foundations',
            'technology' => 'Technology Infrastructure',
            'culture' => 'Culture & Skills',
            'process' => 'Process Maturity',
            'compliance' => 'Compliance & Governance',
        ];

        foreach ($labels as $key => $label) {
            $avg = $this->{"avg_$key"};
            if ($avg !== null && $avg >= 3.5) {
                $strong[$key] = ['label' => $label, 'score' => $avg];
            }
        }

        uasort($strong, fn($a, $b) => $b['score'] <=> $a['score']);
        return $strong;
    }

    public function getCompanySizeLabelAttribute(): string
    {
        return match ($this->company_size) {
            '1-9' => 'Micro (1-9)',
            '10-49' => 'Small (10-49)',
            '50-249' => 'Medium (50-249)',
            '250+' => 'Large (250+)',
            default => $this->company_size,
        };
    }

    /**
     * Collect all low-score reasons across all dimensions.
     */
    public function getAllLowReasons(): array
    {
        $allReasons = [];
        $dimensions = ['leadership', 'data', 'technology', 'culture', 'process', 'compliance'];

        foreach ($dimensions as $dim) {
            $reasons = $this->{"low_reasons_$dim"};
            if (is_array($reasons)) {
                foreach ($reasons as $key => $reason) {
                    if (!empty($reason)) {
                        $allReasons["{$dim}.{$key}"] = $reason;
                    }
                }
            }
        }

        return $allReasons;
    }
}
