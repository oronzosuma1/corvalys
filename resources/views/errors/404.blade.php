@php
    // Laravel renders the exception view OUTSIDE the middleware pipeline,
    // so SetLocale never gets to run. Re-detect the locale from the URL
    // so the 404 shows the correct language.
    $seg = request()->segment(1);
    $detectedLocale = in_array($seg, ['it', 'fr'], true) ? $seg : app()->getLocale();
    app()->setLocale($detectedLocale);

    // Tell x-seo-head to emit a SINGLE noindex,nofollow tag (otherwise
    // the layout emits index,follow BEFORE our @push and curl shows
    // the wrong directive first).
    $seoNoindex = true;
@endphp
@extends('layouts.app')

@section('title', __('errors.404.title'))
@section('meta_description', __('errors.404.description'))

@section('content')
<section class="bg-hero text-white min-h-[60vh] flex items-center">
    <div class="max-w-3xl mx-auto px-6 py-24 text-center">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/10 backdrop-blur mb-8">
            <svg class="w-10 h-10 text-primary-light" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>
            </svg>
        </div>

        <div class="text-6xl sm:text-7xl font-heading font-bold tracking-tight text-primary-light mb-4">
            404
        </div>

        <h1 class="font-heading text-3xl sm:text-4xl font-bold tracking-tight mb-4">
            {{ __('errors.404.h1') }}
        </h1>

        <p class="text-white/70 text-lg max-w-xl mx-auto mb-10 leading-relaxed">
            {{ __('errors.404.body') }}
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ url('/') }}"
               class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                {{ __('errors.404.home_cta') }}
            </a>
            @if(\Illuminate\Support\Facades\Route::has('contatto.en') || \Illuminate\Support\Facades\Route::has('contatto.it'))
            <a href="{{ \App\Support\LocalizedRoutes::urlFor('contatto') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold backdrop-blur transition">
                {{ __('errors.404.contact_cta') }}
            </a>
            @endif
            @if(\Illuminate\Support\Facades\Route::has('blog.index.it'))
            <a href="{{ \App\Support\LocalizedRoutes::urlFor('blog.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold backdrop-blur transition">
                {{ __('errors.404.blog_cta') }}
            </a>
            @endif
        </div>
    </div>
</section>
@endsection
