<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        // Per-request CSP nonce. Bind before $next() so any view or
        // component rendered downstream can read it via app('csp-nonce').
        $nonce = base64_encode(random_bytes(16));
        app()->instance('csp-nonce', $nonce);
        Vite::useCspNonce($nonce);

        /** @var Response $response */
        $response = $next($request);

        if ($request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        $csp = implode('; ', [
            "default-src 'self'",
            // 'strict-dynamic' lets nonced scripts load further scripts without their own
            // nonces — the host allowlists below are kept for older browsers that ignore
            // 'strict-dynamic' and fall back to CSP2 behaviour.
            //
            // 'unsafe-eval' is required because Alpine.js (bundled inside Livewire 3) uses
            // `new Function()` to evaluate template expressions (x-data, x-show,
            // @click.away, etc.). Without it, the survey page body stays blank, the
            // language dropdown never closes, and every x-data component is inert. Switch
            // to @alpinejs/csp one day if A+ becomes critical — that build precompiles
            // expressions and avoids eval.
            "script-src 'self' 'nonce-{$nonce}' 'strict-dynamic' 'unsafe-eval' https://assets.calendly.com https://cdn.tiny.cloud",
            "style-src 'self' 'unsafe-inline' https://assets.calendly.com https://fonts.googleapis.com",
            "img-src 'self' data: https:",
            "font-src 'self' https://fonts.gstatic.com data:",
            "connect-src 'self' https://calendly.com https://*.calendly.com",
            "frame-src https://calendly.com https://*.calendly.com",
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self'",
            "object-src 'none'",
            "upgrade-insecure-requests",
        ]);
        $response->headers->set('Content-Security-Policy', $csp);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set(
            'Permissions-Policy',
            'geolocation=(), microphone=(), camera=(), payment=(), usb=(), interest-cohort=()'
        );

        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');
        $response->headers->remove('x-turbo-charged-by');
        $response->headers->remove('X-Turbo-Charged-By');

        // PHP's SAPI emits X-Powered-By directly when expose_php=On in php.ini,
        // bypassing Symfony's header bag. header_remove() strips it from PHP's
        // outgoing header list before flush. Web-server-level `Server:` and
        // LiteSpeed's `x-turbo-charged-by` can only be fully suppressed at the
        // web server layer (see docs/seo-audit-2026-04.md).
        if (! headers_sent()) {
            header_remove('X-Powered-By');
            header_remove('x-turbo-charged-by');
            header_remove('X-Turbo-Charged-By');
        }

        return $response;
    }
}
