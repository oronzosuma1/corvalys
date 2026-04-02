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
