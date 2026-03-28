@extends('layouts.app')

@section('title', 'Products — Corvalys AI Suite')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-navy to-primary py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight" data-i18n="prodotti.title">
            Your new AI employees
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto" data-i18n="prodotti.subtitle">
            Three tools designed to solve everyday SME problems. No technical setup, results from day one.
        </p>
    </div>
</section>

{{-- Product Cards --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($products->isEmpty())
            <p class="text-center text-gray-500 text-lg">No products available at the moment. Check back soon.</p>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="card hover:shadow-lg transition-shadow duration-300 flex flex-col">
                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="font-heading text-xl font-bold text-gray-900">{{ $product->name }}</h3>
                        <p class="mt-3 text-gray-600 text-sm flex-1">
                            {{ $product->short_description }}
                        </p>
                        @if($product->price_from)
                            <p class="mt-3 text-primary font-semibold text-sm">
                                From &euro;{{ number_format($product->price_from, 0) }}{{ $product->price_unit ? '/' . $product->price_unit : '' }}
                            </p>
                        @endif
                        <a href="{{ route('prodotti.show', $product) }}" class="mt-6 inline-flex items-center text-primary font-semibold text-sm hover:text-primary-dark">
                            Learn more &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-2xl sm:text-3xl font-bold text-gray-900" data-i18n="prodotti.cta.title">Not sure which tool is right for you?</h2>
        <p class="mt-4 text-gray-600 text-lg" data-i18n="prodotti.cta.desc">Contact us for a free consultation and we'll help you choose.</p>
        <div class="mt-8">
            <a href="/contatto" class="btn-primary" data-i18n="cta.contattaci">Contact us</a>
        </div>
    </div>
</section>

@endsection
