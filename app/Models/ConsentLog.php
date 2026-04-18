<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsentLog extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'session_id',
        'ip_hash',
        'user_agent',
        'categories_accepted',
        'policy_version',
        'locale',
        'action',
        'dnt',
        'gpc',
    ];

    protected $casts = [
        'categories_accepted' => 'array',
        'dnt' => 'boolean',
        'gpc' => 'boolean',
    ];
}
