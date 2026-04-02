<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContattoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:30',
            'service_type' => 'required|in:strategy,development,industry40,compliance,supplychain,llm,general',
            'project_description' => 'required|string|min:20|max:500',
            'budget_range' => 'required|in:under1k,1k-5k,5k-15k,15k-50k,over50k,tbd',
            'gdpr_consent' => 'accepted',
            // Company profile
            'company_size' => 'nullable|string|in:1-10,11-50,51-200,200+',
            'industry' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            // Technology maturity questionnaire
            'uses_erp' => 'nullable|boolean',
            'erp_name' => 'nullable|string|max:100',
            'uses_excel' => 'nullable|boolean',
            'uses_database' => 'nullable|boolean',
            'database_name' => 'nullable|string|max:100',
            'has_it_team' => 'nullable|boolean',
            'it_team_size' => 'nullable|string|max:50',
            'uses_cloud' => 'nullable|boolean',
            'cloud_provider' => 'nullable|string|max:100',
            'has_api_integrations' => 'nullable|boolean',
            'current_ai_usage' => 'nullable|string|in:none,basic,intermediate,advanced',
            // Project details
            'desired_timeline' => 'nullable|string|max:100',
            'pain_points' => 'nullable|string|max:2000',
            'expected_outcomes' => 'nullable|string|max:2000',
            'monthly_volume' => 'nullable|string|max:100',
            // AI Readiness quick assessment
            'readiness_leadership' => 'nullable|integer|between:1,5',
            'readiness_data' => 'nullable|integer|between:1,5',
            'readiness_technology' => 'nullable|integer|between:1,5',
            'readiness_culture' => 'nullable|integer|between:1,5',
            'readiness_process' => 'nullable|integer|between:1,5',
            'readiness_compliance' => 'nullable|integer|between:1,5',
            'readiness_reason_leadership' => 'nullable|string|max:500',
            'readiness_reason_data' => 'nullable|string|max:500',
            'readiness_reason_technology' => 'nullable|string|max:500',
            'readiness_reason_culture' => 'nullable|string|max:500',
            'readiness_reason_process' => 'nullable|string|max:500',
            'readiness_reason_compliance' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'email.required' => 'L\'email è obbligatoria.',
            'email.email' => 'Inserisci un\'email valida.',
            'service_type.required' => 'Seleziona un tipo di servizio.',
            'project_description.required' => 'Descrivi brevemente il progetto.',
            'project_description.min' => 'La descrizione deve essere di almeno 20 caratteri.',
            'budget_range.required' => 'Seleziona un range di budget.',
            'gdpr_consent.accepted' => 'Devi accettare il trattamento dei dati.',
        ];
    }
}
