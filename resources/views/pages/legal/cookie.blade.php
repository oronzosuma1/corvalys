@extends('layouts.app')

@section('title', __('seo.cookie.title'))
@section('meta_description', __('seo.cookie.description'))

@push('head')
    <x-json-ld :data="\App\Support\JsonLd::breadcrumbs([
        ['name' => 'Home', 'url' => route('home')],
        ['name' => __('seo.cookie.title'), 'url' => route('cookie')],
    ])" />
@endpush

@php
    use League\CommonMark\Environment\Environment;
    use League\CommonMark\Extension\Autolink\AutolinkExtension;
    use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
    use League\CommonMark\Extension\Table\TableExtension;
    use League\CommonMark\MarkdownConverter;

    $env = new Environment([
        'html_input'         => 'allow',
        'allow_unsafe_links' => false,
    ]);
    $env->addExtension(new CommonMarkCoreExtension());
    $env->addExtension(new TableExtension());
    $env->addExtension(new AutolinkExtension());
    $converter = new MarkdownConverter($env);

    $body = $converter
        ->convert(__('legal.cookie.body', [], app()->getLocale()))
        ->getContent();
@endphp

@section('content')

    {{-- ── Page Header ── --}}
    <section class="bg-hero text-white pt-32 pb-16 lg:pt-40 lg:pb-20">
        <div class="max-w-4xl mx-auto px-6">
            <h1
                class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight mb-4"
                data-i18n="legal.cookie.title"
            >
                {{ __('legal.cookie.title') }}
            </h1>
            <p class="text-white/60 text-sm" data-i18n="legal.cookie.updated">
                {{ __('legal.cookie.updated') }}
            </p>
        </div>
    </section>

    {{-- ── Content ── --}}
    <section class="section bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div
                class="prose prose-gray prose-headings:font-heading prose-headings:font-bold prose-a:text-primary prose-a:no-underline hover:prose-a:underline prose-table:w-full prose-td:px-4 prose-td:py-2 prose-th:px-4 prose-th:py-2 max-w-none"
            >
                {!! $body !!}
            </div>
        </div>
    </section>

@endsection
