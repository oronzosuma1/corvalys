{{--
    Language Switcher (i18n + URL localization)

    Each option POSTs to /language/{locale} which sets a 1-year `locale`
    cookie and redirects to the equivalent URL in the chosen language
    (hreflang alternate of the current page, computed via
    App\Support\LocalizedRoutes::currentInLocale()).

    The Alpine store update keeps the client-side i18n in sync so the UI
    doesn't flash the old language during the round-trip.
--}}
@php
    $alternates = \App\Support\LocalizedRoutes::alternatesFor();
@endphp
<div x-data="{ open: false }" @click.away="open = false" class="relative">
    <button type="button"
            @click="open = !open"
            :aria-expanded="open.toString()"
            aria-haspopup="true"
            class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
        <span x-text="$store.i18n.lang.toUpperCase()">{{ strtoupper(app()->getLocale()) }}</span>
        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div x-show="open"
         x-transition
         x-cloak
         role="menu"
         class="absolute right-0 mt-1 w-32 bg-white border border-gray-100 rounded-xl shadow-xl py-1 z-50">
        @foreach(['en' => 'English', 'it' => 'Italiano', 'fr' => 'Français'] as $code => $label)
            <form action="{{ route('language.switch', $code) }}" method="POST" class="block">
                @csrf
                {{-- Redirect to the equivalent localized URL, not the current URL --}}
                <input type="hidden" name="redirect" value="{{ $alternates[$code] ?? url()->current() }}">
                <button type="submit"
                        role="menuitem"
                        @click="(function(){ try { localStorage.setItem('lang', '{{ $code }}'); document.cookie = 'locale={{ $code }}; path=/; max-age=31536000; samesite=lax'; } catch(e){} })(); $store.i18n.setLang('{{ $code }}');"
                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 transition"
                        :class="$store.i18n.lang === '{{ $code }}' ? 'text-primary font-semibold' : 'text-gray-600'">
                    {{ $label }}
                </button>
            </form>
        @endforeach
    </div>
</div>
