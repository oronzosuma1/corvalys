{{-- Language Switcher --}}
<div x-data="{ open: false }" @click.away="open = false" class="relative">
    <button @click="open = !open" class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
        <span x-text="$store.i18n.lang.toUpperCase()">EN</span>
        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
    </button>
    <div x-show="open" x-transition x-cloak
         class="absolute right-0 mt-1 w-28 bg-white border border-gray-100 rounded-xl shadow-xl py-1 z-50">
        @foreach(['en' => 'English', 'it' => 'Italiano', 'fr' => 'Français'] as $code => $label)
            <button @click="$store.i18n.setLang('{{ $code }}'); open = false"
                    class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 transition"
                    :class="$store.i18n.lang === '{{ $code }}' ? 'text-primary font-semibold' : 'text-gray-600'">
                {{ $label }}
            </button>
        @endforeach
    </div>
</div>
