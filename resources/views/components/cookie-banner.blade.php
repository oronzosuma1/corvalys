{{-- GDPR / ePrivacy / Garante 2021 compliant cookie consent banner --}}
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
                    {{ __('cookie.banner.title') }}
                </h2>
            </div>

            <p id="cookie-banner-desc"
               class="text-sm text-gray-600 leading-relaxed mb-5"
               data-i18n="cookie.banner.intro">
                {{ __('cookie.banner.intro') }}
            </p>

            {{-- Three equal-prominence buttons (no dark patterns) --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                <button type="button"
                        @click="rejectAll()"
                        aria-label="{{ __('cookie.aria.reject_all') }}"
                        class="px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-800 text-sm font-semibold hover:bg-gray-50 hover:border-gray-400 transition focus:outline-none focus:ring-2 focus:ring-primary/30"
                        data-i18n="cookie.banner.reject">
                    {{ __('cookie.banner.reject') }}
                </button>
                <button type="button"
                        @click="view = 'categories'"
                        aria-label="{{ __('cookie.aria.customize') }}"
                        class="px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-800 text-sm font-semibold hover:bg-gray-50 hover:border-gray-400 transition focus:outline-none focus:ring-2 focus:ring-primary/30"
                        data-i18n="cookie.banner.customize">
                    {{ __('cookie.banner.customize') }}
                </button>
                <button type="button"
                        @click="acceptAll()"
                        aria-label="{{ __('cookie.aria.accept_all') }}"
                        class="px-4 py-2.5 rounded-lg border border-primary bg-primary text-white text-sm font-semibold hover:bg-primary-dark hover:border-primary-dark transition focus:outline-none focus:ring-2 focus:ring-primary/30"
                        data-i18n="cookie.banner.accept">
                    {{ __('cookie.banner.accept') }}
                </button>
            </div>

            {{-- Policy links --}}
            <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500">
                <a href="{{ route('privacy') }}"
                   class="hover:text-primary transition underline underline-offset-2"
                   data-i18n="nav.privacy">
                    {{ __('cookie.nav.privacy') }}
                </a>
                <a href="{{ route('cookie') }}"
                   class="hover:text-primary transition underline underline-offset-2"
                   data-i18n="nav.cookie">
                    {{ __('cookie.nav.cookie') }}
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
                    {{ __('cookie.banner.title') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1"
                   data-i18n="cookie.banner.intro">
                    {{ __('cookie.banner.intro') }}
                </p>
            </div>

            <div class="px-6 py-4 overflow-y-auto space-y-4">

                {{-- 1. Strictly Necessary (always on, locked) --}}
                <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 text-sm"
                            data-i18n="cookie.cat.necessary.title">
                            {{ __('cookie.cat.necessary.title') }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1"
                           data-i18n="cookie.cat.necessary.desc">
                            {{ __('cookie.cat.necessary.desc') }}
                        </p>
                    </div>
                    <div class="flex-shrink-0 pt-0.5">
                        <button type="button"
                                disabled
                                aria-label="{{ __('cookie.aria.necessary_locked') }}"
                                aria-pressed="true"
                                class="relative inline-flex h-6 w-11 items-center rounded-full bg-primary/60 cursor-not-allowed opacity-80">
                            <span class="inline-block h-5 w-5 translate-x-5 rounded-full bg-white shadow"></span>
                        </button>
                    </div>
                </div>

                {{-- 2. Functional (default OFF) --}}
                <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 text-sm"
                            data-i18n="cookie.cat.functional.title">
                            {{ __('cookie.cat.functional.title') }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1"
                           data-i18n="cookie.cat.functional.desc">
                            {{ __('cookie.cat.functional.desc') }}
                        </p>
                    </div>
                    <div class="flex-shrink-0 pt-0.5">
                        <button type="button"
                                @click="categories.functional = !categories.functional"
                                :aria-pressed="categories.functional.toString()"
                                aria-label="{{ __('cookie.aria.toggle_functional') }}"
                                :class="categories.functional ? 'bg-primary' : 'bg-gray-300'"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                            <span class="inline-block h-5 w-5 rounded-full bg-white shadow transition-transform"
                                  :class="categories.functional ? 'translate-x-5' : 'translate-x-1'"></span>
                        </button>
                    </div>
                </div>

                {{-- 3. Analytics (default OFF) --}}
                <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 text-sm"
                            data-i18n="cookie.cat.analytics.title">
                            {{ __('cookie.cat.analytics.title') }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1"
                           data-i18n="cookie.cat.analytics.desc">
                            {{ __('cookie.cat.analytics.desc') }}
                        </p>
                    </div>
                    <div class="flex-shrink-0 pt-0.5">
                        <button type="button"
                                @click="categories.analytics = !categories.analytics"
                                :aria-pressed="categories.analytics.toString()"
                                aria-label="{{ __('cookie.aria.toggle_analytics') }}"
                                :class="categories.analytics ? 'bg-primary' : 'bg-gray-300'"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                            <span class="inline-block h-5 w-5 rounded-full bg-white shadow transition-transform"
                                  :class="categories.analytics ? 'translate-x-5' : 'translate-x-1'"></span>
                        </button>
                    </div>
                </div>

                {{-- 4. Marketing (default OFF) --}}
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-heading font-bold text-gray-900 text-sm"
                            data-i18n="cookie.cat.marketing.title">
                            {{ __('cookie.cat.marketing.title') }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1"
                           data-i18n="cookie.cat.marketing.desc">
                            {{ __('cookie.cat.marketing.desc') }}
                        </p>
                    </div>
                    <div class="flex-shrink-0 pt-0.5">
                        <button type="button"
                                @click="categories.marketing = !categories.marketing"
                                :aria-pressed="categories.marketing.toString()"
                                aria-label="{{ __('cookie.aria.toggle_marketing') }}"
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
                    {{ __('cookie.banner.back') }}
                </button>
                <button type="button"
                        @click="saveCustom()"
                        aria-label="{{ __('cookie.aria.save_prefs') }}"
                        class="px-5 py-2.5 rounded-lg border border-primary bg-primary text-white text-sm font-semibold hover:bg-primary-dark hover:border-primary-dark transition focus:outline-none focus:ring-2 focus:ring-primary/30"
                        data-i18n="cookie.banner.save">
                    {{ __('cookie.banner.save') }}
                </button>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
(function () {
    var POLICY_VERSION = @json(config('legal.policy_version', '2026-04'));
    var EXPIRES_MONTHS = @json((int) config('legal.consent_expires_months', 6));
    var LOCALE = @json(app()->getLocale());
    var ENDPOINT = @json(route('cookie-consent.store'));
    var STORAGE_KEY = 'cookie_consent';
    var DEFAULT_CATEGORIES_SAFE = { necessary: true, functional: false, analytics: false, marketing: false };

    // ──────────────────────────────────────────────────────────────
    // GLOBAL HELPER — window.cookieConsent
    // ──────────────────────────────────────────────────────────────
    window.cookieConsent = {
        /** Return {categories, savedAt, expiresAt, version, uuid} or null if missing/expired/stale-policy. */
        read: function () {
            try {
                var raw = localStorage.getItem(STORAGE_KEY);
                if (!raw) return null;
                var parsed = JSON.parse(raw);
                if (!parsed || !parsed.categories) return null;
                if (parsed.version && parsed.version !== POLICY_VERSION) return null;
                if (parsed.expiresAt && new Date(parsed.expiresAt) < new Date()) return null;
                return parsed;
            } catch (e) { return null; }
        },
        /** `cookieConsent.has('analytics')` → boolean */
        has: function (category) {
            var c = this.read();
            return !!(c && c.categories && c.categories[category]);
        },
        /** Current categories object (or null if no valid consent). */
        categories: function () {
            var c = this.read();
            return c ? c.categories : null;
        },
        /** Policy version constant (compiled from PHP). */
        version: POLICY_VERSION,
        /** Open the preferences modal. */
        open: function () {
            window.dispatchEvent(new CustomEvent('cookie-banner:open'));
        },
        /** Reset consent (debug / test). */
        reset: function () {
            localStorage.removeItem(STORAGE_KEY);
        }
    };

    // Generate a UUID (RFC 4122 v4) without external libs
    function uuid() {
        if (crypto && typeof crypto.randomUUID === 'function') return crypto.randomUUID();
        // Fallback
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    function postToServer(payload) {
        var meta = document.querySelector('meta[name=csrf-token]');
        return fetch(ENDPOINT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': meta ? meta.content : ''
            },
            body: JSON.stringify(payload)
        }).catch(function () { /* fire-and-forget */ });
    }

    // ──────────────────────────────────────────────────────────────
    // GPC / DNT auto-reject on first visit (silent — no banner shown)
    // ──────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        if (window.cookieConsent.read()) return; // already decided
        var gpc = navigator.globalPrivacyControl === true;
        if (!gpc) return; // DNT is deprecated; only GPC triggers silent auto-reject

        var id = uuid();
        var now = new Date();
        var expires = new Date(now.getTime() + EXPIRES_MONTHS * 30 * 24 * 3600 * 1000);
        var payload = {
            version: POLICY_VERSION,
            uuid: id,
            categories: { necessary: true, functional: false, analytics: false, marketing: false },
            savedAt: now.toISOString(),
            expiresAt: expires.toISOString()
        };
        localStorage.setItem(STORAGE_KEY, JSON.stringify(payload));
        postToServer({
            uuid: id,
            categories: payload.categories,
            action: 'gpc_auto_reject',
            policy_version: POLICY_VERSION,
            locale: LOCALE
        });
        window.dispatchEvent(new CustomEvent('consent:updated', { detail: { categories: payload.categories } }));
        // Legacy event alias (backward compat with existing listeners)
        window.dispatchEvent(new CustomEvent('cookie-consent-ready', { detail: payload.categories }));
    });

    // ──────────────────────────────────────────────────────────────
    // ALPINE COMPONENT
    // ──────────────────────────────────────────────────────────────
    document.addEventListener('alpine:init', function () {
        Alpine.data('cookieConsent', function () {
            return {
                open: false,
                view: 'compact',
                policyVersion: POLICY_VERSION,
                // Defaults in Customize modal: only Necessary is true — GDPR strict consent
                categories: { necessary: true, functional: false, analytics: false, marketing: false },

                init: function () {
                    var self = this;
                    var stored = window.cookieConsent.read();

                    if (!stored) {
                        // If GPC is on, the DOMContentLoaded listener above already saved the choice silently.
                        // Double-check and skip banner if consent is now present.
                        if (navigator.globalPrivacyControl === true) {
                            return;
                        }
                        // Delayed open for smoother perceived load
                        setTimeout(function () { self.open = true; }, 600);
                    } else {
                        // Sync toggles to stored choice (for when user opens preferences)
                        this.categories = Object.assign({}, DEFAULT_CATEGORIES_SAFE, stored.categories);
                        // Dispatch both event names (new + legacy)
                        window.dispatchEvent(new CustomEvent('consent:updated', { detail: { categories: stored.categories } }));
                        window.dispatchEvent(new CustomEvent('cookie-consent-ready', { detail: stored.categories }));
                    }

                    // Listen for external "open preferences" triggers (new + legacy event names)
                    window.addEventListener('cookie-banner:open', function () {
                        self.view = 'categories';
                        self.open = true;
                    });
                    window.addEventListener('open-cookie-preferences', function () {
                        self.view = 'categories';
                        self.open = true;
                    });
                },

                save: function (action) {
                    var now = new Date();
                    var expires = new Date(now.getTime() + EXPIRES_MONTHS * 30 * 24 * 3600 * 1000);
                    var id = (window.cookieConsent.read() || {}).uuid || uuid();
                    var payload = {
                        version: POLICY_VERSION,
                        uuid: id,
                        categories: Object.assign({}, this.categories),
                        savedAt: now.toISOString(),
                        expiresAt: expires.toISOString()
                    };
                    localStorage.setItem(STORAGE_KEY, JSON.stringify(payload));
                    postToServer({
                        uuid: id,
                        categories: this.categories,
                        action: action,
                        policy_version: POLICY_VERSION,
                        locale: LOCALE
                    });
                    window.dispatchEvent(new CustomEvent('consent:updated', { detail: { categories: this.categories } }));
                    // Legacy event alias
                    window.dispatchEvent(new CustomEvent('cookie-consent-ready', { detail: this.categories }));
                    this.open = false;
                },

                acceptAll: function () {
                    this.categories = { necessary: true, functional: true, analytics: true, marketing: true };
                    this.save('accept');
                },

                rejectAll: function () {
                    this.categories = { necessary: true, functional: false, analytics: false, marketing: false };
                    this.save('reject');
                },

                saveCustom: function () {
                    this.categories.necessary = true; // never off
                    this.save('custom');
                }
            };
        });
    });
})();
</script>
@endpush
