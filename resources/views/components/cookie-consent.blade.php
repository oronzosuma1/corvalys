{{--
    Cookie consent banner — fixed at the bottom of the viewport on every
    page until the user makes a choice. Driven by Alpine.store('cookies')
    (see resources/js/app.js). GDPR + ePrivacy + Garante 2021 compliant.
--}}
<div
    x-data x-cloak
    x-show="!$store.cookies.accepted"
    role="dialog" aria-modal="true" aria-labelledby="cookie-title"
    class="fixed inset-x-0 bottom-0 z-[9999] p-4 sm:p-6 bg-white shadow-2xl border-t border-gray-200"
>
    <template x-if="$store.cookies.view === 'compact'">
        <div class="mx-auto max-w-5xl flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="flex-1">
                <h2 id="cookie-title" class="font-semibold text-gray-900">{{ __('cookies.title') }}</h2>
                <p class="text-sm text-gray-600 mt-1">
                    {{ __('cookies.body') }}
                    <a class="underline hover:text-primary transition"
                       href="{{ app()->getLocale() === 'en' ? url('/legal/cookie')
                              : (app()->getLocale() === 'it' ? url('/it/legale/cookie') : url('/fr/legal/cookies')) }}">
                        {{ __('cookies.policy_link') }}
                    </a>
                </p>
            </div>
            <div class="flex flex-wrap gap-2 justify-end">
                <button type="button"
                        class="px-4 py-2 text-sm rounded border border-gray-300 text-gray-800 hover:bg-gray-50 transition"
                        @click="$store.cookies.rejectAll()">{{ __('cookies.reject') }}</button>
                <button type="button"
                        class="px-4 py-2 text-sm rounded border border-gray-300 text-gray-800 hover:bg-gray-50 transition"
                        @click="$store.cookies.openCustomize()">{{ __('cookies.customize') }}</button>
                <button type="button"
                        class="px-4 py-2 text-sm rounded bg-primary text-white hover:bg-primary-dark transition"
                        @click="$store.cookies.acceptAll()">{{ __('cookies.accept') }}</button>
            </div>
        </div>
    </template>

    <template x-if="$store.cookies.view === 'categories'">
        <div class="mx-auto max-w-3xl">
            <h2 class="font-semibold text-gray-900 mb-3">{{ __('cookies.customize_title') }}</h2>
            <div class="space-y-3">
                <label class="flex items-center justify-between p-3 rounded bg-gray-50 border">
                    <span class="text-sm text-gray-700">
                        {{ __('cookies.cat.functional') }}
                        <em class="text-xs text-gray-500">({{ __('cookies.always_on') }})</em>
                    </span>
                    <input type="checkbox" checked disabled class="w-4 h-4 accent-primary cursor-not-allowed">
                </label>
                <label class="flex items-center justify-between p-3 rounded border">
                    <span class="text-sm text-gray-700">{{ __('cookies.cat.analytics') }}</span>
                    <input type="checkbox" class="w-4 h-4 accent-primary"
                           x-model="$store.cookies.categories.analytics">
                </label>
                <label class="flex items-center justify-between p-3 rounded border">
                    <span class="text-sm text-gray-700">{{ __('cookies.cat.marketing') }}</span>
                    <input type="checkbox" class="w-4 h-4 accent-primary"
                           x-model="$store.cookies.categories.marketing">
                </label>
            </div>
            <div class="flex gap-2 justify-end mt-4">
                <button type="button"
                        class="px-4 py-2 text-sm rounded border border-gray-300 text-gray-800 hover:bg-gray-50 transition"
                        @click="$store.cookies.view = 'compact'">{{ __('cookies.back') }}</button>
                <button type="button"
                        class="px-4 py-2 text-sm rounded bg-primary text-white hover:bg-primary-dark transition"
                        @click="$store.cookies.savePreferences()">{{ __('cookies.save') }}</button>
            </div>
        </div>
    </template>
</div>
