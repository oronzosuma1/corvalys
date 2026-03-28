@php $service = $service ?? null; @endphp

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-6">

    {{-- Type --}}
    <div>
        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo *</label>
        <select name="type" id="type" required
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            <option value="prodotto" {{ old('type', $service?->type) === 'prodotto' ? 'selected' : '' }}>Prodotto</option>
            <option value="consulenza" {{ old('type', $service?->type) === 'consulenza' ? 'selected' : '' }}>Consulenza</option>
        </select>
        @error('type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Name --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome *</label>
        <input type="text" name="name" id="name" value="{{ old('name', $service?->name) }}" required maxlength="255"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Short description --}}
    <div>
        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Descrizione breve *</label>
        <textarea name="short_description" id="short_description" rows="2" required maxlength="500"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">{{ old('short_description', $service?->short_description) }}</textarea>
        <p class="mt-1 text-xs text-gray-400">Max 500 caratteri</p>
        @error('short_description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrizione completa</label>
        <textarea name="description" id="description" rows="8"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary font-mono text-sm"
            placeholder="Supporta Markdown...">{{ old('description', $service?->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Pricing --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label for="price_from" class="block text-sm font-medium text-gray-700 mb-1">Prezzo da (&euro;)</label>
            <input type="number" name="price_from" id="price_from" step="0.01" min="0"
                value="{{ old('price_from', $service?->price_from) }}"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            @error('price_from')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="price_to" class="block text-sm font-medium text-gray-700 mb-1">Prezzo a (&euro;)</label>
            <input type="number" name="price_to" id="price_to" step="0.01" min="0"
                value="{{ old('price_to', $service?->price_to) }}"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            @error('price_to')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="price_unit" class="block text-sm font-medium text-gray-700 mb-1">Unit&agrave; prezzo</label>
            <select name="price_unit" id="price_unit"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                <option value="">-- Nessuna --</option>
                <option value="ora" {{ old('price_unit', $service?->price_unit) === 'ora' ? 'selected' : '' }}>Ora</option>
                <option value="mese" {{ old('price_unit', $service?->price_unit) === 'mese' ? 'selected' : '' }}>Mese</option>
                <option value="progetto" {{ old('price_unit', $service?->price_unit) === 'progetto' ? 'selected' : '' }}>Progetto</option>
                <option value="fisso" {{ old('price_unit', $service?->price_unit) === 'fisso' ? 'selected' : '' }}>Fisso</option>
            </select>
            @error('price_unit')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Active + Sort order --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1"
                    {{ old('is_active', $service?->is_active ?? true) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-primary focus:ring-primary">
                <span class="text-sm font-medium text-gray-700">Attivo</span>
            </label>
        </div>
        <div>
            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Ordine</label>
            <input type="number" name="sort_order" id="sort_order"
                value="{{ old('sort_order', $service?->sort_order ?? 0) }}"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            @error('sort_order')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
