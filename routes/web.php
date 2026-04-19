<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

// Register localized routes from config/localized_routes.php
\App\Support\LocalizedRoutes::register();

// ── Legacy redirects — MUST register AFTER LocalizedRoutes so they take
//     precedence over any colliding canonical paths. Blog, product detail
//     and /legal/privacy currently contain Italian-only content, so every
//     anonymous hit should go to the /it/... equivalent until English
//     content ships.
//     Each redirect keeps the same route NAME as the canonical LocalizedRoutes
//     entry it replaces, so route('blog.index'), route('privacy'), etc.
//     continue to resolve via the UrlGenerator override (fall back to .en name).
Route::get('/blog', fn () => redirect('/it/blog', 301))->name('blog.index.en');
Route::get('/blog/{slug}', fn (string $slug) => redirect("/it/blog/{$slug}", 301))
    ->where('slug', '[A-Za-z0-9_\-]+')
    ->name('blog.show.en');
Route::get('/prodotti/{slug}', fn (string $slug) => redirect("/it/prodotti/{$slug}", 301))
    ->where('slug', '[A-Za-z0-9_\-]+');
// Note: /legal/privacy is the canonical EN privacy URL (served via LocalizedRoutes
// → privacy.en). No legacy redirect needed — keeping one here would collide with
// the canonical route name and break `php artisan route:cache`.
Route::redirect('/business-survey', '/it/business-survey', 301);
Route::redirect('/it/survey', '/it/business-survey', 301);
Route::redirect('/fr/survey', '/fr/sondage', 301);

// Courtesy redirects for common localized slugs typed without /it or /fr prefix.
// These are NOT legacy URLs — they exist to catch users who guess the slug in
// their language and to keep 301s consistent across the domain.
Route::permanentRedirect('/a-propos', '/fr/a-propos');
Route::permanentRedirect('/conseil', '/fr/conseil');
Route::permanentRedirect('/produits', '/fr/produits');
Route::permanentRedirect('/tarifs', '/fr/tarifs');
Route::permanentRedirect('/ressources', '/fr/ressources');
Route::permanentRedirect('/contatti', '/it/contatto');
Route::permanentRedirect('/servizi', '/it/consulenza');
Route::permanentRedirect('/sondage', '/fr/sondage');

// Home shortcut — keep non-suffixed `home` name for backward compat
Route::redirect('/home', '/', 301);

// Sitemap (top-level, not localized)
Route::get('/sitemap.xml', \App\Http\Controllers\SitemapController::class)->name('sitemap');

// Dynamic robots.txt (top-level, not localized)
Route::get('/robots.txt', \App\Http\Controllers\RobotsController::class)->name('robots');

// RSS feed (top-level + per-locale prefix). The controller resolves locale from
// the request-scoped locale set by middleware (same URL convention as sitemap).
Route::get('/feed.xml', \App\Http\Controllers\FeedController::class)->name('feed.en');
Route::get('/it/feed.xml', \App\Http\Controllers\FeedController::class)->name('feed.it');
Route::get('/fr/feed.xml', \App\Http\Controllers\FeedController::class)->name('feed.fr');

// Newsletter (form POST, not localized)
Route::post('/newsletter', [HomeController::class, 'newsletter'])->name('newsletter');

// Language switcher — sets `locale` cookie and redirects back
Route::post('/language/{locale}', [LanguageController::class, 'switch'])
    ->where('locale', 'en|it|fr')
    ->name('language.switch');

// GDPR cookie consent logging (session + CSRF)
Route::post('/api/consent', [\App\Http\Controllers\Api\ConsentController::class, 'store'])
    ->middleware(['throttle:30,1'])
    ->name('consent.store');

Route::post('/api/cookie-consent', [\App\Http\Controllers\Api\ConsentController::class, 'store'])
    ->middleware(['throttle:30,1'])
    ->name('cookie-consent.store');
