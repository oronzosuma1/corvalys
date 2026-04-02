@extends('layouts.admin')

@section('title', 'Business Survey Response')

@section('content')
    @php
        $sectorLabels = [
            'retail' => 'Retail & E-commerce',
            'manufacturing' => 'Manufacturing',
            'food_hospitality' => 'Food & Hospitality',
            'professional_services' => 'Professional Services',
            'healthcare' => 'Healthcare',
            'construction' => 'Construction & Real Estate',
            'logistics' => 'Logistics & Transport',
            'education' => 'Education & Training',
            'finance' => 'Finance & Insurance',
            'technology' => 'Technology',
            'agriculture' => 'Agriculture',
            'other' => 'Other',
        ];

        $sizeLabels = [
            '1_5' => '1-5 employees',
            '6_20' => '6-20 employees',
            '21_50' => '21-50 employees',
            '51_100' => '51-100 employees',
            '101_250' => '101-250 employees',
            '250_plus' => '250+ employees',
        ];

        $clusterLabels = [
            'admin_automation' => 'Admin Automation',
            'finance_automation' => 'Finance & Invoice',
            'customer_service_automation' => 'Customer Service',
            'sales_automation' => 'Sales Automation',
            'reporting_bi_automation' => 'Reporting & BI',
            'supply_chain_automation' => 'Supply Chain',
            'compliance_automation' => 'Compliance',
            'marketing_automation' => 'Marketing',
        ];

        $clusterColors = [
            'admin_automation' => 'bg-blue-100 text-blue-700',
            'finance_automation' => 'bg-green-100 text-green-700',
            'customer_service_automation' => 'bg-purple-100 text-purple-700',
            'sales_automation' => 'bg-orange-100 text-orange-700',
            'reporting_bi_automation' => 'bg-cyan-100 text-cyan-700',
            'supply_chain_automation' => 'bg-amber-100 text-amber-700',
            'compliance_automation' => 'bg-red-100 text-red-700',
            'marketing_automation' => 'bg-pink-100 text-pink-700',
        ];

        $frustrationLabels = [
            'manual_data_entry' => 'Manual data entry',
            'invoice_processing' => 'Invoice processing',
            'email_management' => 'Email management',
            'scheduling' => 'Scheduling & calendar',
            'report_generation' => 'Report generation',
            'inventory_tracking' => 'Inventory tracking',
            'customer_follow_up' => 'Customer follow-up',
            'document_management' => 'Document management',
            'hr_admin' => 'HR administration',
            'compliance_tracking' => 'Compliance tracking',
            'social_media' => 'Social media management',
            'order_processing' => 'Order processing',
        ];

        $frequencyLabels = [
            'multiple_daily' => 'Multiple times daily',
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
            'rarely' => 'Rarely',
        ];

        $concernLabels = [
            'cost' => 'Cost',
            'complexity' => 'Complexity',
            'data_privacy' => 'Data privacy',
            'job_loss' => 'Job loss concerns',
            'reliability' => 'Reliability',
            'integration' => 'Integration difficulty',
            'lack_of_knowledge' => 'Lack of knowledge',
            'no_concerns' => 'No concerns',
        ];

        $trustLabels = [
            'european_data' => 'European data hosting',
            'gdpr_compliance' => 'GDPR compliance',
            'transparent_pricing' => 'Transparent pricing',
            'human_support' => 'Human support available',
            'free_trial' => 'Free trial period',
            'case_studies' => 'Case studies & references',
            'certifications' => 'Certifications',
        ];

        $supportLabels = [
            'self_service' => 'Self-service',
            'guided_setup' => 'Guided setup',
            'full_managed' => 'Fully managed',
            'consulting_first' => 'Consulting first',
        ];

        $startLabels = [
            'immediately' => 'Immediately',
            'within_3_months' => 'Within 3 months',
            'within_6_months' => 'Within 6 months',
            'within_12_months' => 'Within 12 months',
            'no_timeline' => 'No specific timeline',
        ];

        $readinessLabels = [
            'ready_now' => 'Ready to start now',
            'exploring' => 'Exploring options',
            'need_convincing' => 'Need more convincing',
            'not_ready' => 'Not ready yet',
            'already_using' => 'Already using AI tools',
        ];

        $usageLabels = [
            'none' => 'Not using any AI',
            'basic' => 'Basic tools (ChatGPT, etc.)',
            'some_automation' => 'Some automation in place',
            'advanced' => 'Advanced AI integration',
        ];
    @endphp

    <div class="mb-6">
        <a href="{{ route('admin.business-survey.index') }}" class="text-sm text-primary hover:text-primary-dark font-medium inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            All Responses
        </a>
        <h1 class="text-2xl font-heading font-bold text-gray-900 mt-2">Response #{{ $survey->id }}</h1>
        <p class="text-sm text-gray-500 mt-1">Submitted {{ $survey->created_at?->format('d M Y, H:i') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column (2/3) --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Company Profile --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Company Profile</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Company Size</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $sizeLabels[$survey->company_size] ?? $survey->company_size }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Sector</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $sectorLabels[$survey->sector] ?? $survey->sector }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Country</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $survey->country }}</p>
                    </div>
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Role</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $survey->role }}</p>
                    </div>
                </div>
            </div>

            {{-- Pain Analysis --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Pain Analysis</h3>

                @if($survey->frustration_areas)
                <div class="mb-4">
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Frustration Areas</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach((array) $survey->frustration_areas as $area)
                            <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-full bg-red-50 text-red-700 border border-red-100">
                                {{ $frustrationLabels[$area] ?? str_replace('_', ' ', ucfirst($area)) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($survey->main_pain_driver)
                <div class="mb-4">
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Main Pain Driver</p>
                    <span class="inline-block px-3 py-1.5 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                        {{ $frustrationLabels[$survey->main_pain_driver] ?? str_replace('_', ' ', ucfirst($survey->main_pain_driver)) }}
                    </span>
                </div>
                @endif

                <div class="grid grid-cols-2 gap-4 mb-4">
                    @if($survey->frequency)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Frequency</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $frequencyLabels[$survey->frequency] ?? $survey->frequency }}</p>
                    </div>
                    @endif
                    @if($survey->time_wasted)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Time Wasted</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $survey->time_wasted }}</p>
                    </div>
                    @endif
                </div>

                @if($survey->severity)
                <div>
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Severity</p>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500
                            @if($survey->severity >= 8) bg-red-500
                            @elseif($survey->severity >= 5) bg-amber-500
                            @else bg-blue-500
                            @endif"
                            style="width: {{ ($survey->severity / 10) * 100 }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">{{ $survey->severity }}/10</p>
                </div>
                @endif
            </div>

            {{-- Tasks --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Tasks</h3>

                @if($survey->repetitive_tasks)
                <div class="mb-4">
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Repetitive Tasks</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach((array) $survey->repetitive_tasks as $task)
                            <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                {{ str_replace('_', ' ', ucfirst($task)) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($survey->top_delegate_tasks)
                <div>
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Top Tasks to Delegate</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach((array) $survey->top_delegate_tasks as $task)
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full bg-primary/10 text-primary border border-primary/20">
                                {{ str_replace('_', ' ', ucfirst($task)) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- AI Readiness --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">AI Readiness</h3>

                @if($survey->current_ai_usage)
                <div class="mb-4">
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Current AI Usage</p>
                    <p class="text-sm text-gray-900 mt-1">{{ $usageLabels[$survey->current_ai_usage] ?? $survey->current_ai_usage }}</p>
                </div>
                @endif

                @if($survey->ai_concerns)
                <div class="mb-4">
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Concerns</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach((array) $survey->ai_concerns as $concern)
                            <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                                {{ $concernLabels[$concern] ?? str_replace('_', ' ', ucfirst($concern)) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($survey->readiness_statement)
                <div>
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Readiness Statement</p>
                    <p class="text-sm text-gray-900 mt-1">{{ $readinessLabels[$survey->readiness_statement] ?? $survey->readiness_statement }}</p>
                </div>
                @endif
            </div>

            {{-- Product Interest --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Product Interest</h3>

                @if($survey->preferred_areas)
                <div class="mb-4">
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Preferred Areas</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach((array) $survey->preferred_areas as $area)
                            <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                {{ str_replace('_', ' ', ucfirst($area)) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    @if($survey->support_model)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Support Model</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $supportLabels[$survey->support_model] ?? str_replace('_', ' ', ucfirst($survey->support_model)) }}</p>
                    </div>
                    @endif
                    @if($survey->start_method)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Start Method</p>
                        <p class="text-sm text-gray-900 mt-1">{{ $startLabels[$survey->start_method] ?? str_replace('_', ' ', ucfirst($survey->start_method)) }}</p>
                    </div>
                    @endif
                </div>

                @if($survey->trust_factors)
                <div class="mt-4">
                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Trust Factors</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach((array) $survey->trust_factors as $factor)
                            <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-full bg-green-50 text-green-700 border border-green-100">
                                {{ $trustLabels[$factor] ?? str_replace('_', ' ', ucfirst($factor)) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Right Column (1/3) --}}
        <div class="space-y-6">

            {{-- Scores --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Scores</h3>
                <div class="space-y-5">
                    {{-- Pain Score --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-xs font-semibold text-gray-500">Pain Score</span>
                            <span class="text-sm font-bold
                                @if($survey->pain_score >= 8) text-red-600
                                @elseif($survey->pain_score >= 5) text-amber-600
                                @else text-green-600
                                @endif">{{ number_format($survey->pain_score, 1) }}/10</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500
                                @if($survey->pain_score >= 8) bg-red-500
                                @elseif($survey->pain_score >= 5) bg-amber-500
                                @else bg-green-500
                                @endif"
                                style="width: {{ ($survey->pain_score / 10) * 100 }}%"></div>
                        </div>
                    </div>

                    {{-- Automation Potential --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-xs font-semibold text-gray-500">Automation Potential</span>
                            <span class="text-sm font-bold
                                @if($survey->automation_potential >= 8) text-green-600
                                @elseif($survey->automation_potential >= 5) text-amber-600
                                @else text-red-600
                                @endif">{{ number_format($survey->automation_potential, 1) }}/10</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500
                                @if($survey->automation_potential >= 8) bg-green-500
                                @elseif($survey->automation_potential >= 5) bg-amber-500
                                @else bg-red-500
                                @endif"
                                style="width: {{ ($survey->automation_potential / 10) * 100 }}%"></div>
                        </div>
                    </div>

                    {{-- Commercial Readiness --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-xs font-semibold text-gray-500">Commercial Readiness</span>
                            <span class="text-sm font-bold
                                @if($survey->commercial_readiness >= 8) text-green-600
                                @elseif($survey->commercial_readiness >= 5) text-amber-600
                                @else text-red-600
                                @endif">{{ number_format($survey->commercial_readiness, 1) }}/10</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500
                                @if($survey->commercial_readiness >= 8) bg-green-500
                                @elseif($survey->commercial_readiness >= 5) bg-amber-500
                                @else bg-red-500
                                @endif"
                                style="width: {{ ($survey->commercial_readiness / 10) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Opportunity Clusters --}}
            @if($survey->opportunity_clusters)
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Opportunity Clusters</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach((array) $survey->opportunity_clusters as $cluster)
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full {{ $clusterColors[$cluster] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $clusterLabels[$cluster] ?? str_replace('_', ' ', ucfirst($cluster)) }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Contact (if lead) --}}
            @if($survey->is_lead)
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-green-500"></span>
                    Contact Information
                </h3>
                <div class="space-y-3">
                    @if($survey->contact_name)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Name</p>
                        <p class="text-sm text-gray-900 mt-0.5">{{ $survey->contact_name }}</p>
                    </div>
                    @endif
                    @if($survey->company_name)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Company</p>
                        <p class="text-sm text-gray-900 mt-0.5">{{ $survey->company_name }}</p>
                    </div>
                    @endif
                    @if($survey->contact_email)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Email</p>
                        <p class="text-sm text-gray-900 mt-0.5">{{ $survey->contact_email }}</p>
                    </div>
                    @endif
                    @if($survey->contact_phone)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Phone</p>
                        <p class="text-sm text-gray-900 mt-0.5">{{ $survey->contact_phone }}</p>
                    </div>
                    @endif
                    @if($survey->country)
                    <div>
                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Country</p>
                        <p class="text-sm text-gray-900 mt-0.5">{{ $survey->country }}</p>
                    </div>
                    @endif

                    <div class="pt-3 border-t border-gray-100 space-y-2">
                        <div class="flex items-center gap-2">
                            @if($survey->wants_newsletter)
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            @else
                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-5a1 1 0 112 0 1 1 0 01-2 0zm1-8a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            @endif
                            <span class="text-xs text-gray-600">Newsletter opt-in</span>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($survey->wants_consultation)
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            @else
                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-5a1 1 0 112 0 1 1 0 01-2 0zm1-8a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            @endif
                            <span class="text-xs text-gray-600">Wants consultation</span>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($survey->gdpr_consent)
                                <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            @else
                                <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-5a1 1 0 112 0 1 1 0 01-2 0zm1-8a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            @endif
                            <span class="text-xs text-gray-600">GDPR consent</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
