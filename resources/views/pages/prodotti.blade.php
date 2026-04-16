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

    {{-- ── Custom Solution Bridge ── --}}
    <section class="section bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-gradient-to-br from-primary-dark to-navy rounded-2xl p-8 sm:p-12 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
                <div class="relative text-center">
                    <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center">
                        <svg class="w-7 h-7 text-primary-light" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z"/>
                        </svg>
                    </div>
                    <h2 class="font-heading text-2xl sm:text-3xl font-bold mb-3">
                        Hai bisogno di una soluzione su misura?
                    </h2>
                    <p class="text-white/60 text-base sm:text-lg max-w-xl mx-auto mb-8">
                        I nostri prodotti sono l'entry point ideale. Ma se hai esigenze specifiche, il nostro team di consulenza può costruire una soluzione personalizzata per la tua azienda.
                    </p>
                    <a href="{{ route('consulenza') }}"
                       class="inline-flex items-center gap-2.5 bg-white text-primary-dark font-semibold px-8 py-3.5 rounded-xl hover:bg-primary-light hover:scale-[1.03] transition-all duration-200 shadow-lg shadow-black/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                        </svg>
                        Scopri i Nostri Servizi
                    </a>
                </div>
            </div>
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
