<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogPost extends Model
{
    protected $fillable = ['key', 'category', 'cover_path', 'published_at', 'published'];
    protected $casts = [
        'published_at' => 'datetime',
        'published' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(BlogPostTranslation::class);
    }

    public function tr(?string $locale = null): ?BlogPostTranslation
    {
        return $this->translations()
            ->where('locale', $locale ?? app()->getLocale())
            ->first();
    }

    public function availableLocales(): array
    {
        return $this->translations()->pluck('locale')->all();
    }

    public function slugFor(string $locale): ?string
    {
        return $this->translations()->where('locale', $locale)->value('slug');
    }

    public function coverUrl(): string
    {
        if ($this->cover_path) {
            return str_starts_with($this->cover_path, 'http') ? $this->cover_path : asset($this->cover_path);
        }
        return asset('images/og-default.png');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
