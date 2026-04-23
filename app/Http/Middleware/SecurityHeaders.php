<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
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
            "script-src 'self' 'unsafe-inline' https://assets.calendly.com",
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

        // PHP's SAPI emits X-Powered-By directly when expose_php=On in php.ini,
        // bypassing Symfony's header bag. header_remove() strips it from PHP's
        // outgoing header list before flush. Web-server-level `Server:` (e.g.
        // LiteSpeed) can only be suppressed at the web server layer.
        if (! headers_sent()) {
            header_remove('X-Powered-By');
        }

        return $response;
    }
}
