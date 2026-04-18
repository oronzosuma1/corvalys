<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PolicyVersion extends Model
{
    protected $fillable = [
        'document',
        'version',
        'locale',
        'content_hash',
        'effective_from',
        'is_current',
    ];

    protected $casts = [
        'effective_from' => 'datetime',
        'is_current' => 'boolean',
    ];

    /**
     * Scope a query to the current version for a given document+locale.
     */
    public function scopeCurrent(Builder $query, string $document, string $locale): Builder
    {
        return $query
            ->where('document', $document)
            ->where('locale', $locale)
            ->where('is_current', true);
    }
}
