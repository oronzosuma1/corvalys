@extends('layouts.app')

@section('title', __('seo.chi_siamo.title'))
@section('meta_description', __('seo.chi_siamo.description'))

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="about.hero.title"
            >
                Chi Siamo
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="about.hero.sub"
            >
                Aiutiamo le PMI europee a crescere attraverso l'intelligenza artificiale applicata ai processi reali.
            </p>
        </div>
    </section>

    {{-- ── Intro Content (i18n) ── --}}
    <section class="section bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div
                class="prose prose-lg prose-gray max-w-none
                       prose-headings:font-heading prose-headings:text-gray-900
                       prose-a:text-primary prose-a:no-underline hover:prose-a:underline"
                data-i18n-html="about.intro"
            >
                <p>
                    Corvalys nasce con un obiettivo chiaro: rendere l'intelligenza artificiale accessibile,
                    comprensibile e concretamente utile per le piccole e medie imprese europee.
                </p>
            </div>
        </div>
    </section>

    {{-- ── Sub-page Cards ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2
                    class="section-title mb-4"
                    data-i18n="about.sections.heading"
                >
                    Scopri Corvalys
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="about.sections.sub"
                >
                    Approfondisci ogni aspetto della nostra identità e del nostro approccio.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">

                {{-- Card: Mission --}}
                <a
                    href="{{ route('chi-siamo.missione') }}"
                    class="card flex flex-col group hover:shadow-lg transition-shadow duration-300"
                >
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5 group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                        </svg>
                    </div>
                    <h3
                        class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                        data-i18n="about.card.mission.title"
                    >
                        La Nostra Missione
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="about.card.mission.desc"
                    >
                        Perché esistiamo e quale impatto vogliamo generare nel tessuto imprenditoriale europeo.
                    </p>
                    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-primary">
                        <span data-i18n="about.card.readmore">Scopri di più</span>
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </span>
                </a>

                {{-- Card: What We Do --}}
                <a
                    href="{{ route('chi-siamo.cosa-facciamo') }}"
                    class="card flex flex-col group hover:shadow-lg transition-shadow duration-300"
                >
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5 group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                        </svg>
                    </div>
                    <h3
                        class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                        data-i18n="about.card.whatwedo.title"
                    >
                        Cosa Facciamo
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="about.card.whatwedo.desc"
                    >
                        Soluzioni AI concrete: dalla suite prodotti alla consulenza su misura e alla formazione.
                    </p>
                    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-primary">
                        <span data-i18n="about.card.readmore">Scopri di più</span>
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </span>
                </a>

                {{-- Card: Values --}}
                <a
                    href="{{ route('chi-siamo.valori') }}"
                    class="card flex flex-col group hover:shadow-lg transition-shadow duration-300"
                >
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5 group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3
                        class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                        data-i18n="about.card.values.title"
                    >
                        I Nostri Valori
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="about.card.values.desc"
                    >
                        I principi che guidano ogni decisione: chiarezza, impatto misurabile, etica e partnership.
                    </p>
                    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-primary">
                        <span data-i18n="about.card.readmore">Scopri di più</span>
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </span>
                </a>

            </div>
        </div>
    </section>

    {{-- ── CTA: Meet the Team ── --}}
    <section class="bg-hero text-white section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2
                class="font-heading text-3xl sm:text-4xl font-bold mb-4"
                data-i18n="about.cta.title"
            >
                Chi c'è dietro Corvalys
            </h2>
            <p
                class="text-white/70 text-lg mb-10 max-w-xl mx-auto"
                data-i18n="about.cta.sub"
            >
                Fondato da professionisti con oltre 20 anni di esperienza in operations, AI e sistemi di qualità.
            </p>
            <a
                href="{{ route('chi-siamo.team') }}"
                class="btn-white"
                data-i18n="about.cta.button"
            >
                Meet the Team
            </a>
        </div>
    </section>

@endsection
