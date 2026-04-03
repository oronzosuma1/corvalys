@extends('layouts.app')

@section('title', __('home.meta.title', [], app()->getLocale()) ?: 'Corvalys — AI for European SMEs')
@section('meta_description', __('home.meta.description', [], app()->getLocale()) ?: 'AI tools and consulting for European SMEs. Automate operations, ensure AI Act compliance, and measurably grow your business.')

@section('content')

{{-- ══════════════════════════════════════════════════════
     1. HERO
══════════════════════════════════════════════════════ --}}
<section class="bg-hero relative overflow-hidden min-h-screen flex flex-col justify-center">

    {{-- Background decorative orbs --}}
    <div class="absolute inset-0 pointer-events-none select-none" aria-hidden="true">
        <div class="absolute -top-40 -left-40 w-[600px] h-[600px] rounded-full bg-primary/20 blur-[120px] opacity-60"></div>
        <div class="absolute top-1/2 right-0 translate-x-1/3 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-navy-light/30 blur-[100px] opacity-50"></div>
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[700px] h-[300px] rounded-full bg-primary/10 blur-[90px] opacity-40"></div>
        {{-- Subtle grid --}}
        <div class="absolute inset-0 opacity-[0.04]"
             style="background-image: linear-gradient(rgba(255,255,255,.5) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.5) 1px,transparent 1px);background-size:64px 64px;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 pt-40 pb-20 lg:pt-48 lg:pb-28 text-center">

        {{-- Badge --}}
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-4'"
            class="inline-flex mb-8 transition-all duration-700 ease-out"
        >
            <span class="badge bg-primary/20 text-primary-light border border-primary/30 text-xs font-semibold tracking-widest uppercase backdrop-blur-sm px-4 py-1.5 rounded-full"
                  data-i18n="home.hero.badge">
                AI-First for European SMEs
            </span>
        </div>

        {{-- H1 --}}
        <h1
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 200)"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
            class="font-heading text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold text-white tracking-tight leading-[1.05] mb-7 transition-all duration-700 ease-out"
            data-i18n-html="home.hero.title"
        >
            The AI Platform<br>
            <span class="bg-gradient-to-r from-primary-light via-[#34d399] to-[#6ee7b7] bg-clip-text text-transparent">
                Built for Europe
            </span>
        </h1>

        {{-- Subtitle --}}
        <p
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 350)"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
            class="text-lg sm:text-xl lg:text-2xl text-white/70 max-w-3xl mx-auto leading-relaxed mb-12 transition-all duration-700 ease-out"
            data-i18n="home.hero.sub"
        >
            Automate operations, slash admin hours, and stay ahead of the AI Act — purpose-built for European SMEs.
        </p>

        {{-- CTA Buttons --}}
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 500)"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
            class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-20 transition-all duration-700 ease-out"
        >
            <a href="{{ route('contatto') }}"
               class="btn-primary text-base px-8 py-4 rounded-xl shadow-xl shadow-primary/30 hover:shadow-primary/50 hover:scale-[1.03] transition-all duration-200 gap-2"
               data-i18n="home.hero.cta1">
                Get in Touch
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
            <a href="{{ route('prodotti') }}"
               class="btn-white text-base px-8 py-4 rounded-xl hover:scale-[1.03] transition-all duration-200 gap-2"
               data-i18n="home.hero.cta2">
                See Products
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </a>
        </div>

        {{-- Stats Row --}}
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 650)"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
            class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-w-5xl mx-auto transition-all duration-700 ease-out"
        >
            {{-- Stat: SMEs --}}
            <div class="card-glass bg-white/5 border-white/10 rounded-2xl p-6 text-center backdrop-blur-md hover:bg-white/10 transition-colors duration-300">
                <div class="text-3xl lg:text-4xl font-heading font-bold text-white mb-1">
                    {{ $stats['sme'] ?? '26.1M' }}
                </div>
                <div class="text-xs sm:text-sm text-white/60 font-medium leading-tight" data-i18n="home.hero.stat.sme">
                    SMEs in Europe
                </div>
            </div>

            {{-- Stat: Hours saved --}}
            <div class="card-glass bg-white/5 border-white/10 rounded-2xl p-6 text-center backdrop-blur-md hover:bg-white/10 transition-colors duration-300">
                <div class="text-3xl lg:text-4xl font-heading font-bold text-white mb-1">
                    {{ $stats['ore'] ?? '9.85h' }}
                </div>
                <div class="text-xs sm:text-sm text-white/60 font-medium leading-tight" data-i18n="home.hero.stat.ore">
                    saved per week
                </div>
            </div>

            {{-- Stat: Percentage --}}
            <div class="card-glass bg-white/5 border-white/10 rounded-2xl p-6 text-center backdrop-blur-md hover:bg-white/10 transition-colors duration-300">
                <div class="text-3xl lg:text-4xl font-heading font-bold text-white mb-1">
                    {{ $stats['pct'] ?? '52%' }}
                </div>
                <div class="text-xs sm:text-sm text-white/60 font-medium leading-tight" data-i18n="home.hero.stat.pct">
                    of SMEs want AI
                </div>
            </div>

            {{-- Stat: AI Act countdown --}}
            <div class="card-glass bg-gradient-to-br from-amber/30 to-amber/10 border-amber/30 rounded-2xl p-6 text-center backdrop-blur-md hover:from-amber/40 transition-colors duration-300">
                <div class="text-3xl lg:text-4xl font-heading font-bold text-amber-light mb-1">
                    {{ $stats['giorni'] ?? '—' }}
                </div>
                <div class="text-xs sm:text-sm text-amber-light/80 font-medium leading-tight" data-i18n="home.hero.stat.giorni">
                    days to AI Act
                </div>
            </div>
        </div>

    </div>

    {{-- Bottom wave --}}
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none" aria-hidden="true">
        <svg viewBox="0 0 1440 64" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full h-16">
            <path d="M0 64L60 58.7C120 53.3 240 42.7 360 37.3C480 32 600 32 720 37.3C840 42.7 960 53.3 1080 56C1200 58.7 1320 53.3 1380 50.7L1440 48V64H1380C1320 64 1200 64 1080 64C960 64 840 64 720 64C600 64 480 64 360 64C240 64 120 64 60 64H0Z" fill="rgb(249 250 251)"/>
        </svg>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     2. PRODUCTS
