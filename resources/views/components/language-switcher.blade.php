<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" @click.away="open = false"
        class="flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-primary transition px-2 py-1 rounded-md hover:bg-gray-50">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
        <span x-text="$store.lang.current.toUpperCase()" class="text-xs font-bold"></span>
        <svg class="w-3 h-3 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </button>
    <div x-show="open" x-cloak x-transition
        class="absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
        <button @click="$store.lang.set('en'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center gap-2" :class="{ 'text-primary font-semibold': $store.lang.current === 'en' }">
            <span>&#127468;&#127463;</span> English
        </button>
        <button @click="$store.lang.set('it'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center gap-2" :class="{ 'text-primary font-semibold': $store.lang.current === 'it' }">
            <span>&#127470;&#127481;</span> Italiano
        </button>
        <button @click="$store.lang.set('fr'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center gap-2" :class="{ 'text-primary font-semibold': $store.lang.current === 'fr' }">
            <span>&#127467;&#127479;</span> Fran&ccedil;ais
        </button>
        <button @click="$store.lang.set('de'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center gap-2" :class="{ 'text-primary font-semibold': $store.lang.current === 'de' }">
            <span>&#127465;&#127466;</span> Deutsch
        </button>
        <button @click="$store.lang.set('es'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 flex items-center gap-2" :class="{ 'text-primary font-semibold': $store.lang.current === 'es' }">
            <span>&#127466;&#127480;</span> Espa&ntilde;ol
        </button>
    </div>
</div>
