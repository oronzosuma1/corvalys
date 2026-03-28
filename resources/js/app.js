import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import { translations } from './translations.js'

Alpine.plugin(focus)

// Translation system
Alpine.store('lang', {
    current: localStorage.getItem('corvalys_lang') || 'en',

    set(lang) {
        this.current = lang;
        localStorage.setItem('corvalys_lang', lang);
        document.documentElement.lang = lang;
        this.translatePage();
    },

    t(key, params = {}) {
        let text = translations[this.current]?.[key] || translations['en']?.[key] || key;
        Object.entries(params).forEach(([k, v]) => {
            text = text.replace(`{${k}}`, v);
        });
        return text;
    },

    translatePage() {
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            const params = el.getAttribute('data-i18n-params');
            const parsedParams = params ? JSON.parse(params) : {};
            el.textContent = this.t(key, parsedParams);
        });
        document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
            el.placeholder = this.t(el.getAttribute('data-i18n-placeholder'));
        });
        document.querySelectorAll('[data-i18n-html]').forEach(el => {
            const key = el.getAttribute('data-i18n-html');
            const params = el.getAttribute('data-i18n-params');
            const parsedParams = params ? JSON.parse(params) : {};
            el.innerHTML = this.t(key, parsedParams);
        });
    },

    init() {
        // Set initial lang attribute
        document.documentElement.lang = this.current;
    }
});

window.Alpine = Alpine
Alpine.start()

// Translate on page load after Alpine is ready
document.addEventListener('alpine:initialized', () => {
    Alpine.store('lang').translatePage();
});
