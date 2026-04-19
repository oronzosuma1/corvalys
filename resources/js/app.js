import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import focus from '@alpinejs/focus';
import intersect from '@alpinejs/intersect';
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

/* ══════════════════════════════════════════════════════
   i18n store — exposes $store.i18n.lang to every Alpine component.
   The language is authoritative on the server (SetLocale middleware +
   __() in Blade); this store is the read-only JS mirror used by the
   language-switcher UI indicator.
   ══════════════════════════════════════════════════════ */
Alpine.store('i18n', {
    lang: document.documentElement.lang || 'en',
    setLang(l) { this.lang = l; },
});

/* ══════════════════════════════════════════════════════
   Cookie consent store — $store.cookies.accepted / view / categories
   / acceptAll / rejectAll / savePreferences / openCustomize.
   Persists to localStorage.corvalys_consent.
   ══════════════════════════════════════════════════════ */
const readConsent = () => {
    try { return JSON.parse(localStorage.getItem('corvalys_consent')); }
    catch (_) { return null; }
};

Alpine.store('cookies', {
    _loaded: readConsent(),
    view: 'compact',
    categories: { functional: true, analytics: false, marketing: false },
    get accepted() { return !!this._loaded; },
    openCustomize() { this.view = 'categories'; },
    acceptAll() {
        this.categories = { functional: true, analytics: true, marketing: true };
        this._persist();
    },
    rejectAll() {
        this.categories = { functional: true, analytics: false, marketing: false };
        this._persist();
    },
    savePreferences() { this._persist(); },
    _persist() {
        const payload = { ts: Date.now(), categories: this.categories };
        localStorage.setItem('corvalys_consent', JSON.stringify(payload));
        this._loaded = payload;
        window.dispatchEvent(new CustomEvent('consent:updated', {
            detail: { categories: this.categories },
        }));
    },
});

/* ══════════════════════════════════════════════════════
   Alpine plugins (must register BEFORE Livewire.start()).
   intersect is used across home.blade.php for scroll-in animations.
   ══════════════════════════════════════════════════════ */
Alpine.plugin(collapse);
Alpine.plugin(focus);
Alpine.plugin(intersect);
window.Alpine = Alpine;

/* ══════════════════════════════════════════════════════
   Consent-gated script loader.
   <x-consent-script category="analytics" src="..."> emits a
   <script type="text/plain" data-consent="analytics"> that we
   materialize into a real <script> when the matching category is
   granted. Idempotent — safe to fire multiple times.
   ══════════════════════════════════════════════════════ */
function activateConsentedScripts(categories) {
    if (!categories) return;
    const sel = 'script[type="text/plain"][data-consent], script[type="text/plain"][data-tracker-category]';
    document.querySelectorAll(sel).forEach(el => {
        const cat = el.getAttribute('data-consent') || el.getAttribute('data-tracker-category');
        if (!categories[cat]) return;
        if (el.dataset.activated === '1') return;
        const s = document.createElement('script');
        if (el.dataset.src) s.src = el.dataset.src;
        else s.textContent = el.textContent;
        if (el.dataset.async === 'true') s.async = true;
        if (el.dataset.defer === 'true') s.defer = true;
        if (el.id) s.id = el.id + '-activated';
        s.setAttribute('data-activated-from', cat);
        el.dataset.activated = '1';
        el.parentNode.insertBefore(s, el.nextSibling);
    });
}
window.addEventListener('consent:updated', (e) => {
    const categories = (e.detail && e.detail.categories) ? e.detail.categories : e.detail;
    activateConsentedScripts(categories);
});
window.addEventListener('cookie-consent-ready', (e) => activateConsentedScripts(e.detail));
document.addEventListener('DOMContentLoaded', () => {
    try {
        const stored = JSON.parse(localStorage.getItem('cookie_consent') || 'null');
        if (stored && stored.categories) activateConsentedScripts(stored.categories);
    } catch (_) {}
});

/* ══════════════════════════════════════════════════════
   Start Livewire (which starts Alpine for us — single boot).
   The layout uses @livewireScriptConfig so Livewire does NOT
   auto-start from a separate bundled script.
   ══════════════════════════════════════════════════════ */
Livewire.start();
