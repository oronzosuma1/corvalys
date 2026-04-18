@extends('layouts.app')

@section('title', __('seo.prezzi.title'))
@section('meta_description', __('seo.prezzi.description'))

@push('head')
    <x-json-ld :data="\App\Support\JsonLd::breadcrumbs([
        ['name' => 'Home', 'url' => route('home')],
        ['name' => __('seo.prezzi.title'), 'url' => route('prezzi')],
    ])" />
@endpush

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="pricing.hero.title"
            >
                Piani e Prezzi
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="pricing.hero.sub"
            >
                Scegli il piano più adatto alla tua PMI. Nessuna sorpresa, nessun costo nascosto.
            </p>
        </div>
    </section>

    {{-- ── Pricing Section ── --}}
    <section
        class="section bg-white"
        x-data="{ period: 'monthly' }"
    >
        <div class="max-w-7xl mx-auto px-6">

            {{-- ── Period Toggle ── --}}
            <div class="flex items-center justify-center gap-3 mb-16">

                <div class="inline-flex items-center bg-gray-100 rounded-xl p-1 gap-1">

                    {{-- Monthly --}}
                    <button
                        @click="period = 'monthly'"
                        :class="period === 'monthly'
                            ? 'bg-primary text-white shadow-sm'
                            : 'bg-transparent text-gray-600 hover:text-gray-900'"
                        class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200"
                        data-i18n="pricing.monthly"
                    >
                        Mensile
                    </button>

                    {{-- Annual --}}
                    <button
                        @click="period = 'annual'"
                        :class="period === 'annual'
                            ? 'bg-primary text-white shadow-sm'
                            : 'bg-transparent text-gray-600 hover:text-gray-900'"
                        class="px-5 py-2.5 rounded-lg text-sm font-semibold transition-all duration-200 flex items-center gap-2"
                        data-i18n="pricing.annual"
                    >
                        Annuale
                    </button>

                </div>

                {{-- Save badge --}}
                <span
                    x-show="period === 'annual'"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="badge bg-amber/10 text-amber font-bold"
                    data-i18n="pricing.save"
                    style="display:none"
                >
                    Risparmia 20%
                </span>

            </div>

            {{-- ── Pricing Cards Grid ── --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8 items-stretch">

                {{-- ── STARTER ── --}}
                <div class="card flex flex-col">

                    {{-- Plan name --}}
                    <div class="mb-6">
                        <span
                            class="badge bg-gray-100 text-gray-600 mb-3"
                            data-i18n="pricing.starter.name"
                        >
                            Starter
                        </span>

                        {{-- Price --}}
                        <div class="mt-4">
                            <div
                                x-show="period === 'monthly'"
                                class="flex items-baseline gap-1"
                            >
                                <span
                                    class="font-heading text-4xl font-bold text-gray-900"
                                    data-i18n="pricing.free"
                                >
                                    Gratis
                                </span>
                            </div>
                            <div
                                x-show="period === 'annual'"
                                class="flex items-baseline gap-1"
                                style="display:none"
                            >
                                <span
                                    class="font-heading text-4xl font-bold text-gray-900"
                                    data-i18n="pricing.free"
                                >
                                    Gratis
                                </span>
                            </div>

                            {{-- Trial note --}}
                            <p
                                class="mt-2 text-xs text-primary font-semibold"
                                data-i18n="pricing.starter.trial"
                            >
                                3 mesi di prova gratuita
                            </p>
                        </div>
                    </div>

                    {{-- Description --}}
                    <p
                        class="text-gray-500 text-sm leading-relaxed mb-6"
                        data-i18n="pricing.starter.desc"
                    >
                        Perfetto per iniziare a esplorare l'AI nella tua azienda senza rischi.
                    </p>

                    {{-- Features --}}
                    <ul class="space-y-3 flex-1 mb-8">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.starter.f1">
                                Accesso base alla piattaforma
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.starter.f2">
                                Fino a 3 utenti
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.starter.f3">
                                Supporto via email
                            </span>
                        </li>
                    </ul>

                    {{-- CTA --}}
                    <a
                        href="{{ route('contatto') }}"
                        class="btn-outline w-full text-center"
                        data-i18n="pricing.starter.cta"
                    >
                        Inizia gratis
                    </a>

                </div>

                {{-- ── CORE ── --}}
                <div class="card flex flex-col">

                    <div class="mb-6">
                        <span
                            class="badge bg-primary/10 text-primary mb-3"
                            data-i18n="pricing.core.name"
                        >
                            Core
                        </span>

                        {{-- Price --}}
                        <div class="mt-4">
                            <div
                                x-show="period === 'monthly'"
                                class="flex items-baseline gap-1"
                            >
                                <span class="font-heading text-4xl font-bold text-gray-900">€{{ $prezzi['core']['monthly'] }}</span>
                                <span class="text-gray-400 text-sm font-medium">/mo</span>
                            </div>
                            <div
                                x-show="period === 'annual'"
                                class="flex items-baseline gap-1"
                                style="display:none"
                            >
                                <span class="font-heading text-4xl font-bold text-gray-900">€{{ $prezzi['core']['annual'] }}</span>
                                <span class="text-gray-400 text-sm font-medium">/yr</span>
                            </div>
                        </div>
                    </div>

                    <p
                        class="text-gray-500 text-sm leading-relaxed mb-6"
                        data-i18n="pricing.core.desc"
                    >
                        La soluzione ideale per PMI che vogliono automatizzare i processi core.
                    </p>

                    <ul class="space-y-3 flex-1 mb-8">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.core.f1">
                                Tutto di Starter
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.core.f2">
                                Fino a 10 utenti
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.core.f3">
                                Automazione fatture
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.core.f4">
                                Reporting base
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.core.f5">
                                Supporto prioritario
                            </span>
                        </li>
                    </ul>

                    <a
                        href="{{ route('contatto') }}"
                        class="btn-outline w-full text-center"
                        data-i18n="pricing.core.cta"
                    >
                        Inizia ora
                    </a>

                </div>

                {{-- ── PRO (highlighted) ── --}}
                <div class="card flex flex-col ring-2 ring-primary relative">

                    {{-- Most Popular badge --}}
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                        <span
                            class="badge bg-primary text-white shadow-lg shadow-primary/30 px-4 py-1.5"
                            data-i18n="pricing.popular"
                        >
                            Più Popolare
                        </span>
                    </div>

                    <div class="mb-6 mt-4">
                        <span
                            class="badge bg-primary text-white mb-3"
                            data-i18n="pricing.pro.name"
                        >
                            Pro
                        </span>

                        {{-- Price --}}
                        <div class="mt-4">
                            <div
                                x-show="period === 'monthly'"
                                class="flex items-baseline gap-1"
                            >
                                <span class="font-heading text-4xl font-bold text-gray-900">€{{ $prezzi['pro']['monthly'] }}</span>
                                <span class="text-gray-400 text-sm font-medium">/mo</span>
                            </div>
                            <div
                                x-show="period === 'annual'"
                                class="flex items-baseline gap-1"
                                style="display:none"
                            >
                                <span class="font-heading text-4xl font-bold text-gray-900">€{{ $prezzi['pro']['annual'] }}</span>
                                <span class="text-gray-400 text-sm font-medium">/yr</span>
                            </div>
                        </div>
                    </div>

                    <p
                        class="text-gray-500 text-sm leading-relaxed mb-6"
                        data-i18n="pricing.pro.desc"
                    >
                        Potenza e flessibilità per team in crescita che vogliono il massimo dall'AI.
                    </p>

                    <ul class="space-y-3 flex-1 mb-8">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.pro.f1">
                                Tutto di Core
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.pro.f2">
                                Utenti illimitati
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.pro.f3">
                                AI Act compliance dashboard
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.pro.f4">
                                Integrazioni avanzate
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.pro.f5">
                                Analytics avanzati
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-gray-600" data-i18n="pricing.pro.f6">
                                Account manager dedicato
                            </span>
                        </li>
                    </ul>

                    <a
                        href="{{ route('contatto') }}"
                        class="btn-primary w-full text-center"
                        data-i18n="pricing.pro.cta"
                    >
                        Scegli Pro
                    </a>

                </div>

                {{-- ── BUSINESS ── --}}
                <div class="card flex flex-col bg-navy text-white border-navy">

                    <div class="mb-6">
                        <span
                            class="badge bg-white/10 text-white mb-3"
                            data-i18n="pricing.business.name"
                        >
                            Business
                        </span>

                        {{-- Price --}}
                        <div class="mt-4">
                            <div
                                x-show="period === 'monthly'"
                                class="flex items-baseline gap-1"
                            >
                                <span class="font-heading text-4xl font-bold text-white">€{{ $prezzi['business']['monthly'] }}</span>
                                <span class="text-white/50 text-sm font-medium">/mo</span>
                            </div>
                            <div
                                x-show="period === 'annual'"
                                class="flex items-baseline gap-1"
                                style="display:none"
                            >
                                <span
                                    class="font-heading text-3xl font-bold text-white"
                                    data-i18n="pricing.contact"
                                >
                                    Contattaci
                                </span>
                            </div>
                        </div>
                    </div>

                    <p
                        class="text-white/60 text-sm leading-relaxed mb-6"
                        data-i18n="pricing.business.desc"
                    >
                        Soluzioni enterprise su misura per organizzazioni complesse con esigenze specifiche.
                    </p>

                    <ul class="space-y-3 flex-1 mb-8">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary-light flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-white/80" data-i18n="pricing.business.f1">
                                Tutto di Pro
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary-light flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-white/80" data-i18n="pricing.business.f2">
                                Implementazione dedicata
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary-light flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-white/80" data-i18n="pricing.business.f3">
                                SLA garantito
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary-light flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-white/80" data-i18n="pricing.business.f4">
                                Integrazioni custom
                            </span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-primary-light flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-white/80" data-i18n="pricing.business.f5">
                                Formazione del team
                            </span>
                        </li>
                    </ul>

                    <a
                        href="{{ route('contatto') }}"
                        class="btn-white w-full text-center"
                        data-i18n="pricing.business.cta"
                    >
                        Parla con noi
                    </a>

                </div>

            </div>
            {{-- End grid --}}

        </div>
    </section>
    {{-- End Alpine x-data scope --}}

    {{-- ── Bottom CTA / FAQ ── --}}
    <section class="bg-section-alt section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2
                class="section-title mb-4"
                data-i18n="pricing.cta.title"
            >
                Hai domande?
            </h2>
            <p
                class="section-sub mx-auto mb-10"
                data-i18n="pricing.cta.sub"
            >
                Il nostro team è pronto ad aiutarti a scegliere il piano giusto e rispondere a qualsiasi domanda.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a
                    href="{{ route('contatto') }}"
                    class="btn-primary"
                    data-i18n="pricing.cta.btn"
                >
                    Contattaci
                </a>
                <a
                    href="{{ route('prodotti') }}"
                    class="btn-ghost text-gray-700"
                    data-i18n="pricing.cta.products"
                >
                    Esplora i prodotti
                </a>
            </div>

        </div>
    </section>

@endsection
