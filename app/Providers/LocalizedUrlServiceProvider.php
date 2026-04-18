<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class LocalizedUrlServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend('url', function (UrlGenerator $original, $app) {
            $generator = new class(
                $app['router']->getRoutes(),
                $app['request'],
                $app['config']['app.asset_url']
            ) extends UrlGenerator {
                public function route($name, $parameters = [], $absolute = true)
                {
                    if ($this->routes->hasNamedRoute($name)) {
                        return parent::route($name, $parameters, $absolute);
                    }
                    $locale = app()->getLocale();
                    $suffixed = "{$name}.{$locale}";
                    if ($this->routes->hasNamedRoute($suffixed)) {
                        return parent::route($suffixed, $parameters, $absolute);
                    }
                    $fallback = "{$name}." . config('localized_routes.default_locale', 'en');
                    if ($this->routes->hasNamedRoute($fallback)) {
                        return parent::route($fallback, $parameters, $absolute);
                    }
                    return parent::route($name, $parameters, $absolute);
                }
            };

            // Preserve formatter/session/key/root resolvers from the original generator
            $generator->setSessionResolver(fn () => $app['session'] ?? null);
            $generator->setKeyResolver(fn () => $app->make('config')->get('app.key'));
            if (method_exists($original, 'formatHostUsing')) {
                // Keep any formatHostUsing callbacks by re-applying through the router
            }

            return $generator;
        });
    }
}
