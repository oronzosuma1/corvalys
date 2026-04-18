<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

// Register localized routes from config/localized_routes.php
\App\Support\LocalizedRoutes::register();

// Home shortcut — keep non-suffixed `home` name for backward compat
Route::redirect('/home', '/', 301);

// Sitemap (top-level, not localized)
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');

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
