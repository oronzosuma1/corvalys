@extends('layouts.app')

@section('title', $service->name . ' — Corvalys')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-navy to-primary py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block rounded-full bg-white/10 text-white text-xs font-semibold px-4 py-1.5 mb-6">Product</span>
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight">
            {{ $service->name }}
        </h1>
        @if($service->short_description)
            <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto">
                {{ $service->short_description }}
            </p>
        @endif
    </div>
</section>

{{-- Main Content --}}
<section class="bg-white py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($service->description)
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($service->description)) !!}
            </div>
        @endif

        {{-- Price Info --}}
        @if($service->price_from || $service->price_to)
            <div class="mt-12 bg-gray-50 rounded-2xl p-8">
                <h2 class="font-heading text-2xl font-bold text-gray-900 mb-4">Pricing</h2>
                <div class="flex items-baseline gap-2">
                    @if($service->price_from)
                        <span class="text-3xl font-bold text-primary">&euro;{{ number_format($service->price_from, 0) }}</span>
                    @endif
                    @if($service->price_to && $service->price_to != $service->price_from)
                        <span class="text-gray-500 text-lg">&ndash;</span>
                        <span class="text-3xl font-bold text-primary">&euro;{{ number_format($service->price_to, 0) }}</span>
                    @endif
                    @if($service->price_unit)
                        <span class="text-gray-500 text-lg">/{{ $service->price_unit }}</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-navy">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white">Start free &mdash; 3 months</h2>
        <p class="mt-4 text-gray-300 text-lg">No commitment, no credit card. Try {{ $service->name }} on your business.</p>
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <a href="https://app.corvalys.eu/register" class="btn-primary">Start free</a>
            <a href="/contatto" class="border border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white/10 transition">Contact us</a>
        </div>
    </div>
</section>

{{-- Other Products --}}
@php
    $otherProducts = \App\Models\Service::prodotti()->active()->where('id', '!=', $service->id)->orderBy('sort_order')->get();
@endphp
@if($otherProducts->isNotEmpty())
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title text-center">Other Products</h2>
        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($otherProducts as $product)
                <div class="card hover:shadow-lg transition-shadow duration-300 flex flex-col">
                    <h3 class="font-heading text-xl font-bold text-gray-900">{{ $product->name }}</h3>
                    <p class="mt-3 text-gray-600 text-sm flex-1">{{ $product->short_description }}</p>
                    <a href="{{ route('prodotti.show', $product) }}" class="mt-6 inline-flex items-center text-primary font-semibold text-sm hover:text-primary-dark">
                        Learn more &rarr;
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
