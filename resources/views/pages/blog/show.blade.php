@extends('layouts.app')

@section('title', $article->title . ' — Blog Corvalys')

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="flex items-center gap-2">
                <li><a href="{{ route('blog.index') }}" class="hover:text-primary transition">Blog</a></li>
                <li><span class="text-gray-300">/</span></li>
                <li>
                    <a href="{{ route('blog.index', ['category' => $article->category]) }}" class="hover:text-primary transition">
                        {{ ucfirst(str_replace('-', ' ', $article->category)) }}
                    </a>
                </li>
                <li><span class="text-gray-300">/</span></li>
                <li class="text-gray-700 font-medium truncate max-w-xs">{{ $article->title }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-12">

            {{-- ===== Main content (70%) ===== --}}
            <article>
                {{-- Category badge --}}
                <span class="inline-block bg-primary-light text-primary text-xs font-semibold px-3 py-1 rounded-full mb-4">
                    {{ ucfirst(str_replace('-', ' ', $article->category)) }}
                </span>

                {{-- Title --}}
                <h1 class="font-heading text-3xl sm:text-4xl font-bold text-navy leading-tight">
                    {{ $article->title }}
                </h1>

                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="text-primary font-bold text-xs">E</span>
                        </div>
                        <span class="font-medium text-gray-700">Enzo</span>
                    </div>
                    <span>{{ $article->published_at?->format('d M Y') }}</span>
                    <span>{{ $article->reading_time_min }} min lettura</span>
                </div>

                {{-- Cover image --}}
                @if($article->cover_image)
                    <div class="mt-8 rounded-xl overflow-hidden">
                        <img src="{{ asset($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover">
                    </div>
                @endif

                {{-- Article body --}}
                <div class="mt-8 prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-navy prose-a:text-primary prose-a:no-underline hover:prose-a:underline">
                    {!! $article->rendered_body !!}
                </div>

                {{-- Share & copy link --}}
                <div class="mt-12 pt-8 border-t border-gray-100" x-data="{ copied: false }">
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-medium text-gray-600">Condividi:</span>
                        <button
                            @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition text-sm"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            <span x-show="!copied">Copia link</span>
                            <span x-show="copied" x-cloak class="text-primary">Copiato!</span>
                        </button>
                    </div>
                </div>

                {{-- CTA trial --}}
                <div class="mt-12 card bg-gradient-to-br from-navy to-primary text-white">
                    <h3 class="font-heading text-xl font-bold">Prova Corvalys gratis per 3 mesi</h3>
                    <p class="mt-2 text-white/80">
                        Il tuo primo dipendente AI: gestisce fatture, approvazioni e compliance. Zero setup tecnico.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="https://app.corvalys.eu/register" class="inline-block bg-white text-primary font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                            Inizia gratis
                        </a>
                        <a href="{{ route('contatto') }}" class="btn-outline border-white text-white hover:bg-white/10">
                            Parla con Enzo
                        </a>
                    </div>
                </div>
            </article>

            {{-- ===== Sidebar (30%) ===== --}}
            <aside class="space-y-8 lg:sticky lg:top-24 lg:self-start">

                {{-- Contatto rapido card --}}
                <div class="card">
                    <h3 class="font-heading text-lg font-bold text-navy mb-3">Contatto rapido</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Hai domande su questo argomento? Parliamone.
                    </p>
                    <a href="{{ route('contatto') }}" class="btn-primary w-full text-center block">
                        Scrivimi
                    </a>
                </div>

                {{-- Newsletter --}}
                <div class="card">
                    <h3 class="font-heading text-lg font-bold text-navy mb-3">Newsletter</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Un articolo a settimana su AI e PMI. Zero spam.
                    </p>
                    @livewire('newsletter-form')
                </div>

                {{-- Related articles --}}
                @if($related->count() > 0)
                    <div>
                        <h3 class="font-heading text-lg font-bold text-navy mb-4">Articoli correlati</h3>
                        <div class="space-y-4">
                            @foreach($related->take(3) as $relatedArticle)
                                <a href="{{ route('blog.show', $relatedArticle) }}" class="block card hover:shadow-md transition group p-4">
                                    <span class="text-xs text-primary font-semibold">
                                        {{ ucfirst(str_replace('-', ' ', $relatedArticle->category)) }}
                                    </span>
                                    <h4 class="font-heading text-sm font-bold text-navy group-hover:text-primary transition mt-1 line-clamp-2">
                                        {{ $relatedArticle->title }}
                                    </h4>
                                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-400">
                                        <span>{{ $relatedArticle->published_at?->format('d M Y') }}</span>
                                        <span>{{ $relatedArticle->reading_time_min }} min</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </aside>
        </div>
    </div>
</section>
@endsection
