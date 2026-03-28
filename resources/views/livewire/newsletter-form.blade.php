<div>
    @if($success)
        <div class="bg-primary-light text-primary-dark px-4 py-3 rounded-lg text-sm font-medium">
            Iscritto con successo! Ti terremo aggiornato.
        </div>
    @else
        <form wire:submit="subscribe" class="flex gap-2">
            <input type="email" wire:model="email" placeholder="La tua email"
                class="flex-1 px-4 py-3 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-primary focus:border-primary"
                required>
            <button type="submit" class="btn-primary whitespace-nowrap text-sm" wire:loading.attr="disabled">
                <span wire:loading.remove>Iscriviti</span>
                <span wire:loading>...</span>
            </button>
        </form>
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        @if($error)
            <p class="text-red-500 text-xs mt-1">{{ $error }}</p>
        @endif
    @endif
</div>
