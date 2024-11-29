<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'special_dates',
        'specific_barbers',
        'special_packages',
    ];

    // Si `specific_barbers` es un array JSON, aseguramos que se maneje como array en Eloquent
    protected $casts = [
        'specific_barbers' => 'array',
    ];
}
