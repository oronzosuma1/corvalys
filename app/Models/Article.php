<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'type',
        'excerpt',
        'body',
        'category',
        'tags',
        'cover_image',
        'reading_time_min',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Article $article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }

            if (! empty($article->body)) {
                $article->reading_time_min = max(1, (int) ceil(str_word_count(strip_tags($article->body)) / 200));
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
    }

    public function scopeArticles($query)
    {
        return $query->where('type', 'article');
    }

    public function scopeCaseStudies($query)
    {
        return $query->where('type', 'case_study');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getRenderedBodyAttribute(): string
    {
        $converter = new CommonMarkConverter();

        return $converter->convert($this->body ?? '')->getContent();
    }
}
