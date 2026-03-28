@extends('layouts.app')

@section('title', 'Blog — Insights su AI, PMI e futuro del lavoro | Corvalys')

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="section-title">Insights su AI, PMI e futuro del lavoro</h1>
            <p class="section-sub">Articoli pratici su automazione, AI Act e come le PMI europee possono competere meglio.</p>
        </div>

        {{-- Type filter tabs --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <a href="{{ route('blog.index', $category ? ['category' => $category] : []) }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition {{ !$type ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                <span data-i18n="nav.blog.all">All Posts</span>
            </a>
            <a href="{{ route('blog.index', array_filter(['type' => 'article', 'category' => $category])) }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition {{ $type === 'article' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                <span data-i18n="nav.blog.articles">Articles</span>
            </a>
            <a href="{{ route('blog.index', array_filter(['type' => 'case_study', 'category' => $category])) }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition {{ $type === 'case_study' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                <span data-i18n="nav.blog.case-studies">Case Studies</span>
            </a>
        </div>

        {{-- Category tabs --}}
        <div class="flex flex-wrap justify-center gap-2 mb-12">
            <a href="{{ route('blog.index', $type ? ['type' => $type] : []) }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition {{ !$category ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                Tutti
            </a>
            @foreach(['ai-pmi' => 'AI per PMI', 'ai-act' => 'AI Act', 'supply-chain' => 'Supply Chain', 'prodotto' => 'Prodotto', 'case-study' => 'Case Study'] as $slug => $label)
                <a href="{{ route('blog.index', array_filter(['category' => $slug, 'type' => $type])) }}"
                    class="px-4 py-2 rounded-full text-sm font-medium transition {{ $category === $slug ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Articles grid --}}
        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $index => $article)
                    @if($index === 0 && !$category && $articles->currentPage() === 1)
                        {{-- Featured first article --}}
                        <div class="md:col-span-2 lg:col-span-3">
                            <a href="{{ route('blog.show', $article) }}" class="block card hover:shadow-lg transition group">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gray-100 rounded-lg h-48 md:h-full flex items-center justify-center text-gray-400">
                                        @if($article->cover_image)
                                            <img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        @endif
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <span class="inline-block bg-primary-light text-primary text-xs font-semibold px-3 py-1 rounded-full w-fit mb-3">{{ ucfirst(str_replace('-', ' ', $article->category)) }}</span>
                                        <h2 class="font-heading text-2xl font-bold text-navy group-hover:text-primary transition">{{ $article->title }}</h2>
                                        <p class="text-gray-600 mt-3 line-clamp-3">{{ $article->excerpt }}</p>
                                        <div class="flex items-center gap-4 mt-4 text-sm text-gray-400">
                                            <span>{{ $article->published_at?->format('d M Y') }}</span>
                                            <span>{{ $article->reading_time_min }} min lettura</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        {{-- Regular article card --}}
                        <a href="{{ route('blog.show', $article) }}" class="card hover:shadow-lg transition group flex flex-col">
                            <div class="bg-gray-100 rounded-lg h-40 mb-4 flex items-center justify-center text-gray-400">
                                @if($article->cover_image)
                                    <img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @endif
                            </div>
                            <span class="inline-block bg-primary-light text-primary text-xs font-semibold px-3 py-1 rounded-full w-fit mb-2">{{ ucfirst(str_replace('-', ' ', $article->category)) }}</span>
                            <h3 class="font-heading text-lg font-bold text-navy group-hover:text-primary transition">{{ $article->title }}</h3>
                            <p class="text-gray-600 text-sm mt-2 line-clamp-2 flex-1">{{ $article->excerpt }}</p>
                            <div class="flex items-center gap-4 mt-4 text-xs text-gray-400">
                                <span>{{ $article->published_at?->format('d M Y') }}</span>
                                <span>{{ $article->reading_time_min }} min</span>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $articles->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Nessun articolo trovato in questa categoria.</p>
                <a href="{{ route('blog.index') }}" class="btn-outline mt-4 inline-block">Vedi tutti gli articoli</a>
            </div>
        @endif
    </div>
</section>
@endsection
