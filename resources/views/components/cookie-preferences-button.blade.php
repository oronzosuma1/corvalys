{{-- Floating Cookie Preferences Button (opt-in via config) --}}
@if(config('corvalys.cookie_preferences_button', false))
<div x-data="{
        bannerOpen: false,
        init() {
            // Hide if banner is open; track via custom events.
            this.bannerOpen = false;
            window.addEventListener('cookie-banner:open', () => { this.bannerOpen = true; });
            window.addEventListener('open-cookie-preferences', () => { this.bannerOpen = true; }); // legacy alias
            // Reset when consent is saved
            window.addEventListener('consent:updated', () => { this.bannerOpen = false; });
            window.addEventListener('cookie-consent-ready', () => { this.bannerOpen = false; }); // legacy alias
        }
     }"
     x-cloak
     x-show="!bannerOpen"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 scale-90"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-90"
     class="fixed bottom-4 left-4 z-[9998]"
     style="display: none;">
    <button type="button"
            @click="window.dispatchEvent(new CustomEvent('cookie-banner:open'))"
            aria-label="{{ __('cookie.banner.preferences_link') }}"
            title="{{ __('cookie.banner.preferences_link') }}"
            data-i18n-title="nav.cookie-preferences"
            class="group flex items-center justify-center w-12 h-12 rounded-full bg-white border border-gray-200 shadow-lg hover:shadow-xl hover:border-primary/40 transition focus:outline-none focus:ring-2 focus:ring-primary/30">
        {{-- Fingerprint / cookie icon --}}
        <svg class="w-6 h-6 text-gray-600 group-hover:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-4-4 4 4 0 0 1-4-4 4 4 0 0 1-2-6z"/>
            <circle cx="8.5" cy="10.5" r="1" fill="currentColor"/>
            <circle cx="14" cy="15" r="1" fill="currentColor"/>
            <circle cx="16.5" cy="9.5" r="1" fill="currentColor"/>
            <circle cx="10" cy="14" r="0.75" fill="currentColor"/>
        </svg>
    </button>
</div>
@endif
