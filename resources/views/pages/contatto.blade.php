@extends('layouts.app')

@section('title', __('contact.meta.title', [], app()->getLocale()) ?: 'Contatto — Corvalys')
@section('meta_description', __('contact.meta.description', [], app()->getLocale()) ?: '')

@section('content')

    {{-- ── Success flash ── --}}
    @if(session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed top-20 inset-x-4 sm:inset-x-auto sm:left-1/2 sm:-translate-x-1/2 sm:w-full sm:max-w-lg z-50"
            x-cloak
        >
            <div class="flex items-start gap-3 bg-white border border-primary/20 rounded-2xl shadow-xl px-5 py-4">
                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900" data-i18n="contact.success.title">
                        Messaggio inviato!
                    </p>
                    <p class="text-sm text-gray-500 mt-0.5" data-i18n="contact.success.sub">
                        {{ session('success') }}
                    </p>
                    @if(config('corvalys.calendly_url'))
                        <a href="{{ config('corvalys.calendly_url') }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-dark mt-2 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                            Prenota subito una call gratuita &rarr;
                        </a>
                    @endif
                </div>
                <button @click="show = false" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-20 lg:pt-40 lg:pb-28">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="contact.hero.title"
            >
                Contattaci
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="contact.hero.sub"
            >
                Raccontaci la tua sfida. Ti risponderemo entro 24 ore con una proposta su misura.
            </p>
        </div>
    </section>

    {{-- ── Wizard Form ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-3xl mx-auto px-6">

            <div
                x-data="{
                    step: 1,
                    totalSteps: 5,
                    form: {
                        name: '{{ old('name') }}',
                        email: '{{ old('email') }}',
                        company: '{{ old('company') }}',
                        phone: '{{ old('phone') }}',
                        company_size: '{{ old('company_size') }}',
                        industry: '{{ old('industry') }}',
                        country: '{{ old('country') }}',
                        website: '{{ old('website') }}',
                        uses_erp: {{ old('uses_erp') ? 'true' : 'false' }},
                        uses_excel: {{ old('uses_excel') ? 'true' : 'false' }},
                        uses_database: {{ old('uses_database') ? 'true' : 'false' }},
                        has_it_team: {{ old('has_it_team') ? 'true' : 'false' }},
                        uses_cloud: {{ old('uses_cloud') ? 'true' : 'false' }},
                        has_api_integrations: {{ old('has_api_integrations') ? 'true' : 'false' }},
                        erp_name: '{{ old('erp_name') }}',
                        database_name: '{{ old('database_name') }}',
                        it_team_size: '{{ old('it_team_size') }}',
                        cloud_provider: '{{ old('cloud_provider') }}',
                        current_ai_usage: '{{ old('current_ai_usage') }}',
                        service_type: '{{ old('service_type') }}',
                        project_description: '{{ old('project_description') }}',
                        budget_range: '{{ old('budget_range') }}',
                        desired_timeline: '{{ old('desired_timeline') }}',
                        pain_points: '{{ old('pain_points') }}',
                        expected_outcomes: '{{ old('expected_outcomes') }}',
                        monthly_volume: '{{ old('monthly_volume') }}',
                        gdpr_consent: {{ old('gdpr_consent') ? 'true' : 'false' }},
                        readiness_leadership: {{ old('readiness_leadership', 0) }},
                        readiness_data: {{ old('readiness_data', 0) }},
                        readiness_technology: {{ old('readiness_technology', 0) }},
                        readiness_culture: {{ old('readiness_culture', 0) }},
                        readiness_process: {{ old('readiness_process', 0) }},
                        readiness_compliance: {{ old('readiness_compliance', 0) }},
                        readiness_reason_leadership: '{{ old('readiness_reason_leadership') }}',
                        readiness_reason_data: '{{ old('readiness_reason_data') }}',
                        readiness_reason_technology: '{{ old('readiness_reason_technology') }}',
                        readiness_reason_culture: '{{ old('readiness_reason_culture') }}',
                        readiness_reason_process: '{{ old('readiness_reason_process') }}',
                        readiness_reason_compliance: '{{ old('readiness_reason_compliance') }}'
                    },
                    readinessAvg() {
                        const dims = ['leadership','data','technology','culture','process','compliance'];
                        const vals = dims.map(d => this.form['readiness_' + d]).filter(v => v > 0);
                        return vals.length > 0 ? (vals.reduce((a,b) => a+b, 0) / vals.length).toFixed(1) : '—';
                    },
                    goNext() {
                        if (this.step < this.totalSteps) this.step++;
                    },
                    goPrev() {
                        if (this.step > 1) this.step--;
                    }
                }"
                {{-- If there are validation errors, jump to first step with error --}}
                x-init="
                    @if($errors->has('name') || $errors->has('email') || $errors->has('company') || $errors->has('phone'))
                        step = 1;
                    @elseif($errors->has('company_size') || $errors->has('industry') || $errors->has('country') || $errors->has('website'))
                        step = 2;
                    @elseif($errors->has('current_ai_usage') || $errors->has('erp_name') || $errors->has('database_name') || $errors->has('it_team_size') || $errors->has('cloud_provider'))
                        step = 3;
                    @elseif($errors->has('service_type') || $errors->has('project_description') || $errors->has('budget_range'))
                        step = 4;
                    @elseif($errors->has('gdpr_consent'))
                        step = 5;
                    @endif
                "
            >

                {{-- ── Progress Indicator ── --}}
                <div class="mb-10">
                    <div class="flex items-center justify-between relative">

                        {{-- Track line --}}
                        <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-0.5 bg-gray-200 z-0"></div>
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 bg-primary z-0 transition-all duration-500"
                            :style="`width: ${((step - 1) / (totalSteps - 1)) * 100}%`"
                        ></div>

                        @foreach([1, 2, 3, 4, 5] as $s)
                            <div class="relative z-10 flex flex-col items-center gap-2">
                                <div
                                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center text-sm font-bold border-2 transition-all duration-300"
                                    :class="{
                                        'bg-primary border-primary text-white shadow-md shadow-primary/30': step >= {{ $s }},
                                        'bg-white border-gray-200 text-gray-400': step < {{ $s }}
                                    }"
                                >
                                    <span x-show="step > {{ $s }}">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                    </span>
                                    <span x-show="step <= {{ $s }}">{{ $s }}</span>
                                </div>
                                <span
                                    class="hidden sm:block text-[10px] sm:text-xs font-medium transition-colors duration-300"
                                    :class="step >= {{ $s }} ? 'text-primary' : 'text-gray-400'"
                                    data-i18n="contact.step{{ $s }}.short"
                                >
                                    @if($s === 1) Info
                                    @elseif($s === 2) Company
                                    @elseif($s === 3) Tech
                                    @elseif($s === 4) Project
                                    @else Readiness
                                    @endif
                                </span>
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- ── The Form ── --}}
                <form
                    action="{{ route('contatto.store') }}"
                    method="POST"
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                >
                    @csrf

                    {{-- ═══════════════════════════════════════ --}}
                    {{-- STEP 1 — Personal Info                  --}}
                    {{-- ═══════════════════════════════════════ --}}
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">

                        <div class="px-8 pt-8 pb-4 border-b border-gray-100">
                            <h2
                                class="font-heading text-xl font-bold text-gray-900"
                                data-i18n="contact.step1.title"
                            >
                                Informazioni Personali
                            </h2>
                            <p class="text-sm text-gray-500 mt-1" data-i18n="contact.step1.sub">
                                Dicci chi sei per poter personalizzare la nostra risposta.
                            </p>
                        </div>

                        <div class="px-8 py-8 space-y-6">

                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.name">
                                    Nome e Cognome <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    x-model="form.name"
                                    required
                                    data-i18n-placeholder="contact.placeholder.name"
                                    placeholder="Mario Rossi"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('name') ? 'border-red-400 bg-red-50' : '' }}"
                                >
                                @error('name')
                                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.email">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    x-model="form.email"
                                    required
                                    data-i18n-placeholder="contact.placeholder.email"
                                    placeholder="mario@azienda.it"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('email') ? 'border-red-400 bg-red-50' : '' }}"
                                >
                                @error('email')
                                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Company + Phone --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                                <div>
                                    <label for="company" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.company">
                                        Azienda
                                    </label>
                                    <input
                                        type="text"
                                        id="company"
                                        name="company"
                                        x-model="form.company"
                                        data-i18n-placeholder="contact.placeholder.company"
                                        placeholder="Acme S.r.l."
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('company') ? 'border-red-400 bg-red-50' : '' }}"
                                    >
                                    @error('company')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.phone">
                                        Telefono
                                    </label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        x-model="form.phone"
                                        data-i18n-placeholder="contact.placeholder.phone"
                                        placeholder="+39 02 1234567"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('phone') ? 'border-red-400 bg-red-50' : '' }}"
                                    >
                                    @error('phone')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- ═══════════════════════════════════════ --}}
                    {{-- STEP 2 — Company Profile               --}}
                    {{-- ═══════════════════════════════════════ --}}
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display:none">

                        <div class="px-8 pt-8 pb-4 border-b border-gray-100">
                            <h2
                                class="font-heading text-xl font-bold text-gray-900"
                                data-i18n="contact.step2.title"
                            >
                                Profilo Aziendale
                            </h2>
                            <p class="text-sm text-gray-500 mt-1" data-i18n="contact.step2.sub">
                                Aiutaci a capire la dimensione e il contesto della tua realtà.
                            </p>
                        </div>

                        <div class="px-8 py-8 space-y-6">

                            {{-- Company size --}}
                            <div>
                                <label for="company_size" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.company_size">
                                    Dimensione Azienda
                                </label>
                                <select
                                    id="company_size"
                                    name="company_size"
                                    x-model="form.company_size"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('company_size') ? 'border-red-400 bg-red-50' : '' }}"
                                >
                                    <option value="" data-i18n="contact.placeholder.company_size">Seleziona...</option>
                                    <option value="1-10" data-i18n="contact.size.micro">1–10 dipendenti</option>
                                    <option value="11-50" data-i18n="contact.size.small">11–50 dipendenti</option>
                                    <option value="51-200" data-i18n="contact.size.medium">51–200 dipendenti</option>
                                    <option value="200+" data-i18n="contact.size.large">200+ dipendenti</option>
                                </select>
                                @error('company_size')
                                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Industry + Country --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.industry">
                                        Settore
                                    </label>
                                    <input
                                        type="text"
                                        id="industry"
                                        name="industry"
                                        x-model="form.industry"
                                        data-i18n-placeholder="contact.placeholder.industry"
                                        placeholder="es. Manifatturiero"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('industry') ? 'border-red-400 bg-red-50' : '' }}"
                                    >
                                    @error('industry')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.country">
                                        Paese
                                    </label>
                                    <input
                                        type="text"
                                        id="country"
                                        name="country"
                                        x-model="form.country"
                                        data-i18n-placeholder="contact.placeholder.country"
                                        placeholder="Italia"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('country') ? 'border-red-400 bg-red-50' : '' }}"
                                    >
                                    @error('country')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            {{-- Website --}}
                            <div>
                                <label for="website" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.website">
                                    Sito Web
                                </label>
                                <input
                                    type="url"
                                    id="website"
                                    name="website"
                                    x-model="form.website"
                                    data-i18n-placeholder="contact.placeholder.website"
                                    placeholder="https://www.azienda.it"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('website') ? 'border-red-400 bg-red-50' : '' }}"
                                >
                                @error('website')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- ═══════════════════════════════════════ --}}
                    {{-- STEP 3 — Tech Maturity                 --}}
                    {{-- ═══════════════════════════════════════ --}}
                    <div x-show="step === 3" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display:none">

                        <div class="px-8 pt-8 pb-4 border-b border-gray-100">
                            <h2
                                class="font-heading text-xl font-bold text-gray-900"
                                data-i18n="contact.step3.title"
                            >
                                Maturità Tecnologica
                            </h2>
                            <p class="text-sm text-gray-500 mt-1" data-i18n="contact.step3.sub">
                                Seleziona le tecnologie che utilizzi attualmente in azienda.
                            </p>
                        </div>

                        <div class="px-8 py-8 space-y-8">

                            {{-- Checkboxes grid --}}
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-4" data-i18n="contact.field.tech_stack">
                                    Stack Tecnologico Attuale
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                    @php
                                        $checkboxes = [
                                            ['name' => 'uses_erp',            'i18n' => 'contact.tech.erp',      'label' => 'Gestionale / ERP'],
                                            ['name' => 'uses_excel',          'i18n' => 'contact.tech.excel',    'label' => 'Excel / Fogli di calcolo'],
                                            ['name' => 'uses_database',       'i18n' => 'contact.tech.database', 'label' => 'Database relazionale'],
                                            ['name' => 'has_it_team',         'i18n' => 'contact.tech.it_team',  'label' => 'Team IT interno'],
                                            ['name' => 'uses_cloud',          'i18n' => 'contact.tech.cloud',    'label' => 'Servizi Cloud'],
                                            ['name' => 'has_api_integrations','i18n' => 'contact.tech.api',      'label' => 'Integrazioni API'],
                                        ];
                                    @endphp

                                    @foreach($checkboxes as $cb)
                                        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-primary/30 hover:bg-primary/5 cursor-pointer transition-colors group">
                                            <input
                                                type="checkbox"
                                                name="{{ $cb['name'] }}"
                                                value="1"
                                                x-model="form.{{ $cb['name'] }}"
                                                @checked(old($cb['name']))
                                                class="w-4 h-4 rounded text-primary border-gray-300 focus:ring-primary/30 cursor-pointer"
                                            >
                                            <span
                                                class="text-sm text-gray-700 group-hover:text-gray-900 transition-colors"
                                                data-i18n="{{ $cb['i18n'] }}"
                                            >
                                                {{ $cb['label'] }}
                                            </span>
                                        </label>
                                    @endforeach

                                </div>
                            </div>

                            {{-- Conditional detail fields --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                                <div x-show="form.uses_erp">
                                    <label for="erp_name" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.erp_name">
                                        Nome ERP
                                    </label>
                                    <input
                                        type="text"
                                        id="erp_name"
                                        name="erp_name"
                                        x-model="form.erp_name"
                                        data-i18n-placeholder="contact.placeholder.erp_name"
                                        placeholder="SAP, Oracle, Sage..."
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
                                    >
                                    @error('erp_name')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div x-show="form.uses_database">
                                    <label for="database_name" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.database_name">
                                        Database
                                    </label>
                                    <input
                                        type="text"
                                        id="database_name"
                                        name="database_name"
                                        x-model="form.database_name"
                                        data-i18n-placeholder="contact.placeholder.database_name"
                                        placeholder="PostgreSQL, MySQL, MSSQL..."
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
                                    >
                                    @error('database_name')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div x-show="form.has_it_team">
                                    <label for="it_team_size" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.it_team_size">
                                        Dimensione Team IT
                                    </label>
                                    <input
                                        type="text"
                                        id="it_team_size"
                                        name="it_team_size"
                                        x-model="form.it_team_size"
                                        data-i18n-placeholder="contact.placeholder.it_team_size"
                                        placeholder="es. 3 persone"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
                                    >
                                    @error('it_team_size')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div x-show="form.uses_cloud">
                                    <label for="cloud_provider" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.cloud_provider">
                                        Provider Cloud
                                    </label>
                                    <input
                                        type="text"
                                        id="cloud_provider"
                                        name="cloud_provider"
                                        x-model="form.cloud_provider"
                                        data-i18n-placeholder="contact.placeholder.cloud_provider"
                                        placeholder="AWS, Azure, Google Cloud..."
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
                                    >
                                    @error('cloud_provider')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            {{-- Current AI usage --}}
                            <div>
                                <label for="current_ai_usage" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.current_ai_usage">
                                    Utilizzo Attuale dell'AI
                                </label>
                                <select
                                    id="current_ai_usage"
                                    name="current_ai_usage"
                                    x-model="form.current_ai_usage"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('current_ai_usage') ? 'border-red-400 bg-red-50' : '' }}"
                                >
                                    <option value="" data-i18n="contact.placeholder.current_ai_usage">Seleziona livello...</option>
                                    <option value="none" data-i18n="contact.ai.none">Nessuno</option>
                                    <option value="basic" data-i18n="contact.ai.basic">Base (es. chatbot, automazioni semplici)</option>
                                    <option value="intermediate" data-i18n="contact.ai.intermediate">Intermedio (ML in produzione)</option>
                                    <option value="advanced" data-i18n="contact.ai.advanced">Avanzato (LLM, AI Act readiness)</option>
                                </select>
                                @error('current_ai_usage')
                                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- ═══════════════════════════════════════ --}}
                    {{-- STEP 4 — Project Details               --}}
                    {{-- ═══════════════════════════════════════ --}}
                    <div x-show="step === 4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display:none">

                        <div class="px-8 pt-8 pb-4 border-b border-gray-100">
                            <h2
                                class="font-heading text-xl font-bold text-gray-900"
                                data-i18n="contact.step4.title"
                            >
                                Dettagli Progetto
                            </h2>
                            <p class="text-sm text-gray-500 mt-1" data-i18n="contact.step4.sub">
                                Raccontaci il tuo progetto nel dettaglio per una proposta accurata.
                            </p>
                        </div>

                        <div class="px-8 py-8 space-y-6">

                            {{-- Service type --}}
                            <div>
                                <label for="service_type" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.service_type">
                                    Tipo di Servizio
                                </label>
                                <select
                                    id="service_type"
                                    name="service_type"
                                    x-model="form.service_type"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('service_type') ? 'border-red-400 bg-red-50' : '' }}"
                                >
                                    <option value="" data-i18n="contact.placeholder.service_type">Seleziona servizio...</option>
                                    <option value="strategy" data-i18n="contact.service.strategy">Strategia AI</option>
                                    <option value="development" data-i18n="contact.service.development">Sviluppo AI / ML</option>
                                    <option value="industry40" data-i18n="contact.service.industry40">Industria 4.0</option>
                                    <option value="compliance" data-i18n="contact.service.compliance">AI Act Compliance</option>
                                    <option value="supplychain" data-i18n="contact.service.supplychain">Supply Chain AI</option>
                                    <option value="llm" data-i18n="contact.service.llm">LLM / AI Generativa</option>
                                    <option value="general" data-i18n="contact.service.general">Consulenza Generale</option>
                                </select>
                                @error('service_type')
                                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Project description --}}
                            <div>
                                <label for="project_description" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.project_description">
                                    Descrizione del Progetto <span class="text-red-500">*</span>
                                </label>
                                <textarea
                                    id="project_description"
                                    name="project_description"
                                    x-model="form.project_description"
                                    required
                                    rows="4"
                                    data-i18n-placeholder="contact.placeholder.project_description"
                                    placeholder="Descrivi brevemente la sfida o l'obiettivo che vorresti raggiungere con l'AI..."
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors resize-none {{ $errors->has('project_description') ? 'border-red-400 bg-red-50' : '' }}"
                                ></textarea>
                                @error('project_description')
                                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Budget + Timeline --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                                <div>
                                    <label for="budget_range" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.budget_range">
                                        Budget Indicativo
                                    </label>
                                    <select
                                        id="budget_range"
                                        name="budget_range"
                                        x-model="form.budget_range"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('budget_range') ? 'border-red-400 bg-red-50' : '' }}"
                                    >
                                        <option value="" data-i18n="contact.placeholder.budget_range">Seleziona range...</option>
                                        <option value="under1k" data-i18n="contact.budget.under1k">&lt; €1.000</option>
                                        <option value="1k-5k" data-i18n="contact.budget.1k5k">€1.000 – €5.000</option>
                                        <option value="5k-15k" data-i18n="contact.budget.5k15k">€5.000 – €15.000</option>
                                        <option value="15k-50k" data-i18n="contact.budget.15k50k">€15.000 – €50.000</option>
                                        <option value="over50k" data-i18n="contact.budget.over50k">&gt; €50.000</option>
                                        <option value="tbd" data-i18n="contact.budget.tbd">Da definire</option>
                                    </select>
                                    @error('budget_range')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="desired_timeline" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.desired_timeline">
                                        Timeline Desiderata
                                    </label>
                                    <input
                                        type="text"
                                        id="desired_timeline"
                                        name="desired_timeline"
                                        x-model="form.desired_timeline"
                                        data-i18n-placeholder="contact.placeholder.desired_timeline"
                                        placeholder="es. entro Q3 2025"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('desired_timeline') ? 'border-red-400 bg-red-50' : '' }}"
                                    >
                                    @error('desired_timeline')
                                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            {{-- Monthly volume --}}
                            <div>
                                <label for="monthly_volume" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.monthly_volume">
                                    Volume Mensile (es. transazioni, documenti)
                                </label>
                                <input
                                    type="text"
                                    id="monthly_volume"
                                    name="monthly_volume"
                                    x-model="form.monthly_volume"
                                    data-i18n-placeholder="contact.placeholder.monthly_volume"
                                    placeholder="es. 500 fatture/mese"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors {{ $errors->has('monthly_volume') ? 'border-red-400 bg-red-50' : '' }}"
                                >
                                @error('monthly_volume')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Pain points --}}
                            <div>
                                <label for="pain_points" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.pain_points">
                                    Principali Problemi / Pain Points
                                </label>
                                <textarea
                                    id="pain_points"
                                    name="pain_points"
                                    x-model="form.pain_points"
                                    rows="3"
                                    data-i18n-placeholder="contact.placeholder.pain_points"
                                    placeholder="Quali processi rallentano la tua azienda? Dove perdi più tempo o risorse?"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors resize-none {{ $errors->has('pain_points') ? 'border-red-400 bg-red-50' : '' }}"
                                ></textarea>
                                @error('pain_points')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Expected outcomes --}}
                            <div>
                                <label for="expected_outcomes" class="block text-sm font-medium text-gray-700 mb-1.5" data-i18n="contact.field.expected_outcomes">
                                    Risultati Attesi
                                </label>
                                <textarea
                                    id="expected_outcomes"
                                    name="expected_outcomes"
                                    x-model="form.expected_outcomes"
                                    rows="3"
                                    data-i18n-placeholder="contact.placeholder.expected_outcomes"
                                    placeholder="Cosa vorresti ottenere? (es. -30% tempo manuale, conformità AI Act, nuovi servizi digitali...)"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors resize-none {{ $errors->has('expected_outcomes') ? 'border-red-400 bg-red-50' : '' }}"
                                ></textarea>
                                @error('expected_outcomes')
                                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- ═══════════════════════════════════════ --}}
                    {{-- STEP 5 — AI Readiness Assessment       --}}
                    {{-- ═══════════════════════════════════════ --}}
                    <div x-show="step === 5" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" style="display:none">

                        <div class="px-8 pt-8 pb-4 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="font-heading text-xl font-bold text-gray-900" data-i18n="contact.step5.title">
                                        AI Readiness Assessment
                                    </h2>
                                    <p class="text-sm text-gray-500 mt-1" data-i18n="contact.step5.sub">
                                        Rate your organisation on each dimension (1-5) so we can tailor our proposal to your needs.
                                    </p>
                                </div>
                                <div class="hidden sm:block flex-shrink-0 ml-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-bold transition-colors"
                                          :class="readinessAvg() !== '—' && readinessAvg() >= 4 ? 'bg-green-100 text-green-700' : (readinessAvg() >= 3 ? 'bg-amber-100 text-amber-700' : (readinessAvg() !== '—' ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-400'))">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                                        <span x-text="readinessAvg() + ' / 5.0'"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="px-8 py-8 space-y-5">

                            {{-- Info box --}}
                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-2">
                                <p class="text-sm text-blue-700 leading-relaxed" data-i18n="contact.step5.info">
                                    This quick assessment helps us understand your starting point. A lower score doesn't mean we can't help — it means we'll include training and change management in our proposal. <strong>1 = Very Low, 5 = Excellent.</strong>
                                </p>
                            </div>

                            @php
                                $readinessDimensions = [
                                    ['key' => 'leadership', 'title' => 'Leadership & Strategy', 'desc' => 'Has leadership articulated a vision for AI and committed resources?', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/>'],
                                    ['key' => 'data', 'title' => 'Data Foundations', 'desc' => 'Is your business data organised, accessible, and of good quality?', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/>'],
                                    ['key' => 'technology', 'title' => 'Technology Infrastructure', 'desc' => 'Do you have modern systems, cloud, and integration capabilities?', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z"/>'],
                                    ['key' => 'culture', 'title' => 'Culture & Skills', 'desc' => 'Is your team digitally literate, open to change, and aware of AI?', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>'],
                                    ['key' => 'process', 'title' => 'Process Maturity', 'desc' => 'Are your key processes documented, measured, and automated?', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>'],
                                    ['key' => 'compliance', 'title' => 'Compliance & Governance', 'desc' => 'Are you aware of GDPR/AI Act and have governance structures?', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>'],
                                ];
                            @endphp

                            @foreach($readinessDimensions as $dim)
                            <div class="border border-gray-100 rounded-xl p-5 hover:border-gray-200 transition-colors">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-[#1B3A5C]/10 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#1B3A5C]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">{!! $dim['icon'] !!}</svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-800">{{ $dim['title'] }}</h3>
                                        <p class="text-xs text-gray-500">{{ $dim['desc'] }}</p>
                                    </div>
                                </div>

                                {{-- Score buttons --}}
                                <div class="flex items-center gap-2 mb-2">
                                    <input type="hidden" name="readiness_{{ $dim['key'] }}" :value="form.readiness_{{ $dim['key'] }}">
                                    @for($i = 1; $i <= 5; $i++)
                                    <button type="button"
                                            @click="form.readiness_{{ $dim['key'] }} = {{ $i }}"
                                            :class="form.readiness_{{ $dim['key'] }} === {{ $i }}
                                                ? '{{ $i <= 2 ? "bg-red-500 text-white border-red-500" : ($i === 3 ? "bg-amber-500 text-white border-amber-500" : "bg-green-500 text-white border-green-500") }} shadow-sm scale-110'
                                                : 'bg-white text-gray-500 border-gray-200 hover:border-primary/40'"
                                            class="w-10 h-10 sm:w-11 sm:h-11 rounded-lg border-2 text-sm font-bold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary/20">
                                        {{ $i }}
                                    </button>
                                    @endfor
                                    <span class="ml-2 text-xs text-gray-400 hidden sm:inline"
                                          x-text="form.readiness_{{ $dim['key'] }} === 0 ? '' :
                                                   form.readiness_{{ $dim['key'] }} <= 2 ? 'Low' :
                                                   form.readiness_{{ $dim['key'] }} === 3 ? 'Moderate' : 'Good'"></span>
                                </div>

                                {{-- Low score reason (1 or 2) --}}
                                <div x-show="form.readiness_{{ $dim['key'] }} === 1 || form.readiness_{{ $dim['key'] }} === 2"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 -translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="mt-2">
                                    <textarea
                                        name="readiness_reason_{{ $dim['key'] }}"
                                        x-model="form.readiness_reason_{{ $dim['key'] }}"
                                        rows="2"
                                        class="w-full px-3 py-2 text-sm border border-red-200 rounded-lg bg-red-50/50 focus:ring-2 focus:ring-red-200 focus:border-red-300 transition-colors placeholder-red-300"
                                        placeholder="What are the main challenges in this area?"
                                    ></textarea>
                                </div>
                            </div>
                            @endforeach

                            {{-- GDPR consent (moved from step 4) --}}
                            <div class="pt-4 border-t border-gray-100">
                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <input
                                        type="checkbox"
                                        id="gdpr_consent"
                                        name="gdpr_consent"
                                        value="1"
                                        x-model="form.gdpr_consent"
                                        required
                                        @checked(old('gdpr_consent'))
                                        class="mt-0.5 w-4 h-4 rounded text-primary border-gray-300 focus:ring-primary/30 cursor-pointer {{ $errors->has('gdpr_consent') ? 'border-red-400' : '' }}"
                                    >
                                    <span class="text-sm text-gray-600 leading-relaxed" data-i18n="contact.field.gdpr_consent">
                                        Acconsento al trattamento dei miei dati personali in conformità al
                                        <a href="{{ route('privacy') }}" target="_blank" class="text-primary hover:underline font-medium">Regolamento GDPR</a>
                                        e alla
                                        <a href="{{ route('privacy') }}" target="_blank" class="text-primary hover:underline font-medium">Privacy Policy</a>
                                        di Corvalys. <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                @error('gdpr_consent')
                                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1 ml-7">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- ── Navigation Buttons ── --}}
                    <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/50 flex items-center justify-between gap-4">

                        {{-- Previous --}}
                        <button
                            type="button"
                            @click="goPrev()"
                            x-show="step > 1"
                            class="btn-ghost text-gray-600 gap-2"
                            data-i18n="contact.nav.prev"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Previous
                        </button>

                        {{-- Spacer when on step 1 --}}
                        <div x-show="step === 1"></div>

                        {{-- Next (steps 1–3) --}}
                        <button
                            type="button"
                            @click="goNext()"
                            x-show="step < totalSteps"
                            class="btn-primary gap-2"
                            data-i18n="contact.nav.next"
                        >
                            Next
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>

                        {{-- Submit (step 4 only) --}}
                        <button
                            type="submit"
                            x-show="step === totalSteps"
                            class="btn-primary gap-2"
                            data-i18n="contact.nav.submit"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                            </svg>
                            Invia Richiesta
                        </button>

                    </div>

                </form>

                {{-- Step counter label --}}
                <p class="text-center text-xs text-gray-400 mt-4">
                    <span data-i18n="contact.step_of">Step</span>
                    <span x-text="step"></span>
                    <span data-i18n="contact.step_of_mid">di</span>
                    <span x-text="totalSteps"></span>
                </p>

            </div>

        </div>
    </section>

    {{-- ── Schedule a Call CTA ── --}}
    @if(config('corvalys.calendly_url'))
    <section class="section bg-white">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <div class="bg-gradient-to-br from-primary-dark to-navy rounded-2xl p-8 sm:p-12 text-white relative overflow-hidden">
                {{-- Decorative --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                <div class="relative">
                    <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center">
                        <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                        </svg>
                    </div>

                    <h3 class="font-heading text-2xl sm:text-3xl font-bold mb-3">
                        Preferisci parlarne a voce?
                    </h3>
                    <p class="text-white/60 text-base sm:text-lg max-w-xl mx-auto mb-8">
                        Prenota una videochiamata gratuita di 30 minuti. Nessun impegno, solo una conversazione per capire come possiamo aiutarti.
                    </p>

                    <a href="{{ config('corvalys.calendly_url') }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 bg-white text-primary-dark font-semibold px-8 py-3.5 rounded-xl hover:bg-primary-light hover:scale-[1.03] transition-all duration-200 shadow-lg shadow-black/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                        Prenota una Call Gratuita
                    </a>

                    <p class="text-white/40 text-xs mt-4">30 min · Google Meet · Nessun impegno</p>
                </div>
            </div>
        </div>
    </section>
    @endif

@endsection
