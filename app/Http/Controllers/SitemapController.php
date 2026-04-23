<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Support\LocalizedRoutes;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $base = rtrim(config('app.url'), '/');
        $locales = config('localized_routes.locales', ['en', 'it', 'fr']);

        $staticRoutes = [
            ['name' => 'home',                         'priority' => '1.0', 'changefreq' => 'weekly'],
            ['name' => 'consulenza',                   'priority' => '0.9', 'changefreq' => 'monthly'],
            ['name' => 'prodotti',                     'priority' => '0.9', 'changefreq' => 'monthly'],
            ['name' => 'prezzi',                       'priority' => '0.9', 'changefreq' => 'monthly'],
            ['name' => 'chi-siamo',                    'priority' => '0.8', 'changefreq' => 'monthly'],
            ['name' => 'chi-siamo.missione',           'priority' => '0.7', 'changefreq' => 'monthly'],
            ['name' => 'chi-siamo.cosa-facciamo',      'priority' => '0.7', 'changefreq' => 'monthly'],
            ['name' => 'chi-siamo.valori',             'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'chi-siamo.team',               'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'chi-siamo.partners',           'priority' => '0.5', 'changefreq' => 'monthly'],
            ['name' => 'contatto',                     'priority' => '0.8', 'changefreq' => 'monthly'],
            ['name' => 'blog.index',                   'priority' => '0.8', 'changefreq' => 'weekly'],
            ['name' => 'partner',                      'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'risorse',                      'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'survey',                       'priority' => '0.5', 'changefreq' => 'monthly'],
            ['name' => 'business-survey',              'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'privacy',                      'priority' => '0.3', 'changefreq' => 'yearly'],
            ['name' => 'cookie',                       'priority' => '0.3', 'changefreq' => 'yearly'],
            ['name' => 'termini',                      'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        $entries = [];

        // Static routes × locales
        foreach ($staticRoutes as $route) {
            $alternates = $this->alternatesFor($route['name']);
            foreach ($locales as $locale) {
                $entries[] = [
                    'loc' => $this->toAbsolute(LocalizedRoutes::urlFor($route['name'], [], $locale), $base),
                    'lastmod' => null,
                    'changefreq' => $route['changefreq'],
                    'priority' => $route['priority'],
                    'alternates' => $alternates + ['x-default' => $alternates['en'] ?? null],
                ];
            }
        }

        // Dynamic product detail pages (one <url> per product per locale)
        $products = class_exists(Service::class)
            ? Service::prodotti()->active()->orderBy('sort_order')->get()
            : collect();
        foreach ($products as $product) {
            $alternates = $this->alternatesFor('prodotti.show', ['service' => $product->slug]);
            foreach ($locales as $locale) {
                $entries[] = [
                    'loc' => $this->toAbsolute(
                        LocalizedRoutes::urlFor('prodotti.show', ['service' => $product->slug], $locale),
                        $base
                    ),
                    'lastmod' => optional($product->updated_at)->toIso8601String(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                    'alternates' => $alternates + ['x-default' => $alternates['en'] ?? null],
                ];
            }
        }

        // Blog articles
        $articles = class_exists(Article::class)
            ? Article::published()->orderByDesc('published_at')->get()
            : collect();
        foreach ($articles as $article) {
            $alternates = $this->alternatesFor('blog.show', ['slug' => $article->slug]);
            foreach ($locales as $locale) {
                $entries[] = [
                    'loc' => $this->toAbsolute(
                        LocalizedRoutes::urlFor('blog.show', ['slug' => $article->slug], $locale),
                        $base
                    ),
                    'lastmod' => optional($article->updated_at)->toIso8601String(),
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                    'alternates' => $alternates + ['x-default' => $alternates['en'] ?? null],
                ];
            }
        }

        return response()
            ->view('seo.sitemap', compact('entries'), 200, [
                'Content-Type' => 'application/xml; charset=UTF-8',
                'Cache-Control' => 'public, max-age=3600',
            ]);
    }

    /** @return array<string,string> locale → absolute URL */
    protected function alternatesFor(string $name, array $params = []): array
    {
        $base = rtrim(config('app.url'), '/');
        $out = [];
        foreach (config('localized_routes.locales', ['en', 'it', 'fr']) as $locale) {
            try {
                $url = LocalizedRoutes::urlFor($name, $params, $locale);
                $out[$locale] = $this->toAbsolute($url, $base);
            } catch (\Throwable $e) {
                // route doesn't exist for this locale — skip
            }
        }
        return $out;
    }

    protected function toAbsolute(string $url, string $base): string
    {
        // Replace local request host with production app.url
        $localHost = rtrim(url('/'), '/');
        if ($localHost && $localHost !== $base) {
            return str_replace($localHost, $base, $url);
        }
        return $url;
    }
}
