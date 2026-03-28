<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'studio_name',
        'clients_count',
        'message',
        'status',
    ];
}
