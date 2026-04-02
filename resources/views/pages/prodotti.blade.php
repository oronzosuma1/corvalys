@extends('layouts.app')

@section('title', __('products.meta.title', [], app()->getLocale()) ?: 'Prodotti — Corvalys')
@section('meta_description', __('products.meta.description', [], app()->getLocale()) ?: '')

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="products.hero.title"
            >
                I Nostri Prodotti
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="products.hero.sub"
            >
                Soluzioni AI progettate per le PMI europee. Automazione intelligente, conformità garantita.
            </p>
        </div>
    </section>

    {{-- ── Product Grid ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            @if($products->isEmpty())
                <div class="text-center py-20">
                    <p class="text-gray-400 text-lg" data-i18n="products.empty">
                        Nessun prodotto disponibile al momento.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <article class="card flex flex-col group relative">

                            {{-- Card header accent --}}
                            <div class="h-1.5 rounded-t-2xl bg-gradient-to-r from-primary to-primary-dark -mt-7 -mx-7 mb-7"></div>

                            {{-- Coming Soon badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-amber/10 text-amber border border-amber/20" data-i18n="products.coming_soon">
                                    Coming Soon
                                </span>
                            </div>

                            {{-- Product name — dynamic, no i18n --}}
                            <h2 class="font-heading text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-200">
                                {{ $product->name }}
                            </h2>

                            {{-- Short description — dynamic --}}
                            <p class="text-gray-500 text-sm leading-relaxed flex-1">
                                {{ $product->short_description }}
                            </p>

                            {{-- CTA: Learn More only --}}
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <a
                                    href="{{ route('prodotti.show', $product) }}"
                                    class="btn-outline w-full text-center text-sm gap-2"
                                    data-i18n="products.learn"
                                >
                                    Scopri di più
                                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>

                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

    {{-- ── Bottom CTA ── --}}
    <section class="bg-section-alt section-sm">
        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2
                class="section-title mb-4"
                data-i18n="products.cta.title"
            >
                Non sai da dove iniziare?
            </h2>
            <p
                class="section-sub mx-auto mb-10"
                data-i18n="products.cta.sub"
            >
                Parliamo delle tue esigenze specifiche e troviamo insieme la soluzione giusta per la tua azienda.
            </p>

            <a
                href="{{ route('contatto') }}"
                class="btn-primary"
                data-i18n="products.cta.btn"
            >
                Contattaci
            </a>

        </div>
    </section>

@endsection
