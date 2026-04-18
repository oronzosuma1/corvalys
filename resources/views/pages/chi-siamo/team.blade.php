@extends('layouts.app')

@section('title', __('seo.chi_siamo_team.title'))
@section('meta_description', __('seo.chi_siamo_team.description'))

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="about.team.title"
            >
                Il Team
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="about.team.sub"
            >
                Le persone che trasformano la visione di Corvalys in soluzioni concrete per le PMI europee.
            </p>
        </div>
    </section>

    {{-- ── Team Grid ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            @if($members->isEmpty())

                {{-- Fallback: no members --}}
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                    </div>
                    <p
                        class="text-gray-400 text-lg max-w-sm"
                        data-i18n="about.team.empty"
                    >
                        I profili del team saranno disponibili a breve.
                    </p>
                </div>

            @else

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($members as $member)

                        <div class="card flex flex-col group">

                            {{-- Photo --}}
                            <div class="mb-6 relative">
                                @if($member->photo)
                                    <img
                                        src="{{ asset($member->photo) }}"
                                        alt="{{ $member->name }}"
                                        class="w-20 h-20 rounded-full object-cover ring-4 ring-white shadow-md"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-20 h-20 rounded-full bg-primary/10 ring-4 ring-white shadow-md flex items-center justify-center">
                                        <svg class="w-10 h-10 text-primary/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Name & Role --}}
                            <h3 class="font-heading text-xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-200 mb-1">
                                {{ $member->name }}
                            </h3>
                            <p class="text-sm font-semibold text-primary mb-4">
                                {{ $member->role }}
                            </p>

                            {{-- Experience summary --}}
                            @if($member->experience_summary)
                                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-3">
                                    {{ $member->experience_summary }}
                                </p>
                            @endif

                            {{-- Bio (truncated) --}}
                            @if($member->bio)
                                <p class="text-gray-500 text-sm leading-relaxed flex-1 line-clamp-4">
                                    {{ $member->bio }}
                                </p>
                            @endif

                            {{-- LinkedIn --}}
                            @if($member->linkedin_url)
                                <div class="mt-5 pt-5 border-t border-gray-100">
                                    <a
                                        href="{{ $member->linkedin_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-primary transition-colors duration-200"
                                        aria-label="LinkedIn profile of {{ $member->name }}"
                                    >
                                        {{-- LinkedIn icon --}}
                                        <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                        <span data-i18n="about.team.linkedin">LinkedIn</span>
                                    </a>
                                </div>
                            @endif

                        </div>

                    @endforeach
                </div>

            @endif

        </div>
    </section>

    {{-- ── CTA ── --}}
    <section class="bg-hero text-white section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2
                class="font-heading text-3xl sm:text-4xl font-bold mb-4"
                data-i18n="about.team.cta.title"
            >
                Vuoi unirti a noi?
            </h2>
            <p
                class="text-white/70 text-lg mb-10 max-w-xl mx-auto"
                data-i18n="about.team.cta.sub"
            >
                Siamo sempre alla ricerca di persone che condividano la nostra passione per l'AI applicata.
            </p>
            <a
                href="{{ route('contatto') }}"
                class="btn-white"
                data-i18n="about.team.cta.button"
            >
                Scrivici
            </a>
        </div>
    </section>

@endsection
