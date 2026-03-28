@extends('layouts.app')

@section('title', 'About Us – Corvalys')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-navy to-navy/80 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight" data-i18n="chi-siamo.title">
            About Us
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto" data-i18n="chi-siamo.subtitle">
            An AI-first company helping European SMEs modernize with pragmatism and strategic vision.
        </p>
    </div>
</section>

{{-- Sub-navigation --}}
@include('pages.chi-siamo._subnav')

{{-- Main Content --}}
<section class="bg-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($page && $page->body)
            <div class="prose prose-lg max-w-none">
                {!! $page->body !!}
            </div>
        @else
            <div class="space-y-6">
                <p class="text-gray-600 leading-relaxed" data-i18n="chi-siamo.mission.p1">
                    Corvalys was founded with a clear goal: making artificial intelligence accessible, practical, and compliant for European micro, small, and medium enterprises.
                </p>
                <p class="text-gray-600 leading-relaxed" data-i18n-html="chi-siamo.mission.p2">
                    We don&rsquo;t sell technology for its own sake. We analyze business processes, identify inefficiencies, and build AI solutions that deliver measurable results from day one.
                </p>
                <p class="text-gray-600 leading-relaxed" data-i18n="chi-siamo.mission.p3">
                    Our approach combines expertise in Agentic AI, supply chain, regulatory compliance, and software development to deliver a complete service: from strategy to implementation.
                </p>
            </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-primary-dark text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="font-heading text-2xl sm:text-3xl font-bold tracking-wide">Strategy. Experience. Identity.</p>
        <p class="mt-6 text-lg text-white/90 leading-relaxed" data-i18n="chi-siamo.cta.desc">
            We believe every European SME deserves access to pragmatic, compliant AI tools built for their context.
        </p>
        <div class="mt-10">
            <a href="/contatto" class="btn-primary" data-i18n="chi-siamo.cta.btn">Let's work together</a>
        </div>
    </div>
</section>

@endsection
