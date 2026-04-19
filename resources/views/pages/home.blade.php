@extends('layouts.app')

@section('title', __('seo.home.title'))
@section('meta_description', __('seo.home.description'))

@section('content')

{{-- ══════════════════════════════════════════════════════
     1. HERO — Consultancy-first
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
                {{ __('home.hero.badge') }}
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
            {!! __('home.hero.title') !!}
        </h1>

        {{-- Subtitle --}}
        <p
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 350)"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
            class="text-lg sm:text-xl lg:text-2xl text-white/70 max-w-3xl mx-auto leading-relaxed mb-12 transition-all duration-700 ease-out"
            data-i18n="home.hero.sub"
        >
            {{ __('home.hero.sub') }}
        </p>

        {{-- CTA Buttons --}}
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 500)"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
            class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-20 transition-all duration-700 ease-out"
        >
            <a href="{{ config('corvalys.calendly_url', route('contatto')) }}"
               target="{{ config('corvalys.calendly_url') ? '_blank' : '_self' }}"
               rel="noopener noreferrer"
               class="btn-primary text-base px-8 py-4 rounded-xl shadow-xl shadow-primary/30 hover:shadow-primary/50 hover:scale-[1.03] transition-all duration-200 gap-2"
               data-i18n="home.hero.cta1">
                {{ __('home.hero.cta1') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
            <a href="{{ route('consulenza') }}"
               class="btn-white text-base px-8 py-4 rounded-xl hover:scale-[1.03] transition-all duration-200 gap-2"
               data-i18n="home.hero.cta2">
                {{ __('home.hero.cta2') }}
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
                    {{ __('home.hero.stat.sme') }}
                </div>
            </div>

            {{-- Stat: Hours saved --}}
            <div class="card-glass bg-white/5 border-white/10 rounded-2xl p-6 text-center backdrop-blur-md hover:bg-white/10 transition-colors duration-300">
                <div class="text-3xl lg:text-4xl font-heading font-bold text-white mb-1">
                    {{ $stats['ore'] ?? '9.85h' }}
                </div>
                <div class="text-xs sm:text-sm text-white/60 font-medium leading-tight" data-i18n="home.hero.stat.ore">
                    {{ __('home.hero.stat.ore') }}
                </div>
            </div>

            {{-- Stat: Percentage --}}
            <div class="card-glass bg-white/5 border-white/10 rounded-2xl p-6 text-center backdrop-blur-md hover:bg-white/10 transition-colors duration-300">
                <div class="text-3xl lg:text-4xl font-heading font-bold text-white mb-1">
                    {{ $stats['pct'] ?? '52%' }}
                </div>
                <div class="text-xs sm:text-sm text-white/60 font-medium leading-tight" data-i18n="home.hero.stat.pct">
                    {{ __('home.hero.stat.pct') }}
                </div>
            </div>

            {{-- Stat: AI Act countdown --}}
            <div class="card-glass bg-gradient-to-br from-amber/30 to-amber/10 border-amber/30 rounded-2xl p-6 text-center backdrop-blur-md hover:from-amber/40 transition-colors duration-300">
                <div class="text-3xl lg:text-4xl font-heading font-bold text-amber-light mb-1">
                    {{ $stats['giorni'] ?? '—' }}
                </div>
                <div class="text-xs sm:text-sm text-amber-light/80 font-medium leading-tight" data-i18n="home.hero.stat.giorni">
                    {{ __('home.hero.stat.giorni') }}
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
     2. HOW WE HELP — 3 cards
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
            <span class="badge bg-primary/10 text-primary mb-4 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-widest"
                  data-i18n="home.help.badge">
                {{ __('home.help.badge') }}
            </span>
            <h2 class="section-title mb-5" data-i18n="home.help.title">
                {{ __('home.help.title') }}
            </h2>
            <p class="section-sub mx-auto text-center" data-i18n="home.help.sub">
                {{ __('home.help.sub') }}
            </p>
        </div>

        {{-- Cards grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Card 1: Assess --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 0ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/15 to-primary/5 flex items-center justify-center mb-6 group-hover:from-primary/25 group-hover:to-primary/10 transition-colors duration-300">
                    {{-- Magnifying glass icon --}}
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                    data-i18n="home.help.assess.title">
                    {{ __('home.help.assess.title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.help.assess.desc">
                    {{ __('home.help.assess.desc') }}
                </p>
                <div class="mt-7 pt-6 border-t border-gray-100">
                    <a href="{{ route('consulenza') }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary-dark transition-colors duration-200 group/link"
                       data-i18n="home.help.assess.link">
                        {{ __('home.help.assess.link') }}
                    </a>
                </div>
                <div class="mt-4 w-8 h-0.5 bg-primary/30 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

            {{-- Card 2: Implement --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 120ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber/15 to-amber/5 flex items-center justify-center mb-6 group-hover:from-amber/25 group-hover:to-amber/10 transition-colors duration-300">
                    {{-- Cog/wrench icon --}}
                    <svg class="w-7 h-7 text-amber" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437"/>
                    </svg>
                </div>
                <h3 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-amber transition-colors duration-200"
                    data-i18n="home.help.implement.title">
                    {{ __('home.help.implement.title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.help.implement.desc">
                    {{ __('home.help.implement.desc') }}
                </p>
                <div class="mt-7 pt-6 border-t border-gray-100">
                    <a href="{{ route('consulenza') }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-amber hover:text-amber-dark transition-colors duration-200 group/link"
                       data-i18n="home.help.implement.link">
                        {{ __('home.help.implement.link') }}
                    </a>
                </div>
                <div class="mt-4 w-8 h-0.5 bg-amber/40 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

            {{-- Card 3: Support --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 240ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-navy/15 to-navy/5 flex items-center justify-center mb-6 group-hover:from-navy/25 group-hover:to-navy/10 transition-colors duration-300">
                    {{-- Shield-check icon --}}
                    <svg class="w-7 h-7 text-navy" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-navy transition-colors duration-200"
                    data-i18n="home.help.support.title">
                    {{ __('home.help.support.title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.help.support.desc">
                    {{ __('home.help.support.desc') }}
                </p>
                <div class="mt-7 pt-6 border-t border-gray-100">
                    <a href="{{ route('consulenza') }}"
                       class="inline-flex items-center gap-2 text-sm font-semibold text-navy hover:text-navy-dark transition-colors duration-200 group/link"
                       data-i18n="home.help.support.link">
                        {{ __('home.help.support.link') }}
                    </a>
                </div>
                <div class="mt-4 w-8 h-0.5 bg-navy/30 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     3. OUR APPROACH — 5-phase methodology
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
            <span class="badge bg-navy/10 text-navy mb-4 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-widest"
                  data-i18n="home.approach.badge">
                {{ __('home.approach.badge') }}
            </span>
            <h2 class="section-title mb-4" data-i18n="home.approach.title">
                {{ __('home.approach.title') }}
            </h2>
        </div>

        {{-- 5-phase flow --}}
        <div
            x-data="{ visible: false }"
            x-intersect.once="visible = true"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="transition-all duration-700 ease-out"
        >
            {{-- Desktop: horizontal flow with connector line --}}
            <div class="hidden lg:block relative">
                {{-- Connector line --}}
                <div class="absolute top-10 left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-primary/30 via-primary/50 to-primary/30" aria-hidden="true"></div>

                <div class="grid grid-cols-5 gap-6 relative">
                    @php
                        $phases = [
                            ['num' => '1', 'title' => 'Discover', 'desc' => 'Deep-dive into your operations, pain points, and goals', 'delay' => '0'],
                            ['num' => '2', 'title' => 'Diagnose', 'desc' => 'Identify where AI creates real, measurable value', 'delay' => '100'],
                            ['num' => '3', 'title' => 'Design', 'desc' => 'Architecture solutions that fit your systems and budget', 'delay' => '200'],
                            ['num' => '4', 'title' => 'Deliver', 'desc' => 'Build, test, and deploy in focused sprints', 'delay' => '300'],
                            ['num' => '5', 'title' => 'Support', 'desc' => 'Monitor, optimise, and scale what works', 'delay' => '400'],
                        ];
                    @endphp

                    @foreach($phases as $phase)
                    <div
                        x-data="{ visible: false }"
                        x-intersect.once="visible = true"
                        :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="transition-delay: {{ $phase['delay'] }}ms"
                        class="flex flex-col items-center text-center transition-all duration-700 ease-out"
                    >
                        {{-- Number circle --}}
                        <div class="relative z-10 w-20 h-20 rounded-2xl bg-white border-2 border-primary/30 flex items-center justify-center mb-5 shadow-lg shadow-primary/10">
                            <span class="font-heading text-2xl font-bold text-primary">{{ $phase['num'] }}</span>
                        </div>
                        <h3 class="font-heading text-lg font-bold text-gray-900 mb-2" data-i18n="home.approach.phase{{ $phase['num'] }}.title">
                            {{ __('home.approach.phase' . $phase['num'] . '.title') }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.approach.phase{{ $phase['num'] }}.desc">
                            {{ __('home.approach.phase' . $phase['num'] . '.desc') }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Mobile: stacked --}}
            <div class="lg:hidden space-y-6">
                @foreach($phases as $phase)
                <div
                    x-data="{ visible: false }"
                    x-intersect.once="visible = true"
                    :class="visible ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-6'"
                    style="transition-delay: {{ $phase['delay'] }}ms"
                    class="flex items-start gap-5 transition-all duration-700 ease-out"
                >
                    <div class="flex-shrink-0 w-14 h-14 rounded-xl bg-white border-2 border-primary/30 flex items-center justify-center shadow-md shadow-primary/10">
                        <span class="font-heading text-xl font-bold text-primary">{{ $phase['num'] }}</span>
                    </div>
                    <div>
                        <h3 class="font-heading text-lg font-bold text-gray-900 mb-1" data-i18n="home.approach.phase{{ $phase['num'] }}.title">
                            {{ __('home.approach.phase' . $phase['num'] . '.title') }}
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.approach.phase{{ $phase['num'] }}.desc">
                            {{ __('home.approach.phase' . $phase['num'] . '.desc') }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     4. WHO WE WORK WITH
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
            <span class="badge bg-primary/10 text-primary mb-4 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-widest"
                  data-i18n="home.sectors.badge">
                {{ __('home.sectors.badge') }}
            </span>
            <h2 class="section-title mb-5" data-i18n="home.sectors.title">
                {{ __('home.sectors.title') }}
            </h2>
            <p class="section-sub mx-auto text-center" data-i18n="home.sectors.sub">
                {{ __('home.sectors.sub') }}
            </p>
        </div>

        {{-- Sector cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- Operations & Processes --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 0ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/15 to-primary/5 flex items-center justify-center mb-6 group-hover:from-primary/25 group-hover:to-primary/10 transition-colors duration-300">
                    {{-- Cog/gear icon --}}
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                    data-i18n="home.sectors.operations.title">
                    {{ __('home.sectors.operations.title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.sectors.operations.desc">
                    {{ __('home.sectors.operations.desc') }}
                </p>
                <div class="mt-6 w-8 h-0.5 bg-primary/30 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

            {{-- Finance & Administration --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 100ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber/15 to-amber/5 flex items-center justify-center mb-6 group-hover:from-amber/25 group-hover:to-amber/10 transition-colors duration-300">
                    {{-- Banknote/currency icon --}}
                    <svg class="w-7 h-7 text-amber" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-gray-900 mb-3 group-hover:text-amber transition-colors duration-200"
                    data-i18n="home.sectors.finance.title">
                    {{ __('home.sectors.finance.title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.sectors.finance.desc">
                    {{ __('home.sectors.finance.desc') }}
                </p>
                <div class="mt-6 w-8 h-0.5 bg-amber/40 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

            {{-- Quality & Compliance --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 200ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-navy/15 to-navy/5 flex items-center justify-center mb-6 group-hover:from-navy/25 group-hover:to-navy/10 transition-colors duration-300">
                    {{-- Shield-check icon --}}
                    <svg class="w-7 h-7 text-navy" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-gray-900 mb-3 group-hover:text-navy transition-colors duration-200"
                    data-i18n="home.sectors.quality.title">
                    {{ __('home.sectors.quality.title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.sectors.quality.desc">
                    {{ __('home.sectors.quality.desc') }}
                </p>
                <div class="mt-6 w-8 h-0.5 bg-navy/30 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

            {{-- Sales & Customer Service --}}
            <div
                x-data="{ visible: false }"
                x-intersect.once="visible = true"
                :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                style="transition-delay: 300ms"
                class="group relative rounded-2xl border border-gray-100 p-8 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/5 transition-all duration-700 ease-out bg-white"
            >
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/15 to-primary/5 flex items-center justify-center mb-6 group-hover:from-primary/25 group-hover:to-primary/10 transition-colors duration-300">
                    {{-- Users/people icon --}}
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                    data-i18n="home.sectors.sales.title">
                    {{ __('home.sectors.sales.title') }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed" data-i18n="home.sectors.sales.desc">
                    {{ __('home.sectors.sales.desc') }}
                </p>
                <div class="mt-6 w-8 h-0.5 bg-primary/30 group-hover:w-16 transition-all duration-400 rounded-full"></div>
            </div>

        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     5. AI ACT COUNTDOWN
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
                    {{ __('home.aiact.days') }}
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
                {{ __('home.aiact.title') }}
            </h2>
            <p class="text-lg sm:text-xl text-white/65 max-w-2xl mx-auto leading-relaxed mb-10"
               data-i18n="home.aiact.desc">
                {{ __('home.aiact.desc') }}
            </p>

            <a href="{{ route('contatto') }}"
               class="btn-primary px-8 py-4 text-base rounded-xl shadow-xl shadow-primary/30 hover:shadow-primary/50 hover:scale-[1.03] transition-all duration-200 gap-2"
               data-i18n="home.aiact.cta">
                {{ __('home.aiact.cta') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     6. PRODUCTS — AI-Powered Tools
══════════════════════════════════════════════════════ --}}
<section class="section bg-white">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Section header --}}
        <div
            x-data="{ visible: false }"
            x-intersect.once="visible = true"
            :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            class="text-center mb-16 transition-all duration-700 ease-out"
        >
            <span class="badge bg-primary/10 text-primary mb-4 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-widest"
                  data-i18n="home.products.badge">
                {{ __('home.products.badge') }}
            </span>
            <h2 class="section-title mb-5" data-i18n="home.products.title">
                {{ __('home.products.title') }}
            </h2>
            <p class="section-sub mx-auto text-center" data-i18n="home.products.sub">
                {{ __('home.products.sub') }}
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
                        {{ __('home.products.coming_soon') }}
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
                        {{ __('home.products.learn') }}
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
                {{ __('home.products.viewall') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     7. AI READINESS SURVEY CTA
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
                        {{ __('home.survey.badge') }}
                    </span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white tracking-tight leading-tight mb-4">
                        {{ __('home.survey.title') }}
                    </h2>
                    <p class="text-white/60 text-base leading-relaxed mb-8 max-w-lg">
                        {{ __('home.survey.lead') }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-center gap-4 lg:justify-start justify-center">
                        <a href="{{ route('business-survey') }}"
                           class="inline-flex items-center gap-2 px-8 py-4 bg-[#0F7B6C] text-white rounded-xl font-semibold text-sm hover:bg-[#0d6b5e] hover:shadow-lg hover:shadow-primary/30 transition-all duration-200">
                            {{ __('home.survey.cta') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                        </a>
                        <span class="text-white/40 text-xs font-medium">{{ __('home.survey.duration') }}</span>
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
     8. FINAL CTA
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
            <span class="badge bg-primary/20 text-primary-light border border-primary/30 mb-6 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-widest"
                  data-i18n="home.cta.badge">
                {{ __('home.cta.badge') }}
            </span>

            <h2 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight mb-6 leading-tight"
                data-i18n-html="home.cta.title">
                {!! __('home.cta.title') !!}
            </h2>

            <p class="text-lg sm:text-xl text-white/60 max-w-2xl mx-auto leading-relaxed mb-12"
               data-i18n="home.cta.sub">
                {{ __('home.cta.sub') }}
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ config('corvalys.calendly_url', route('contatto')) }}"
                   target="{{ config('corvalys.calendly_url') ? '_blank' : '_self' }}"
                   rel="noopener noreferrer"
                   class="btn-primary text-base px-9 py-4 rounded-xl shadow-xl shadow-primary/30 hover:shadow-primary/50 hover:scale-[1.03] transition-all duration-200 gap-2"
                   data-i18n="home.cta.btn1">
                    {{ __('home.cta.btn1') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
                <a href="{{ route('contatto') }}"
                   class="btn-white text-base px-9 py-4 rounded-xl hover:scale-[1.03] transition-all duration-200 gap-2"
                   data-i18n="home.cta.btn2">
                    {{ __('home.cta.btn2') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                    </svg>
                </a>
            </div>

            {{-- Trust badges --}}
            <div class="mt-14 flex flex-wrap items-center justify-center gap-8 opacity-50">
                <div class="flex items-center gap-2 text-white/70 text-sm font-medium">
                    <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span data-i18n="home.cta.trust1">{{ __('home.cta.trust1') }}</span>
                </div>
                <div class="flex items-center gap-2 text-white/70 text-sm font-medium">
                    <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span data-i18n="home.cta.trust2">{{ __('home.cta.trust2') }}</span>
                </div>
                <div class="flex items-center gap-2 text-white/70 text-sm font-medium">
                    <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span data-i18n="home.cta.trust3">{{ __('home.cta.trust3') }}</span>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
