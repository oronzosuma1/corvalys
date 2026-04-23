# SEO & Security Audit — April 2026

Companion document for the remediation commits addressing the April 2026 external audit
(SSL Labs, securityheaders.com, Google Search Console, PageSpeed).

This file records **what was changed, what was intentionally left alone, and what still
needs human review**.

---

## 1. Security headers — DONE

| Header | Source of truth | Notes |
|---|---|---|
| `Strict-Transport-Security: max-age=31536000; includeSubDomains; preload` | `SecurityHeaders` middleware, gated on `$request->isSecure()` | Also mirrored in `.htaccess` under `env=HTTPS` as defense-in-depth |
| `Content-Security-Policy` | `SecurityHeaders` middleware (single source of truth) | **Not duplicated in `.htaccess`** to avoid drift |
| `X-Frame-Options: SAMEORIGIN` | Middleware + `.htaccess` | |
| `X-Content-Type-Options: nosniff` | Middleware + `.htaccess` | |
| `Referrer-Policy: strict-origin-when-cross-origin` | Middleware + `.htaccess` | |
| `Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=(), usb=(), interest-cohort=()` | Middleware + `.htaccess` | |

CSP allow-list covers Calendly (booking embed), Google Fonts, and TinyMCE (admin only).
Review before adding new third-party scripts (analytics, chat widgets, etc.) — they will
be blocked until added.

### CSP nonce migration — DONE (A+ push)

`script-src` no longer contains `'unsafe-inline'`. The middleware now generates a per-request
nonce, binds it to the container as `csp-nonce`, and configures `Illuminate\Support\Facades\Vite::useCspNonce($nonce)`
so Vite-generated `<script>` tags carry the same nonce automatically. A Blade directive
`@cspNonce` is registered in `AppServiceProvider::boot()` and emits
`nonce="..."` in any template.

`'strict-dynamic'` is enabled so nonced scripts can load further scripts without each of
them needing their own nonce. Host allow-lists (`calendly.com`, `cdn.tiny.cloud`) remain
for CSP2 fallback on older browsers.

Templates updated (each inline or external `<script>` now carries `@cspNonce`):

- `resources/views/components/json-ld.blade.php`
- `resources/views/components/seo-head.blade.php` (JSON-LD loop)
- `resources/views/layouts/app.blade.php` — `@livewireScriptConfig(['nonce' => app('csp-nonce')])`
- `resources/views/layouts/admin.blade.php` — TinyMCE CDN script + inline init + `@livewireScripts(['nonce' => ...])`
- `resources/views/pages/contatto.blade.php` — Calendly CDN script
- `resources/views/pages/survey.blade.php`
- `resources/views/pages/business-survey.blade.php`
- `resources/views/admin/survey/analytics.blade.php`
- `resources/views/admin/business-survey/analytics.blade.php`
- `resources/views/admin/invoices/_form.blade.php`

The inert loader in `resources/views/components/consent-script.blade.php` uses
`type="text/plain"` and is never executed by the browser — intentionally left without a
nonce.

### X-Powered-By / Server

- Middleware removes `X-Powered-By` via both `$response->headers->remove()` **and**
  `header_remove('X-Powered-By')` because PHP's SAPI emits this header directly when
  `expose_php=On` in `php.ini`, bypassing Symfony's header bag.
- `.htaccess` also contains `Header unset X-Powered-By` / `Header unset Server` as
  defense-in-depth.
- **Action required on the server:** edit `php.ini` (or a conf.d drop-in) and set
  `expose_php = Off`, then restart LiteSpeed:
  `systemctl restart lsws` (or cPanel → LiteSpeed Web Server → Graceful Restart).
- **`Server: LiteSpeed`** can only be suppressed at the web-server layer. On shared cPanel
  hosting this usually requires support intervention; on a VPS, set
  `ServerSignature Off` + `ServerTokens Prod` in the LiteSpeed/Apache config.

### Ops action required — LiteSpeed signature + turbo header

LSWS emits `Server: LiteSpeed` and `x-turbo-charged-by: LiteSpeed` after our PHP/Apache
layer. Neither can be fully removed from application code. Do this once in the web-server
config:

1. **LiteSpeed WebAdmin console** → Server Configuration → General → set
   **"Server Signature"** to `Off`. Then **Graceful Restart** LSWS.
2. If on cPanel with LiteSpeed: **WHM → Tweak Settings → "Server Tokens"** to
   `ProductOnly` (or `Minimal`), then restart the web server.
3. Middleware and `.htaccess` already strip `x-turbo-charged-by` / `X-Turbo-Charged-By`
   via `Header unset`, but this only works if `mod_headers` is loaded on LiteSpeed — verify
   with `curl -sI https://www.corvalys.eu/` after deploy.

