<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'type', 'name', 'slug', 'short_description', 'description',
        'price_from', 'price_to', 'price_unit', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'price_from' => 'decimal:2',
        'price_to' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function scopeProdotti($q) { return $q->where('type', 'prodotto'); }
    public function scopeConsulenze($q) { return $q->where('type', 'consulenza'); }
    public function scopeActive($q) { return $q->where('is_active', true); }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }
}
