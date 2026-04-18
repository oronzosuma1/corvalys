<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BlogPost;
use App\Support\LocalizedRoutes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $locale = app()->getLocale();
        $base = rtrim(config('app.url'), '/');

        $items = collect();

        $posts = BlogPost::published()
            ->whereHas('translations', fn ($q) => $q->where('locale', $locale))
            ->with(['translations' => fn ($q) => $q->where('locale', $locale)])
            ->orderByDesc('published_at')
            ->limit(20)
            ->get();

        if ($posts->isNotEmpty()) {
            foreach ($posts as $p) {
                $tr = $p->translations->first();
                if (!$tr) continue;
                $items->push([
                    'title' => $tr->title,
                    'link' => LocalizedRoutes::urlFor('blog.show', ['slug' => $tr->slug], $locale),
                    'guid' => LocalizedRoutes::urlFor('blog.show', ['slug' => $tr->slug], $locale),
                    'description' => $tr->excerpt,
                    'pubDate' => $p->published_at->toRfc2822String(),
                    'image' => $p->coverUrl(),
                ]);
            }
        } else {
            foreach (Article::where('is_published', true)->orderByDesc('published_at')->limit(20)->get() as $a) {
                $items->push([
                    'title' => $a->title,
                    'link' => LocalizedRoutes::urlFor('blog.show', ['slug' => $a->slug], $locale),
                    'guid' => LocalizedRoutes::urlFor('blog.show', ['slug' => $a->slug], $locale),
                    'description' => $a->excerpt ?? '',
                    'pubDate' => optional($a->published_at)->toRfc2822String() ?? now()->toRfc2822String(),
                    'image' => $a->cover_image ? asset($a->cover_image) : null,
                ]);
            }
        }

        return response()
            ->view('seo.feed', [
                'locale' => $locale,
                'base' => $base,
                'items' => $items,
                'selfUrl' => $request->fullUrl(),
            ], 200, [
                'Content-Type' => 'application/rss+xml; charset=UTF-8',
                'Cache-Control' => 'public, max-age=600',
            ]);
    }
}
