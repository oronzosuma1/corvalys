@extends('layouts.admin')

@section('title', 'Modifica: ' . $page->title)

@section('content')
    {{-- Back link --}}
    <div class="mb-6">
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Torna alle pagine
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-heading font-semibold text-gray-900">Modifica pagina</h2>
        </div>
        <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="p-5">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                {{-- Title --}}
                <div>
                    <label for="title" class="block text-xs font-medium text-gray-500 mb-1">Titolo</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('title') border-red-300 @enderror">
                    @error('title')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label for="slug" class="block text-xs font-medium text-gray-500 mb-1">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug) }}" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('slug') border-red-300 @enderror">
                    @error('slug')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Body --}}
                <div>
                    <label for="body" class="block text-xs font-medium text-gray-500 mb-1">Contenuto</label>
                    <textarea name="body" id="body" rows="16" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary tinymce-editor @error('body') border-red-300 @enderror">{{ old('body', $page->body) }}</textarea>
                    @error('body')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Meta Description --}}
                <div>
                    <label for="meta_description" class="block text-xs font-medium text-gray-500 mb-1">Meta Description <span class="text-gray-400 font-normal">(opzionale)</span></label>
                    <textarea name="meta_description" id="meta_description" rows="2"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none @error('meta_description') border-red-300 @enderror">{{ old('meta_description', $page->meta_description) }}</textarea>
                    @error('meta_description')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Published --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $page->is_published) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="is_published" class="text-sm text-gray-700">Pubblicata</label>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 transition-colors">Annulla</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                    Salva modifiche
                </button>
            </div>
        </form>
    </div>
@endsection
