import { translations } from './translations.js';

/* ── Alpine.js (bundled, no CDN) ──
 * Livewire v3 bootstraps Alpine itself, so we MUST NOT call the start
 * method here (else double-boot warning). Expose Alpine on window so
 * existing inline x-data components work.
 */
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import collapse from '@alpinejs/collapse';

Alpine.plugin(intersect);
Alpine.plugin(collapse);
window.Alpine = Alpine;

/* ── i18n System ── */
function readLocaleCookie() {
    const m = document.cookie.match(/(?:^|;\s*)locale=(en|it|fr)(?:;|$)/);
    return m ? m[1] : null;
}
function writeLocaleCookie(lang) {
    try {
        const oneYear = 60 * 60 * 24 * 365;
        document.cookie = 'locale=' + lang + '; path=/; max-age=' + oneYear + '; samesite=lax';
    } catch (e) {}
}
const i18n = {
    // Priority: cookie (server-authoritative) > localStorage > 'en'.
    current: readLocaleCookie() || localStorage.getItem('lang') || 'en',

    t(key, params = {}) {
        const lang = translations[this.current] || translations.en;
        let text = lang[key] || translations.en[key] || key;
        Object.entries(params).forEach(([k, v]) => {
            text = text.replace(new RegExp(`\\{${k}\\}`, 'g'), v);
        });
        return text;
    },

    apply() {
        document.documentElement.lang = this.current;

        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            const params = el.getAttribute('data-i18n-params');
            const parsed = params ? JSON.parse(params) : {};
            el.textContent = this.t(key, parsed);
        });

        document.querySelectorAll('[data-i18n-html]').forEach(el => {
            const key = el.getAttribute('data-i18n-html');
            const params = el.getAttribute('data-i18n-params');
            const parsed = params ? JSON.parse(params) : {};
            el.innerHTML = this.t(key, parsed);
        });

        document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
            el.placeholder = this.t(el.getAttribute('data-i18n-placeholder'));
        });

        document.querySelectorAll('[data-i18n-aria-label]').forEach(el => {
            el.setAttribute('aria-label', this.t(el.getAttribute('data-i18n-aria-label')));
        });

        document.querySelectorAll('[data-i18n-title]').forEach(el => {
            el.setAttribute('title', this.t(el.getAttribute('data-i18n-title')));
        });
    },

    setLang(lang) {
        this.current = lang;
        try { localStorage.setItem('lang', lang); } catch (e) {}
        writeLocaleCookie(lang); // keep server + client in sync
        this.apply();
        window.dispatchEvent(new CustomEvent('lang-changed', { detail: lang }));
    },
};

/* Expose to Alpine */
document.addEventListener('alpine:init', () => {
    Alpine.store('i18n', {
        lang: i18n.current,
        setLang(l) { i18n.setLang(l); this.lang = l; },
        t(key, params) { return i18n.t(key, params); },
    });
});

/* Apply on load and after Livewire updates */
document.addEventListener('DOMContentLoaded', () => i18n.apply());
document.addEventListener('livewire:navigated', () => i18n.apply());

/* Re-apply after Alpine components render (debounced, observer paused during apply) */
let applyTimeout = null;
const observer = new MutationObserver(() => {
    clearTimeout(applyTimeout);
    applyTimeout = setTimeout(() => {
        observer.disconnect();
        i18n.apply();
        observer.observe(document.body, { childList: true, subtree: true });
    }, 100);
});
observer.observe(document.body, { childList: true, subtree: true });

/* ── Consent-gated script loader ──
 * Scripts wrapped in <x-consent-script category="analytics" src="..."> are
 * emitted as <script type="text/plain" data-consent="..."> so the browser
 * never executes them until the user grants consent for that category.
 *
 * Selector accepts both the new (data-consent) and legacy (data-tracker-category)
 * attributes for backward compatibility.
 */
function activateConsentedScripts(categories) {
    if (!categories) return;
    const sel = 'script[type="text/plain"][data-consent], script[type="text/plain"][data-tracker-category]';
    document.querySelectorAll(sel).forEach(el => {
        const cat = el.getAttribute('data-consent') || el.getAttribute('data-tracker-category');
        if (!categories[cat]) return;
        if (el.dataset.activated === '1') return; // idempotent

        const s = document.createElement('script');
        if (el.dataset.src) {
            s.src = el.dataset.src;
        } else {
            s.textContent = el.textContent;
        }
        if (el.dataset.async === 'true') s.async = true;
        if (el.dataset.defer === 'true') s.defer = true;
        if (el.id) s.id = el.id + '-activated';
        s.setAttribute('data-activated-from', cat);
        el.dataset.activated = '1';
        el.parentNode.insertBefore(s, el.nextSibling);
    });
}

// Listen for new + legacy events
window.addEventListener('consent:updated', (e) => {
    const categories = (e.detail && e.detail.categories) ? e.detail.categories : e.detail;
    activateConsentedScripts(categories);
});
window.addEventListener('cookie-consent-ready', (e) => activateConsentedScripts(e.detail));

// Activate on initial page load if valid consent is already stored
document.addEventListener('DOMContentLoaded', () => {
    try {
        const cats = (window.cookieConsent && window.cookieConsent.categories())
            || (JSON.parse(localStorage.getItem('cookie_consent') || 'null') || {}).categories;
        if (cats) activateConsentedScripts(cats);
    } catch (e) {}
});
