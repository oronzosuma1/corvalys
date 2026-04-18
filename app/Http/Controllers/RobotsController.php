<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $isProd = app()->environment('production')
            && str_contains(parse_url(config('app.url'), PHP_URL_HOST) ?? '', 'corvalys.eu');

        if ($isProd) {
            $host = parse_url(config('app.url'), PHP_URL_HOST);
            $lines = [
                'User-agent: *',
                'Allow: /',
                'Disallow: /livewire/',
                'Disallow: /livewire-*/',
                'Disallow: /_debugbar/',
                'Disallow: /storage/',
                'Disallow: /build/',
                'Disallow: /api/',
                'Disallow: /admin/',
                'Disallow: /admin-login/',
                'Disallow: /language/',
                'Disallow: /*?lang=',
                '',
                'Sitemap: ' . rtrim(config('app.url'), '/') . '/sitemap.xml',
                'Host: ' . $host,
            ];
        } else {
            $lines = [
                'User-agent: *',
                'Disallow: /',
            ];
        }

        return response(implode("\n", $lines) . "\n", 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
