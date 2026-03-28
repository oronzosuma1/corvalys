<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number', 'type', 'client_name', 'client_email', 'client_vat',
        'amount', 'vat_amount', 'total', 'currency', 'status',
        'issue_date', 'due_date', 'paid_date', 'description', 'notes', 'lead_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'issue_date' => 'date',
        'due_date' => 'date',
        'paid_date' => 'date',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function cashFlowEntry()
    {
        return $this->hasOne(CashFlowEntry::class);
    }

    public function scopeEmesse($q) { return $q->where('type', 'emessa'); }
    public function scopeRicevute($q) { return $q->where('type', 'ricevuta'); }
    public function scopePagate($q) { return $q->where('status', 'pagata'); }
    public function scopeScadute($q) { return $q->where('status', '!=', 'pagata')->where('due_date', '<', now()); }
    public function scopeInScadenza($q) { return $q->where('status', '!=', 'pagata')->whereBetween('due_date', [now(), now()->addDays(30)]); }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'bozza' => 'Bozza',
            'inviata' => 'Inviata',
            'pagata' => 'Pagata',
            'scaduta' => 'Scaduta',
            'annullata' => 'Annullata',
            default => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'bozza' => 'bg-gray-100 text-gray-600',
            'inviata' => 'bg-blue-100 text-blue-700',
            'pagata' => 'bg-green-100 text-green-700',
            'scaduta' => 'bg-red-100 text-red-700',
            'annullata' => 'bg-gray-100 text-gray-400',
            default => 'bg-gray-100 text-gray-600',
        };
    }
}
