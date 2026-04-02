@extends('layouts.app')

@section('title', __('about.values.meta.title', [], app()->getLocale()) ?: 'I Nostri Valori — Corvalys')
@section('meta_description', __('about.values.meta.description', [], app()->getLocale()) ?: '')

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="about.values.title"
            >
                I Nostri Valori
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="about.values.sub"
            >
                I principi che guidano ogni nostro progetto, prodotto e relazione.
            </p>
        </div>
    </section>

    {{-- ── Value Cards ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2
                    class="section-title mb-4"
                    data-i18n="about.values.cards.heading"
                >
                    Ciò in cui crediamo
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="about.values.cards.sub"
                >
                    Non solo parole: ogni valore si traduce in scelte concrete nel modo in cui lavoriamo.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

                {{-- Value 1: Clarity --}}
                <div class="card flex flex-col sm:flex-row gap-6 group">
                    <div class="shrink-0 w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="font-heading text-xl font-bold text-gray-900 mb-3"
                            data-i18n="about.values.value1.title"
                        >
                            Chiarezza
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="about.values.value1.desc"
                        >
                            L'AI non deve essere una scatola nera. Rendiamo ogni algoritmo, ogni raccomandazione
                            e ogni output comprensibile per chi deve prendere decisioni di business. La chiarezza
                            costruisce fiducia e fiducia genera adozione.
                        </p>
                    </div>
                </div>

                {{-- Value 2: Measurable Impact --}}
                <div class="card flex flex-col sm:flex-row gap-6 group">
                    <div class="shrink-0 w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="font-heading text-xl font-bold text-gray-900 mb-3"
                            data-i18n="about.values.value2.title"
                        >
                            Impatto Misurabile
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="about.values.value2.desc"
                        >
                            Ogni soluzione che proponiamo è valutata su metriche concrete: ore risparmiate,
                            errori ridotti, ricavi incrementali. Non vendiamo tecnologia: vendiamo risultati
                            verificabili e documentati nel tempo.
                        </p>
                    </div>
                </div>

                {{-- Value 3: Data Ethics --}}
                <div class="card flex flex-col sm:flex-row gap-6 group">
                    <div class="shrink-0 w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="font-heading text-xl font-bold text-gray-900 mb-3"
                            data-i18n="about.values.value3.title"
                        >
                            Etica dei Dati
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="about.values.value3.desc"
                        >
                            Progettiamo sistemi AI che rispettano la privacy, minimizzano i bias e si conformano
                            all'AI Act europeo. I dati dei nostri clienti restano dei nostri clienti: nessuna
                            condivisione, nessuna monetizzazione.
                        </p>
                    </div>
                </div>

                {{-- Value 4: Partnership --}}
                <div class="card flex flex-col sm:flex-row gap-6 group">
                    <div class="shrink-0 w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3
                            class="font-heading text-xl font-bold text-gray-900 mb-3"
                            data-i18n="about.values.value4.title"
                        >
                            Partnership
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="about.values.value4.desc"
                        >
                            Non siamo vendor: siamo partner. Affianchiamo i nostri clienti con relazioni
                            di lungo periodo, condividendo rischi e successi. La loro crescita è la nostra
                            crescita.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── CMS Content (supplementary) ── --}}
    @if($page && $page->body)
        <section class="section bg-section-alt">
            <div class="max-w-4xl mx-auto px-6">
                <div class="prose prose-lg prose-gray max-w-none
                            prose-headings:font-heading prose-headings:text-gray-900
                            prose-a:text-primary prose-a:no-underline hover:prose-a:underline">
                    {!! $page->body !!}
                </div>
            </div>
        </section>
    @endif

    {{-- ── CTA ── --}}
    <section class="bg-hero text-white section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2
                class="font-heading text-3xl sm:text-4xl font-bold mb-4"
                data-i18n="about.values.cta.title"
            >
                Lavora con chi condivide i tuoi valori
            </h2>
            <p
                class="text-white/70 text-lg mb-10 max-w-xl mx-auto"
                data-i18n="about.values.cta.sub"
            >
                Scopri il team di persone che ogni giorno mette in pratica questi principi.
            </p>
            <a
                href="{{ route('chi-siamo.team') }}"
                class="btn-white"
                data-i18n="about.values.cta.button"
            >
                Conosci il Team
            </a>
        </div>
    </section>

@endsection
