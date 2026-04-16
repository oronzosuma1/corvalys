<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\NewsletterSubscriber;
use App\Models\Service;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Corvalys — AI Consulting & Operational Improvement for European SMEs');
        SEOTools::setDescription('Practical AI consulting for European SMEs. Assessment, implementation, and managed support. GDPR compliant, EU AI Act ready.');
        JsonLd::setType('Organization');
        JsonLd::addValue('name', 'Corvalys');
        JsonLd::addValue('url', config('app.url'));

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

        $urls = collect([
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => url('/prodotti'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => url('/prezzi'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => url('/consulenza'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/chi-siamo'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => url('/contatto'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/blog'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => url('/partner'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => url('/risorse'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ]);

        foreach ($articles as $article) {
            $urls->push([
                'loc' => route('blog.show', $article),
                'priority' => '0.7',
                'changefreq' => 'monthly',
                'lastmod' => $article->updated_at->toAtomString(),
            ]);
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>{$url['loc']}</loc>\n";
            if (isset($url['lastmod'])) $xml .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
            $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
