<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()
            ->when($request->type, fn($q, $t) => $q->where('type', $t))
            ->latest()
            ->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:article,case_study',
            'excerpt' => 'required|string|max:500',
            'body' => 'required|string',
            'category' => 'required|in:ai-pmi,ai-act,supply-chain,prodotto,case-study',
            'tags' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        if ($request->boolean('is_published')) {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Articolo creato.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:article,case_study',
            'excerpt' => 'required|string|max:500',
            'body' => 'required|string',
            'category' => 'required|in:ai-pmi,ai-act,supply-chain,prodotto,case-study',
            'tags' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $wasPublished = $article->is_published;
        if ($request->boolean('is_published') && !$wasPublished) {
            $validated['published_at'] = now();
        } elseif (!$request->boolean('is_published')) {
            $validated['published_at'] = null;
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Articolo aggiornato.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Articolo eliminato.');
    }

    public function toggle(Article $article)
    {
        $article->update([
            'is_published' => !$article->is_published,
            'published_at' => !$article->is_published ? now() : null,
        ]);

        $status = $article->is_published ? 'pubblicato' : 'in bozza';
        return redirect()->route('admin.articles.index')->with('success', "Articolo {$status}.");
    }
}
