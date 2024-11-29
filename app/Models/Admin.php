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


    protected function getTableData($table)
    {
        $models = [
            'users' => User::class,
            'products' => Product::class,
            'appointments' => Cita::with('cliente', 'barber'),
            'barbers' => Barber::class,
            'contacts' => Contact::class,
            'categories' => Category::class,
            'services' => Service::class,
            'promotions' => Promotion::class,
        ];

        return isset($models[$table]) ? $models[$table]::all() : null;
    }
}
