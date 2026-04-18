@extends('layouts.app')

@section('title', __('seo.chi_siamo_cosa_facciamo.title'))
@section('meta_description', __('seo.chi_siamo_cosa_facciamo.description'))

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="about.whatwedo.title"
            >
                Cosa Facciamo
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="about.whatwedo.sub"
            >
                Tre aree di intervento complementari per portare l'AI in azienda in modo strutturato e duraturo.
            </p>
        </div>
    </section>

    {{-- ── Service Areas ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2
                    class="section-title mb-4"
                    data-i18n="about.whatwedo.areas.heading"
                >
                    Le Nostre Aree di Attività
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="about.whatwedo.areas.sub"
                >
                    Dall'adozione di strumenti pronti all'uso alla costruzione di soluzioni su misura.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Area 1: AI Suite --}}
                <div class="card flex flex-col group">
                    <div class="h-1 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary/10 mb-6 group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 01-.657.643 48.39 48.39 0 01-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 01-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 00-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 01-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 00.657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 005.427-.63 48.05 48.05 0 00.582-4.717.532.532 0 00-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.959.401v0a.656.656 0 00.658-.663 48.422 48.422 0 00-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 01-.61-.58v0z"/>
                        </svg>
                    </div>
                    <h3
                        class="font-heading text-xl font-bold text-gray-900 mb-3"
                        data-i18n="about.whatwedo.area1.title"
                    >
                        AI Suite
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="about.whatwedo.area1.desc"
                    >
                        Una piattaforma integrata di moduli AI pronti all'uso: gestione fatture, approvazioni
                        automatiche, conformità all'AI Act. Attiva in giorni, non mesi.
                    </p>
                    <ul class="mt-5 space-y-2">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area1.feat1">Gestione fatture AI</span>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area1.feat2">Automazione approvazioni</span>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area1.feat3">Compliance AI Act</span>
                        </li>
                    </ul>
                </div>

                {{-- Area 2: Custom Consulting --}}
                <div class="card flex flex-col group">
                    <div class="h-1 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary/10 mb-6 group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <h3
                        class="font-heading text-xl font-bold text-gray-900 mb-3"
                        data-i18n="about.whatwedo.area2.title"
                    >
                        Consulenza Personalizzata
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="about.whatwedo.area2.desc"
                    >
                        Progetti AI su misura per le esigenze specifiche della tua azienda: dall'analisi
                        dei processi alla roadmap strategica fino all'implementazione e al supporto continuativo.
                    </p>
                    <ul class="mt-5 space-y-2">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area2.feat1">AI Readiness Assessment</span>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area2.feat2">Roadmap strategica AI</span>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area2.feat3">Integrazione sistemi esistenti</span>
                        </li>
                    </ul>
                </div>

                {{-- Area 3: Training --}}
                <div class="card flex flex-col group">
                    <div class="h-1 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary/10 mb-6 group-hover:bg-primary/20 transition-colors duration-200">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                        </svg>
                    </div>
                    <h3
                        class="font-heading text-xl font-bold text-gray-900 mb-3"
                        data-i18n="about.whatwedo.area3.title"
                    >
                        Formazione
                    </h3>
                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="about.whatwedo.area3.desc"
                    >
                        Programmi di formazione pratici per manager, team operativi e developer: dall'AI
                        literacy di base ai workshop avanzati su LLM, automazione e data governance.
                    </p>
                    <ul class="mt-5 space-y-2">
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area3.feat1">AI Literacy per manager</span>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area3.feat2">Workshop pratici LLM</span>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-primary shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            <span data-i18n="about.whatwedo.area3.feat3">Certificazioni AI Act</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    {{-- ── CMS Content (supplementary) ── --}}
    @if($page && $page->body)
        <section class="section bg-white">
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
                data-i18n="about.whatwedo.cta.title"
            >
                Pronto a fare il primo passo?
            </h2>
            <p
                class="text-white/70 text-lg mb-10 max-w-xl mx-auto"
                data-i18n="about.whatwedo.cta.sub"
            >
                Parlaci dei tuoi obiettivi e troveremo insieme l'approccio più adatto alla tua realtà.
            </p>
            <a
                href="{{ route('contatto') }}"
                class="btn-white"
                data-i18n="about.whatwedo.cta.button"
            >
                Parla con Noi
            </a>
        </div>
    </section>

@endsection
