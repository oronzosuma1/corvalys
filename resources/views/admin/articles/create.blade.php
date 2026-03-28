@extends('layouts.admin')

@section('title', 'Nuovo articolo')

@section('content')
    {{-- Back link --}}
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Torna agli articoli
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-heading font-semibold text-gray-900">Crea nuovo articolo</h2>
        </div>
        <form method="POST" action="{{ route('admin.articles.store') }}" class="p-5">
            @csrf
            <div class="space-y-5">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-xs font-medium text-gray-500 mb-1">Titolo</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('title') border-red-300 @enderror">
                    @error('title')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excerpt --}}
                <div>
                    <label for="excerpt" class="block text-xs font-medium text-gray-500 mb-1">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" rows="2"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none @error('excerpt') border-red-300 @enderror">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Body --}}
                <div>
                    <label for="body" class="block text-xs font-medium text-gray-500 mb-1">Contenuto <span class="text-gray-400 font-normal">(Scrivi in Markdown)</span></label>
                    <textarea name="body" id="body" rows="16"
                        class="w-full rounded-lg border-gray-300 text-sm font-mono focus:border-primary focus:ring-primary @error('body') border-red-300 @enderror">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    {{-- Type --}}
                    <div>
                        <label for="type" class="block text-xs font-medium text-gray-500 mb-1">Tipo</label>
                        <select name="type" id="type" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                            <option value="article" {{ old('type') === 'article' ? 'selected' : '' }}>Article</option>
                            <option value="case_study" {{ old('type') === 'case_study' ? 'selected' : '' }}>Case Study</option>
                        </select>
                        @error('type')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div>
                        <label for="category" class="block text-xs font-medium text-gray-500 mb-1">Categoria</label>
                        <select name="category" id="category" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                            <option value="">Seleziona categoria</option>
                            <option value="ai-act" {{ old('category') === 'ai-act' ? 'selected' : '' }}>AI Act</option>
                            <option value="ai-pmi" {{ old('category') === 'ai-pmi' ? 'selected' : '' }}>AI per PMI</option>
                            <option value="supply-chain" {{ old('category') === 'supply-chain' ? 'selected' : '' }}>Supply Chain</option>
                            <option value="automazione" {{ old('category') === 'automazione' ? 'selected' : '' }}>Automazione</option>
                            <option value="strategia" {{ old('category') === 'strategia' ? 'selected' : '' }}>Strategia</option>
                        </select>
                        @error('category')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tags --}}
                    <div>
                        <label for="tags" class="block text-xs font-medium text-gray-500 mb-1">Tags <span class="text-gray-400 font-normal">(separati da virgola)</span></label>
                        <input type="text" name="tags" id="tags" value="{{ old('tags') }}" placeholder="ai, pmi, compliance..."
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        @error('tags')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Published --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                        class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="is_published" class="text-sm text-gray-700">Pubblica immediatamente</label>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 transition-colors">Annulla</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                    Crea articolo
                </button>
            </div>
        </form>
    </div>
@endsection
