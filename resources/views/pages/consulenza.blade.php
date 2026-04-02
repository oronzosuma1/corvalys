@extends('layouts.app')

@section('title', __('consulting.meta.title', [], app()->getLocale()) ?: 'Consulenza AI — Corvalys')
@section('meta_description', __('consulting.meta.description', [], app()->getLocale()) ?: '')

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="consulting.hero.title"
            >
                Consulenza AI
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="consulting.hero.sub"
            >
                Accompagniamo le PMI europee in ogni fase dell'adozione dell'intelligenza artificiale.
            </p>
        </div>
    </section>

    {{-- ── Services Grid ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2
                    class="section-title mb-4"
                    data-i18n="consulting.services.title"
                >
                    I Nostri Servizi
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="consulting.services.sub"
                >
                    Soluzioni su misura per le sfide reali delle imprese europee.
                </p>
            </div>

            @if($services->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg" data-i18n="consulting.services.empty">
                        Nessun servizio disponibile al momento.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)

                        <div class="card flex flex-col group">

                            {{-- Accent top bar --}}
                            <div class="h-1 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>

                            {{-- Icon placeholder --}}
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5">
                                <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                                </svg>
                            </div>

                            {{-- Name — dynamic from DB --}}
                            <h3 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200">
                                {{ $service->name }}
                            </h3>

                            {{-- Description — dynamic from DB --}}
                            <p class="text-gray-500 text-sm leading-relaxed flex-1">
                                {{ $service->description ?? $service->short_description }}
                            </p>

                        </div>

                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- ── Process Section ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2
                    class="section-title mb-4"
                    data-i18n="consulting.process.title"
                >
                    Il Nostro Processo
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="consulting.process.sub"
                >
                    Un approccio strutturato per risultati concreti e misurabili.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">

                {{-- Connector line (desktop only) --}}
                <div class="hidden lg:block absolute top-10 left-[12.5%] right-[12.5%] h-px bg-gradient-to-r from-primary/20 via-primary/50 to-primary/20 z-0"></div>

                {{-- Step 1 — Discovery --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5 group-hover:border-primary transition-colors duration-300">
                        <span class="font-heading text-2xl font-bold text-primary">1</span>
                    </div>
                    <h3
                        class="font-heading text-lg font-bold text-gray-900 mb-2"
                        data-i18n="consulting.step1.title"
                    >
                        Discovery
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed"
                        data-i18n="consulting.step1.desc"
                    >
                        Analizziamo i processi, i dati e le esigenze specifiche della tua azienda.
                    </p>
                </div>

                {{-- Step 2 — Strategy --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">2</span>
                    </div>
                    <h3
                        class="font-heading text-lg font-bold text-gray-900 mb-2"
                        data-i18n="consulting.step2.title"
                    >
                        Strategy
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed"
                        data-i18n="consulting.step2.desc"
                    >
                        Definiamo una roadmap AI personalizzata con obiettivi chiari e misurabili.
                    </p>
                </div>

                {{-- Step 3 — Implementation --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">3</span>
                    </div>
                    <h3
                        class="font-heading text-lg font-bold text-gray-900 mb-2"
                        data-i18n="consulting.step3.title"
                    >
                        Implementation
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed"
                        data-i18n="consulting.step3.desc"
                    >
                        Sviluppiamo e integriamo le soluzioni AI nei tuoi sistemi esistenti.
                    </p>
                </div>

                {{-- Step 4 — Support --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">4</span>
                    </div>
                    <h3
                        class="font-heading text-lg font-bold text-gray-900 mb-2"
                        data-i18n="consulting.step4.title"
                    >
                        Support
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed"
                        data-i18n="consulting.step4.desc"
                    >
                        Forniamo supporto continuo, monitoraggio e ottimizzazione delle soluzioni.
                    </p>
                </div>

            </div>

        </div>
    </section>

    {{-- ── CTA Section ── --}}
    <section class="bg-hero text-white section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2
                class="font-heading text-3xl sm:text-4xl font-bold mb-4"
                data-i18n="consulting.cta.title"
            >
                Pronto a trasformare la tua azienda?
            </h2>
            <p
                class="text-white/70 text-lg mb-10 max-w-xl mx-auto"
                data-i18n="consulting.cta.sub"
            >
                Prenota una call gratuita con un nostro esperto e scopri come l'AI può fare la differenza per te.
            </p>

            <a
                href="{{ route('contatto') }}"
                class="btn-white"
                data-i18n="consulting.cta"
            >
                Schedule a Call
            </a>

        </div>
    </section>

@endsection
