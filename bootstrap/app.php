<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders(require __DIR__.'/providers.php')
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        then: function () {
            require base_path('routes/admin.php');
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // Redirect unauthenticated users to admin login
        $middleware->redirectGuestsTo('/admin/login');

        // Locale resolution (cookie > ?lang= > Accept-Language) — must run
        // before any controller so app()->getLocale() returns the right value.
        $middleware->web(prepend: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        // Track page views on all web requests
        $middleware->web(append: [
            \App\Http\Middleware\TrackPageViews::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
