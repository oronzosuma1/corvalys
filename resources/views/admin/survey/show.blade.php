@extends('layouts.admin')

@section('title', 'Survey: ' . $survey->company_name)

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('admin.survey.index') }}" class="text-sm text-primary hover:text-primary-dark font-medium mb-2 inline-flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Back to Surveys
            </a>
            <h1 class="text-2xl font-heading font-bold text-gray-900">{{ $survey->company_name }}</h1>
            <p class="text-sm text-gray-500">Submitted {{ $survey->completed_at?->format('d M Y \a\t H:i') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-block px-4 py-1.5 rounded-full text-sm font-bold
                @if($survey->overall_score >= 4.5) bg-green-100 text-green-700
                @elseif($survey->overall_score >= 3.5) bg-blue-100 text-blue-700
                @elseif($survey->overall_score >= 2.5) bg-amber-100 text-amber-700
                @else bg-red-100 text-red-600
                @endif">
                {{ $survey->readiness_level }} &mdash; {{ number_format($survey->overall_score, 1) }}/5.0
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left column: Company Info + Score Summary --}}
        <div class="space-y-6">
            {{-- Company Info --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Company Information</h3>
                <dl class="space-y-3">
                    <div><dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Company</dt><dd class="text-sm text-gray-900 font-medium">{{ $survey->company_name }}</dd></div>
                    <div><dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Size</dt><dd class="text-sm text-gray-700">{{ $survey->company_size_label }}</dd></div>
                    <div><dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Industry</dt><dd class="text-sm text-gray-700">{{ $survey->industry }}</dd></div>
                    @if($survey->country)<div><dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Country</dt><dd class="text-sm text-gray-700">{{ $survey->country }}</dd></div>@endif
                </dl>
            </div>

            {{-- Contact Info --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Contact</h3>
                <dl class="space-y-3">
                    <div><dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Name</dt><dd class="text-sm text-gray-900 font-medium">{{ $survey->contact_name }}</dd></div>
                    <div><dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Email</dt><dd class="text-sm text-primary"><a href="mailto:{{ $survey->contact_email }}">{{ $survey->contact_email }}</a></dd></div>
                    @if($survey->contact_role)<div><dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Role</dt><dd class="text-sm text-gray-700">{{ $survey->contact_role }}</dd></div>@endif
                    @if($survey->contact_phone)<div><dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Phone</dt><dd class="text-sm text-gray-700">{{ $survey->contact_phone }}</dd></div>@endif
                    <div>
                        <dt class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Wants Consultation</dt>
                        <dd class="text-sm">
                            @if($survey->wants_consultation)
                                <span class="text-green-600 font-semibold">Yes</span>
                            @else
                                <span class="text-gray-400">No</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Overall Score --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 text-center">
                <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Overall Score</p>
                <p class="text-5xl font-heading font-bold
                    @if($survey->overall_score >= 4) text-green-600
                    @elseif($survey->overall_score >= 3) text-amber-600
                    @else text-red-500
                    @endif">
                    {{ number_format($survey->overall_score, 1) }}
                </p>
                <p class="text-sm text-gray-500 mt-1">out of 5.0</p>
            </div>
        </div>

        {{-- Right column: Dimension Details --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Dimension Summary Bars --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-5">Dimension Scores</h3>
                @php
                    $dimensions = [
                        'leadership' => ['label' => 'Leadership & Strategy', 'prefix' => 'L', 'criteria' => ['L1' => 'AI Vision', 'L2' => 'Executive Sponsorship', 'L3' => 'Strategic Alignment', 'L4' => 'Investment Commitment', 'L5' => 'Risk Tolerance', 'L6' => 'Change Leadership', 'L7' => 'Industry Awareness']],
                        'data' => ['label' => 'Data Foundations', 'prefix' => 'D', 'criteria' => ['D1' => 'Data Availability', 'D2' => 'Data Quality', 'D3' => 'Data Accessibility', 'D4' => 'Data Volume', 'D5' => 'Data Variety', 'D6' => 'Data Governance', 'D7' => 'Data Cataloguing', 'D8' => 'Data Security']],
                        'technology' => ['label' => 'Technology Infrastructure', 'prefix' => 'T', 'criteria' => ['T1' => 'Core Systems', 'T2' => 'Cloud Readiness', 'T3' => 'Integration Capability', 'T4' => 'Computational Resources', 'T5' => 'Network Infrastructure', 'T6' => 'Security Posture', 'T7' => 'IT Support']],
                        'culture' => ['label' => 'Culture & Skills', 'prefix' => 'C', 'criteria' => ['C1' => 'Digital Literacy', 'C2' => 'Change Readiness', 'C3' => 'AI Awareness', 'C4' => 'Data Literacy', 'C5' => 'Learning Culture', 'C6' => 'Innovation Mindset', 'C7' => 'Collaboration', 'C8' => 'AI/Data Skills']],
                        'process' => ['label' => 'Process Maturity', 'prefix' => 'P', 'criteria' => ['P1' => 'Documentation', 'P2' => 'Standardisation', 'P3' => 'Measurement', 'P4' => 'Automation', 'P5' => 'Optimisation', 'P6' => 'Ownership']],
                        'compliance' => ['label' => 'Compliance & Governance', 'prefix' => 'G', 'criteria' => ['G1' => 'GDPR Awareness', 'G2' => 'Data Protection', 'G3' => 'Privacy Policies', 'G4' => 'EU AI Act', 'G5' => 'Governance Framework', 'G6' => 'Risk Management', 'G7' => 'Regulatory Monitoring']],
                    ];
                @endphp

                <div class="space-y-4">
                    @foreach($dimensions as $dimKey => $dim)
                        @php $avg = $survey->{"avg_$dimKey"}; @endphp
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ $dim['label'] }}</span>
                                <span class="text-sm font-bold
                                    @if($avg >= 4) text-green-600 @elseif($avg >= 3) text-amber-600 @else text-red-500 @endif">
                                    {{ $avg ? number_format($avg, 1) : '—' }}
                                </span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full rounded-full
                                    @if($avg >= 4) bg-green-500 @elseif($avg >= 3) bg-amber-500 @else bg-red-400 @endif"
                                     style="width: {{ $avg ? ($avg / 5) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Detailed Criteria Scores --}}
            @foreach($dimensions as $dimKey => $dim)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">
                        {{ $dim['label'] }}
                        @if($survey->{"avg_$dimKey"})
                            <span class="ml-2 text-xs font-normal px-2 py-0.5 rounded-full
                                @if($survey->{"avg_$dimKey"} >= 4) bg-green-100 text-green-700
                                @elseif($survey->{"avg_$dimKey"} >= 3) bg-amber-100 text-amber-700
                                @else bg-red-100 text-red-600
                                @endif">
                                {{ number_format($survey->{"avg_$dimKey"}, 1) }}/5.0
                            </span>
                        @endif
                    </h3>
                    @php $scores = $survey->{"scores_$dimKey"} ?? []; $notes = $survey->{"notes_$dimKey"} ?? []; $reasons = $survey->{"low_reasons_$dimKey"} ?? []; @endphp

                    <div class="space-y-3">
                        @foreach($dim['criteria'] as $code => $label)
                            @php $score = $scores[$code] ?? null; @endphp
                            <div class="flex items-start gap-3 py-2 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                                <span class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold text-white
                                    @if($score === null) bg-gray-300
                                    @elseif($score <= 2) bg-red-500
                                    @elseif($score <= 3) bg-amber-500
                                    @else bg-green-500
                                    @endif">
                                    {{ $score ?? '—' }}
                                </span>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold text-gray-400">{{ $code }}</span>
                                        <span class="text-sm text-gray-700">{{ $label }}</span>
                                    </div>
                                    @if(!empty($notes[$code]))
                                        <p class="text-xs text-gray-500 mt-1 italic">{{ $notes[$code] }}</p>
                                    @endif
                                    @if(!empty($reasons[$code]))
                                        <p class="text-xs text-red-500 mt-1">
                                            <span class="font-semibold">Low score reason:</span> {{ $reasons[$code] }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{-- Additional Comments --}}
            @if($survey->additional_comments)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-heading font-semibold text-gray-900 mb-3">Additional Comments</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $survey->additional_comments }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
