<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category;
        $type = $request->type;
        $articles = Article::published()
            ->when($category, fn($q) => $q->where('category', $category))
            ->when($type, fn($q) => $q->where('type', $type))
            ->orderByDesc('published_at')
            ->paginate(12);

        SEOTools::setTitle('Blog — Insights su AI, PMI e futuro del lavoro');
        SEOTools::setDescription('Articoli su AI per PMI, AI Act, supply chain e automazione aziendale.');

        return view('pages.blog.index', compact('articles', 'category', 'type'));
    }

    public function show(Article $article)
    {
        abort_unless($article->is_published, 404);

        SEOTools::setTitle($article->title);
        SEOTools::setDescription($article->excerpt);
        if ($article->cover_image) {
            SEOTools::addImages(asset($article->cover_image));
        }
        JsonLd::setType('Article');
        JsonLd::addValue('headline', $article->title);
        JsonLd::addValue('datePublished', $article->published_at?->toAtomString());

        $related = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('article', 'related'));
    }
}
