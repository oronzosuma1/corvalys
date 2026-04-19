{{--
    Cookie consent modal (GDPR / ePrivacy / Garante 2021 compliant).

    Blocking centered pop-up that appears on EVERY page until the user
    makes a choice. Driven entirely by $store.cookies (see resources/js/app.js)
    so there's a single source of truth and no race with Alpine boot.

    The three buttons (Reject All / Customize / Accept All) have equal
    visual prominence — no dark patterns. Necessary cookies are always on.
--}}
<div
    x-data
    x-init="$store.cookies.init && $store.cookies.init()"
    x-cloak
    x-show="!$store.cookies.accepted"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    role="dialog"
    aria-modal="true"
    aria-labelledby="cookie-modal-title"
    aria-describedby="cookie-modal-desc"
    class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
>
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" aria-hidden="true"></div>

    {{-- Modal card --}}
    <div
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col"
    >

        {{-- ══════ COMPACT VIEW ══════ --}}
        <template x-if="$store.cookies.view === 'compact'">
            <div class="p-6 sm:p-8 overflow-y-auto">
                <div class="flex items-start gap-3 mb-4">
                    <div class="flex-shrink-0 w-11 h-11 rounded-full bg-primary/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-4-4 4 4 0 0 1-4-4 4 4 0 0 1-2-6z"/>
                            <circle cx="8.5" cy="10.5" r="1" fill="currentColor"/>
                            <circle cx="14" cy="15" r="1" fill="currentColor"/>
                            <circle cx="16.5" cy="9.5" r="1" fill="currentColor"/>
                            <circle cx="10" cy="14" r="0.75" fill="currentColor"/>
                        </svg>
                    </div>
                    <h2 id="cookie-modal-title"
                        class="font-heading font-bold text-gray-900 text-xl leading-tight pt-1.5">
                        {{ __('cookie.banner.title') }}
                    </h2>
                </div>

                <p id="cookie-modal-desc" class="text-sm text-gray-600 leading-relaxed mb-6">
                    {{ __('cookie.banner.intro') }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                    <button type="button"
                            @click="$store.cookies.rejectAll()"
                            aria-label="{{ __('cookie.aria.reject_all') }}"
                            class="px-4 py-3 rounded-lg border border-gray-300 bg-white text-gray-800 text-sm font-semibold hover:bg-gray-50 hover:border-gray-400 transition focus:outline-none focus:ring-2 focus:ring-primary/30">
                        {{ __('cookie.banner.reject') }}
                    </button>
                    <button type="button"
                            @click="$store.cookies.openCustomize()"
                            aria-label="{{ __('cookie.aria.customize') }}"
                            class="px-4 py-3 rounded-lg border border-gray-300 bg-white text-gray-800 text-sm font-semibold hover:bg-gray-50 hover:border-gray-400 transition focus:outline-none focus:ring-2 focus:ring-primary/30">
                        {{ __('cookie.banner.customize') }}
                    </button>
                    <button type="button"
                            @click="$store.cookies.acceptAll()"
                            aria-label="{{ __('cookie.aria.accept_all') }}"
                            class="px-4 py-3 rounded-lg border border-primary bg-primary text-white text-sm font-semibold hover:bg-primary-dark hover:border-primary-dark transition focus:outline-none focus:ring-2 focus:ring-primary/30">
                        {{ __('cookie.banner.accept') }}
                    </button>
                </div>

                <div class="mt-5 pt-5 border-t border-gray-100 flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500">
                    <a href="{{ route('privacy') }}"
                       class="hover:text-primary transition underline underline-offset-2">
                        {{ __('cookie.nav.privacy') }}
                    </a>
                    <a href="{{ route('cookie') }}"
                       class="hover:text-primary transition underline underline-offset-2">
                        {{ __('cookie.nav.cookie') }}
                    </a>
                </div>
            </div>
        </template>

        {{-- ══════ CATEGORIES (CUSTOMIZE) VIEW ══════ --}}
        <template x-if="$store.cookies.view === 'categories'">
            <div class="flex flex-col flex-1 min-h-0">

                <div class="px-6 sm:px-8 pt-6 pb-4 border-b border-gray-100">
                    <h2 class="font-heading font-bold text-gray-900 text-xl leading-tight">
                        {{ __('cookie.banner.title') }}
                    </h2>
                    <p class="text-sm text-gray-600 mt-1.5">
                        {{ __('cookie.banner.intro') }}
                    </p>
                </div>

                <div class="px-6 sm:px-8 py-5 overflow-y-auto space-y-5 flex-1">

                    {{-- 1. Strictly Necessary --}}
                    <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-heading font-bold text-gray-900 text-sm">
                                {{ __('cookie.cat.necessary.title') }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
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

                    {{-- 2. Functional --}}
                    <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-heading font-bold text-gray-900 text-sm">
                                {{ __('cookie.cat.functional.title') }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ __('cookie.cat.functional.desc') }}
                            </p>
                        </div>
                        <div class="flex-shrink-0 pt-0.5">
                            <button type="button"
                                    @click="$store.cookies.categories.functional = !$store.cookies.categories.functional"
                                    :aria-pressed="$store.cookies.categories.functional ? 'true' : 'false'"
                                    aria-label="{{ __('cookie.aria.toggle_functional') }}"
                                    :class="$store.cookies.categories.functional ? 'bg-primary' : 'bg-gray-300'"
                                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                                <span class="inline-block h-5 w-5 rounded-full bg-white shadow transition-transform"
                                      :class="$store.cookies.categories.functional ? 'translate-x-5' : 'translate-x-1'"></span>
                            </button>
                        </div>
                    </div>

                    {{-- 3. Analytics --}}
                    <div class="flex items-start justify-between gap-4 pb-4 border-b border-gray-100">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-heading font-bold text-gray-900 text-sm">
                                {{ __('cookie.cat.analytics.title') }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ __('cookie.cat.analytics.desc') }}
                            </p>
                        </div>
                        <div class="flex-shrink-0 pt-0.5">
                            <button type="button"
                                    @click="$store.cookies.categories.analytics = !$store.cookies.categories.analytics"
                                    :aria-pressed="$store.cookies.categories.analytics ? 'true' : 'false'"
                                    aria-label="{{ __('cookie.aria.toggle_analytics') }}"
                                    :class="$store.cookies.categories.analytics ? 'bg-primary' : 'bg-gray-300'"
                                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                                <span class="inline-block h-5 w-5 rounded-full bg-white shadow transition-transform"
                                      :class="$store.cookies.categories.analytics ? 'translate-x-5' : 'translate-x-1'"></span>
                            </button>
                        </div>
                    </div>

                    {{-- 4. Marketing --}}
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-heading font-bold text-gray-900 text-sm">
                                {{ __('cookie.cat.marketing.title') }}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ __('cookie.cat.marketing.desc') }}
                            </p>
                        </div>
                        <div class="flex-shrink-0 pt-0.5">
                            <button type="button"
                                    @click="$store.cookies.categories.marketing = !$store.cookies.categories.marketing"
                                    :aria-pressed="$store.cookies.categories.marketing ? 'true' : 'false'"
                                    aria-label="{{ __('cookie.aria.toggle_marketing') }}"
                                    :class="$store.cookies.categories.marketing ? 'bg-primary' : 'bg-gray-300'"
                                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                                <span class="inline-block h-5 w-5 rounded-full bg-white shadow transition-transform"
                                      :class="$store.cookies.categories.marketing ? 'translate-x-5' : 'translate-x-1'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Footer actions --}}
                <div class="px-6 sm:px-8 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-between gap-3">
                    <button type="button"
                            @click="$store.cookies.backToCompact()"
                            class="text-sm text-gray-600 hover:text-gray-900 font-medium transition focus:outline-none focus:ring-2 focus:ring-primary/30 rounded px-2 py-1">
                        {{ __('cookie.banner.back') }}
                    </button>
                    <button type="button"
                            @click="$store.cookies.savePreferences()"
                            aria-label="{{ __('cookie.aria.save_prefs') }}"
                            class="px-5 py-2.5 rounded-lg border border-primary bg-primary text-white text-sm font-semibold hover:bg-primary-dark hover:border-primary-dark transition focus:outline-none focus:ring-2 focus:ring-primary/30">
                        {{ __('cookie.banner.save') }}
                    </button>
                </div>
            </div>
        </template>

    </div>
</div>
