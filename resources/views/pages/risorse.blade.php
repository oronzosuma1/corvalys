@extends('layouts.app')

@section('title', __('seo.risorse.title'))
@section('meta_description', __('seo.risorse.description'))

@push('head')
    <x-json-ld :data="\App\Support\JsonLd::breadcrumbs([
        ['name' => 'Home', 'url' => route('home')],
        ['name' => __('seo.risorse.title'), 'url' => route('risorse')],
    ])" />
@endpush

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="resources.hero.title"
            >
                Resources
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="resources.hero.sub"
            >
                Free guides, templates, and tools to help your business navigate AI adoption and compliance.
            </p>
        </div>
    </section>

    {{-- ── Featured: AI Readiness Assessment ── --}}
    {{-- Deep 6-dimension self-evaluation (Leadership, Data, Technology,
         Culture, Process, Compliance). This is the full version — the mini
         5-question variant inside the Contact form is kept unchanged for
         quick-lead scoring. --}}
    <section class="section bg-white pb-0">
        <div class="max-w-7xl mx-auto px-6">
            <article class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary via-primary-dark to-navy text-white p-8 sm:p-12 shadow-xl">
                {{-- Decorative corner --}}
                <div class="absolute -top-10 -right-10 w-56 h-56 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-16 -left-16 w-64 h-64 rounded-full bg-white/5"></div>

                <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                    <div class="lg:max-w-2xl">
                        <div class="mb-4">
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-white/10 text-white border border-white/20 px-3 py-1 rounded-full" data-i18n="resources.featured.badge">
                                Free Assessment
                            </span>
                        </div>

                        <h2
                            class="font-heading text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight mb-4"
                            data-i18n="resources.featured.title"
                        >
                            AI Readiness Assessment
                        </h2>

                        <p
                            class="text-white/80 text-base sm:text-lg leading-relaxed mb-6"
                            data-i18n="resources.featured.desc"
                        >
                            Discover how ready your organisation is for AI adoption. Our comprehensive evaluation scores you across six dimensions — Leadership, Data, Technology, Culture, Process, and Compliance — and delivers tailored recommendations based on your results.
                        </p>

                        {{-- Dimension chips --}}
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="text-xs font-medium bg-white/10 text-white/90 px-3 py-1.5 rounded-lg" data-i18n="resources.featured.dim1">Leadership</span>
                            <span class="text-xs font-medium bg-white/10 text-white/90 px-3 py-1.5 rounded-lg" data-i18n="resources.featured.dim2">Data</span>
                            <span class="text-xs font-medium bg-white/10 text-white/90 px-3 py-1.5 rounded-lg" data-i18n="resources.featured.dim3">Technology</span>
                            <span class="text-xs font-medium bg-white/10 text-white/90 px-3 py-1.5 rounded-lg" data-i18n="resources.featured.dim4">Culture</span>
                            <span class="text-xs font-medium bg-white/10 text-white/90 px-3 py-1.5 rounded-lg" data-i18n="resources.featured.dim5">Process</span>
                            <span class="text-xs font-medium bg-white/10 text-white/90 px-3 py-1.5 rounded-lg" data-i18n="resources.featured.dim6">Compliance</span>
                        </div>
                    </div>

                    <div class="flex-shrink-0">
                        <a
                            href="{{ route('survey') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-white text-primary-dark font-bold text-sm sm:text-base shadow-lg hover:shadow-2xl hover:-translate-y-0.5 transition-all duration-200"
                            data-i18n="resources.featured.cta"
                        >
                            Start the Assessment
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </section>

    {{-- ── Resource Cards ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                {{-- Card 1: AI Act Guide --}}
                <article class="card flex flex-col group">
                    <div class="h-1.5 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>

                    <div class="mb-4">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary bg-primary/10 px-3 py-1 rounded-full" data-i18n="resources.badge.guide">
                            Guide
                        </span>
                    </div>

                    <h2
                        class="font-heading text-lg font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                        data-i18n="resources.card1.title"
                    >
                        AI Act Guide for SMEs
                    </h2>

                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="resources.card1.desc"
                    >
                        A practical overview of the EU AI Act obligations that apply to small and medium-sized enterprises, with actionable compliance steps.
                    </p>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <a
                            href="#"
                            class="btn-outline w-full text-center text-sm gap-2"
                            data-i18n="resources.card1.cta"
                        >
                            Download PDF
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </a>
                    </div>
                </article>

                {{-- Card 2: SME Digital Readiness Checklist --}}
                <article class="card flex flex-col group">
                    <div class="h-1.5 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>

                    <div class="mb-4">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary bg-primary/10 px-3 py-1 rounded-full" data-i18n="resources.badge.checklist">
                            Checklist
                        </span>
                    </div>

                    <h2
                        class="font-heading text-lg font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                        data-i18n="resources.card2.title"
                    >
                        SME Digital Readiness Checklist
                    </h2>

                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="resources.card2.desc"
                    >
                        Assess your company's digital maturity across processes, data, infrastructure, and culture before embarking on an AI project.
                    </p>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <a
                            href="#"
                            class="btn-outline w-full text-center text-sm gap-2"
                            data-i18n="resources.card2.cta"
                        >
                            Download Checklist
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </a>
                    </div>
                </article>

                {{-- Card 3: ROI Calculator Template --}}
                <article class="card flex flex-col group">
                    <div class="h-1.5 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>

                    <div class="mb-4">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary bg-primary/10 px-3 py-1 rounded-full" data-i18n="resources.badge.template">
                            Template
                        </span>
                    </div>

                    <h2
                        class="font-heading text-lg font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                        data-i18n="resources.card3.title"
                    >
                        ROI Calculator Template
                    </h2>

                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="resources.card3.desc"
                    >
                        A ready-to-use spreadsheet to model the return on investment of an AI automation project, with built-in formulas and benchmarks.
                    </p>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <a
                            href="#"
                            class="btn-outline w-full text-center text-sm gap-2"
                            data-i18n="resources.card3.cta"
                        >
                            Download Template
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </a>
                    </div>
                </article>

                {{-- Card 4: Integration Playbook --}}
                <article class="card flex flex-col group">
                    <div class="h-1.5 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>

                    <div class="mb-4">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary bg-primary/10 px-3 py-1 rounded-full" data-i18n="resources.badge.playbook">
                            Playbook
                        </span>
                    </div>

                    <h2
                        class="font-heading text-lg font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200"
                        data-i18n="resources.card4.title"
                    >
                        Integration Playbook
                    </h2>

                    <p
                        class="text-gray-500 text-sm leading-relaxed flex-1"
                        data-i18n="resources.card4.desc"
                    >
                        Step-by-step guidance for connecting Corvalys to your ERP, CRM, and accounting software — from API keys to go-live day.
                    </p>

                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <a
                            href="#"
                            class="btn-outline w-full text-center text-sm gap-2"
                            data-i18n="resources.card4.cta"
                        >
                            Learn More
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    {{-- ── Newsletter CTA ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-2xl mx-auto px-6 text-center">

            <h2
                class="section-title mb-4"
                data-i18n="resources.newsletter.title"
            >
                Stay up to date
            </h2>
            <p
                class="section-sub mx-auto mb-10"
                data-i18n="resources.newsletter.sub"
            >
                New guides, regulatory updates, and product tips — delivered straight to your inbox. No spam, unsubscribe any time.
            </p>

            <form
                action="{{ route('newsletter') }}"
                method="POST"
                class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto"
            >
                @csrf
                <input
                    type="email"
                    name="email"
                    required
                    class="flex-1 rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition"
                    data-i18n-placeholder="resources.newsletter.placeholder"
                    placeholder="your@email.com"
                >
                <button
                    type="submit"
                    class="btn-primary shrink-0"
                    data-i18n="resources.newsletter.btn"
                >
                    Subscribe
                </button>
            </form>

        </div>
    </section>

@endsection
