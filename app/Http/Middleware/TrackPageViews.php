<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;

class TrackPageViews
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only track GET requests on public pages (not admin, not assets)
        if ($request->isMethod('GET')
            && !$request->is('admin*')
            && !$request->is('build/*')
            && !$request->ajax()
            && $response->getStatusCode() === 200
        ) {
            try {
                $ip = $request->ip();
                $geo = $this->geolocate($ip);

                PageView::create([
                    'url' => $request->path(),
                    'ip_address' => $ip,
                    'country' => $geo['country'] ?? null,
                    'city' => $geo['city'] ?? null,
                    'user_agent' => substr($request->userAgent() ?? '', 0, 255),
                    'referer' => substr($request->header('referer', ''), 0, 255) ?: null,
                ]);
            } catch (\Exception $e) {
                // Silently fail — analytics should never break the site
            }
        }

        return $response;
    }

    /**
     * Simple IP geolocation using ip-api.com (free, no API key needed).
     * For production, consider a local GeoIP database (e.g., MaxMind GeoLite2).
     */
    private function geolocate(string $ip): array
    {
        // Skip localhost/private IPs
        if (in_array($ip, ['127.0.0.1', '::1']) || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.')) {
            return ['country' => 'Local', 'city' => 'Localhost'];
        }

        try {
            $context = stream_context_create(['http' => ['timeout' => 2]]);
            $response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=country,city", false, $context);

            if ($response) {
                $data = json_decode($response, true);
                return [
                    'country' => $data['country'] ?? 'Unknown',
                    'city' => $data['city'] ?? 'Unknown',
                ];
            }
        } catch (\Exception $e) {
            // Fail silently
        }

        return ['country' => 'Unknown', 'city' => 'Unknown'];
    }
}
