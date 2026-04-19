<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sets app locale from a `locale` cookie (or ?lang= query param).
 * Falls back to Accept-Language header, then to app.fallback_locale.
 *
 * Accepted values: en, it, fr.
 */
class SetLocale
{
    public const SUPPORTED = ['en', 'it', 'fr'];
    public const COOKIE = 'locale';

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->resolveLocale($request) ?? config('app.fallback_locale', 'en');

        app()->setLocale($locale);

        // Carbon + setlocale for dates, numbers, etc.
        try {
            \Carbon\Carbon::setLocale($locale);
            // Best-effort setlocale — platforms vary in available C locales.
            @setlocale(LC_TIME, "{$locale}_" . strtoupper($locale) . ".UTF-8", $locale);
        } catch (\Throwable $e) {
            // ignore — locale formatting is non-critical
        }

        // Persist to session so subsequent requests (POST forms, Livewire updates)
        // resolve the same locale without re-parsing the URL.
        if ($request->hasSession()) {
            session(['locale' => $locale]);
        }

        // Share to every Blade view + auto-inject {locale} into generated URLs
        // when a route accepts it.
        view()->share('currentLocale', $locale);
        \Illuminate\Support\Facades\URL::defaults(['locale' => $locale === 'en' ? null : $locale]);

        return $next($request);
    }

    private function resolveLocale(Request $request): ?string
    {
        // 1. URL path prefix — highest priority so Google crawling /it/... always
        //    renders the Italian version regardless of the user's cookie.
        $path = trim($request->path(), '/');
        $firstSegment = strtolower(strtok($path, '/') ?: '');
        if ($firstSegment && in_array($firstSegment, self::SUPPORTED, true) && $firstSegment !== 'en') {
            return $firstSegment;
        }

        // 2. Query string override (?lang=it) — useful for testing
        $qs = $request->query('lang');
        if ($qs && in_array($qs, self::SUPPORTED, true)) {
            return $qs;
        }

        // 3. Cookie
        $cookie = $request->cookie(self::COOKIE);
        if ($cookie && in_array($cookie, self::SUPPORTED, true)) {
            return $cookie;
        }

        // 4. Accept-Language best match
        $header = (string) $request->header('Accept-Language', '');
        foreach (explode(',', $header) as $chunk) {
            $tag = strtolower(trim(explode(';', $chunk)[0]));
            $primary = substr($tag, 0, 2);
            if (in_array($primary, self::SUPPORTED, true)) {
                return $primary;
            }
        }

        return null; // let Laravel use app.fallback_locale
    }
}
