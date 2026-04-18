import { translations } from './translations.js';

/* ── i18n System ── */
const i18n = {
    current: localStorage.getItem('lang') || 'en',

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
    },

    setLang(lang) {
        this.current = lang;
        localStorage.setItem('lang', lang);
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

/* ── Cookie consent tracker activation ── */
function activateTrackers(categories) {
    document.querySelectorAll('script[type="text/plain"][data-tracker-category]').forEach(el => {
        const cat = el.getAttribute('data-tracker-category');
        if (categories[cat]) {
            const newScript = document.createElement('script');
            // Copy attributes
            if (el.dataset.src) {
                newScript.src = el.dataset.src;
            } else {
                newScript.textContent = el.textContent;
            }
            if (el.id) newScript.id = el.id + '-activated';
            newScript.setAttribute('data-activated-from', cat);
            el.parentNode.insertBefore(newScript, el.nextSibling);
        }
    });
}
window.addEventListener('cookie-consent-ready', (e) => activateTrackers(e.detail));
// Also activate on page load if consent already stored
document.addEventListener('DOMContentLoaded', () => {
    try {
        const stored = JSON.parse(localStorage.getItem('cookie_consent') || 'null');
        if (stored && stored.categories) activateTrackers(stored.categories);
    } catch (e) {}
});
