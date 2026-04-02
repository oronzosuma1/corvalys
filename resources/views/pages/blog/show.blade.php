@extends('layouts.app')

@section('title', $article->title . ' — Corvalys')
@section('meta_description', $article->excerpt ?? '')

@section('content')

    {{-- ── Breadcrumb ── --}}
    <div class="bg-white border-b border-gray-100 pt-20">
        <div class="max-w-4xl mx-auto px-6 py-4">
            <nav class="flex items-center gap-2 text-sm text-gray-400" aria-label="Breadcrumb">
                <a
                    href="{{ route('blog.index') }}"
                    class="hover:text-primary transition-colors duration-150"
                    data-i18n="blog.breadcrumb.blog"
                >
                    Blog
                </a>
                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-700 font-medium truncate max-w-xs sm:max-w-sm lg:max-w-lg">
                    {{ $article->title }}
                </span>
            </nav>
        </div>
    </div>

    {{-- ── Article Header ── --}}
    <header class="bg-white pt-10 pb-0">
        <div class="max-w-4xl mx-auto px-6">

            {{-- Category badge --}}
            @if($article->category)
                <div class="mb-4">
                    <span class="badge bg-primary/10 text-primary">
                        {{ $article->category }}
                    </span>
                </div>
            @endif

            {{-- Title --}}
            <h1 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 tracking-tight leading-tight mb-6">
                {{ $article->title }}
            </h1>

            {{-- Meta row: date + author --}}
            <div class="flex flex-wrap items-center gap-4 pb-8 border-b border-gray-100">

                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 9v7.5"/>
                    </svg>
                    <time datetime="{{ $article->published_at->toDateString() }}">
                        {{ $article->published_at->format('M d, Y') }}
                    </time>
                </div>

                @if($article->author)
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                        <span>{{ $article->author }}</span>
                    </div>
                @endif

            </div>
        </div>
    </header>

    {{-- ── Cover Image ── --}}
    @if($article->cover_image)
        <div class="bg-white">
            <div class="max-w-4xl mx-auto px-6 pt-8">
                <figure class="rounded-2xl overflow-hidden shadow-lg aspect-[16/9]">
                    <img
                        src="{{ asset($article->cover_image) }}"
                        alt="{{ $article->title }}"
                        class="w-full h-full object-cover"
                    >
                </figure>
            </div>
        </div>
    @endif

    {{-- ── Article Body ── --}}
    <article class="bg-white py-12 lg:py-16">
        <div class="max-w-4xl mx-auto px-6">
            <div class="prose prose-lg prose-gray max-w-none
                prose-headings:font-heading prose-headings:font-bold prose-headings:text-gray-900
                prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                prose-img:rounded-xl prose-img:shadow-md
                prose-blockquote:border-primary prose-blockquote:bg-primary/5 prose-blockquote:rounded-r-lg prose-blockquote:py-1
                prose-code:text-primary prose-code:bg-primary/5 prose-code:rounded prose-code:px-1">
                {!! $article->body !!}
            </div>
        </div>
    </article>

    {{-- ── Related Articles ── --}}
    @if($related->count() > 0)
        <section class="bg-section-alt section-sm">
            <div class="max-w-7xl mx-auto px-6">

                <h2
                    class="font-heading text-2xl sm:text-3xl font-bold text-gray-900 mb-10"
                    data-i18n="blog.related.title"
                >
                    Related Articles
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($related as $rel)

                        <article class="card flex flex-col group overflow-hidden p-0">

                            <a href="{{ route('blog.show', $rel) }}" class="block relative overflow-hidden aspect-[16/9]">
                                @if($rel->cover_image)
                                    <img
                                        src="{{ asset($rel->cover_image) }}"
                                        alt="{{ $rel->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary/20 via-navy/10 to-primary-dark/30"></div>
                                @endif
                            </a>

                            <div class="flex flex-col flex-1 p-6">

                                @if($rel->category)
                                    <div class="mb-2">
                                        <span class="badge bg-primary/10 text-primary text-xs">
                                            {{ $rel->category }}
                                        </span>
                                    </div>
                                @endif

                                <h3 class="font-heading text-base font-bold text-gray-900 mb-2 leading-snug group-hover:text-primary transition-colors duration-200 flex-1">
                                    <a href="{{ route('blog.show', $rel) }}">{{ $rel->title }}</a>
                                </h3>

                                <div class="mt-4 flex items-center justify-between">
                                    <time
                                        datetime="{{ $rel->published_at->toDateString() }}"
                                        class="text-xs text-gray-400"
                                    >
                                        {{ $rel->published_at->format('M d, Y') }}
                                    </time>
                                    <a
                                        href="{{ route('blog.show', $rel) }}"
                                        class="inline-flex items-center gap-1 text-sm font-semibold text-primary hover:text-primary-dark transition-colors duration-150"
                                        data-i18n="blog.card.read_more"
                                    >
                                        Read more
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </article>

                    @endforeach
                </div>

            </div>
        </section>
    @endif

    {{-- ── Back to Blog ── --}}
    <div class="bg-white py-10 border-t border-gray-100">
        <div class="max-w-4xl mx-auto px-6">
            <a
                href="{{ route('blog.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-primary transition-colors duration-150"
                data-i18n="blog.back"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Blog
            </a>
        </div>
    </div>

@endsection
