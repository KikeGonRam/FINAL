<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];

    // Relación con Barbero
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
