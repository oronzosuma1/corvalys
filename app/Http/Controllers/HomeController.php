<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\NewsletterSubscriber;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'sme' => '26.1M',
            'ore' => '9.85',
            'pct' => '52%',
            'miliardi' => '100B',
            'giorni' => max(0, (int) now()->diffInDays(\Carbon\Carbon::parse('2026-08-02'), false)),
        ];

        $products = Service::prodotti()->active()->orderBy('sort_order')->take(3)->get();

        return view('pages.home', compact('stats', 'products'));
    }

    public function newsletter(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);
        NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email],
            ['source' => 'website']
        );
        return back()->with('newsletter_success', true);
    }

    public function sitemap()
    {
        $articles = Article::published()->orderByDesc('published_at')->get();
        $base = rtrim(config('app.url'), '/');
        $locales = config('localized_routes.locales', ['en', 'it', 'fr']);

        // Static routes to include, in priority order
        $staticRoutes = [
            ['name' => 'home',        'priority' => '1.0', 'changefreq' => 'weekly'],
            ['name' => 'prodotti',    'priority' => '0.9', 'changefreq' => 'monthly'],
            ['name' => 'prezzi',      'priority' => '0.9', 'changefreq' => 'monthly'],
            ['name' => 'consulenza',  'priority' => '0.9', 'changefreq' => 'monthly'],
            ['name' => 'chi-siamo',   'priority' => '0.7', 'changefreq' => 'monthly'],
            ['name' => 'contatto',    'priority' => '0.8', 'changefreq' => 'monthly'],
            ['name' => 'blog.index',  'priority' => '0.8', 'changefreq' => 'weekly'],
            ['name' => 'partner',     'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'risorse',     'priority' => '0.6', 'changefreq' => 'monthly'],
            ['name' => 'privacy',     'priority' => '0.3', 'changefreq' => 'yearly'],
            ['name' => 'cookie',      'priority' => '0.3', 'changefreq' => 'yearly'],
            ['name' => 'termini',     'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        $normalize = fn ($url) => str_replace(url('/'), $base, $url);

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" '
              . 'xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

        // Emit one <url> per (route × locale), each listing all siblings as xhtml:link alternates.
        foreach ($staticRoutes as $route) {
            $alts = collect($locales)->mapWithKeys(function ($locale) use ($route, $normalize) {
                return [$locale => $normalize(\App\Support\LocalizedRoutes::urlFor($route['name'], [], $locale))];
            })->all();

            foreach ($locales as $locale) {
                $xml .= "  <url>\n";
                $xml .= "    <loc>" . htmlspecialchars($alts[$locale]) . "</loc>\n";
                foreach ($alts as $altLocale => $altUrl) {
                    $xml .= "    <xhtml:link rel=\"alternate\" hreflang=\"{$altLocale}\" href=\"" . htmlspecialchars($altUrl) . "\"/>\n";
                }
                $xml .= "    <xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . htmlspecialchars($alts['en']) . "\"/>\n";
                $xml .= "    <changefreq>{$route['changefreq']}</changefreq>\n";
                $xml .= "    <priority>{$route['priority']}</priority>\n";
                $xml .= "  </url>\n";
            }
        }

        // Blog articles (one entry per locale — content is currently single-language
        // but URL still needs localized prefix per hreflang best practice).
        foreach ($articles as $article) {
            $alts = collect($locales)->mapWithKeys(function ($locale) use ($article, $normalize) {
                return [$locale => $normalize(\App\Support\LocalizedRoutes::urlFor('blog.show', ['article' => $article->slug], $locale))];
            })->all();

            foreach ($locales as $locale) {
                $xml .= "  <url>\n";
                $xml .= "    <loc>" . htmlspecialchars($alts[$locale]) . "</loc>\n";
                $xml .= "    <lastmod>" . $article->updated_at->toAtomString() . "</lastmod>\n";
                foreach ($alts as $altLocale => $altUrl) {
                    $xml .= "    <xhtml:link rel=\"alternate\" hreflang=\"{$altLocale}\" href=\"" . htmlspecialchars($altUrl) . "\"/>\n";
                }
                $xml .= "    <xhtml:link rel=\"alternate\" hreflang=\"x-default\" href=\"" . htmlspecialchars($alts['en']) . "\"/>\n";
                $xml .= "    <changefreq>monthly</changefreq>\n";
                $xml .= "    <priority>0.7</priority>\n";
                $xml .= "  </url>\n";
            }
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
