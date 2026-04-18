{{-- GDPR Cookie Consent Banner --}}
<div x-data="cookieConsent"
     x-cloak
     x-show="open"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-8"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-8"
     role="dialog"
     aria-modal="false"
     aria-labelledby="cookie-banner-title"
     aria-describedby="cookie-banner-desc"
     class="fixed bottom-4 right-4 left-4 sm:left-auto sm:bottom-6 sm:right-6 z-[9999] w-auto sm:max-w-[560px]"
     style="display: none;">

    <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden">

        {{-- VIEW 1: Compact banner --}}
        <div x-show="view === 'compact'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="p-6">

            <div class="flex items-start gap-3 mb-3">
                {{-- Cookie icon --}}
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-light flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-4-4 4 4 0 0 1-4-4 4 4 0 0 1-2-6z"/>
                        <circle cx="8.5" cy="10.5" r="1" fill="currentColor"/>
                        <circle cx="14" cy="15" r="1" fill="currentColor"/>
                        <circle cx="16.5" cy="9.5" r="1" fill="currentColor"/>
                        <circle cx="10" cy="14" r="0.75" fill="currentColor"/>
                    </svg>
                </div>
                <h2 id="cookie-banner-title"
                    class="font-heading font-bold text-gray-900 text-lg leading-tight pt-1"
                    data-i18n="cookie.banner.title">
                    We value your privacy
                </h2>
            </div>

            <p id="cookie-banner-desc"
               class="text-sm text-gray-600 leading-relaxed mb-5"
               data-i18n="cookie.banner.intro">
                We use cookies to improve your experience, analyze traffic, and personalize content. See our Cookie Policy for details.
            </p>

            {{-- Three equal-prominence buttons (no dark patterns) --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                <button type="button"
                        @click="rejectAll()"
                        aria-label="Reject all non-essential cookies"
                        class="px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-800 text-sm font-semibold hover:bg-gray-50 hover:border-gray-400 transition focus:outline-none focus:ring-2 focus:ring-primary/30"
                        data-i18n="cookie.banner.reject">
                    Reject All
                </button>
                <button type="button"
                        @click="view = 'categories'"
                        aria-label="Customize cookie preferences"
                        class="px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-800 text-sm font-semibold hover:bg-gray-50 hover:border-gray-400 transition focus:outline-none focus:ring-2 focus:ring-primary/30"
                        data-i18n="cookie.banner.customize">
                    Customize
                </button>
                <button type="button"
                        @click="acceptAll()"
                        aria-label="Accept all cookies"
                        class="px-4 py-2.5 rounded-lg border border-primary bg-primary text-white text-sm font-semibold hover:bg-primary-dark hover:border-primary-dark transition focus:outline-none focus:ring-2 focus:ring-primary/30"
                        data-i18n="cookie.banner.accept">
                    Accept All
                </button>
            </div>

            {{-- Policy links --}}
            <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500">
                <a href="{{ route('privacy') }}"
                   class="hover:text-primary transition underline underline-offset-2"
                   data-i18n="nav.privacy">
                    Privacy
                </a>
                <a href="{{ route('cookie') }}"
                   class="hover:text-primary transition underline underline-offset-2"
                   data-i18n="nav.cookie">
                    Cookie Policy
                </a>
            </div>
        </div>

        {{-- VIEW 2: Categories modal --}}
        <div x-show="view === 'categories'"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="flex flex-col max-h-[80vh]">

            <div class="px-6 pt-6 pb-4 border-b border-gray-100">
                <h2 class="font-heading font-bold text-gray-900 text-lg leading-tight"
                    data-i18n="cookie.banner.title">
                    We value your privacy
                </h2>
                <p class="text-sm text-gray-600 mt-1"
                   data-i18n="cookie.banner.intro">
                    We use cookies to improve your experience, analyze traffic, and personalize content. See our Cookie Policy for details.
                </p>
            </div>

            <div class="px-6 py-4 overflow-y-auto space-y-4">

                {{-- 1. Strictly Necessary --}}
                <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 text-sm"
                            data-i18n="cookie.cat.necessary.title">
                            Strictly Necessary
                        </h3>
                        <p class="text-sm text-gray-600 mt-1"
                           data-i18n="cookie.cat.necessary.desc">
                            Required for the site to function. Cannot be disabled.
                        </p>
                    </div>
                    {{-- Locked toggle (always on) --}}
                    <div class="flex-shrink-0 pt-0.5">
                        <button type="button"
                                disabled
                                aria-label="Strictly necessary cookies are always on"
                                aria-pressed="true"
                                class="relative inline-flex h-6 w-11 items-center rounded-full bg-primary/60 cursor-not-allowed opacity-80">
                            <span class="inline-block h-5 w-5 translate-x-5 rounded-full bg-white shadow"></span>
                        </button>
                    </div>
                </div>

                {{-- 2. Functional --}}
                <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 text-sm"
                            data-i18n="cookie.cat.functional.title">
                            Functional
                        </h3>
                        <p class="text-sm text-gray-600 mt-1"
                           data-i18n="cookie.cat.functional.desc">
                            Remember your preferences (language, theme).
                        </p>
                    </div>
                    <div class="flex-shrink-0 pt-0.5">
                        <button type="button"
                                @click="categories.functional = !categories.functional"
                                :aria-pressed="categories.functional.toString()"
                                aria-label="Toggle functional cookies"
                                :class="categories.functional ? 'bg-primary' : 'bg-gray-300'"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                            <span class="inline-block h-5 w-5 rounded-full bg-white shadow transition-transform"
                                  :class="categories.functional ? 'translate-x-5' : 'translate-x-1'"></span>
                        </button>
                    </div>
                </div>

                {{-- 3. Analytics --}}
                <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 text-sm"
                            data-i18n="cookie.cat.analytics.title">
                            Analytics
                        </h3>
                        <p class="text-sm text-gray-600 mt-1"
                           data-i18n="cookie.cat.analytics.desc">
                            Help us understand how visitors use the site.
                        </p>
                    </div>
                    <div class="flex-shrink-0 pt-0.5">
                        <button type="button"
                                @click="categories.analytics = !categories.analytics"
                                :aria-pressed="categories.analytics.toString()"
                                aria-label="Toggle analytics cookies"
                                :class="categories.analytics ? 'bg-primary' : 'bg-gray-300'"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                            <span class="inline-block h-5 w-5 rounded-full bg-white shadow transition-transform"
                                  :class="categories.analytics ? 'translate-x-5' : 'translate-x-1'"></span>
                        </button>
                    </div>
                </div>

                {{-- 4. Marketing --}}
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 text-sm"
                            data-i18n="cookie.cat.marketing.title">
                            Marketing
                        </h3>
                        <p class="text-sm text-gray-600 mt-1"
                           data-i18n="cookie.cat.marketing.desc">
                            Personalized ads and content.
                        </p>
                    </div>
                    <div class="flex-shrink-0 pt-0.5">
                        <button type="button"
                                @click="categories.marketing = !categories.marketing"
                                :aria-pressed="categories.marketing.toString()"
                                aria-label="Toggle marketing cookies"
                                :class="categories.marketing ? 'bg-primary' : 'bg-gray-300'"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                            <span class="inline-block h-5 w-5 rounded-full bg-white shadow transition-transform"
                                  :class="categories.marketing ? 'translate-x-5' : 'translate-x-1'"></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Footer actions --}}
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-between gap-3">
                <button type="button"
                        @click="view = 'compact'"
                        class="text-sm text-gray-600 hover:text-gray-900 font-medium transition focus:outline-none focus:ring-2 focus:ring-primary/30 rounded px-2 py-1"
                        data-i18n="cookie.banner.back">
                    Back
                </button>
                <button type="button"
                        @click="saveCustom()"
                        aria-label="Save cookie preferences"
                        class="px-5 py-2.5 rounded-lg border border-primary bg-primary text-white text-sm font-semibold hover:bg-primary-dark hover:border-primary-dark transition focus:outline-none focus:ring-2 focus:ring-primary/30"
                        data-i18n="cookie.banner.save">
                    Save Preferences
                </button>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('cookieConsent', () => ({
        open: false,
        view: 'compact',
        policyVersion: '1.0.0',
        categories: {
            necessary: true,
            functional: true,
            analytics: false,
            marketing: false
        },

        init() {
            const stored = this.getStoredConsent();
            if (!stored) {
                // Respect DNT/GPC — default to reject if set
                const dnt = navigator.doNotTrack === '1' || window.doNotTrack === '1';
                const gpc = navigator.globalPrivacyControl === true;
                if (dnt || gpc) {
                    this.categories = { necessary: true, functional: false, analytics: false, marketing: false };
                }
                setTimeout(() => { this.open = true; }, 600);
            } else {
                this.categories = stored.categories;
                // Dispatch global event so trackers can initialize
                window.dispatchEvent(new CustomEvent('cookie-consent-ready', { detail: stored.categories }));
            }
            // Listen for external "open preferences" trigger
            window.addEventListener('open-cookie-preferences', () => {
                this.open = true;
                this.view = 'categories';
            });
        },

        getStoredConsent() {
            try {
                const raw = localStorage.getItem('cookie_consent');
                if (!raw) return null;
                const parsed = JSON.parse(raw);
                // Invalidate if policy version changed
                if (parsed.version !== this.policyVersion) return null;
                return parsed;
            } catch (e) {
                return null;
            }
        },

        save(action) {
            const payload = {
                version: this.policyVersion,
                categories: { ...this.categories },
                savedAt: new Date().toISOString()
            };
            localStorage.setItem('cookie_consent', JSON.stringify(payload));

            // Send to backend
            fetch('/api/consent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || ''
                },
                body: JSON.stringify({
                    categories: this.categories,
                    action: action,
                    policy_version: this.policyVersion
                })
            }).catch(() => {});

            window.dispatchEvent(new CustomEvent('cookie-consent-ready', { detail: this.categories }));
            this.open = false;
        },

        acceptAll() {
            this.categories = { necessary: true, functional: true, analytics: true, marketing: true };
            this.save('accept');
        },

        rejectAll() {
            this.categories = { necessary: true, functional: false, analytics: false, marketing: false };
            this.save('reject');
        },

        saveCustom() {
            this.save('custom');
        }
    }));
});
</script>
@endpush
