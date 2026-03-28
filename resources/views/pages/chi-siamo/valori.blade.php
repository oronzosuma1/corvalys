@extends('layouts.app')

@section('title', 'Our Values – Corvalys')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-navy to-navy/80 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight" data-i18n="chi-siamo.values.title">
            Our Values
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
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Chiarezza --}}
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="chi-siamo.values.clarity.title">Clarity</h3>
                    <p class="mt-2 text-gray-600 text-sm" data-i18n="chi-siamo.values.clarity.desc">No buzzwords. We explain what we do, why, and how much it costs.</p>
                </div>

                {{-- Impatto misurabile --}}
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="chi-siamo.values.impact.title">Measurable Impact</h3>
                    <p class="mt-2 text-gray-600 text-sm" data-i18n-html="chi-siamo.values.impact.desc">Every project has KPIs defined upfront. If there&rsquo;s no ROI, we don&rsquo;t propose it.</p>
                </div>

                {{-- Etica dei dati --}}
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="chi-siamo.values.ethics.title">Data Ethics</h3>
                    <p class="mt-2 text-gray-600 text-sm" data-i18n="chi-siamo.values.ethics.desc">GDPR and AI Act are not checkboxes. They are the foundation of how we work.</p>
                </div>

                {{-- Partnership --}}
                <div class="text-center">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="chi-siamo.values.partnership.title">Partnership</h3>
                    <p class="mt-2 text-gray-600 text-sm" data-i18n="chi-siamo.values.partnership.desc">We are not vendors. We are partners who grow with our clients.</p>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
