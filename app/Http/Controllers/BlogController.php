<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\BlogPost;
use App\Models\BlogPostTranslation;
use App\Support\MarkdownRenderer;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $locale = app()->getLocale();

        // Prefer BlogPost (multilingual) if any exist for current locale;
        // otherwise fall back to legacy Article table.
        $hasNewPosts = BlogPost::published()
            ->whereHas('translations', fn ($q) => $q->where('locale', $locale))
            ->exists();

        if ($hasNewPosts) {
            $posts = BlogPost::published()
                ->whereHas('translations', fn ($q) => $q->where('locale', $locale))
                ->with(['translations' => fn ($q) => $q->where('locale', $locale)])
                ->orderByDesc('published_at')
                ->paginate(12);

            SEOTools::setTitle(__('seo.blog_index.title'));
            SEOTools::setDescription(__('seo.blog_index.description'));

            return view('pages.blog.index', [
                'posts' => $posts,
                'articles' => null,
                'category' => $request->category,
                'type' => $request->type,
            ]);
        }

        // Legacy fallback
        $category = $request->category;
        $type = $request->type;
        $articles = Article::published()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($type, fn ($q) => $q->where('type', $type))
            ->orderByDesc('published_at')
            ->paginate(12);

        SEOTools::setTitle('Blog — Insights su AI, PMI e futuro del lavoro');
        SEOTools::setDescription('Articoli su AI per PMI, AI Act, supply chain e automazione aziendale.');

        return view('pages.blog.index', [
            'articles' => $articles,
            'posts' => null,
            'category' => $category,
            'type' => $type,
        ]);
    }

    public function show($slug)
    {
        $locale = app()->getLocale();

        // Try new BlogPost by slug in current locale first
        $translation = BlogPostTranslation::where('locale', $locale)
            ->where('slug', $slug)
            ->first();

        if ($translation) {
            $post = $translation->post;
            if (!$post || !$post->published || !$post->published_at || $post->published_at > now()) {
                abort(404);
            }

            SEOTools::setTitle($translation->meta_title ?: $translation->title);
            SEOTools::setDescription($translation->meta_description ?: $translation->excerpt);
            SEOTools::addImages($post->coverUrl());
            JsonLd::setType('Article');
            JsonLd::addValue('headline', $translation->title);
            JsonLd::addValue('datePublished', $post->published_at?->toAtomString());

            return view('pages.blog.show', [
                'translation' => $translation,
                'post' => $post,
                'article' => null,
                'related' => collect(),
            ]);
        }

        // Legacy Article fallback
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

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

        // Pre-render markdown body → HTML for safe output.
        $article->body_html = app(MarkdownRenderer::class)->render($article->body ?? '');

        return view('pages.blog.show', [
            'article' => $article,
            'translation' => null,
            'post' => null,
            'related' => $related,
        ]);
    }
}
