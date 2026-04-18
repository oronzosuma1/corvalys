@extends('layouts.app')

@section('title', __('seo.chi_siamo_missione.title'))
@section('meta_description', __('seo.chi_siamo_missione.description'))

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="about.mission.title"
            >
                La Nostra Missione
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="about.mission.sub"
            >
                Rendere l'intelligenza artificiale uno strumento concreto e accessibile per ogni PMI europea.
            </p>
        </div>
    </section>

    {{-- ── Mission Content (i18n) ── --}}
    <section class="section bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div
                class="prose prose-lg prose-gray max-w-none
                       prose-headings:font-heading prose-headings:text-gray-900
                       prose-a:text-primary prose-a:no-underline hover:prose-a:underline"
                data-i18n-html="about.mission.content"
            >
                <p>
                    La nostra missione è democratizzare l'accesso all'intelligenza artificiale, abbattendo le barriere
                    tecniche ed economiche che oggi escludono molte PMI dai benefici di questa rivoluzione.
                </p>
            </div>
        </div>
    </section>

    {{-- ── Mission Pillars ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2
                    class="section-title mb-4"
                    data-i18n="about.mission.pillars.heading"
                >
                    I Pilastri della Nostra Missione
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="about.mission.pillars.sub"
                >
                    Tre principi fondamentali che orientano ogni nostra scelta strategica e operativa.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">

                {{-- Pillar 1: Accessibility --}}
                <div class="card flex flex-col items-start gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3
                            class="font-heading text-lg font-bold text-gray-900 mb-2"
                            data-i18n="about.mission.pillar1.title"
                        >
                            Accessibilità
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="about.mission.pillar1.desc"
                        >
                            Strumenti AI progettati per imprenditori e team non tecnici, con interfacce intuitive
                            e supporto dedicato in ogni fase.
                        </p>
                    </div>
                </div>

                {{-- Pillar 2: Measurable Impact --}}
                <div class="card flex flex-col items-start gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                        </svg>
                    </div>
                    <div>
                        <h3
                            class="font-heading text-lg font-bold text-gray-900 mb-2"
                            data-i18n="about.mission.pillar2.title"
                        >
                            Impatto Misurabile
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="about.mission.pillar2.desc"
                        >
                            Ogni progetto parte dagli obiettivi di business e si misura su KPI concreti:
                            ore risparmiate, ricavi generati, costi ridotti.
                        </p>
                    </div>
                </div>

                {{-- Pillar 3: European Rootedness --}}
                <div class="card flex flex-col items-start gap-5">
                    <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/>
                        </svg>
                    </div>
                    <div>
                        <h3
                            class="font-heading text-lg font-bold text-gray-900 mb-2"
                            data-i18n="about.mission.pillar3.title"
                        >
                            Radici Europee
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="about.mission.pillar3.desc"
                        >
                            Progettato nel rispetto dei valori europei: privacy, trasparenza e conformità
                            all'AI Act. Un AI made in Europe, per l'Europa.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── CTA ── --}}
    <section class="bg-hero text-white section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2
                class="font-heading text-3xl sm:text-4xl font-bold mb-4"
                data-i18n="about.mission.cta.title"
            >
                Condividi la nostra visione?
            </h2>
            <p
                class="text-white/70 text-lg mb-10 max-w-xl mx-auto"
                data-i18n="about.mission.cta.sub"
            >
                Lavoriamo insieme per portare l'AI nelle PMI europee in modo responsabile e sostenibile.
            </p>
            <a
                href="{{ route('contatto') }}"
                class="btn-white"
                data-i18n="about.mission.cta.button"
            >
                Contattaci
            </a>
        </div>
    </section>

@endsection
