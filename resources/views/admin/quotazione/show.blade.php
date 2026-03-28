@extends('layouts.admin')

@section('title', 'Quotazione: ' . $lead->name)

@section('content')
    {{-- Back link --}}
    <div class="mb-6">
        <a href="{{ route('admin.leads.show', $lead) }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Torna al lead
        </a>
    </div>

    @if(isset($lastAssessment) && $lastAssessment)
        {{-- Results --}}
        <div class="space-y-6">
            {{-- Price Range --}}
            <div class="bg-white rounded-xl border border-gray-200/60 p-6">
                <div class="text-center mb-6">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Range stimato</p>
                    <div class="flex items-center justify-center gap-4">
                        <div>
                            <p class="text-3xl font-heading font-bold text-primary-dark">EUR {{ number_format($lastAssessment->min_eur ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">Minimo</p>
                        </div>
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        <div>
                            <p class="text-3xl font-heading font-bold text-navy">EUR {{ number_format($lastAssessment->max_eur ?? 0, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-400">Massimo</p>
                        </div>
                    </div>
                    @if(isset($lastAssessment->confidence))
                        <div class="mt-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-light text-primary-dark">
                                Confidenza: {{ $lastAssessment->confidence }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Breakdown --}}
            @if(isset($lastAssessment->breakdown) && $lastAssessment->breakdown)
                <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="text-sm font-heading font-semibold text-gray-900">Breakdown costi</h2>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @foreach(['analisi' => 'Analisi', 'sviluppo' => 'Sviluppo', 'pm' => 'Project Management', 'testing' => 'Testing'] as $key => $label)
                                @if(isset($lastAssessment->breakdown[$key]))
                                    <div class="bg-gray-50 rounded-lg p-3 text-center">
                                        <p class="text-xs font-medium text-gray-500">{{ $label }}</p>
                                        <p class="text-lg font-heading font-bold text-gray-900 mt-1">{{ $lastAssessment->breakdown[$key] }}%</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            {{-- Warnings & Strengths --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(isset($lastAssessment->warnings) && count($lastAssessment->warnings))
                    <div class="bg-white rounded-xl border border-red-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-red-100 bg-red-50">
                            <h2 class="text-sm font-heading font-semibold text-red-700">Warnings</h2>
                        </div>
                        <div class="p-5">
                            <ul class="space-y-2">
                                @foreach($lastAssessment->warnings as $warning)
                                    <li class="flex items-start gap-2 text-sm text-red-700">
                                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                        {{ $warning }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if(isset($lastAssessment->strengths) && count($lastAssessment->strengths))
                    <div class="bg-white rounded-xl border border-green-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-green-100 bg-green-50">
                            <h2 class="text-sm font-heading font-semibold text-green-700">Punti di forza</h2>
                        </div>
                        <div class="p-5">
                            <ul class="space-y-2">
                                @foreach($lastAssessment->strengths as $strength)
                                    <li class="flex items-start gap-2 text-sm text-green-700">
                                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $strength }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Negotiation Notes --}}
            @if(isset($lastAssessment->negotiation_notes) && $lastAssessment->negotiation_notes)
                <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="text-sm font-heading font-semibold text-gray-900">Note negoziazione</h2>
                    </div>
                    <div class="p-5 text-sm text-gray-700 whitespace-pre-line">{{ $lastAssessment->negotiation_notes }}</div>
                </div>
            @endif

            {{-- Proposal Highlights --}}
            @if(isset($lastAssessment->proposal_highlights) && $lastAssessment->proposal_highlights)
                <div class="bg-white rounded-xl border border-primary/20 overflow-hidden">
                    <div class="px-5 py-4 border-b border-primary/10 bg-primary-light">
                        <h2 class="text-sm font-heading font-semibold text-primary-dark">Highlights proposta</h2>
                    </div>
                    <div class="p-5 text-sm text-gray-700 whitespace-pre-line">{{ $lastAssessment->proposal_highlights }}</div>
                </div>
            @endif

            {{-- Generate Again --}}
            <div class="text-center">
                <p class="text-xs text-gray-400 mb-3">Generata il {{ $lastAssessment->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    @endif

    {{-- Quotation Form --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden {{ isset($lastAssessment) && $lastAssessment ? 'mt-8' : '' }}">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-heading font-semibold text-gray-900">
                {{ isset($lastAssessment) && $lastAssessment ? 'Rigenera quotazione' : 'Genera quotazione con Claude AI' }}
            </h2>
        </div>
        <form method="POST" action="{{ route('admin.quotazione.generate', $lead) }}" class="p-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- Service Type --}}
                <div>
                    <label for="service_type" class="block text-xs font-medium text-gray-500 mb-1">Tipo servizio</label>
                    <select name="service_type" id="service_type" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="consulenza">Consulenza</option>
                        <option value="sviluppo">Sviluppo software</option>
                        <option value="ai-integration">Integrazione AI</option>
                        <option value="formazione">Formazione</option>
                        <option value="audit">Audit & Assessment</option>
                    </select>
                </div>

                {{-- Sector --}}
                <div>
                    <label for="sector" class="block text-xs font-medium text-gray-500 mb-1">Settore</label>
                    <input type="text" name="sector" id="sector" value="{{ $lead->company ?? '' }}" placeholder="es. manifattura, servizi, retail..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>

                {{-- Complexity --}}
                <div>
                    <label for="complexity" class="block text-xs font-medium text-gray-500 mb-1">Complessit&agrave; (1-5)</label>
                    <input type="range" name="complexity" id="complexity" min="1" max="5" value="3"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary">
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>1 - Semplice</span><span>5 - Molto complessa</span>
                    </div>
                </div>

                {{-- Domain Expertise --}}
                <div>
                    <label for="domain_expertise" class="block text-xs font-medium text-gray-500 mb-1">Competenza dominio</label>
                    <select name="domain_expertise" id="domain_expertise" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="alta">Alta</option>
                        <option value="media" selected>Media</option>
                        <option value="bassa">Bassa</option>
                    </select>
                </div>

                {{-- Output Type --}}
                <div>
                    <label for="output_type" class="block text-xs font-medium text-gray-500 mb-1">Tipo output</label>
                    <input type="text" name="output_type" id="output_type" placeholder="es. webapp, dashboard, report, API..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>

                {{-- Timeline --}}
                <div>
                    <label for="timeline" class="block text-xs font-medium text-gray-500 mb-1">Timeline</label>
                    <select name="timeline" id="timeline" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="urgente">Urgente</option>
                        <option value="1-2 settimane">1-2 settimane</option>
                        <option value="1 mese" selected>1 mese</option>
                        <option value="2-3 mesi">2-3 mesi</option>
                    </select>
                </div>

                {{-- Hours Estimate --}}
                <div>
                    <label for="hours_estimate" class="block text-xs font-medium text-gray-500 mb-1">Stima ore</label>
                    <input type="text" name="hours_estimate" id="hours_estimate" placeholder="es. 40-80"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>

                {{-- Client Team --}}
                <div>
                    <label for="client_team" class="block text-xs font-medium text-gray-500 mb-1">Team cliente</label>
                    <input type="text" name="client_team" id="client_team" placeholder="es. 1 PM, 2 dev interni"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>

                {{-- Budget Alignment --}}
                <div>
                    <label for="budget_alignment" class="block text-xs font-medium text-gray-500 mb-1">Allineamento budget</label>
                    <select name="budget_alignment" id="budget_alignment" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="allineato">Allineato</option>
                        <option value="sopra">Sopra aspettative</option>
                        <option value="sotto">Sotto aspettative</option>
                    </select>
                </div>

                {{-- Scope Clarity --}}
                <div>
                    <label for="scope_clarity" class="block text-xs font-medium text-gray-500 mb-1">Chiarezza scope</label>
                    <select name="scope_clarity" id="scope_clarity" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="chiaro">Chiaro</option>
                        <option value="medio" selected>Medio</option>
                        <option value="vago">Vago</option>
                    </select>
                </div>

                {{-- Risk Flags --}}
                <div class="sm:col-span-2">
                    <label for="risk_flags" class="block text-xs font-medium text-gray-500 mb-1">Risk flags</label>
                    <textarea name="risk_flags" id="risk_flags" rows="2" placeholder="Eventuali rischi identificati..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none"></textarea>
                </div>

                {{-- Notes --}}
                <div class="sm:col-span-2">
                    <label for="notes" class="block text-xs font-medium text-gray-500 mb-1">Note aggiuntive</label>
                    <textarea name="notes" id="notes" rows="3" placeholder="Contesto aggiuntivo per la quotazione..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none"></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-primary-dark to-navy text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Genera con Claude AI
                </button>
            </div>
        </form>
    </div>
@endsection
