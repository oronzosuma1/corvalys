<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationAssessment extends Model
{
    protected $fillable = [
        'lead_id',
        'user_id',
        'answers',
        'result',
        'notes',
    ];

    protected $casts = [
        'answers' => 'array',
        'result' => 'array',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
