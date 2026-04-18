@extends('layouts.app')

@section('title', __('seo.chi_siamo_partners.title'))
@section('meta_description', __('seo.chi_siamo_partners.description'))

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="about.partners.title"
            >
                I Nostri Partner
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="about.partners.sub"
            >
                Collaboriamo con organizzazioni che condividono la nostra missione di rendere l'AI accessibile
                alle PMI europee.
            </p>
        </div>
    </section>

    {{-- ── Partners Grid ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            @if($partners->isEmpty())

                {{-- Fallback: no partners --}}
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"/>
                        </svg>
                    </div>
                    <p
                        class="text-gray-400 text-lg max-w-sm"
                        data-i18n="about.partners.empty"
                    >
                        Stiamo costruendo la nostra rete di partner. Torna presto.
                    </p>
                </div>

            @else

                <div class="text-center mb-14">
                    <h2
                        class="section-title mb-4"
                        data-i18n="about.partners.grid.heading"
                    >
                        Chi collabora con noi
                    </h2>
                    <p
                        class="section-sub mx-auto"
                        data-i18n="about.partners.grid.sub"
                    >
                        Organizzazioni tecnologiche, accademiche e di consulenza che amplificano l'impatto di Corvalys.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($partners as $partner)

                        <div class="card flex flex-col group">

                            {{-- Logo --}}
                            <div class="mb-6 flex items-center justify-center h-20 rounded-xl bg-gray-50 p-4">
                                @if($partner->logo)
                                    <img
                                        src="{{ asset($partner->logo) }}"
                                        alt="{{ $partner->name }}"
                                        class="max-h-12 max-w-full object-contain"
                                        loading="lazy"
                                    >
                                @else
                                    <span class="font-heading text-xl font-bold text-gray-400">
                                        {{ $partner->name }}
                                    </span>
                                @endif
                            </div>

                            {{-- Name --}}
                            <h3 class="font-heading text-lg font-bold text-gray-900 group-hover:text-primary transition-colors duration-200 mb-3">
                                {{ $partner->name }}
                            </h3>

                            {{-- Description --}}
                            @if($partner->description)
                                <p class="text-gray-500 text-sm leading-relaxed flex-1">
                                    {{ $partner->description }}
                                </p>
                            @endif

                            {{-- Website link --}}
                            @if($partner->website_url)
                                <div class="mt-5 pt-5 border-t border-gray-100">
                                    <a
                                        href="{{ $partner->website_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:underline"
                                        data-i18n="about.partners.visit"
                                    >
                                        Visita il sito
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif

                        </div>

                    @endforeach
                </div>

            @endif

        </div>
    </section>

    {{-- ── Become a Partner CTA ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-4xl mx-auto px-6">
            <div class="card text-center py-14 px-8">

                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary/10 mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <h2
                    class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 mb-4"
                    data-i18n="about.partners.join.title"
                >
                    Diventa un Partner Corvalys
                </h2>
                <p
                    class="text-gray-500 text-base leading-relaxed max-w-xl mx-auto mb-8"
                    data-i18n="about.partners.join.desc"
                >
                    Unisciti alla rete di organizzazioni che portano l'intelligenza artificiale alle PMI europee.
                    Commissioni ricorrenti, supporto dedicato e co-marketing inclusi.
                </p>

                <a
                    href="{{ route('partner') }}"
                    class="btn-primary inline-flex"
                    data-i18n="about.partners.cta"
                >
                    Become a Partner
                </a>

            </div>
        </div>
    </section>

@endsection
