@extends('layouts.admin')

@section('title', 'Nuovo membro del team')

@section('content')
    {{-- Back link --}}
    <div class="mb-6">
        <a href="{{ route('admin.team-members.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Torna al team
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-heading font-semibold text-gray-900">Nuovo membro del team</h2>
        </div>
        <form method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data" class="p-5">
            @csrf
            <div class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-xs font-medium text-gray-500 mb-1">Nome</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('name') border-red-300 @enderror">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label for="role" class="block text-xs font-medium text-gray-500 mb-1">Ruolo</label>
                        <input type="text" name="role" id="role" value="{{ old('role') }}" required
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('role') border-red-300 @enderror">
                        @error('role')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Bio --}}
                <div>
                    <label for="bio" class="block text-xs font-medium text-gray-500 mb-1">Bio</label>
                    <textarea name="bio" id="bio" rows="4"
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none @error('bio') border-red-300 @enderror">{{ old('bio') }}</textarea>
                    @error('bio')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Photo --}}
                <div>
                    <label for="photo" class="block text-xs font-medium text-gray-500 mb-1">Foto</label>
                    <input type="file" name="photo" id="photo" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-dark file:text-white hover:file:bg-primary @error('photo') border-red-300 @enderror">
                    @error('photo')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- LinkedIn URL --}}
                    <div>
                        <label for="linkedin_url" class="block text-xs font-medium text-gray-500 mb-1">LinkedIn URL <span class="text-gray-400 font-normal">(opzionale)</span></label>
                        <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/in/..."
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('linkedin_url') border-red-300 @enderror">
                        @error('linkedin_url')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sort Order --}}
                    <div>
                        <label for="sort_order" class="block text-xs font-medium text-gray-500 mb-1">Ordine</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary @error('sort_order') border-red-300 @enderror">
                        @error('sort_order')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Active --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="is_active" class="text-sm text-gray-700">Attivo</label>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.team-members.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 transition-colors">Annulla</a>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                    Crea membro
                </button>
            </div>
        </form>
    </div>
@endsection
