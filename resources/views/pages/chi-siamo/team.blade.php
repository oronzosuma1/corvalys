@extends('layouts.app')

@section('title', 'Our Team – Corvalys')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-navy to-navy/80 py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight" data-i18n="chi-siamo.team.title">
            Our Team
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto" data-i18n="chi-siamo.subtitle">
            An AI-first company helping European SMEs modernize with pragmatism and strategic vision.
        </p>
    </div>
</section>

{{-- Sub-navigation --}}
@include('pages.chi-siamo._subnav')

{{-- Team Members --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($members->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($members as $member)
                    <div class="card text-center">
                        <div class="mx-auto mb-4 h-32 w-32 rounded-full overflow-hidden bg-gray-100">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="h-full w-full object-cover">
                        </div>
                        <h3 class="font-heading text-lg font-bold text-gray-900">{{ $member->name }}</h3>
                        <p class="text-primary text-sm font-medium mt-1">{{ $member->role }}</p>
                        @if($member->bio)
                            <p class="text-gray-600 text-sm mt-3 leading-relaxed">{{ $member->bio }}</p>
                        @endif
                        @if($member->linkedin_url)
                            <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 mt-4 text-sm text-primary hover:text-primary/80 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                LinkedIn
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg" data-i18n="chi-siamo.team.desc">
                    We will soon publish our leadership team profiles. In the meantime, find out how we can help your business.
                </p>
                <div class="mt-8">
                    <a href="/contatto" class="btn-primary" data-i18n="cta.contattaci">Contact us</a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
