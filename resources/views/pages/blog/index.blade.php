@extends('layouts.app')

@section('title', __('seo.blog_index.title'))
@section('meta_description', __('seo.blog_index.description'))

@push('head')
    <x-json-ld :data="\App\Support\JsonLd::breadcrumbs([
        ['name' => 'Home', 'url' => route('home')],
        ['name' => __('seo.blog_index.title'), 'url' => route('blog.index')],
    ])" />
@endpush

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="blog.hero.title"
            >
                Blog
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="blog.hero.sub"
            >
                Insights, guide pratiche e case study sull'adozione dell'AI nelle PMI europee.
            </p>
        </div>
    </section>

    {{-- ── Filter Bar ── --}}
    <section class="bg-white border-b border-gray-100 sticky top-16 z-30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-2 py-4 overflow-x-auto scrollbar-hide">

                <a
                    href="{{ route('blog.index') }}"
                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-colors duration-150
                        {{ !$type ? 'bg-primary text-white shadow-sm shadow-primary/20' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}"
                    data-i18n="blog.filter.all"
                >
                    All
                </a>

                <a
                    href="{{ route('blog.index', ['type' => 'article']) }}"
                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-colors duration-150
                        {{ $type === 'article' ? 'bg-primary text-white shadow-sm shadow-primary/20' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}"
                    data-i18n="blog.filter.articles"
                >
                    Articles
                </a>

                <a
                    href="{{ route('blog.index', ['type' => 'case_study']) }}"
                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-colors duration-150
                        {{ $type === 'case_study' ? 'bg-primary text-white shadow-sm shadow-primary/20' : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}"
                    data-i18n="blog.filter.cases"
                >
                    Case Studies
                </a>

            </div>
        </div>
    </section>

    {{-- ── Article Grid ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            @if($articles->isEmpty())

                {{-- Empty state --}}
                <div class="text-center py-24">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gray-100 mb-6">
                        <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg" data-i18n="blog.empty">
                        Nessun articolo disponibile al momento.
                    </p>
                </div>

            @else

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)

                        <article class="card flex flex-col group overflow-hidden p-0">

                            {{-- Cover image / placeholder --}}
                            <a href="{{ route('blog.show', ['slug' => $article->slug]) }}" class="block relative overflow-hidden aspect-[16/9]">
                                @if($article->cover_image)
                                    <img
                                        src="{{ asset($article->cover_image) }}"
                                        alt="{{ $article->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary/20 via-navy/10 to-primary-dark/30 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"/>
                                        </svg>
                                    </div>
                                @endif

                                {{-- Type badge overlay --}}
                                @if($article->type)
                                    <span class="absolute top-3 left-3 badge bg-primary text-white text-xs">
                                        {{ $article->type === 'case_study' ? 'Case Study' : 'Article' }}
                                    </span>
                                @endif
                            </a>

                            {{-- Card body --}}
                            <div class="flex flex-col flex-1 p-6">

                                {{-- Category badge --}}
                                @if($article->category)
                                    <div class="mb-3">
                                        <span class="badge bg-primary/10 text-primary">
                                            {{ $article->category }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Title --}}
                                <h2 class="font-heading text-lg font-bold text-gray-900 mb-2 leading-snug group-hover:text-primary transition-colors duration-200">
                                    <a href="{{ route('blog.show', ['slug' => $article->slug]) }}">
                                        {{ $article->title }}
                                    </a>
                                </h2>

                                {{-- Excerpt --}}
                                @if($article->excerpt)
                                    <p class="text-gray-500 text-sm leading-relaxed flex-1 line-clamp-3">
                                        {{ $article->excerpt }}
                                    </p>
                                @endif

                                {{-- Footer: date + read more --}}
                                <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <time
                                        datetime="{{ $article->published_at->toDateString() }}"
                                        class="text-xs text-gray-400 font-medium"
                                    >
                                        {{ $article->published_at->format('M d, Y') }}
                                    </time>

                                    <a
                                        href="{{ route('blog.show', ['slug' => $article->slug]) }}"
                                        class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:text-primary-dark transition-colors duration-150"
                                        data-i18n="blog.card.read_more"
                                    >
                                        Read more
                                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>

                            </div>

                        </article>

                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($articles->hasPages())
                    <div class="mt-14 flex justify-center">
                        {{ $articles->links() }}
                    </div>
                @endif

            @endif

        </div>
    </section>

@endsection