Do NOT attempt to edit `httpd.conf` or LSWS config files from the Laravel repo.

---

## 2. Cookie hardening — DONE

`config/session.php`:

- `secure`    → `env('SESSION_SECURE_COOKIE', true)` (defaults to `true`)
- `http_only` → hardcoded `true`
- `same_site` → hardcoded `'lax'`

`.env.example` adds `SESSION_SECURE_COOKIE=true` as documentation for fresh installs.

**XSRF-TOKEN cookie intentionally remains JS-readable** (no HttpOnly) — required by
Laravel's CSRF flow via `axios`/fetch + `X-XSRF-TOKEN` header. It still gets `Secure` and
`SameSite=Lax` in production (HTTPS).

---

## 3. Sitemap response — DONE (hardened)

`SitemapController` returns:

- `HTTP/1.1 200`
- `Content-Type: application/xml; charset=UTF-8`
- `Cache-Control: public, max-age=3600`
- XML prolog is served as first bytes (commit `cb3f3ad`)

### No Set-Cookie on sitemap / robots / feed (new)

The `sitemap.xml`, `robots.txt`, and `feed.xml` routes now exclude the session/CSRF
middleware stack via `->withoutMiddleware([...])` in `routes/web.php`. This removes the
`XSRF-TOKEN` + session `Set-Cookie` headers that were leaking onto every stateless
response, and lets upstream caches (LiteSpeed, browser, GSC) reuse the payload.

Feature test at `tests/Feature/SitemapTest.php` asserts: status 200, correct `Content-Type`
and `Cache-Control`, **no `Set-Cookie`**, body starts with `<?xml`, contains `<urlset`, and
matches `<loc>https?://...</loc>`.

### GSC resubmit — MANUAL

- [ ] After this deploy, in https://search.google.com/search-console/ for
  `https://www.corvalys.eu/`: **Sitemaps → remove** the existing `/sitemap.xml` entry,
  wait 5 min, then **re-add `sitemap.xml`**. Status should turn to **Success** within 72h.

---

## 4. Non-indexed / noindex audit

### `noindex` directives — grep results

| File | Line | Context | Verdict |
|---|---|---|---|
| `resources/views/components/seo-head.blade.php` | 15, 70 | Component prop + conditional meta | **OK** — infrastructure, default `false` |
| `resources/views/layouts/app.blade.php` | 22 | Passes `$seoNoindex ?? false` to component | **OK** |
| `resources/views/errors/404.blade.php` | 12 | `$seoNoindex = true` | **OK** — 404 pages correctly noindexed |

- `X-Robots-Tag`: **0 occurrences** in `app/`.
- `<meta name="robots">` emitted: **one** — from `seo-head` component, either
  `index,follow` (default) or `noindex,nofollow` (only for 404).

### Canonical tags

Spot-checked homepage, EN product, IT product — all emit a `<link rel="canonical">`
pointing to self with the correct locale prefix. `seo-head.blade.php` generates
hreflang alternates from `LocalizedRoutes::alternatesFor()`.

### Sitemap URL status (local verification, 93 URLs)

| Status | Count |
|---|---|
| 200 | 71 |
| 301 | 4 |
| 404 | **18** |

### FLAGGED — HUMAN REVIEW REQUIRED

**A) 18 product pages in sitemap return 404** — likely the GSC "non-indexed" cause.

