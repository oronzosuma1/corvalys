@extends('layouts.app')

@section('title', __('seo.consulenza.title'))
@section('meta_description', __('seo.consulenza.description'))

@php
    $consulenzaFaqs = [];
    for ($i = 1; $i <= 6; $i++) {
        $q = __("consulting.faq.q{$i}");
        $a = __("consulting.faq.a{$i}");
        // Skip if translation is missing
        if ($q !== "consulting.faq.q{$i}" && $a !== "consulting.faq.a{$i}") {
            $consulenzaFaqs[] = ['q' => $q, 'a' => $a];
        }
    }
    $consulenzaBreadcrumbs = \App\Support\JsonLd::breadcrumbs([
        ['name' => 'Home', 'url' => route('home')],
        ['name' => __('seo.consulenza.title'), 'url' => route('consulenza')],
    ]);
@endphp
@push('head')
    @if(!empty($consulenzaFaqs))
        <x-json-ld :data="\App\Support\JsonLd::faqPage($consulenzaFaqs)" />
    @endif
    <x-json-ld :data="$consulenzaBreadcrumbs" />
@endpush

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="consulting.hero.title"
            >
                {{ __('consulting.hero.title') }}
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="consulting.hero.sub"
            >
                {{ __('consulting.hero.sub') }}
            </p>
        </div>
    </section>

    {{-- ── Service Tiers Visual ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="section-title mb-4" data-i18n="consulenza.tiers.title">{{ __('consulting.tiers.title') }}</h2>
                <p class="section-sub mx-auto" data-i18n="consulenza.tiers.sub">{{ __('consulting.tiers.sub') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Tier 1 — Advisory --}}
                <div class="relative bg-white border border-gray-200 rounded-2xl p-8 hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col">
                    {{-- Badge --}}
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700" data-i18n="consulenza.tier1.badge">
                        {{ __('consulting.tier1.badge') }}
                    </span>
                    {{-- Icon --}}
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                        </svg>
                    </div>
                    {{-- Content --}}
                    <h3 class="font-heading text-xl font-bold text-gray-900 mb-1" data-i18n="consulenza.tier1.title">{{ __('consulting.tier1.title') }}</h3>
                    <p class="text-sm text-primary font-medium mb-3" data-i18n="consulenza.tier1.subtitle">{{ __('consulting.tier1.subtitle') }}</p>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5" data-i18n="consulenza.tier1.desc">
                        {{ __('consulting.tier1.desc') }}
                    </p>
                    <a href="{{ route('contatto') }}" class="text-primary text-sm font-semibold hover:text-primary-dark transition-colors duration-200" data-i18n="consulenza.tier1.cta">
                        {{ __('consulting.tier1.cta') }}
                    </a>
                </div>

                {{-- Tier 2 — Implementation --}}
                <div class="relative bg-white border border-gray-200 rounded-2xl p-8 hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col ring-2 ring-primary/20">
                    {{-- Badge --}}
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary text-white" data-i18n="consulenza.tier2.badge">
                        {{ __('consulting.tier2.badge') }}
                    </span>
                    {{-- Icon --}}
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    {{-- Content --}}
                    <h3 class="font-heading text-xl font-bold text-gray-900 mb-1" data-i18n="consulenza.tier2.title">{{ __('consulting.tier2.title') }}</h3>
                    <p class="text-sm text-primary font-medium mb-3" data-i18n="consulenza.tier2.subtitle">{{ __('consulting.tier2.subtitle') }}</p>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5" data-i18n="consulenza.tier2.desc">
                        {{ __('consulting.tier2.desc') }}
                    </p>
                    <a href="{{ route('contatto') }}" class="text-primary text-sm font-semibold hover:text-primary-dark transition-colors duration-200" data-i18n="consulenza.tier2.cta">
                        {{ __('consulting.tier2.cta') }}
                    </a>
                </div>

                {{-- Tier 3 — Managed Support --}}
                <div class="relative bg-white border border-gray-200 rounded-2xl p-8 hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col">
                    {{-- Badge --}}
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-800 text-white" data-i18n="consulenza.tier3.badge">
                        {{ __('consulting.tier3.badge') }}
                    </span>
                    {{-- Icon --}}
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 mb-5">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </div>
                    {{-- Content --}}
                    <h3 class="font-heading text-xl font-bold text-gray-900 mb-1" data-i18n="consulenza.tier3.title">{{ __('consulting.tier3.title') }}</h3>
                    <p class="text-sm text-primary font-medium mb-3" data-i18n="consulenza.tier3.subtitle">{{ __('consulting.tier3.subtitle') }}</p>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5" data-i18n="consulenza.tier3.desc">
                        {{ __('consulting.tier3.desc') }}
                    </p>
                    <a href="{{ route('contatto') }}" class="text-primary text-sm font-semibold hover:text-primary-dark transition-colors duration-200" data-i18n="consulenza.tier3.cta">
                        {{ __('consulting.tier3.cta') }}
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
                    {{ __('consulting.services.title') }}
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="consulting.services.sub"
                >
                    {{ __('consulting.services.sub') }}
                </p>
            </div>

            @if($services->isEmpty())
                <div class="text-center py-16">
                    <p class="text-gray-400 text-lg" data-i18n="consulting.services.empty">
                        {{ __('consulting.services.empty') }}
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
                    {{ __('consulting.process.title') }}
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="consulting.process.sub"
                >
                    {{ __('consulting.process.sub') }}
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
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2" data-i18n="consulenza.process.step1.title">
                        {{ __('consulting.process.step1.title') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.process.step1.desc">
                        {{ __('consulting.process.step1.desc') }}
                    </p>
                </div>

                {{-- Step 2 — Diagnose --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">2</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2" data-i18n="consulenza.process.step2.title">
                        {{ __('consulting.process.step2.title') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.process.step2.desc">
                        {{ __('consulting.process.step2.desc') }}
                    </p>
                </div>

                {{-- Step 3 — Design --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">3</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2" data-i18n="consulenza.process.step3.title">
                        {{ __('consulting.process.step3.title') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.process.step3.desc">
                        {{ __('consulting.process.step3.desc') }}
                    </p>
                </div>

                {{-- Step 4 — Deliver --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">4</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2" data-i18n="consulenza.process.step4.title">
                        {{ __('consulting.process.step4.title') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.process.step4.desc">
                        {{ __('consulting.process.step4.desc') }}
                    </p>
                </div>

                {{-- Step 5 — Support --}}
                <div class="relative z-10 flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-primary/20 shadow-md flex items-center justify-center mb-5">
                        <span class="font-heading text-2xl font-bold text-primary">5</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900 mb-2" data-i18n="consulenza.process.step5.title">
                        {{ __('consulting.process.step5.title') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.process.step5.desc">
                        {{ __('consulting.process.step5.desc') }}
                    </p>
                </div>

            </div>

        </div>
    </section>

    {{-- ── Case Studies Placeholder ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="section-title mb-4" data-i18n="consulenza.cases.title">{{ __('consulting.cases.title') }}</h2>
                <p class="section-sub mx-auto" data-i18n="consulenza.cases.sub">{{ __('consulting.cases.sub') }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Case Study 1 --}}
                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-2xl p-8 flex flex-col">
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700" data-i18n="consulenza.cases.coming">
                        {{ __('consulting.cases.coming') }}
                    </span>
                    <p class="text-gray-600 text-sm leading-relaxed mt-4" data-i18n="consulenza.cases.1">
                        {{ __('consulting.cases.1') }}
                    </p>
                </div>

                {{-- Case Study 2 --}}
                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-2xl p-8 flex flex-col">
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700" data-i18n="consulenza.cases.coming">
                        {{ __('consulting.cases.coming') }}
                    </span>
                    <p class="text-gray-600 text-sm leading-relaxed mt-4" data-i18n="consulenza.cases.2">
                        {{ __('consulting.cases.2') }}
                    </p>
                </div>

                {{-- Case Study 3 --}}
                <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-2xl p-8 flex flex-col">
                    <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700" data-i18n="consulenza.cases.coming">
                        {{ __('consulting.cases.coming') }}
                    </span>
                    <p class="text-gray-600 text-sm leading-relaxed mt-4" data-i18n="consulenza.cases.3">
                        {{ __('consulting.cases.3') }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ── FAQ Section ── --}}
    <section class="section bg-white">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="section-title mb-4" data-i18n="consulenza.faq.title">{{ __('consulting.faq.title') }}</h2>
            </div>

            <div class="space-y-4">

                {{-- FAQ 1 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900" data-i18n="consulenza.faq.q1">{{ __('consulting.faq.q1') }}</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.faq.a1">{{ __('consulting.faq.a1') }}</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900" data-i18n="consulenza.faq.q2">{{ __('consulting.faq.q2') }}</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.faq.a2">{{ __('consulting.faq.a2') }}</p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900" data-i18n="consulenza.faq.q3">{{ __('consulting.faq.q3') }}</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.faq.a3">{{ __('consulting.faq.a3') }}</p>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900" data-i18n="consulenza.faq.q4">{{ __('consulting.faq.q4') }}</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.faq.a4">{{ __('consulting.faq.a4') }}</p>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900" data-i18n="consulenza.faq.q5">{{ __('consulting.faq.q5') }}</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.faq.a5">{{ __('consulting.faq.a5') }}</p>
                    </div>
                </div>

                {{-- FAQ 6 --}}
                <div x-data="{ open: false }" class="border border-gray-200 rounded-xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors duration-200">
                        <span class="font-semibold text-gray-900" data-i18n="consulenza.faq.q6">{{ __('consulting.faq.q6') }}</span>
                        <svg :class="open && 'rotate-180'" class="w-5 h-5 text-gray-400 flex-shrink-0 ml-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-5">
                        <p class="text-gray-500 text-sm leading-relaxed" data-i18n="consulenza.faq.a6">{{ __('consulting.faq.a6') }}</p>
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
                    <span data-i18n="consulenza.trust.item1">{{ __('consulting.trust.item1') }}</span>
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span data-i18n="consulenza.trust.item2">{{ __('consulting.trust.item2') }}</span>
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span data-i18n="consulenza.trust.item3">{{ __('consulting.trust.item3') }}</span>
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span data-i18n="consulenza.trust.item4">{{ __('consulting.trust.item4') }}</span>
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span data-i18n="consulenza.trust.item5">{{ __('consulting.trust.item5') }}</span>
                </span>
            </div>
        </div>
    </section>

    {{-- ── CTA Section ── --}}
    <section class="bg-hero text-white section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2 class="font-heading text-3xl sm:text-4xl font-bold mb-4" data-i18n="consulenza.cta.title">
                {{ __('consulting.cta.title') }}
            </h2>
            <p class="text-white/70 text-lg mb-10 max-w-xl mx-auto" data-i18n="consulenza.cta.sub">
                {{ __('consulting.cta.sub') }}
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a
                    href="{{ config('corvalys.calendly_url', route('contatto')) }}"
                    target="{{ config('corvalys.calendly_url') ? '_blank' : '_self' }}"
                    class="btn-white"
                    data-i18n="consulenza.cta.primary"
                >
                    {{ __('consulting.cta.primary') }}
                </a>
                <a
                    href="{{ route('contatto') }}"
                    class="inline-flex items-center px-6 py-3 border-2 border-white/30 text-white rounded-xl font-semibold hover:bg-white/10 transition-colors duration-200"
                    data-i18n="consulenza.cta.secondary"
                >
                    {{ __('consulting.cta.secondary') }}
                </a>
            </div>

        </div>
    </section>

@endsection
