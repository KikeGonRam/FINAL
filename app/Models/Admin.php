<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Cambia Model a Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable // Cambia Model a Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'nombre',
        'email',
        'password'
    ];
}