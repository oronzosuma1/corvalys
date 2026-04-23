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

CSP allow-list covers Calendly (booking embed) and Google Fonts. Review before adding new
third-party scripts (analytics, chat widgets, etc.) — they will be blocked until added.

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

## 3. Sitemap response — VERIFIED (no code change)

`SitemapController` already returns:

- `HTTP/1.1 200`
- `Content-Type: application/xml; charset=UTF-8`
- `Cache-Control: public, max-age=3600`

XML prolog is served as first bytes (fixed separately in commit `cb3f3ad`).

The GSC "Couldn't fetch" was stale state from the pre-fix submission. Action:
**remove the sitemap entry in GSC and re-add `https://www.corvalys.eu/sitemap.xml`** to
force a refetch.

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

---

## 5. Recommended GSC actions post-deploy

1. Sitemaps → remove stale entry → resubmit `https://www.corvalys.eu/sitemap.xml`.
2. URL Inspection → request indexing for the 5 canonical product pages that return 200
   (cash-controller, approval-coordinator, compliance-officer) × (en/it/fr).
3. Coverage → once the product-scope fix lands, expect the 18 × 404s to drop out of
   "Discovered – currently not indexed".

---

## 6. Acceptance criteria status

| Criterion | Status |
|---|---|
| All 6 security headers present on production (via middleware + .htaccess) | Pending prod deploy + verification |
| Middleware alone produces headers (verified with built-in `php artisan serve`, no .htaccess) | ✅ 5/6 locally (HSTS correctly gated on HTTPS) |
| `X-Powered-By` removed | ✅ locally; requires `expose_php=Off` on server for full belt-and-braces |
| `Server` header minimized | Requires LiteSpeed-level config (see §1) |
| XSRF-TOKEN remains JS-readable | ✅ |
| Sitemap headers correct | ✅ |
| Non-indexed page investigation | ✅ (see §4-A) |
