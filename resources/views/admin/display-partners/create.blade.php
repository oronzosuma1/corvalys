@extends('layouts.admin')

@section('title', 'Nuovo partner')

@section('content')
    {{-- Back link --}}
    <div class="mb-6">
        <a href="{{ route('admin.display-partners.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Torna ai partner
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-heading font-semibold text-gray-900">Nuovo partner</h2>
        </div>
        <form method="POST" action="{{ route('admin.display-partners.store') }}" enctype="multipart/form-data" class="p-5">
            @csrf
            <div class="space-y-5">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-xs font-medium text-gray-500 mb-1">Nome</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('name') border-red-300 @enderror">
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Logo --}}
                <div>
                    <label for="logo" class="block text-xs font-medium text-gray-500 mb-1">Logo</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-dark file:text-white hover:file:bg-primary @error('logo') border-red-300 @enderror">
                    @error('logo')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Website URL --}}
                <div>
                    <label for="website_url" class="block text-xs font-medium text-gray-500 mb-1">Sito Web <span class="text-gray-400 font-normal">(opzionale)</span></label>
                    <input type="url" name="website_url" id="website_url" value="{{ old('website_url') }}" placeholder="https://..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('website_url') border-red-300 @enderror">
                    @error('website_url')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-xs font-medium text-gray-500 mb-1">Descrizione <span class="text-gray-400 font-normal">(opzionale)</span></label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Sort Order --}}
                <div class="max-w-xs">
                    <label for="sort_order" class="block text-xs font-medium text-gray-500 mb-1">Ordine</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('sort_order') border-red-300 @enderror">
                    @error('sort_order')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Active --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="is_active" class="text-sm text-gray-700">Attivo</label>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.display-partners.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 transition-colors">Annulla</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                    Crea partner
                </button>
            </div>
        </form>
    </div>
@endsection
