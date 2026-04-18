{{--
    Language Switcher (i18n)

    POSTs to /language/{locale} which sets a `locale` cookie (1y) and
    redirects back. The SetLocale middleware resolves that cookie on
    subsequent requests, so server-rendered content (page titles, legal
    bodies, lang/* files) aligns with the user's choice.

    Client-side JS i18n (translations.js) is kept for instant UI swap
    without a page round-trip — localStorage.lang is synced from the cookie
    on boot to keep the two sources consistent.
--}}
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
                <input type="hidden" name="redirect" value="{{ url()->current() }}">
                <button type="submit"
                        role="menuitem"
                        @click="(function(){ try { localStorage.setItem('lang', '{{ $code }}'); } catch(e){} })(); $store.i18n.setLang('{{ $code }}');"
                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 transition"
                        :class="$store.i18n.lang === '{{ $code }}' ? 'text-primary font-semibold' : 'text-gray-600'">
                    {{ $label }}
                </button>
            </form>
        @endforeach
    </div>
</div>
