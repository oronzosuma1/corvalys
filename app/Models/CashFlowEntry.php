<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashFlowEntry extends Model
{
    protected $fillable = [
        'type', 'category', 'description', 'amount', 'date',
        'is_recurring', 'recurring_frequency', 'invoice_id', 'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
        'is_recurring' => 'boolean',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function scopeEntrate($q) { return $q->where('type', 'entrata'); }
    public function scopeUscite($q) { return $q->where('type', 'uscita'); }
}
