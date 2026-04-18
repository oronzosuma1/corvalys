<?php

use App\Support\LocalizedRoutes;

if (!function_exists('lroute')) {
    /**
     * Generate a URL for a localized route, respecting the current locale.
     */
    function lroute(string $name, array $params = [], ?string $locale = null): string
    {
        return LocalizedRoutes::urlFor($name, $params, $locale);
    }
}
