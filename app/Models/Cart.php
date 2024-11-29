<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'estado', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    // En el modelo Cart
    public function product()
    {
        return $this->belongsToMany(Product::class, 'cart_items')
            ->withPivot('quantity', 'price');
    }
}