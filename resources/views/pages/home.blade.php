@extends('layouts.app')

@section('title', 'Corvalys — Your first AI employee for European SMEs')

@section('content')

{{-- ========== 1. HERO ========== --}}
<section class="bg-gradient-to-br from-navy to-primary py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- Left column --}}
            <div>
                <span class="inline-block bg-amber-light text-amber-800 text-xs font-semibold px-3 py-1 rounded-full mb-6" data-i18n-html="home.badge">
                    AI Act &mdash; {{ $stats['giorni'] }} days
                </span>
                <h1 class="font-heading text-5xl font-bold text-white leading-tight">
                    <span data-i18n="home.title">Your first</span> <span class="text-primary-light" data-i18n="home.title.highlight">AI employee</span>
                </h1>
                <p class="mt-6 text-xl text-gray-300 max-w-lg" data-i18n="home.subtitle">
                    Manages your invoices, approves documents, prepares you for the AI Act. Zero technical setup.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="https://app.corvalys.eu/register" class="btn-primary" data-i18n-html="home.cta1">
                        Start free &mdash; 3 months
                    </a>
                    <a href="/consulenza" class="btn-outline border-white text-white hover:bg-white/10" data-i18n="home.cta2">
                        Discover consulting
                    </a>
                </div>
            </div>

            {{-- Right column — animated brief card --}}
            <div class="flex justify-center lg:justify-end"
                 x-data="{ active: 0 }"
                 x-init="setInterval(() => active = (active + 1) % 3, 2500)">
                <div class="bg-white rounded-2xl shadow-2xl p-6 text-gray-900 w-full max-w-md">
                    {{-- Card header --}}
                    <div class="flex items-center justify-between mb-5">
                        <span class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Morning brief
                        </span>
                        <span class="text-xs text-gray-400">Generated at 07:00</span>
                    </div>

                    {{-- Invoice rows --}}
                    <div class="space-y-3 min-h-[72px]">
                        {{-- Row 0 --}}
                        <div x-show="active === 0"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Invoice #2847 &mdash; Rossi Constructions</p>
                                <p class="text-xs text-gray-500">&euro;4,200 &mdash; Due tomorrow</p>
                            </div>
                            <span class="shrink-0 ml-3 inline-block bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Urgent</span>
                        </div>

                        {{-- Row 1 --}}
                        <div x-show="active === 1"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Invoice #2843 &mdash; Studio Bianchi</p>
                                <p class="text-xs text-gray-500">&euro;1,850 &mdash; Reminder sent</p>
                            </div>
                            <span class="shrink-0 ml-3 inline-block bg-amber-100 text-amber-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Pending</span>
                        </div>

                        {{-- Row 2 --}}
                        <div x-show="active === 2"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Invoice #2839 &mdash; Tech Solutions</p>
                                <p class="text-xs text-gray-500">&euro;7,500 &mdash; Paid</p>
                            </div>
                            <span class="shrink-0 ml-3 inline-block bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Completed</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ========== 2. STATS ========== --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8 text-center">
            <div>
                <p class="text-primary font-heading text-3xl font-bold">{{ $stats['sme'] }}</p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.sme">SMEs in Europe</p>
            </div>
            <div>
                <p class="text-primary font-heading text-3xl font-bold">{{ $stats['ore'] }}</p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.ore">hrs/week on payments</p>
            </div>
            <div>
                <p class="text-primary font-heading text-3xl font-bold">{{ $stats['pct'] }}</p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.pct">SMEs with delays</p>
            </div>
            <div>
                <p class="text-primary font-heading text-3xl font-bold">&euro;{{ $stats['miliardi'] }}</p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.cash">cash blocked</p>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <p class="text-primary font-heading text-3xl font-bold">{{ $stats['giorni'] }}</p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.giorni">days to Aug 2, 2026</p>
            </div>
        </div>
    </div>
</section>

