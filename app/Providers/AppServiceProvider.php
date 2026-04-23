<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(\App\Services\ClaudeService::class);
    }

    public function boot(): void
    {
        // Emits the per-request CSP nonce attribute. Pairs with the
        // SecurityHeaders middleware, which binds 'csp-nonce' in the
        // container before the response is built.
        Blade::directive('cspNonce', function () {
            return "<?php echo 'nonce=\"' . e(app('csp-nonce')) . '\"'; ?>";
        });
    }
}
