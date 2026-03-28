@extends('layouts.admin')

@section('title', 'Articoli')

@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Gestisci gli articoli del blog</p>
        <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Nuovo articolo
        </a>
    </div>

    {{-- Filter tabs --}}
    <div class="flex gap-2 mb-6">
        <a href="{{ route('admin.articles.index') }}"
           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('type') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Tutti
        </a>
        <a href="{{ route('admin.articles.index', ['type' => 'article']) }}"
           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('type') === 'article' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Articoli
        </a>
        <a href="{{ route('admin.articles.index', ['type' => 'case_study']) }}"
           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('type') === 'case_study' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Case Study
        </a>
    </div>

    {{-- Articles Table --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/80">
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Titolo</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Categoria</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Stato</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Data</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Azioni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($articles ?? [] as $article)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-3">
                                <p class="font-medium text-gray-900">{{ $article->title }}</p>
                                @if($article->excerpt)
                                    <p class="text-xs text-gray-400 mt-0.5 truncate max-w-md">{{ $article->excerpt }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $article->category ?? '-' }}</td>
                            <td class="px-5 py-3">
                                <form method="POST" action="{{ route('admin.articles.toggle', $article) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium transition-colors
                                        {{ $article->is_published
                                            ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                            : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $article->is_published ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                        {{ $article->is_published ? 'Pubblicato' : 'Bozza' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-5 py-3 text-xs text-gray-400">{{ $article->created_at->format('d/m/Y') }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="inline-flex items-center text-primary hover:text-primary-dark text-xs font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Modifica
                                    </a>
                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo articolo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-red-500 hover:text-red-700 text-xs font-medium">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Elimina
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400 text-sm">Nessun articolo presente</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($articles) && $articles->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">
                {{ $articles->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