{{-- ========== 3. PROBLEMA ========== --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <h2 class="section-title" data-i18n="problem.title">Every week SMEs lose time and money</h2>
            <p class="section-sub mt-4" data-i18n="problem.subtitle">Forgotten invoices, chaotic approvals, and an AI regulation looming. Sound familiar?</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Card 1 — Cash blocked --}}
            <div class="card hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <text x="12" y="16" text-anchor="middle" fill="currentColor" font-size="12" font-weight="bold" stroke="none">&euro;</text>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy" data-i18n="problem.card1.title">Cash blocked</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed" data-i18n="problem.card1.desc">
                    9.85 hours per week chasing late payments. Almost 2 working days lost.
                </p>
            </div>

            {{-- Card 2 — Approvals in chaos --}}
            <div class="card hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy" data-i18n="problem.card2.title">Approvals in chaos</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed" data-i18n="problem.card2.desc">
                    Contracts approved via WhatsApp, without trace. Who gave the OK? When?
                </p>
            </div>

            {{-- Card 3 — AI Act imminent --}}
            <div class="card hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy" data-i18n="problem.card3.title">AI Act imminent</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed" data-i18n="problem.card3.desc">
                    {{ $stats['giorni'] }} days to August 2, 2026. You are already an AI deployer even if you don't know it.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ========== 4. TOOLS — Dynamic Product Sections ========== --}}
@foreach($products as $index => $product)
<section class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            @if($index % 2 === 1)
                {{-- Visual placeholder (first on desktop for alternating layout) --}}
                <div class="hidden lg:flex items-center justify-center order-2 lg:order-1">
                    <div class="w-full max-w-sm bg-gray-200 rounded-2xl h-72 flex items-center justify-center text-gray-400 text-sm">
                        Screenshot {{ $product->name }}
                    </div>
                </div>
            @endif

            {{-- Text --}}
            <div class="{{ $index % 2 === 1 ? 'order-1 lg:order-2' : '' }}">
                <span class="inline-block bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Tool {{ chr(65 + $index) }}</span>
                <h2 class="section-title">{{ $product->name }}</h2>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    {{ $product->short_description }}
                </p>
                @if($product->price_from)
                    <p class="mt-6 text-primary font-semibold">
                        From &euro;{{ number_format($product->price_from, 0) }}{{ $product->price_unit ? '/' . $product->price_unit : '' }}
                    </p>
                @endif
                <a href="{{ route('prodotti.show', $product) }}" class="inline-block mt-4 text-primary font-semibold hover:underline">Learn more &rarr;</a>
            </div>

            @if($index % 2 === 0)
                {{-- Visual placeholder --}}
                <div class="hidden lg:flex items-center justify-center">
                    <div class="w-full max-w-sm bg-gray-100 rounded-2xl h-72 flex items-center justify-center text-gray-400 text-sm">
                        Screenshot {{ $product->name }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endforeach

{{-- ========== 5. CONSULENZA TEASER ========== --}}
<section class="bg-primary-dark py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-3xl font-bold text-white" data-i18n="consult.title">
            Need something more custom?
        </h2>
        <p class="mt-4 text-lg text-white/80 max-w-2xl mx-auto" data-i18n="consult.desc">
            We design and build custom AI systems for your business.
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm" data-i18n="consult.pill1">Agentic AI Systems</span>
            <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm" data-i18n="consult.pill2">Supply Chain</span>
            <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm" data-i18n="consult.pill3">AI Act Compliance</span>
        </div>
        <div class="mt-8">
            <a href="/consulenza" class="btn-outline border-white text-white hover:bg-white/10" data-i18n-html="consult.cta">
                Discover consulting &rarr;
            </a>
        </div>
    </div>
</section>

{{-- ========== 6. FOOTER CTA ========== --}}
<section class="bg-navy py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-3xl font-bold text-white" data-i18n="footer-cta.title">
            Join the SMEs already using their first AI employee
        </h2>

        <div class="max-w-md mx-auto mt-8">
            @livewire('newsletter-form')
        </div>

        <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-sm text-white/70">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span data-i18n="footer-cta.badge1">No credit card</span>
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span data-i18n="footer-cta.badge2">3 months free</span>
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span data-i18n="footer-cta.badge3">AI Act compliant</span>
            </span>
        </div>
    </div>
</section>

@endsection