══════════════════════════════════════════════════════ --}}
<section class="section bg-section-alt">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Section header --}}
        <div
            x-data="{ visible: false }"
            x-intersect.once="visible = true"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="text-center mb-16 transition-all duration-700 ease-out"
        >
            <span class="badge bg-primary/10 text-primary mb-4 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-widest">
                Products
            </span>
            <h2 class="section-title mb-5" data-i18n="home.products.title">
                Tools That Work on Day One
            </h2>
            <p class="section-sub mx-auto text-center" data-i18n="home.products.sub">
                No lengthy onboarding. No IT team required. Each product activates in minutes and starts delivering value immediately.
            </p>
        </div>

        {{-- Product grid --}}
        @if($products->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-14">
            @foreach($products as $index => $product)
            <article
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                :style="'transition-delay: ' + ({{ $index }} * 100) + 'ms'"
                class="card flex flex-col group relative overflow-hidden transition-all duration-700 ease-out"
            >
                {{-- Animated top accent --}}
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-primary-dark rounded-t-2xl transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                <div class="h-1 rounded-t-2xl bg-gradient-to-r from-primary/20 to-primary-dark/20 -mt-7 -mx-7 mb-7"></div>

                {{-- Coming Soon badge --}}
                <div class="absolute top-3 right-3">
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-amber/10 text-amber border border-amber/20" data-i18n="products.coming_soon">
                        Coming Soon
                    </span>
                </div>

                {{-- Icon placeholder --}}
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors duration-300">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
                    </svg>
                </div>

                {{-- Product name — dynamic, no data-i18n --}}
                <h3 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200">
                    {{ $product->name }}
                </h3>

                {{-- Description — dynamic --}}
                <p class="text-gray-500 text-sm leading-relaxed flex-1">
                    {{ $product->short_description }}
                </p>

                {{-- Learn more --}}
                <div class="mt-7 pt-6 border-t border-gray-100">
                    <a href="{{ route('prodotti.show', $product) }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary-dark transition-colors duration-200 group/link"
                       data-i18n="home.products.learn">
                        Learn more
                        <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        @endif

        {{-- View all CTA --}}
        <div class="text-center">
            <a href="{{ route('prodotti') }}"
               class="btn-outline gap-2"
               data-i18n="home.products.viewall">
                View All Products
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     3. WHY CORVALYS
══════════════════════════════════════════════════════ --}}
<section class="section bg-white relative overflow-hidden">

    {{-- Subtle decorative blob --}}
    <div class="absolute top-0 right-0 w-[480px] h-[480px] rounded-full bg-primary/5 blur-[80px] pointer-events-none" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-6">

        {{-- Section header --}}
        <div
            x-data="{ visible: false }"
            x-intersect.once="visible = true"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="text-center mb-16 transition-all duration-700 ease-out"
        >
            <span class="badge bg-navy/10 text-navy mb-4 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-widest">
                Why Corvalys
            </span>
            <h2 class="section-title mb-4" data-i18n="home.why.title">
                Built Different. Built for Europe.
            </h2>
        </div>

        {{-- Feature cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Card 1: EU-First Compliance --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 0ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/15 to-primary/5 flex items-center justify-center mb-6 group-hover:from-primary/25 group-hover:to-primary/10 transition-colors duration-300">
                    {{-- Shield icon --}}
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                    data-i18n="home.why.f1.title">
                    EU-First Compliance
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.why.f1.desc">
                    Every feature is designed around GDPR, the AI Act, and NIS2 by default — so you're always protected without extra effort.
                </p>
                <div class="mt-6 w-8 h-0.5 bg-primary/30 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

            {{-- Card 2: No-Code Setup --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 120ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber/15 to-amber/5 flex items-center justify-center mb-6 group-hover:from-amber/25 group-hover:to-amber/10 transition-colors duration-300">
                    {{-- Lightning bolt icon --}}
                    <svg class="w-7 h-7 text-amber" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-amber transition-colors duration-200"
                    data-i18n="home.why.f2.title">
                    No-Code Setup
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.why.f2.desc">
                    Activate your first workflow in under 10 minutes. No developers, no consultants, no lengthy integrations required.
                </p>
                <div class="mt-6 w-8 h-0.5 bg-amber/40 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

            {{-- Card 3: Measurable ROI --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 240ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-navy/15 to-navy/5 flex items-center justify-center mb-6 group-hover:from-navy/25 group-hover:to-navy/10 transition-colors duration-300">
                    {{-- Chart bar icon --}}
                    <svg class="w-7 h-7 text-navy" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-navy transition-colors duration-200"
                    data-i18n="home.why.f3.title">
                    Measurable ROI
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.why.f3.desc">
                    Real-time dashboards track hours saved, errors eliminated, and revenue recovered — from your first week of use.
                </p>
                <div class="mt-6 w-8 h-0.5 bg-navy/30 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     4. AI ACT COUNTDOWN
══════════════════════════════════════════════════════ --}}
<section class="section relative overflow-hidden bg-gradient-to-br from-[#0a1628] via-navy to-[#0d2d1e]">

    {{-- Background accents --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] rounded-full bg-amber/10 blur-[120px] opacity-60"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] rounded-full bg-primary/15 blur-[100px] opacity-50"></div>
        <div class="absolute inset-0 opacity-[0.03]"
             style="background-image: radial-gradient(rgba(255,255,255,.8) 1px,transparent 1px);background-size:32px 32px;"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-6 text-center">

        {{-- Countdown display --}}
        <div
            x-data="{ visible: false }"
            x-intersect.once="visible = true"
            :class="visible ? 'opacity-100 scale-100' : 'opacity-0 scale-95'"
            class="mb-10 transition-all duration-700 ease-out"
        >
            <div class="inline-flex flex-col items-center justify-center w-44 h-44 rounded-3xl border-2 border-amber/40 bg-amber/10 backdrop-blur-sm shadow-2xl shadow-amber/10 mb-8">
                <span class="font-heading text-6xl font-bold text-amber-light leading-none">
                    {{ $stats['giorni'] ?? '—' }}
                </span>
                <span class="text-amber-light/70 text-sm font-semibold mt-2 tracking-wide" data-i18n="home.aiact.days">
                    days
                </span>
            </div>
        </div>

        <div
            x-data="{ visible: false }"
            x-intersect.once="visible = true"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
            style="transition-delay: 200ms"
            class="transition-all duration-700 ease-out"
        >
            <span class="badge bg-amber/20 text-amber-light border border-amber/30 mb-5 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-widest">
                EU AI Act — August 2, 2026
            </span>

            <h2 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-6"
                data-i18n="home.aiact.title">
                Is Your Business Ready?
            </h2>
            <p class="text-lg sm:text-xl text-white/65 max-w-2xl mx-auto leading-relaxed mb-10"
               data-i18n="home.aiact.desc">
                The EU AI Act enters full force on August 2, 2026. Non-compliant businesses face fines up to 3% of global turnover. Corvalys helps you prepare — starting today.
            </p>

            <a href="{{ route('contatto') }}"
               class="btn-primary px-8 py-4 text-base rounded-xl shadow-xl shadow-primary/30 hover:shadow-primary/50 hover:scale-[1.03] transition-all duration-200 gap-2"
               data-i18n="home.aiact.cta">
                Check Compliance
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     5. AI READINESS SURVEY CTA
══════════════════════════════════════════════════════ --}}
<section class="section bg-white relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute -top-20 right-0 w-[400px] h-[400px] rounded-full bg-primary/5 blur-[80px]"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-6">
        <div
            x-data="{ visible: false }"
            x-intersect.once="visible = true"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-700 ease-out"
        >
            <div class="bg-gradient-to-br from-[#1B3A5C] to-[#0a1628] rounded-3xl p-10 lg:p-16 flex flex-col lg:flex-row items-center gap-10 lg:gap-16 shadow-2xl">

                {{-- Left: Content --}}
                <div class="flex-1 text-center lg:text-left">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold tracking-widest uppercase bg-amber-500/20 text-amber-300 border border-amber-500/30 mb-5">
                        3-Minute Survey
                    </span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white tracking-tight leading-tight mb-4">
                        What is slowing down your business?
                    </h2>
                    <p class="text-white/60 text-base leading-relaxed mb-8 max-w-lg">
                        Take our free 3-minute survey. Help us understand the tasks European businesses want to solve first.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-4 lg:justify-start justify-center">
                        <a href="{{ route('business-survey') }}"
                           class="inline-flex items-center gap-2 px-8 py-4 bg-[#0F7B6C] text-white rounded-xl font-semibold text-sm hover:bg-[#0d6b5e] hover:shadow-lg hover:shadow-primary/30 transition-all duration-200">
                            Start Survey
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                        </a>
                        <span class="text-white/40 text-xs font-medium">Takes 3-5 minutes</span>
                    </div>
                </div>

                {{-- Right: Visual --}}
                <div class="flex-shrink-0 hidden lg:block">
                    <div class="w-56 h-56 relative">
                        {{-- Radar chart illustration --}}
                        <div class="absolute inset-0 rounded-full border-2 border-white/10"></div>
                        <div class="absolute inset-4 rounded-full border border-white/10"></div>
                        <div class="absolute inset-8 rounded-full border border-white/10"></div>
                        <div class="absolute inset-12 rounded-full border border-white/5"></div>
                        {{-- Center icon --}}
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-20 h-20 rounded-2xl bg-primary/20 backdrop-blur-sm border border-primary/30 flex items-center justify-center">
                                <svg class="w-10 h-10 text-primary-light" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                                </svg>
                            </div>
                        </div>
                        {{-- Floating dimension labels --}}
                        <div class="absolute -top-2 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-md bg-green-500/20 text-green-300 text-[9px] font-bold">Leadership</div>
                        <div class="absolute top-1/4 -right-4 px-2 py-0.5 rounded-md bg-blue-500/20 text-blue-300 text-[9px] font-bold">Data</div>
                        <div class="absolute bottom-1/4 -right-6 px-2 py-0.5 rounded-md bg-amber-500/20 text-amber-300 text-[9px] font-bold">Technology</div>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded-md bg-red-500/20 text-red-300 text-[9px] font-bold">Process</div>
                        <div class="absolute bottom-1/4 -left-6 px-2 py-0.5 rounded-md bg-purple-500/20 text-purple-300 text-[9px] font-bold">Culture</div>
                        <div class="absolute top-1/4 -left-8 px-2 py-0.5 rounded-md bg-cyan-500/20 text-cyan-300 text-[9px] font-bold">Compliance</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     6. FINAL CTA
══════════════════════════════════════════════════════ --}}
<section class="section relative overflow-hidden bg-gray-950">

    {{-- Background decoration --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] rounded-full bg-primary/15 blur-[120px]"></div>
        <div class="absolute inset-0 opacity-[0.025]"
             style="background-image: linear-gradient(rgba(255,255,255,.6) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.6) 1px,transparent 1px);background-size:48px 48px;"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-6 text-center">

        <div
            x-data="{ visible: false }"
            x-intersect.once="visible = true"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-700 ease-out"
        >
            <span class="badge bg-primary/20 text-primary-light border border-primary/30 mb-6 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-widest">
                Get Started Today
            </span>

            <h2 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-6 leading-tight"
                data-i18n="home.cta.title">
                Transform Your Business<br>
                <span class="bg-gradient-to-r from-primary-light to-[#6ee7b7] bg-clip-text text-transparent">
                    With AI That Works
                </span>
            </h2>

            <p class="text-lg sm:text-xl text-white/60 max-w-2xl mx-auto leading-relaxed mb-12"
               data-i18n="home.cta.sub">
                Join hundreds of European SMEs that have already automated their operations with Corvalys. No credit card required to get started.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contatto') }}"
                   class="btn-primary text-base px-9 py-4 rounded-xl shadow-xl shadow-primary/30 hover:shadow-primary/50 hover:scale-[1.03] transition-all duration-200 gap-2"
                   data-i18n="home.cta.btn1">
                    Get Started
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
                <a href="{{ config('corvalys.calendly_url', route('consulenza')) }}"
                   target="{{ config('corvalys.calendly_url') ? '_blank' : '_self' }}"
                   rel="noopener noreferrer"
                   class="btn-white text-base px-9 py-4 rounded-xl hover:scale-[1.03] transition-all duration-200 gap-2"
                   data-i18n="home.cta.btn2">
                    Schedule a Call
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                </a>
            </div>

            {{-- Trust badges --}}
            <div class="mt-14 flex flex-wrap items-center justify-center gap-8 opacity-50">
                <div class="flex items-center gap-2 text-white/70 text-sm font-medium">
                    <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span data-i18n="home.cta.trust1">GDPR Compliant</span>
                </div>
                <div class="flex items-center gap-2 text-white/70 text-sm font-medium">
                    <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span data-i18n="home.cta.trust2">EU Data Residency</span>
                </div>
                <div class="flex items-center gap-2 text-white/70 text-sm font-medium">
                    <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span data-i18n="home.cta.trust3">No Credit Card</span>
                </div>
                <div class="flex items-center gap-2 text-white/70 text-sm font-medium">
                    <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span data-i18n="home.cta.trust4">Setup in 10 min</span>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
