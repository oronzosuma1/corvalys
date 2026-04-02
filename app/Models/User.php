<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'two_factor_secret',
        'two_factor_confirmed_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'password' => 'hashed',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin === true;
    }
}
