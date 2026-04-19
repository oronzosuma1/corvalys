import './bootstrap';
// IMPORTANT: Livewire v3 ESM bundles its OWN Alpine instance. Importing
// `alpinejs` from npm gives you a DIFFERENT instance than the one
// Livewire.start() ends up using — stores registered on the npm Alpine
// are invisible to components in the DOM (they all resolve $store via
// the Livewire-bundled Alpine). Import Alpine from Livewire so both
// share the same instance.
import collapse from '@alpinejs/collapse';
import focus from '@alpinejs/focus';
import intersect from '@alpinejs/intersect';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

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
   Cookie consent store — $store.cookies.*
   - Loads from localStorage.cookie_consent (GDPR/ePrivacy record)
   - Blocks the page via a modal until the user chooses
   - Supports Reject All / Customize / Accept All (three equal buttons)
   - POSTs each decision to /api/cookie-consent for server-side log
   - Respects Global Privacy Control (GPC): silent auto-reject if set
   - Invalidates old consent when policy_version bumps
   ══════════════════════════════════════════════════════ */
const POLICY_VERSION = (document.querySelector('meta[name="policy-version"]')?.content) || '2026-04';
const CONSENT_KEY = 'cookie_consent';

function readConsent() {
    try {
        const raw = localStorage.getItem(CONSENT_KEY);
        if (!raw) return null;
        const parsed = JSON.parse(raw);
        if (!parsed || !parsed.categories) return null;
        if (parsed.version && parsed.version !== POLICY_VERSION) return null;
        if (parsed.expiresAt && new Date(parsed.expiresAt) < new Date()) return null;
        return parsed;
    } catch (_) { return null; }
}

function newUuid() {
    if (crypto && typeof crypto.randomUUID === 'function') return crypto.randomUUID();
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, c => {
        const r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

Alpine.store('cookies', {
    /**
     * accepted is kept as a plain reactive property (not a getter) because
     * Alpine's store proxy only tracks deps on direct property reads, not
     * on nested accesses made inside a JS getter.
     */
    accepted: !!readConsent(),
    _loaded: readConsent(),
    view: 'compact',           // 'compact' | 'categories'
    /** Necessary is always true and cannot be toggled by the user. */
    categories: {
        necessary: true,
        functional: false,
        analytics: false,
        marketing: false,
    },

    init() {
        // Keep local toggles in sync if consent was already saved.
        if (this._loaded && this._loaded.categories) {
            this.categories = Object.assign({}, this.categories, this._loaded.categories);
        }
        // Respect Global Privacy Control: silent reject on first visit only.
        if (!this._loaded && navigator.globalPrivacyControl === true) {
            this._persist('gpc_auto_reject');
        }
    },

    openCustomize() { this.view = 'categories'; },
    backToCompact() { this.view = 'compact'; },

    acceptAll() {
        this.categories = { necessary: true, functional: true, analytics: true, marketing: true };
        this._persist('accept');
    },
    rejectAll() {
        this.categories = { necessary: true, functional: false, analytics: false, marketing: false };
        this._persist('reject');
    },
    savePreferences() {
        this.categories.necessary = true; // enforce
        this._persist('custom');
    },

    _persist(action = 'accept') {
        const now = new Date();
        const sixMonthsMs = 6 * 30 * 24 * 3600 * 1000;
        const payload = {
            version: POLICY_VERSION,
            uuid: (this._loaded && this._loaded.uuid) || newUuid(),
            categories: Object.assign({}, this.categories),
            savedAt: now.toISOString(),
            expiresAt: new Date(now.getTime() + sixMonthsMs).toISOString(),
        };
        localStorage.setItem(CONSENT_KEY, JSON.stringify(payload));
        this._loaded = payload;
        this.accepted = true;

        // POST to the GDPR consent-log endpoint (fire-and-forget).
        const meta = document.querySelector('meta[name="csrf-token"]');
        fetch('/api/cookie-consent', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': meta ? meta.content : '',
            },
            body: JSON.stringify({
                uuid: payload.uuid,
                categories: this.categories,
                action,
                policy_version: POLICY_VERSION,
                locale: document.documentElement.lang || 'en',
            }),
        }).catch(() => {});

        window.dispatchEvent(new CustomEvent('consent:updated', {
            detail: { categories: this.categories },
        }));
    },
});

/* ══════════════════════════════════════════════════════
   Global helper so vanilla JS / analytics scripts can query consent.
   ══════════════════════════════════════════════════════ */
window.cookieConsent = {
    version: POLICY_VERSION,
    read: readConsent,
    has(cat) {
        const c = readConsent();
        return !!(c && c.categories && c.categories[cat]);
    },
    categories() {
        const c = readConsent();
        return c ? c.categories : null;
    },
    open()  {
        const s = Alpine.store('cookies');
        s.view = 'compact';
        s._loaded = null;
        s.accepted = false;
    },
    reset() {
        localStorage.removeItem(CONSENT_KEY);
        const s = Alpine.store('cookies');
        s._loaded = null;
        s.accepted = false;
    },
};

/* ══════════════════════════════════════════════════════
   Alpine plugins (register BEFORE Livewire.start()).
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
document.addEventListener('DOMContentLoaded', () => {
    const stored = readConsent();
    if (stored && stored.categories) activateConsentedScripts(stored.categories);
});

/* ══════════════════════════════════════════════════════
   Start Livewire (which starts Alpine for us — single boot).
   The layout uses @livewireScriptConfig so Livewire does NOT
   auto-start from a separate bundled script.
   ══════════════════════════════════════════════════════ */
Livewire.start();
