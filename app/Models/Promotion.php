<?php
// En el modelo de Promotion
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'discount',
        'start_date',
        'end_date',
        'type',
        'is_for_regular_customers',
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}