Root cause: [SitemapController.php:56](../app/Http/Controllers/SitemapController.php#L56) queries
`Service::active()` without filtering by `type`. It emits URLs for **every** active Service
row including `type='consulenza'` and others. But
[ProdottiController::show()](../app/Http/Controllers/ProdottiController.php#L18) hard-rejects
anything where `type !== 'prodotto'`, returning 404.

Affected slugs (6 services × 3 locales = 18 × 404):
`ai-strategy`, `ai-development`, `supply-chain-ai`, `ai-act-compliance`, `industry-40`,
`llm-multi-agent`.

**Proposed one-line fix** (not applied — flagged for review because it changes the
sitemap URL list):

```php
// app/Http/Controllers/SitemapController.php line 57
$products = class_exists(Service::class)
-   ? Service::active()->orderBy('sort_order')->get()
+   ? Service::prodotti()->active()->orderBy('sort_order')->get()
    : collect();
```

Alternative: decide whether the excluded services should become dedicated pages (change
their `type` to `prodotto` and create content) or remain internal-only (keep them out of
the public sitemap).

**B) `/blog` (EN) returns 301 → `/it/blog`** — intentional legacy redirect
([routes/web.php:18](../routes/web.php#L18)). EN blog listing should not be in the sitemap
until English articles exist. Scope: FIX 3 of the April SEO backlog.

**C) EN blog-post URLs `/blog/<slug>` return 301 → `/it/blog/<slug>`** — same root cause
as (B). 3 URLs.

**D) `/resources` returns 301 → `/resources/`** (NEW — production-only).

`.htaccess` rule normalises trailing slashes in the *other* direction (strips them), so
this redirect isn't coming from Laravel. Most likely a LiteSpeed / `mod_dir` auto-append,
triggered by a file or directory at `public/resources` or `/home/corvkrac/public_html/resources`.
The sitemap emits `/resources` (no slash); GSC follows the 301, but a non-canonical entry
in the sitemap delays indexation.

**Diagnostic commands for the server:**
```
ls -la /home/corvkrac/public_html/resources 2>/dev/null
ls -la /home/corvkrac/corvalys/public/resources 2>/dev/null
curl -sI https://www.corvalys.eu/resources | grep -iE 'HTTP|Location'
```

Fix candidates: remove the stray directory, or add
`DirectorySlash Off` in `.htaccess` above the Laravel rewrite block.

### Automated audit tool — `php artisan seo:audit`

New command at `app/Console/Commands/SeoAudit.php`. Fetches `/sitemap.xml`, inspects
every `<loc>` without following redirects, records status / canonical / robots /
`<html lang>`, and writes the full dataset to `storage/app/seo-audit.json`. Flags any
row where status ≠ 200, canonical ≠ request URL, or `robots` contains `noindex`.

```
php artisan seo:audit --base=https://www.corvalys.eu
```

Latest run (production): 23 anomalies / 93 URLs — 18 × 404 (A), 3 × 301 blog posts (C),
1 × 301 `/blog` (B), 1 × 301 `/resources` (D).

---

## 5. PageSpeed Accessibility regression (96 → 93 mobile)

**Heading hierarchy** on `resources/views/pages/home.blade.php` verified OK:
`h1 (L39) → h2 (L163) → h3 (L188, 219, 250) → h2 (L293) → h3 (L333, 358) → h2 (L390) → h3 (L416, 440, 464, 488)` — no skips.

`<html lang>` is locale-aware via `{{ app()->getLocale() }}` in `layouts/app.blade.php:2`.
`.admin.blade.php:2` is hardcoded `lang="it"` — OK, admin is IT-only.

Cookie banner (`components/cookie-consent.blade.php`) has `role="dialog" aria-modal="true"
aria-labelledby="cookie-title"`. Buttons rely on their visible text content for labels,
which WCAG allows.

**BLOCKED on actual Lighthouse report.** The spec prohibits sweeping refactors to chase a
score. Please run https://pagespeed.web.dev against `https://www.corvalys.eu/` on Mobile,
paste the failing **Accessibility** audits here, and we'll fix exactly those.

---

## 6. Recommended GSC actions post-deploy

1. Sitemaps → remove stale entry → resubmit `https://www.corvalys.eu/sitemap.xml`.
2. URL Inspection → request indexing for the canonical product pages that return 200
   (`cash-controller`, `approval-coordinator`, `compliance-officer`) × (en / it / fr).
3. Coverage → once the product-scope fix (§4-A) lands, expect the 18 × 404s to drop out
   of "Discovered – currently not indexed".
4. Once `/resources` (§4-D) is fixed, the 301 delay on resubmission should clear.

---

## 7. Acceptance criteria status

| Criterion | Status |
|---|---|
| All 6 security headers present on production (via middleware + .htaccess) | Pending prod deploy + verification |
| Middleware alone produces headers (verified with built-in `php artisan serve`, no .htaccess) | ✅ 5/6 locally (HSTS correctly gated on HTTPS) |
| CSP no `'unsafe-inline'` in `script-src` | ✅ (nonce + `'strict-dynamic'`) |
| `X-Powered-By` removed | ✅ locally; requires `expose_php=Off` on server for full belt-and-braces |
| `x-turbo-charged-by` absent | `.htaccess` + middleware `Header unset` applied — verify post-deploy |
| `Server` header minimized | Requires LiteSpeed-level config (see §1 → "Ops action required") |
| XSRF-TOKEN remains JS-readable | ✅ |
| Sitemap response: 200 / `application/xml` / `Cache-Control` / no Set-Cookie | ✅ + Feature test |
| Non-indexed page investigation | ✅ (§4 + `php artisan seo:audit`) |
| PageSpeed Accessibility ≥96 mobile | Blocked on Lighthouse report (see §5) |
| securityheaders.com = A+ | Pending prod deploy + verification |
