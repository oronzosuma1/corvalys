<?php

/**
 * Locale-aware URL helper.
 *
 * Returns the correct localized path for the current locale without
 * having to go through the LocalizedRoutes slug map. Handy for nav
 * links where the slug is the canonical signal (not a route name).
 *
 *   <a href="{{ localized_url('consulting','consulenza','conseil') }}">
 *       {{ __('nav.consulting') }}
 *   </a>
 *
 * On /       → /consulting
 * On /it/... → /it/consulenza
 * On /fr/... → /fr/conseil
 */

if (! function_exists('localized_url')) {
    function localized_url(string $en, string $it, string $fr): string
    {
        return match (app()->getLocale()) {
            'it' => url('/it/' . ltrim($it, '/')),
            'fr' => url('/fr/' . ltrim($fr, '/')),
            default => url('/' . ltrim($en, '/')),
        };
    }
}
