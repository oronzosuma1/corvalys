<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CookieConsent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConsentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'uuid' => 'nullable|uuid',
            'categories' => 'required|array',
            'categories.necessary' => 'required|boolean',
            'categories.functional' => 'required|boolean',
            'categories.analytics' => 'required|boolean',
            'categories.marketing' => 'required|boolean',
            'action' => 'required|in:accept,reject,custom,update,gpc_auto_reject',
            'policy_version' => 'nullable|string|max:20',
            'locale' => 'nullable|string|in:en,it,fr',
        ]);

        $ip = $request->ip();
        $truncatedIp = $this->truncateIp($ip);
        $ipHash = $truncatedIp ? hash('sha256', $truncatedIp . config('app.key')) : null;

        $dnt = $request->header('DNT') === '1' || $request->header('Dnt') === '1';
        $gpc = $request->header('Sec-GPC') === '1';

        $uuid = $validated['uuid'] ?? (string) Str::uuid();
        $policyVersion = $validated['policy_version'] ?? config('legal.policy_version', '2026-04');
        $locale = $validated['locale'] ?? app()->getLocale();

        $consent = CookieConsent::create([
            'uuid' => $uuid,
            'ip_hash' => $ipHash,
            'user_agent' => $request->userAgent(),
            'locale' => $locale,
            'categories' => $validated['categories'],
            'action' => $validated['action'],
            'policy_version' => substr($policyVersion, 0, 20),
            'dnt' => $dnt,
            'gpc' => $gpc,
        ]);

        return response()->json([
            'ok' => true,
            'uuid' => $consent->uuid,
        ]);
    }

    /**
     * Truncate IP for data minimization (GDPR):
     * - IPv4: /24 (remove last octet)  "1.2.3.4"  → "1.2.3.0"
     * - IPv6: /64 (first 4 hextets)    "2001:db8:85a3:8d3:1319:8a2e:370:7348" → "2001:db8:85a3:8d3::"
     */
    private function truncateIp(?string $ip): ?string
    {
        if (!$ip || !config('legal.truncate_ip', true)) {
            return $ip;
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $parts = explode('.', $ip);
            if (count($parts) === 4) {
                $parts[3] = '0';
                return implode('.', $parts);
            }
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            // Normalize to full form, take first 4 hextets
            $expanded = inet_ntop(inet_pton($ip));
            // Use inet_pton for /64 truncation
            $packed = inet_pton($ip);
            if ($packed && strlen($packed) === 16) {
                // Keep first 8 bytes (64 bits), zero the rest
                $truncated = substr($packed, 0, 8) . str_repeat("\0", 8);
                return inet_ntop($truncated);
            }
        }

        return $ip;
    }
}
