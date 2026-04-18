<?php

namespace App\Models;

use App\Support\MarkdownRenderer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPostTranslation extends Model
{
    protected $fillable = [
        'blog_post_id', 'locale', 'slug', 'title', 'excerpt',
        'body_md', 'body_html', 'meta_title', 'meta_description',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id');
    }

    /**
     * Lazily render (and cache) body_md into body_html on first access.
     */
    public function renderedHtml(): string
    {
        if (!empty($this->body_html)) {
            return $this->body_html;
        }
        $html = app(MarkdownRenderer::class)->render($this->body_md);
        $this->forceFill(['body_html' => $html])->saveQuietly();
        return $html;
    }
}
