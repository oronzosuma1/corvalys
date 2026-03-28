@extends('layouts.app')

@section('title', 'Partners – Corvalys')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-navy to-navy/80 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight" data-i18n="nav.partners">
            Partners
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto" data-i18n="chi-siamo.subtitle">
            An AI-first company helping European SMEs modernize with pragmatism and strategic vision.
        </p>
    </div>
</section>

{{-- Sub-navigation --}}
@include('pages.chi-siamo._subnav')

{{-- Partners Grid --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($partners->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($partners as $partner)
                    <div class="card text-center">
                        <div class="mx-auto mb-4 h-24 w-48 flex items-center justify-center">
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-full max-w-full object-contain">
                        </div>
                        <h3 class="font-heading text-lg font-bold text-gray-900">{{ $partner->name }}</h3>
                        @if($partner->description)
                            <p class="text-gray-600 text-sm mt-3 leading-relaxed">{{ $partner->description }}</p>
                        @endif
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 mt-4 text-sm text-primary hover:text-primary/80 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Website
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">
                    Coming soon. We are building our partner network.
                </p>
                <div class="mt-8">
                    <a href="/contatto" class="btn-primary" data-i18n="cta.contattaci">Contact us</a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
