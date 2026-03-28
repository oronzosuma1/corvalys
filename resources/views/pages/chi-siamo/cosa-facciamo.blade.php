@extends('layouts.app')

@section('title', 'What We Do – Corvalys')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-navy to-navy/80 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight" data-i18n="chi-siamo.what.title">
            What We Do
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto" data-i18n="chi-siamo.subtitle">
            An AI-first company helping European SMEs modernize with pragmatism and strategic vision.
        </p>
    </div>
</section>

{{-- Sub-navigation --}}
@include('pages.chi-siamo._subnav')

{{-- Content --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($page && $page->body)
            <div class="prose prose-lg max-w-none">
                {!! $page->body !!}
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="card">
                    <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="chi-siamo.what.card1.title">AI Suite for SMEs</h3>
                    <p class="mt-2 text-gray-600 text-sm" data-i18n="chi-siamo.what.card1.desc">We develop ready-to-use AI tools for invoice management, document approvals, and AI Act compliance. Zero technical setup required.</p>
                </div>

                <div class="card">
                    <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="chi-siamo.what.card2.title">Custom Consulting</h3>
                    <p class="mt-2 text-gray-600 text-sm" data-i18n="chi-siamo.what.card2.desc">We design and implement custom AI systems: multi-agent, supply chain optimization, Industry 4.0, and regulatory readiness.</p>
                </div>

                <div class="card">
                    <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="chi-siamo.what.card3.title">Training & Support</h3>
                    <p class="mt-2 text-gray-600 text-sm" data-i18n="chi-siamo.what.card3.desc">We never leave our clients alone. We train teams, monitor results, and iterate until goals are achieved.</p>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
