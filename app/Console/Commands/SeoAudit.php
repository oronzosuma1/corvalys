<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SeoAudit extends Command
{
    protected $signature = 'seo:audit
        {--base= : Base URL to audit (defaults to APP_URL). Example: https://www.corvalys.eu}
        {--timeout=20 : HTTP timeout in seconds}';

    protected $description = 'Crawl /sitemap.xml, record status + canonical + robots for each URL, flag anomalies.';

    public function handle(): int
    {
        $base = rtrim($this->option('base') ?: config('app.url'), '/');
        $timeout = (int) $this->option('timeout');

        $this->info("Auditing sitemap at {$base}/sitemap.xml");

        $sitemapResponse = Http::timeout($timeout)->get("{$base}/sitemap.xml");
        if (! $sitemapResponse->successful()) {
            $this->error("Sitemap fetch failed: HTTP {$sitemapResponse->status()}");
            return self::FAILURE;
        }

        preg_match_all('#<loc>([^<]+)</loc>#', $sitemapResponse->body(), $matches);
        $urls = $matches[1] ?? [];
        $this->info('Found ' . count($urls) . ' URLs.');

        $results = [];
        $anomalies = [];

        foreach ($urls as $url) {
            $row = $this->audit($url, $timeout);
            $row['note'] = $this->describeAnomaly($row);
            $results[] = $row;

            if ($row['note'] !== '') {
                $anomalies[] = $row;
            }

            $this->line(sprintf(
                '  [%s] %s%s',
                $row['status'] ?? '???',
                $url,
                $row['note'] ? '  — ' . $row['note'] : ''
            ));
        }

        Storage::put('seo-audit.json', json_encode([
            'base' => $base,
            'generated_at' => now()->toIso8601String(),
            'total' => count($results),
            'anomalies' => count($anomalies),
            'results' => $results,
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $this->newLine();
        $this->info("Wrote full results to storage/app/seo-audit.json");
        $this->info("Anomalies: " . count($anomalies) . " / " . count($results));

        if ($anomalies) {
            $this->newLine();
            $this->warn('=== Anomalies (human review) ===');
            foreach ($anomalies as $a) {
                $this->line(sprintf(
                    '  [%s] %s  — %s',
                    $a['status'] ?? '???',
                    $a['url'],
                    $a['note']
                ));
            }
        }

        return self::SUCCESS;
    }

    /**
     * @return array{url:string, status:?int, final_url:?string, content_type:?string, canonical:?string, robots:?string, html_lang:?string, note:string}
     */
    protected function audit(string $url, int $timeout): array
    {
        $row = [
            'url' => $url,
            'status' => null,
            'final_url' => null,
            'content_type' => null,
            'canonical' => null,
            'robots' => null,
            'html_lang' => null,
            'note' => '',
        ];

        try {
            // Do NOT follow redirects — the raw status is what GSC sees for this URL.
            $response = Http::timeout($timeout)
                ->withoutRedirecting()
                ->get($url);
        } catch (\Throwable $e) {
            $row['note'] = 'request failed: ' . $e->getMessage();
            return $row;
        }

        $row['status'] = $response->status();
        $row['content_type'] = $response->header('Content-Type');

        // For 3xx, record the redirect target so the report shows "301 → /new/url".
        if ($response->status() >= 300 && $response->status() < 400) {
            $row['final_url'] = $response->header('Location');
            return $row;
        }

        $row['final_url'] = $url;

        if ($response->status() !== 200 || ! str_contains((string) $row['content_type'], 'text/html')) {
            return $row;
        }

        $body = $response->body();

        if (preg_match('#<link[^>]+rel=["\']canonical["\'][^>]+href=["\']([^"\']+)["\']#i', $body, $m)) {
            $row['canonical'] = $m[1];
        }
        if (preg_match('#<meta[^>]+name=["\']robots["\'][^>]+content=["\']([^"\']+)["\']#i', $body, $m)) {
            $row['robots'] = $m[1];
        }
        if (preg_match('#<html[^>]+lang=["\']([^"\']+)["\']#i', $body, $m)) {
            $row['html_lang'] = $m[1];
        }

        return $row;
    }

    protected function describeAnomaly(array $row): string
    {
        // Keep an existing non-empty note (e.g. request failure) intact.
        if ($row['note'] !== '') {
            return $row['note'];
        }
        if ($row['status'] !== 200) {
            $status = $row['status'] ?? '???';
            if ($row['final_url'] && $row['final_url'] !== $row['url']) {
                return "HTTP {$status} → {$row['final_url']}";
            }
            return 'HTTP ' . $status;
        }
        if ($row['robots'] && stripos($row['robots'], 'noindex') !== false) {
            return 'robots contains noindex';
        }
        if ($row['canonical']) {
            $reqUrl = rtrim($row['url'], '/');
            $canonical = rtrim($row['canonical'], '/');
            if ($reqUrl !== $canonical) {
                return 'canonical mismatch: ' . $row['canonical'];
            }
        }
        return '';
    }
}
