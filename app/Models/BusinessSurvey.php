<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessSurvey extends Model
{
    protected $fillable = [
        'company_size', 'sector', 'country', 'respondent_role',
        'frustration_areas', 'main_pain_driver', 'pain_frequency',
        'time_wasted_weekly', 'pain_severity',
        'repetitive_tasks', 'top_delegate_tasks', 'preferred_outcome',
        'current_ai_usage', 'ai_concerns', 'readiness_statement',
        'preferred_ai_areas', 'preferred_support_model', 'preferred_start_method',
        'trust_factors',
        'pain_score', 'automation_potential', 'commercial_readiness',
        'opportunity_clusters',
        'contact_name', 'contact_company', 'contact_email', 'contact_phone',
        'contact_country', 'wants_insights', 'wants_solutions_contact',
        'wants_pilot', 'gdpr_consent', 'is_lead',
        'session_id', 'preferred_language', 'completed_at',
    ];

    protected $casts = [
        'frustration_areas' => 'array',
        'repetitive_tasks' => 'array',
        'top_delegate_tasks' => 'array',
        'ai_concerns' => 'array',
        'preferred_ai_areas' => 'array',
        'trust_factors' => 'array',
        'opportunity_clusters' => 'array',
        'pain_severity' => 'integer',
        'pain_score' => 'integer',
        'automation_potential' => 'integer',
        'commercial_readiness' => 'integer',
        'wants_insights' => 'boolean',
        'wants_solutions_contact' => 'boolean',
        'wants_pilot' => 'boolean',
        'gdpr_consent' => 'boolean',
        'is_lead' => 'boolean',
        'completed_at' => 'datetime',
    ];

    // ── Scopes ──

    public function scopeCompleted($q)
    {
        return $q->whereNotNull('completed_at');
    }

    public function scopeLeads($q)
    {
        return $q->where('is_lead', true);
    }

    public function scopeBySector($q, string $sector)
    {
        return $q->where('sector', $sector);
    }

    public function scopeBySize($q, string $size)
    {
        return $q->where('company_size', $size);
    }

    public function scopeByCountry($q, string $country)
    {
        return $q->where('country', $country);
    }

    public function scopeByCluster($q, string $cluster)
    {
        return $q->whereJsonContains('opportunity_clusters', $cluster);
    }

    // ── Scoring ──

    public function computeAllScores(): array
    {
        $data = [
            'pain_score' => $this->calculatePainScore(),
            'automation_potential' => $this->calculateAutomationPotential(),
            'commercial_readiness' => $this->calculateCommercialReadiness(),
            'opportunity_clusters' => $this->computeOpportunityClusters(),
        ];
        $this->update($data);
        return $data;
    }

    public function calculatePainScore(): int
    {
        $score = 0;

        // Pain severity (1-5) → 0-5 points
        $score += $this->pain_severity ?? 0;

        // Frequency → 0-2 points
        $score += match ($this->pain_frequency) {
            'daily' => 2,
            'several_weekly' => 1.5,
            'weekly' => 1,
            'monthly' => 0.5,
            default => 0,
        };

        // Time wasted → 0-3 points
        $score += match ($this->time_wasted_weekly) {
            'over_10h' => 3,
            '5_10h' => 2.5,
            '3_5h' => 2,
            '1_3h' => 1,
            'under_1h' => 0.5,
            default => 0,
        };

        return min((int) round($score), 10);
    }

    public function calculateAutomationPotential(): int
    {
        $score = 0;

        // Number of repetitive tasks (0-4 pts)
        $taskCount = is_array($this->repetitive_tasks) ? count($this->repetitive_tasks) : 0;
        $score += min($taskCount * 0.8, 4);

        // Number of frustration areas (0-3 pts)
        $frustCount = is_array($this->frustration_areas) ? count($this->frustration_areas) : 0;
        $score += min($frustCount * 0.6, 3);

        // Time wasted (0-3 pts)
        $score += match ($this->time_wasted_weekly) {
            'over_10h' => 3,
            '5_10h' => 2.5,
            '3_5h' => 2,
            '1_3h' => 1,
            'under_1h' => 0.5,
            default => 0,
        };

        return min((int) round($score), 10);
    }

    public function calculateCommercialReadiness(): int
    {
        $score = 0;

        // AI usage (0-3)
        $score += match ($this->current_ai_usage) {
            'use_regularly' => 3,
            'use_occasionally' => 2,
            'tried_once' => 1,
            default => 0,
        };

        // Readiness statement (0-3)
        $score += match ($this->readiness_statement) {
            'ready_now' => 3,
            'open_to_it' => 2,
            'curious' => 1,
            default => 0,
        };

        // Has contact info (0-2)
        if ($this->is_lead) $score += 2;

        // Wants contact/pilot (0-2)
        if ($this->wants_solutions_contact) $score += 1;
        if ($this->wants_pilot) $score += 1;

        return min((int) round($score), 10);
    }

    public function computeOpportunityClusters(): array
    {
        $clusters = [];
        $all = array_merge(
            $this->frustration_areas ?? [],
            $this->repetitive_tasks ?? [],
            $this->top_delegate_tasks ?? [],
            $this->preferred_ai_areas ?? []
        );

        $map = [
            'admin_automation' => ['manual_data_entry', 'document_filing', 'scheduling', 'copying_data', 'formatting_documents', 'updating_spreadsheets', 'admin_tasks'],
            'finance_automation' => ['invoice_processing', 'expense_tracking', 'creating_invoices', 'financial_reporting', 'time_billing', 'logging_hours', 'food_costing', 'finance_invoicing'],
            'customer_service_automation' => ['customer_inquiries', 'complaint_handling', 'answering_same_questions', 'customer_returns', 'managing_reservations', 'reservation_mgmt', 'customer_support'],
            'sales_automation' => ['lead_tracking', 'sales_follow_ups', 'proposal_writing', 'sending_reminders', 'client_reporting', 'sales_leads'],
            'reporting_bi_automation' => ['reporting', 'data_analysis', 'writing_status_updates', 'preparing_presentations', 'research_compilation', 'reports_analytics'],
            'supply_chain_automation' => ['inventory_tracking', 'order_processing', 'supply_coordination', 'stock_counting', 'processing_orders', 'tracking_materials', 'shipment_tracking', 'warehouse_mgmt', 'tracking_parcels', 'supplier_ordering', 'ordering_supplies', 'inventory_supply'],
            'compliance_automation' => ['compliance_docs', 'quality_control', 'health_safety', 'safety_reports', 'customs_docs', 'filing_quality_reports', 'maintenance_logs', 'contract_mgmt', 'compliance_documentation'],
            'marketing_automation' => ['social_media', 'email_campaigns', 'marketing_content', 'product_listings', 'email_overload', 'marketing_content_creation'],
        ];

        foreach ($map as $cluster => $keywords) {
            if (count(array_intersect($all, $keywords)) > 0) {
                $clusters[] = $cluster;
            }
        }

        return $clusters;
    }

    // ── Accessors ──

    public function getPainLevelAttribute(): string
    {
        $s = $this->pain_score;
        if ($s === null) return 'N/A';
        return match (true) {
            $s >= 8 => 'Critical',
            $s >= 6 => 'High',
            $s >= 4 => 'Medium',
            $s >= 2 => 'Low',
            default => 'Minimal',
        };
    }

    public function getReadinessLevelAttribute(): string
    {
        $s = $this->commercial_readiness;
        if ($s === null) return 'N/A';
        return match (true) {
            $s >= 8 => 'Hot Lead',
            $s >= 6 => 'Warm',
            $s >= 4 => 'Interested',
            $s >= 2 => 'Curious',
            default => 'Cold',
        };
    }

    public static function sectorLabels(): array
    {
        return [
            'retail' => 'Retail & E-commerce',
            'manufacturing' => 'Manufacturing',
            'logistics' => 'Logistics & Transport',
            'food_hospitality' => 'Food & Hospitality',
            'consulting' => 'Consulting & Professional Services',
            'other' => 'Other',
        ];
    }

    public static function sizeLabels(): array
    {
        return [
            '1_5' => '1-5 employees',
            '6_20' => '6-20 employees',
            '21_50' => '21-50 employees',
            '51_200' => '51-200 employees',
            '200_plus' => '200+ employees',
        ];
    }

    public static function clusterLabels(): array
    {
        return [
            'admin_automation' => 'Admin Automation',
            'finance_automation' => 'Finance & Invoice',
            'customer_service_automation' => 'Customer Service',
            'sales_automation' => 'Sales Follow-up',
            'reporting_bi_automation' => 'Reporting & BI',
            'supply_chain_automation' => 'Supply Chain & Inventory',
            'compliance_automation' => 'Compliance & Documents',
            'marketing_automation' => 'Marketing',
        ];
    }
}
