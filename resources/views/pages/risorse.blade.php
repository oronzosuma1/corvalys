@extends('layouts.app')

@section('title', 'Risorse gratuite — Corvalys')

@section('content')

{{-- ========== HERO ========== --}}
<section class="bg-gradient-to-br from-navy to-primary py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl font-bold text-white leading-tight">
            Risorse gratuite
        </h1>
        <p class="mt-6 text-xl text-gray-300 max-w-2xl mx-auto">
            Guide, checklist e template per portare l&rsquo;AI nella tua PMI. Scarica gratuitamente lasciando la tua email.
        </p>
    </div>
</section>

{{-- ========== RESOURCES GRID ========== --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8">

            {{-- Resource 1 --}}
            <div class="card hover:shadow-lg transition">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="inline-block bg-amber-100 text-amber-800 text-xs font-semibold px-2 py-0.5 rounded-full mb-2">PDF</span>
                        <h3 class="font-heading text-lg font-bold text-navy">Guida AI Act per PMI</h3>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                            Tutto quello che una PMI deve sapere sull&rsquo;AI Act: obblighi, scadenze, risk classification e passi concreti per adeguarsi entro il 2 agosto 2026.
                        </p>
                        <a href="{{ route('contatto') }}" class="inline-flex items-center gap-2 mt-4 text-primary font-semibold text-sm hover:underline">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Scarica gratis
                        </a>
                    </div>
                </div>
            </div>

            {{-- Resource 2 --}}
            <div class="card hover:shadow-lg transition">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="inline-block bg-amber-100 text-amber-800 text-xs font-semibold px-2 py-0.5 rounded-full mb-2">Checklist</span>
                        <h3 class="font-heading text-lg font-bold text-navy">Checklist Automazione Fatture</h3>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                            20 punti di verifica per valutare se il tuo processo fatturazione &egrave; pronto per l&rsquo;automazione AI. Identifica i quick win e le aree critiche.
                        </p>
                        <a href="{{ route('contatto') }}" class="inline-flex items-center gap-2 mt-4 text-primary font-semibold text-sm hover:underline">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Scarica gratis
                        </a>
                    </div>
                </div>
            </div>

            {{-- Resource 3 --}}
            <div class="card hover:shadow-lg transition">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="inline-block bg-amber-100 text-amber-800 text-xs font-semibold px-2 py-0.5 rounded-full mb-2">Template</span>
                        <h3 class="font-heading text-lg font-bold text-navy">Template Policy AI Interna</h3>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                            Un template editabile per creare la policy AI interna della tua azienda. Conforme ai requisiti dell&rsquo;AI Act per deployer di sistemi AI.
                        </p>
                        <a href="{{ route('contatto') }}" class="inline-flex items-center gap-2 mt-4 text-primary font-semibold text-sm hover:underline">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Scarica gratis
                        </a>
                    </div>
                </div>
            </div>

            {{-- Resource 4 --}}
            <div class="card hover:shadow-lg transition">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="inline-block bg-amber-100 text-amber-800 text-xs font-semibold px-2 py-0.5 rounded-full mb-2">Tool</span>
                        <h3 class="font-heading text-lg font-bold text-navy">Calcolatore ROI Automazione</h3>
                        <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                            Calcola quanto tempo e denaro puoi risparmiare automatizzando i processi amministrativi della tua PMI con l&rsquo;AI.
                        </p>
                        <a href="{{ route('contatto') }}" class="inline-flex items-center gap-2 mt-4 text-primary font-semibold text-sm hover:underline">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Scarica gratis
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========== NEWSLETTER CTA ========== --}}
<section class="bg-navy py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-3xl font-bold text-white">
            Ricevi nuove risorse nella tua inbox
        </h2>
        <p class="mt-4 text-lg text-white/80 max-w-2xl mx-auto">
            Un articolo a settimana su AI, automazione e PMI. Zero spam, cancellazione in un click.
        </p>
        <div class="max-w-md mx-auto mt-8">
            @livewire('newsletter-form')
        </div>
    </div>
</section>

@endsection
