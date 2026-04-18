@extends('layouts.app')

@section('title', __('seo.consulenza.title'))
@section('meta_description', __('seo.consulenza.description'))

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="consulting.hero.title"
            >
                Servizi AI & Consulenza
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="consulting.hero.sub"
            >
                Aiutiamo le micro, piccole e medie imprese europee a identificare dove l'AI crea valore reale, implementarla correttamente e misurarne i risultati.
            </p>
        </div>
    </section>

    {{-- ── Service Tiers Visual ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="section-title mb-4">Come Lavoriamo</h2>
                <p class="section-sub mx-auto">Un modello a tre livelli per ogni fase del tuo percorso AI.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Tier 1 — Advisory --}}
                <div class="relative bg-white border border-gray-200 rounded-2xl p-8 hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col">
                    {{-- Badge --}}
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                        Inizia da qui
                    </span>
                    {{-- Icon --}}
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                        </svg>
                    </div>
                    {{-- Content --}}
                    <h3 class="font-heading text-xl font-bold text-gray-900 mb-1">Consulenza Strategica</h3>
                    <p class="text-sm text-primary font-medium mb-3">Inizia da qui</p>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5">
                        Assessment AI, analisi dei processi, roadmap strategiche e valutazione della prontezza digitale.
                    </p>
                    <a href="{{ route('contatto') }}" class="text-primary text-sm font-semibold hover:text-primary-dark transition-colors duration-200">
                        Richiedi un preventivo &rarr;
                    </a>
                </div>

                {{-- Tier 2 — Implementation --}}
                <div class="relative bg-white border border-gray-200 rounded-2xl p-8 hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col ring-2 ring-primary/20">
                    {{-- Badge --}}
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary text-white">
                        Pi&ugrave; richiesto
                    </span>
                    {{-- Icon --}}
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    {{-- Content --}}
                    <h3 class="font-heading text-xl font-bold text-gray-900 mb-1">Implementazione</h3>
                    <p class="text-sm text-primary font-medium mb-3">Vai in profondit&agrave;</p>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5">
                        Sprint di sviluppo AI, automazione dei workflow, integrazione con i sistemi esistenti e formazione del team.
                    </p>
                    <a href="{{ route('contatto') }}" class="text-primary text-sm font-semibold hover:text-primary-dark transition-colors duration-200">
                        Richiedi un preventivo &rarr;
                    </a>
                </div>

                {{-- Tier 3 — Managed Support --}}
                <div class="relative bg-white border border-gray-200 rounded-2xl p-8 hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col">
                    {{-- Badge --}}
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-800 text-white">
                        Continuativo
                    </span>
                    {{-- Icon --}}
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </div>
                    {{-- Content --}}
                    <h3 class="font-heading text-xl font-bold text-gray-900 mb-1">Supporto Gestito</h3>
                    <p class="text-sm text-primary font-medium mb-3">Resta supportato</p>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5">
                        Supporto gestito continuativo, monitoraggio delle performance, ottimizzazione e accesso ai nostri strumenti SaaS.
                    </p>
                    <a href="{{ route('contatto') }}" class="text-primary text-sm font-semibold hover:text-primary-dark transition-colors duration-200">
                        Richiedi un preventivo &rarr;
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Services Grid ── --}}
    <section class="section bg-section-alt">
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
    <section class="section bg-white">
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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 relative">

                {{-- Connector line (desktop only) --}}
                <div class="hidden lg:block absolute top-10 left-[10%] right-[10%] h-px bg-gradient-to-r from-primary/20 via-primary/50 to-primary/20 z-0"></div>

                {{-- Step 1 — Discover --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">1</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2">
                        Scoperta
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Analizziamo in profondit&agrave; le tue operazioni, i punti critici e gli obiettivi
                    </p>
                </div>

                {{-- Step 2 — Diagnose --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">2</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2">
                        Diagnosi
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Identifichiamo dove l'AI crea valore reale e misurabile
                    </p>
                </div>

                {{-- Step 3 — Design --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">3</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2">
                        Progettazione
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Progettiamo soluzioni che si integrano con i tuoi sistemi e budget
                    </p>
                </div>

                {{-- Step 4 — Deliver --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">4</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2">
                        Consegna
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Costruiamo, testiamo e implementiamo in sprint focalizzati
                    </p>
                </div>

                {{-- Step 5 — Support --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">5</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2">
                        Supporto
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Monitoriamo, ottimizziamo e scaliamo ci&ograve; che funziona
                    </p>
                </div>

            </div>

        </div>
    </section>

    {{-- ── Case Studies Placeholder ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="section-title mb-4">Casi Studio</h2>
                <p class="section-sub mx-auto">Risultati concreti dai nostri progetti.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Case Study 1 --}}
                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-2xl p-8 flex flex-col">
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                        In arrivo
                    </span>
                    <p class="text-gray-600 text-sm leading-relaxed mt-4">
                        Come una PMI europea ha ridotto i tempi di elaborazione documenti del 60% con workflow AI-assistiti
                    </p>
                </div>

                {{-- Case Study 2 --}}
                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-2xl p-8 flex flex-col">
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                        In arrivo
                    </span>
                    <p class="text-gray-600 text-sm leading-relaxed mt-4">
                        Automazione del controllo qualit&agrave; per un'azienda di servizi: dalla gestione manuale dei processi all'efficienza operativa
                    </p>
                </div>

                {{-- Case Study 3 --}}
                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-2xl p-8 flex flex-col">
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                        In arrivo
                    </span>
                    <p class="text-gray-600 text-sm leading-relaxed mt-4">
                        Trasformazione digitale di un'azienda commerciale: dall'analisi dei processi all'implementazione AI in 8 settimane
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ── FAQ Section ── --}}
    <section class="section bg-white">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="section-title mb-4">Domande Frequenti</h2>
            </div>

            <div class="space-y-4">

                {{-- FAQ 1 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900">Quanto dura una valutazione tipica?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed">Generalmente 2-3 settimane, a seconda della complessit&agrave; dell'organizzazione e del numero di processi da analizzare.</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900">Devo avere conoscenze tecniche per lavorare con voi?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed">No, gestiamo tutto noi. Il nostro approccio &egrave; pensato per imprenditori e manager, non per tecnici. Vi guidiamo in ogni fase.</p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900">Con quali dimensioni di azienda lavorate?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed">Tipicamente con imprese da 5 a 250 dipendenti. Le nostre soluzioni sono progettate specificamente per micro, piccole e medie imprese.</p>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900">Lavorate da remoto?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed">S&igrave;, siamo un team remote-first. Lavoriamo principalmente da remoto con workshop on-site quando necessario per le fasi di discovery e formazione.</p>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900">Quali settori servite?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed">Lavoriamo con aziende di ogni settore: servizi, commercio, manifatturiero, tecnologia e altri. Il nostro approccio si basa sul miglioramento dei processi, applicabile a qualsiasi tipo di business.</p>
                    </div>
                </div>

                {{-- FAQ 6 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900">Quanto costa iniziare?</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed">Ogni progetto &egrave; unico e il costo dipende dalla complessit&agrave; e dall'ambito. Offriamo una discovery call gratuita di 30 minuti per capire le tue esigenze e preparare un preventivo personalizzato senza impegno.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Trust Signals ── --}}
    <section class="py-10 bg-section-alt">
        <div class="max-w-5xl mx-auto px-6">
            <div class="flex flex-wrap items-center justify-center gap-8 text-sm text-gray-500 font-medium">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    20+ anni di esperienza
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    CSCP | SCOR-P | PRINCE2
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Miglioramento Processi
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    GDPR & AI Act Ready
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    EU-Based
                </span>
            </div>
        </div>
    </section>

    {{-- ── CTA Section ── --}}
    <section class="bg-hero text-white section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-4">
                Pronto a esplorare cosa pu&ograve; fare l'AI per la tua azienda?
            </h2>
            <p class="text-white/70 text-lg mb-10 max-w-xl mx-auto">
                Prenota una discovery call gratuita di 30 minuti. Nessun impegno, solo una conversazione per capire come possiamo aiutarti.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a
                    href="{{ config('corvalys.calendly_url', route('contatto')) }}"
                    target="{{ config('corvalys.calendly_url') ? '_blank' : '_self' }}"
                    class="btn-white"
                >
                    Prenota una Discovery Call
                </a>
                <a
                    href="{{ route('contatto') }}"
                    class="inline-flex items-center px-6 py-3 border-2 border-white/30 text-white rounded-xl font-semibold hover:bg-white/10 transition-colors duration-200"
                >
                    Contattaci
                </a>
            </div>

        </div>
    </section>

@endsection
