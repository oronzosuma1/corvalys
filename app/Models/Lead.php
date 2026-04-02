<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'email',
        'company',
        'phone',
        'service_type',
        'project_description',
        'budget_range',
        'status',
        'urgency',
        'internal_notes',
        'quoted_min',
        'quoted_max',
        'quoted_confidence',
        'claude_assessment',
        'source',
        'contacted_at',
        // Company profile
        'company_size',
        'industry',
        'country',
        'website',
        // Technology maturity questionnaire
        'uses_erp',
        'erp_name',
        'uses_excel',
        'uses_database',
        'database_name',
        'has_it_team',
        'it_team_size',
        'uses_cloud',
        'cloud_provider',
        'has_api_integrations',
        'current_ai_usage',
        'tech_maturity_score',
        // AI Readiness assessment
        'readiness_scores',
        'readiness_reasons',
        'readiness_overall',
        // Project details
        'desired_timeline',
        'pain_points',
        'expected_outcomes',
        'monthly_volume',
        // AI auto-assessment
        'claude_auto_assessment',
        'claude_auto_assessed_at',
        // Proposal
        'proposal_pdf_path',
        'proposal_status',
        'proposal_sent_at',
        'proposal_approved_at',
        'proposal_language',
    ];

    protected $casts = [
        'claude_assessment' => 'array',
        'contacted_at' => 'datetime',
        'uses_erp' => 'boolean',
        'uses_excel' => 'boolean',
        'uses_database' => 'boolean',
        'has_it_team' => 'boolean',
        'uses_cloud' => 'boolean',
        'has_api_integrations' => 'boolean',
        'tech_maturity_score' => 'integer',
        'readiness_scores' => 'array',
        'readiness_reasons' => 'array',
        'readiness_overall' => 'decimal:1',
        'claude_auto_assessment' => 'array',
        'claude_auto_assessed_at' => 'datetime',
        'proposal_sent_at' => 'datetime',
        'proposal_approved_at' => 'datetime',
    ];

    public function quotationAssessments(): HasMany
    {
        return $this->hasMany(QuotationAssessment::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['lost', 'spam']);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'new' => 'Nuovo',
            'contacted' => 'Contattato',
            'in_proposta' => 'In proposta',
            'converted' => 'Convertito',
            'lost' => 'Perso',
            'spam' => 'Spam',
            default => $this->status,
        };
    }

    public function getBudgetLabelAttribute(): string
    {
        return match ($this->budget_range) {
            'under1k' => 'Meno di 1.000 €',
            '1k-5k' => '1.000 € - 5.000 €',
            '5k-15k' => '5.000 € - 15.000 €',
            '15k-50k' => '15.000 € - 50.000 €',
            'over50k' => 'Oltre 50.000 €',
            'tbd' => 'Da definire',
            default => $this->budget_range,
        };
    }

    public function getTechMaturityLabel(): string
    {
        $score = $this->tech_maturity_score;

        if ($score === null) {
            return 'N/A';
        }

        return match (true) {
            $score >= 1 && $score <= 3 => 'Low',
            $score >= 4 && $score <= 6 => 'Medium',
            $score >= 7 && $score <= 10 => 'High',
            default => 'N/A',
        };
    }

    /**
     * Compute readiness overall from dimension scores.
     */
    public function computeReadinessOverall(): ?float
    {
        $scores = $this->readiness_scores;
        if (!is_array($scores) || empty($scores)) return null;

        $vals = array_filter($scores, fn($v) => $v > 0);
        if (empty($vals)) return null;

        return round(array_sum($vals) / count($vals), 1);
    }

    /**
     * Get readiness level label.
     */
    public function getReadinessLevelAttribute(): string
    {
        $score = $this->readiness_overall;
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
        $score = $this->readiness_overall;
        if ($score === null) return 'gray';

        return match (true) {
            $score >= 4.0 => 'green',
            $score >= 3.0 => 'amber',
            $score >= 2.0 => 'orange',
            default => 'red',
        };
    }

    /**
     * Check if readiness implies training is needed (score < 3.0 in any dimension).
     */
    public function needsTraining(): bool
    {
        $scores = $this->readiness_scores;
        if (!is_array($scores)) return false;

        foreach ($scores as $score) {
            if ($score > 0 && $score < 3) return true;
        }
        return false;
    }

    public function calculateTechMaturityScore(): int
    {
        $score = 0;

        if ($this->uses_erp) {
            $score += 2;
        }
        if ($this->uses_database) {
            $score += 1;
        }
        if ($this->has_it_team) {
            $score += 2;
        }
        if ($this->uses_cloud) {
            $score += 1;
        }
        if ($this->has_api_integrations) {
            $score += 2;
        }

        $score += match ($this->current_ai_usage) {
            'basic' => 1,
            'intermediate' => 2,
            'advanced' => 3,
            default => 0,
        };

        return min($score, 10);
    }
}
