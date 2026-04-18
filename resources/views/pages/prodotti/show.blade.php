@extends('layouts.app')

@section('title', __('seo.prodotto_show.title', ['product' => $service->name]))
@section('meta_description', $service->short_description ?? __('seo.prodotto_show.description'))

@section('content')

    {{-- ── Breadcrumb ── --}}
    <div class="bg-gray-50 border-b border-gray-100 pt-20">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <nav aria-label="breadcrumb">
                <ol class="flex items-center gap-2 text-sm text-gray-500">
                    <li>
                        <a
                            href="{{ route('prodotti') }}"
                            class="hover:text-primary transition-colors duration-150"
                            data-i18n="nav.products"
                        >
                            Prodotti
                        </a>
                    </li>
                    <li aria-hidden="true">
                        <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>
                    <li class="font-medium text-gray-900 truncate max-w-xs" aria-current="page">
                        {{ $service->name }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white py-20 lg:py-28">
        <div class="max-w-4xl mx-auto px-6 text-center">

            {{-- Coming Soon badge --}}
            <div class="mb-6">
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-semibold bg-amber/20 text-amber-light border border-amber/30" data-i18n="products.coming_soon">
                    Coming Soon
                </span>
            </div>

            <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6">
                {{ $service->name }}
            </h1>

            <p class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed">
                {{ $service->short_description }}
            </p>

        </div>
    </section>

    {{-- ── Full Description ── --}}
    <section class="section bg-white">
        <div class="max-w-3xl mx-auto px-6">
            <div class="prose prose-lg prose-gray max-w-none
                        prose-headings:font-heading prose-headings:text-gray-900
                        prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-gray-900 prose-p:text-gray-600 prose-p:leading-relaxed">
                {!! nl2br(e($service->description)) !!}
            </div>
        </div>
    </section>

    {{-- ── CTA Section ── --}}
    <section class="bg-section-alt section-sm">
        <div class="max-w-4xl mx-auto px-6">

            <div class="card-glass bg-gradient-to-br from-primary/5 to-primary/10 border-primary/10 text-center">

                <h2
                    class="section-title mb-4"
                    data-i18n="service.cta.title"
                >
                    Interessato?
                </h2>
                <p
                    class="section-sub mx-auto mb-10"
                    data-i18n="service.cta.sub"
                >
                    Contattaci per scoprire come {{ $service->name }} può trasformare il tuo business, oppure esplora i nostri piani.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">

                    <a
                        href="{{ route('contatto') }}"
                        class="btn-primary"
                        data-i18n="service.cta.contact"
                    >
                        Contattaci
                    </a>

                    <a
                        href="{{ route('prodotti') }}"
                        class="btn-outline"
                        data-i18n="service.back"
                    >
                        Tutti i prodotti
                    </a>

                </div>
            </div>

        </div>
    </section>

    {{-- ── Back to Products ── --}}
    <div class="bg-white border-t border-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-6">
            <a
                href="{{ route('prodotti') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-primary hover:text-primary-dark transition-colors duration-150"
                data-i18n="service.back"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Tutti i prodotti
            </a>
        </div>
    </div>

@endsection
