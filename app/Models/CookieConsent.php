<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CookieConsent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'uuid',
        'ip_hash',
        'user_agent',
        'locale',
        'categories',
        'action',
        'policy_version',
        'dnt',
        'gpc',
        'created_at',
    ];

    protected $casts = [
        'categories' => 'array',
        'dnt' => 'boolean',
        'gpc' => 'boolean',
        'created_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (CookieConsent $model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->created_at)) {
                $model->created_at = now();
            }
        });
    }
}
