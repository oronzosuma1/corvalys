@extends('layouts.admin')

@section('title', 'Lead: ' . $lead->name)

@section('content')
    {{-- Back link --}}
    <div class="mb-6">
        <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Torna ai lead
        </a>
    </div>

    {{-- Top Bar --}}
    <div class="bg-white rounded-xl border border-gray-200/60 p-5 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div>
                    <h1 class="text-xl font-heading font-bold text-gray-900">{{ $lead->name }}</h1>
                    <p class="text-sm text-gray-500">{{ $lead->company ?? 'No company' }} &middot; {{ $lead->created_at->format('d/m/Y H:i') }}</p>
                </div>
                @php
                    $statusColors = [
                        'new' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'contacted' => 'bg-amber-100 text-amber-700 border-amber-200',
                        'in_proposta' => 'bg-purple-100 text-purple-700 border-purple-200',
                        'converted' => 'bg-green-100 text-green-700 border-green-200',
                        'lost' => 'bg-gray-100 text-gray-600 border-gray-200',
                        'spam' => 'bg-red-100 text-red-700 border-red-200',
                    ];
                    $color = $statusColors[$lead->status] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $color }}">{{ $lead->status_label }}</span>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('proposalModal').classList.remove('hidden')"
                    class="inline-flex items-center px-4 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Invia proposta
                </button>
                <a href="{{ route('admin.quotazione.show', $lead) }}"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-dark to-navy text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    Genera quotazione
                </a>
            </div>
        </div>
    </div>

    {{-- Status Update Bar --}}
    <div class="bg-white rounded-xl border border-gray-200/60 p-4 mb-6">
        <form method="POST" action="{{ route('admin.leads.update', $lead) }}" class="flex flex-wrap items-end gap-4">
            @csrf
            @method('PATCH')
            <div>
                <label for="status" class="block text-xs font-medium text-gray-500 mb-1">Stato</label>
                <select name="status" id="status" class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="in_proposta" {{ $lead->status === 'in_proposta' ? 'selected' : '' }}>In proposta</option>
                    <option value="converted" {{ $lead->status === 'converted' ? 'selected' : '' }}>Converted</option>
                    <option value="lost" {{ $lead->status === 'lost' ? 'selected' : '' }}>Lost</option>
                    <option value="spam" {{ $lead->status === 'spam' ? 'selected' : '' }}>Spam</option>
                </select>
            </div>
            <div>
                <label for="urgency" class="block text-xs font-medium text-gray-500 mb-1">Urgenza</label>
                <select name="urgency" id="urgency" class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="bassa" {{ $lead->urgency === 'bassa' ? 'selected' : '' }}>Bassa</option>
                    <option value="media" {{ $lead->urgency === 'media' ? 'selected' : '' }}>Media</option>
                    <option value="alta" {{ $lead->urgency === 'alta' ? 'selected' : '' }}>Alta</option>
                    <option value="urgente" {{ $lead->urgency === 'urgente' ? 'selected' : '' }}>Urgente</option>
                </select>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                Aggiorna
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Section 1: Client Information --}}
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Informazioni cliente</h2>
                </div>
                <div class="p-5">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Nome</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</dt>
                            <dd class="mt-1 text-sm"><a href="mailto:{{ $lead->email }}" class="text-primary hover:text-primary-dark">{{ $lead->email }}</a></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Telefono</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->phone ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Azienda</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->company ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Website</dt>
                            <dd class="mt-1 text-sm">
                                @if($lead->website)
                                    <a href="{{ $lead->website }}" target="_blank" class="text-primary hover:text-primary-dark">{{ $lead->website }}</a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Dimensione azienda</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->company_size ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Settore</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->industry ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Paese</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->country ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Section 2: Technology Maturity --}}
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Maturita tecnologica</h2>
                </div>
                <div class="p-5">
                    @php
                        $score = $lead->tech_maturity_score;
                        $label = $lead->getTechMaturityLabel();
                        $scoreColor = match($label) {
                            'Low' => 'bg-red-500',
                            'Medium' => 'bg-amber-500',
                            'High' => 'bg-green-500',
                            default => 'bg-gray-300',
                        };
                        $labelColor = match($label) {
                            'Low' => 'text-red-700 bg-red-100',
                            'Medium' => 'text-amber-700 bg-amber-100',
                            'High' => 'text-green-700 bg-green-100',
                            default => 'text-gray-500 bg-gray-100',
                        };
                    @endphp

                    {{-- Score Bar --}}
                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Score: {{ $score ?? 'N/A' }}/10</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $labelColor }}">{{ $label }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="{{ $scoreColor }} h-3 rounded-full transition-all duration-300" style="width: {{ ($score ?? 0) * 10 }}%"></div>
                        </div>
                    </div>

                    {{-- Tech Items Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @php
                            $techItems = [
                                ['label' => 'ERP', 'value' => $lead->uses_erp, 'detail' => $lead->erp_name],
                                ['label' => 'Excel', 'value' => $lead->uses_excel, 'detail' => null],
                                ['label' => 'Database', 'value' => $lead->uses_database, 'detail' => $lead->database_name],
                                ['label' => 'Team IT', 'value' => $lead->has_it_team, 'detail' => $lead->it_team_size ? $lead->it_team_size . ' persone' : null],
                                ['label' => 'Cloud', 'value' => $lead->uses_cloud, 'detail' => $lead->cloud_provider],
                                ['label' => 'API Integrations', 'value' => $lead->has_api_integrations, 'detail' => null],
                            ];
                        @endphp

                        @foreach($techItems as $item)
                            <div class="flex items-center gap-2 py-1.5">
                                @if($item['value'])
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                @endif
                                <span class="text-sm text-gray-700">{{ $item['label'] }}</span>
                                @if($item['detail'])
                                    <span class="text-xs text-gray-400">({{ $item['detail'] }})</span>
                                @endif
                            </div>
                        @endforeach

                        <div class="flex items-center gap-2 py-1.5 sm:col-span-2">
                            <svg class="w-5 h-5 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="text-sm text-gray-700">Uso AI: <span class="font-medium">{{ ucfirst($lead->current_ai_usage ?? 'none') }}</span></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2b: AI Readiness Assessment --}}
            @if($lead->readiness_scores && count($lead->readiness_scores))
                <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-emerald-50">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-heading font-semibold text-gray-900">AI Readiness Assessment</h2>
                            <div class="flex items-center gap-2">
                                @if($lead->readiness_overall)
                                    @php
                                        $rColor = match($lead->readiness_color) {
                                            'green' => 'bg-green-100 text-green-700 border-green-200',
                                            'amber' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            'orange' => 'bg-orange-100 text-orange-700 border-orange-200',
                                            'red' => 'bg-red-100 text-red-700 border-red-200',
                                            default => 'bg-gray-100 text-gray-600 border-gray-200',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $rColor }}">
                                        {{ $lead->readiness_level }} ({{ $lead->readiness_overall }}/5)
                                    </span>
                                @endif
                                @if($lead->needsTraining())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700 border border-red-200">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                        Training Required
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        {{-- Overall Score Bar --}}
                        @if($lead->readiness_overall)
                            <div class="mb-5">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Overall: {{ $lead->readiness_overall }}/5.0</span>
                                    <span class="text-xs text-gray-400">{{ $lead->readiness_level }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="h-3 rounded-full transition-all duration-300 {{ match($lead->readiness_color) { 'green' => 'bg-green-500', 'amber' => 'bg-amber-500', 'orange' => 'bg-orange-500', 'red' => 'bg-red-500', default => 'bg-gray-400' } }}"
                                        style="width: {{ ($lead->readiness_overall / 5) * 100 }}%"></div>
                                </div>
                            </div>
                        @endif

                        {{-- Dimension Scores --}}
                        @php
                            $dimensionLabels = [
                                'leadership' => ['Leadership & Strategy', 'bg-blue-500'],
                                'data' => ['Data Foundations', 'bg-indigo-500'],
                                'technology' => ['Technology', 'bg-purple-500'],
                                'culture' => ['Culture & Skills', 'bg-teal-500'],
                                'process' => ['Process Maturity', 'bg-amber-500'],
                                'compliance' => ['Compliance', 'bg-red-500'],
                            ];
                            $scores = $lead->readiness_scores;
                            $reasons = $lead->readiness_reasons ?? [];
                        @endphp

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($dimensionLabels as $dimKey => [$dimLabel, $barColor])
                                @if(isset($scores[$dimKey]))
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <div class="flex items-center justify-between mb-1.5">
                                            <span class="text-xs font-medium text-gray-700">{{ $dimLabel }}</span>
                                            <span class="text-xs font-bold {{ $scores[$dimKey] >= 4 ? 'text-green-600' : ($scores[$dimKey] >= 3 ? 'text-amber-600' : 'text-red-600') }}">
                                                {{ $scores[$dimKey] }}/5
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="{{ $barColor }} h-2 rounded-full" style="width: {{ ($scores[$dimKey] / 5) * 100 }}%"></div>
                                        </div>
                                        @if(isset($reasons[$dimKey]) && $reasons[$dimKey])
                                            <p class="mt-1.5 text-xs text-red-600 italic">{{ $reasons[$dimKey] }}</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        {{-- Training Notice --}}
                        @if($lead->needsTraining())
                            <div class="mt-4 p-3 bg-red-50 border border-red-100 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                    <div>
                                        <p class="text-sm font-medium text-red-800">Training necessario</p>
                                        <p class="text-xs text-red-600 mt-0.5">Uno o piu dimensioni hanno score &lt; 3. La proposta dovrebbe includere formazione/training specifico.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Section 3: Project Details --}}
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Dettagli progetto</h2>
                </div>
                <div class="p-5">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Tipo servizio</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($lead->service_type)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">{{ $lead->service_type }}</span>
                                @else
                                    -
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Budget</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->budget_label }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Timeline</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->desired_timeline ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Volume mensile</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $lead->monthly_volume ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Descrizione progetto</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $lead->project_description ?? '-' }}</dd>
                        </div>
                        @if($lead->pain_points)
                            <div class="sm:col-span-2">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Pain points</dt>
                                <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $lead->pain_points }}</dd>
                            </div>
                        @endif
                        @if($lead->expected_outcomes)
                            <div class="sm:col-span-2">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Risultati attesi</dt>
                                <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $lead->expected_outcomes }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            {{-- Section 4: AI Auto-Assessment --}}
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-heading font-semibold text-gray-900">AI Auto-Assessment</h2>
                        @if($lead->claude_auto_assessed_at)
                            <span class="text-xs text-gray-400">{{ $lead->claude_auto_assessed_at->format('d/m/Y H:i') }}</span>
                        @endif
                    </div>
                </div>
                <div class="p-5">
                    @if($lead->claude_auto_assessment)
                        @php $aa = $lead->claude_auto_assessment; @endphp

                        {{-- Cost & Hours Summary --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                            <div class="bg-primary-light rounded-lg p-4 text-center">
                                <p class="text-xs font-medium text-primary-dark/60 uppercase">Costo stimato</p>
                                <p class="text-lg font-heading font-bold text-primary-dark mt-1">
                                    EUR {{ number_format($aa['estimated_cost_min'] ?? 0, 0, ',', '.') }} - {{ number_format($aa['estimated_cost_max'] ?? 0, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-primary-dark/50 mt-1">{{ $aa['hourly_rate'] ?? '-' }} EUR/h</p>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-4 text-center">
                                <p class="text-xs font-medium text-blue-700/60 uppercase">Ore stimate</p>
                                <p class="text-lg font-heading font-bold text-blue-700 mt-1">
                                    {{ $aa['estimated_hours_min'] ?? '-' }} - {{ $aa['estimated_hours_max'] ?? '-' }}h
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <p class="text-xs font-medium text-gray-500 uppercase">Complessita / Fattibilita</p>
                                <p class="text-lg font-heading font-bold text-gray-900 mt-1">
                                    {{ $aa['complexity'] ?? '-' }}/5 &middot;
                                    <span class="@if(($aa['feasibility'] ?? '') === 'alta') text-green-600 @elseif(($aa['feasibility'] ?? '') === 'media') text-amber-600 @else text-red-600 @endif">
                                        {{ ucfirst($aa['feasibility'] ?? '-') }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        {{-- Details --}}
                        <div class="space-y-4">
                            @if(isset($aa['recommended_service_type']))
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Servizio consigliato</p>
                                    <p class="text-sm text-gray-900 mt-1">{{ $aa['recommended_service_type'] }}</p>
                                </div>
                            @endif

                            @if(isset($aa['tech_readiness_assessment']))
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Tech Readiness</p>
                                    <p class="text-sm text-gray-900 mt-1">{{ $aa['tech_readiness_assessment'] }}</p>
                                </div>
                            @endif

                            @if(isset($aa['suggested_approach']))
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Approccio suggerito</p>
                                    <p class="text-sm text-gray-900 mt-1 whitespace-pre-line">{{ $aa['suggested_approach'] }}</p>
                                </div>
                            @endif

                            @if(isset($aa['risks']) && count($aa['risks']))
                                <div>
                                    <p class="text-xs font-medium text-red-500 uppercase mb-2">Rischi</p>
                                    <ul class="space-y-1">
                                        @foreach($aa['risks'] as $risk)
                                            <li class="flex items-start gap-2 text-sm text-red-700">
                                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                                {{ $risk }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(isset($aa['next_steps']) && count($aa['next_steps']))
                                <div>
                                    <p class="text-xs font-medium text-green-600 uppercase mb-2">Prossimi passi</p>
                                    <ul class="space-y-1">
                                        @foreach($aa['next_steps'] as $step)
                                            <li class="flex items-start gap-2 text-sm text-green-700">
                                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $step }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        {{-- Re-assess button --}}
                        <div class="mt-5 pt-4 border-t border-gray-100">
                            <form method="POST" action="{{ route('admin.leads.auto-assess', $lead) }}" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    Rigenera auto-assessment
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-gray-500 mb-4">Nessun auto-assessment disponibile</p>
                            <form method="POST" action="{{ route('admin.leads.auto-assess', $lead) }}" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    Genera auto-assessment
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Section 5: Manual Quotation --}}
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Quotazione manuale</h2>
                </div>
                <div class="p-5">
                    @if(isset($lastAssessment) && $lastAssessment)
                        @php $result = $lastAssessment->result ?? []; @endphp
                        <div class="mb-4">
                            <div class="flex items-center justify-center gap-4 mb-4">
                                <div class="text-center">
                                    <p class="text-2xl font-heading font-bold text-primary-dark">EUR {{ number_format($result['min_eur'] ?? 0, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-400">Minimo</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                <div class="text-center">
                                    <p class="text-2xl font-heading font-bold text-navy">EUR {{ number_format($result['max_eur'] ?? 0, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-400">Massimo</p>
                                </div>
                            </div>
                            @if(isset($result['confidence']))
                                <div class="text-center mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-light text-primary-dark">Confidenza: {{ $result['confidence'] }}</span>
                                </div>
                            @endif
                            <p class="text-xs text-gray-400 text-center">Generata il {{ $lastAssessment->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        @if(isset($result['breakdown']) && $result['breakdown'])
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                                @foreach(['analisi' => 'Analisi', 'sviluppo' => 'Sviluppo', 'pm' => 'PM', 'testing' => 'Testing'] as $key => $lbl)
                                    @if(isset($result['breakdown'][$key]))
                                        <div class="bg-gray-50 rounded-lg p-2 text-center">
                                            <p class="text-xs text-gray-500">{{ $lbl }}</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $result['breakdown'][$key] }}%</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <div class="text-center pt-3 border-t border-gray-100">
                            <a href="{{ route('admin.quotazione.show', $lead) }}" class="inline-flex items-center text-sm text-primary hover:text-primary-dark font-medium">
                                Rigenera quotazione manuale &rarr;
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-400 mb-3">Nessuna quotazione manuale generata</p>
                            <a href="{{ route('admin.quotazione.show', $lead) }}"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-dark to-navy text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                Genera quotazione manuale
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-6">

            {{-- Section 6: Internal Notes --}}
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Note interne</h2>
                </div>
                <div class="p-5 space-y-3">
                    @if($lead->internal_notes)
                        @foreach(array_reverse(explode("\n\n", $lead->internal_notes)) as $note)
                            @if(trim($note))
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-sm text-gray-700 whitespace-pre-line">{{ $note }}</p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="text-sm text-gray-400">Nessuna nota</p>
                    @endif

                    <form method="POST" action="{{ route('admin.leads.nota', $lead) }}" class="mt-4">
                        @csrf
                        <textarea name="nota" rows="3" placeholder="Aggiungi una nota..."
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none"></textarea>
                        <button type="submit" class="mt-2 inline-flex items-center px-3 py-1.5 bg-primary-dark text-white text-xs font-medium rounded-lg hover:bg-primary transition-colors">
                            Aggiungi nota
                        </button>
                    </form>
                </div>
            </div>

            {{-- Section 7: Proposal --}}
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Proposta</h2>
                </div>
                <div class="p-5">
                    <button onclick="document.getElementById('proposalModal').classList.remove('hidden')"
                        class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Invia proposta al cliente
                    </button>
                </div>
            </div>

            {{-- Section 8: PDF Proposal --}}
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-teal-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-heading font-semibold text-gray-900">PDF Proposal</h2>
                        @if($lead->proposal_status)
                            @php
                                $proposalStatusColors = [
                                    'draft' => 'bg-gray-100 text-gray-600 border-gray-200',
                                    'sent' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'approved' => 'bg-green-100 text-green-700 border-green-200',
                                    'rejected' => 'bg-red-100 text-red-700 border-red-200',
                                ];
                                $pColor = $proposalStatusColors[$lead->proposal_status] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $pColor }}">
                                {{ ucfirst($lead->proposal_status) }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="p-5 space-y-4">
                    {{-- Generate PDF Form --}}
                    <form method="POST" action="{{ route('admin.leads.proposal.generate', $lead) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="proposal_language" class="block text-xs font-medium text-gray-500 mb-1">Lingua proposta</label>
                            <select name="language" id="proposal_language" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                                <option value="en" {{ ($lead->proposal_language ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                                <option value="it" {{ ($lead->proposal_language ?? 'en') === 'it' ? 'selected' : '' }}>Italiano</option>
                                <option value="fr" {{ ($lead->proposal_language ?? 'en') === 'fr' ? 'selected' : '' }}>Francais</option>
                                <option value="de" {{ ($lead->proposal_language ?? 'en') === 'de' ? 'selected' : '' }}>Deutsch</option>
                                <option value="es" {{ ($lead->proposal_language ?? 'en') === 'es' ? 'selected' : '' }}>Espanol</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-primary-dark to-navy text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            {{ $lead->proposal_pdf_path ? 'Rigenera PDF' : 'Genera PDF' }}
                        </button>
                    </form>

                    {{-- Actions (visible only if PDF exists) --}}
                    @if($lead->proposal_pdf_path)
                        <div class="border-t border-gray-100 pt-4 space-y-2">
                            {{-- Download --}}
                            <a href="{{ route('admin.leads.proposal.download', $lead) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Scarica PDF
                            </a>

                            {{-- Send to Client --}}
                            <form method="POST" action="{{ route('admin.leads.proposal.send', $lead) }}">
                                @csrf
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    Invia PDF al cliente
                                </button>
                            </form>

                            {{-- Approve --}}
                            @if($lead->proposal_status !== 'approved')
                                <form method="POST" action="{{ route('admin.leads.proposal.approve', $lead) }}">
                                    @csrf
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Approva e invia
                                    </button>
                                </form>
                            @endif

                            {{-- Status details --}}
                            <div class="text-xs text-gray-400 pt-2 space-y-1">
                                @if($lead->proposal_sent_at)
                                    <p>Inviata: {{ $lead->proposal_sent_at->format('d/m/Y H:i') }}</p>
                                @endif
                                @if($lead->proposal_approved_at)
                                    <p>Approvata: {{ $lead->proposal_approved_at->format('d/m/Y H:i') }}</p>
                                @endif
                                @if($lead->proposal_language)
                                    <p>Lingua: {{ strtoupper($lead->proposal_language) }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Proposal Modal --}}
    <div id="proposalModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('proposalModal').classList.add('hidden')"></div>

            <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full mx-auto z-10">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-heading font-semibold text-gray-900">Invia proposta a {{ $lead->name }}</h3>
                    <button onclick="document.getElementById('proposalModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form method="POST" action="{{ route('admin.leads.proposal', $lead) }}" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label for="proposal_subject" class="block text-xs font-medium text-gray-500 mb-1">Oggetto</label>
                        <input type="text" name="subject" id="proposal_subject"
                            value="Proposta Corvalys per {{ $lead->company ?? $lead->name }} - {{ ucfirst($lead->service_type ?? 'consulenza') }}"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>

                    <div>
                        <label for="proposal_body" class="block text-xs font-medium text-gray-500 mb-1">Messaggio</label>
                        <textarea name="body" id="proposal_body" rows="12"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">Gentile {{ $lead->name }},

grazie per averci contattato. Dopo un'attenta analisi del progetto descritto, siamo lieti di presentarle la nostra proposta.

@if($lead->claude_auto_assessment)
@php $aa = $lead->claude_auto_assessment; @endphp
Sulla base della nostra analisi preliminare, stimiamo:
- Ore di lavoro: {{ $aa['estimated_hours_min'] ?? '-' }} - {{ $aa['estimated_hours_max'] ?? '-' }} ore
- Investimento: EUR {{ number_format($aa['estimated_cost_min'] ?? 0, 0, ',', '.') }} - {{ number_format($aa['estimated_cost_max'] ?? 0, 0, ',', '.') }}

{{ $aa['suggested_approach'] ?? '' }}
@endif

Restiamo a disposizione per un incontro di approfondimento.

Cordiali saluti,
Enzo - Corvalys</textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="include_assessment" id="include_assessment" value="1"
                            class="rounded border-gray-300 text-primary focus:ring-primary" {{ $lead->claude_auto_assessment ? 'checked' : '' }}>
                        <label for="include_assessment" class="text-sm text-gray-600">Includi dettagli assessment nell'email</label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="document.getElementById('proposalModal').classList.add('hidden')"
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                            Annulla
                        </button>
                        <button type="submit" class="inline-flex items-center px-5 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Invia proposta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
