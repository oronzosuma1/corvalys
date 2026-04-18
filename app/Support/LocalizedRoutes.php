<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

/**
 * Helpers for the localized routing layer defined in config/localized_routes.php.
 *
 * Each route in the config produces one named route per locale:
 *   home       → home.en (/),  home.it (/it),  home.fr (/fr)
 *   consulenza → consulenza.en (/consulting), consulenza.it (/it/consulenza), consulenza.fr (/fr/conseil)
 *
 * The app's UrlGenerator is extended so that route('consulenza') transparently
 * resolves to consulenza.{current-locale}.
 */
class LocalizedRoutes
{
    /**
     * Register every route variant defined in config/localized_routes.php.
     * Called from routes/web.php.
     */
    public static function register(): void
    {
        $config = config('localized_routes');
        $locales = $config['locales'] ?? ['en'];
        $defaultLocale = $config['default_locale'] ?? 'en';

        // First pass: collect every live path so legacy redirects that would
        // collide with a canonical URL can be skipped.
        $livePaths = [];
        foreach ($config['routes'] as $name => $def) {
            foreach ($locales as $locale) {
                $path = $def['paths'][$locale] ?? null;
                if ($path === null) continue;
                $prefix = $locale === $defaultLocale ? '' : $locale;
                $full = trim($prefix . '/' . $path, '/');
                $livePaths['/' . ltrim($full, '/')] = true;
            }
        }

        // Second pass: register canonical locale routes + non-colliding redirects.
        foreach ($config['routes'] as $name => $def) {
            foreach ($locales as $locale) {
                $path = $def['paths'][$locale] ?? null;
                if ($path === null) continue;

                $prefix = $locale === $defaultLocale ? '' : $locale;
                $fullPath = trim($prefix . '/' . $path, '/');
                $fullPath = $fullPath === '' ? '/' : '/' . $fullPath;

                $method = strtolower($def['method'] ?? 'get');
                Route::{$method}($fullPath, $def['controller'])
                    ->name("{$name}.{$locale}");
            }

            // Legacy redirects: old URL → current-locale variant of this route.
            // Skip any redirect source that matches a live canonical path (else it
            // would shadow the real route).
            foreach ($def['redirects'] ?? [] as $oldUrl => $redirectLocale) {
                $normalized = '/' . ltrim($oldUrl, '/');
                if (isset($livePaths[$normalized])) {
                    continue;
                }
                Route::get($oldUrl, function () use ($name, $redirectLocale) {
                    return redirect(self::urlFor($name, [], $redirectLocale), 301);
                });
            }
        }
    }

    /**
     * Return the URL for a named route in a specific locale.
     */
    public static function urlFor(string $name, array $params = [], ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $suffixed = "{$name}.{$locale}";
        if (Route::has($suffixed)) {
            return route($suffixed, $params);
        }
        // Fallback: default locale
        $fallback = "{$name}." . config('localized_routes.default_locale', 'en');
        if (Route::has($fallback)) {
            return route($fallback, $params);
        }
        // Last resort: the original name (may work for non-localized routes)
        return route($name, $params);
    }

    /**
     * Return the current request URL in a different locale, for language
     * switcher. Falls back to the locale's home URL if mapping fails.
     */
    public static function currentInLocale(string $locale): string
    {
        $current = request()->route();
        if (!$current) {
            return self::urlFor('home', [], $locale);
        }
        $currentName = $current->getName();
        if (!$currentName) {
            return self::urlFor('home', [], $locale);
        }
        // Strip trailing .locale suffix if present
        $base = preg_replace('/\.(en|it|fr)$/', '', $currentName);

        // Extract route params (preserve {service} etc.) and normalize any
        // Eloquent models down to their route key (slug) so the URL builder
        // receives plain scalars.
        $params = self::normalizeParams($current->parameters());

        try {
            return self::urlFor($base, $params, $locale);
        } catch (\Throwable $e) {
            return self::urlFor('home', [], $locale);
        }
    }

    /**
     * Return [en => url, it => url, fr => url] for hreflang alternates.
     *
     * If $params is empty and we're being called for the current route, the
     * parameters of the current request route are used — normalized so that
     * Eloquent model parameters are serialized via their route key (slug).
     */
    public static function alternatesFor(?string $name = null, array $params = []): array
    {
        $resolvedName = $name ?: self::currentBaseName();
        if (!$resolvedName) return [];

        // If params are not explicitly provided and we're resolving the
        // current route, pull params from the request and normalize them.
        if (empty($params)) {
            $currentBase = self::currentBaseName();
            if ($currentBase === $resolvedName) {
                $current = request()->route();
                $raw = $current ? $current->parameters() : [];
                $params = self::normalizeParams($raw);
            }
        }

        $out = [];
        foreach (config('localized_routes.locales', ['en']) as $locale) {
            try {
                $out[$locale] = self::urlFor($resolvedName, $params, $locale);
            } catch (\Throwable $e) {
                // Fallback to home if target route requires params we don't have.
                $out[$locale] = self::urlFor('home', [], $locale);
            }
        }
        return $out;
    }

    /**
     * Convert a mixed bag of route parameters (Eloquent models, strings, ints)
     * into a flat array of scalars suitable for route() generation.
     */
    protected static function normalizeParams(array $params): array
    {
        $out = [];
        foreach ($params as $key => $value) {
            if ($value instanceof \Illuminate\Database\Eloquent\Model) {
                $out[$key] = $value->getRouteKey();
            } else {
                $out[$key] = $value;
            }
        }
        return $out;
    }

    public static function currentBaseName(): ?string
    {
        $route = request()->route();
        if (!$route) return null;
        $name = $route->getName();
        if (!$name) return null;
        return preg_replace('/\.(en|it|fr)$/', '', $name);
    }
}
