<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barber;
use App\Models\User;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'barber_id',
        'fecha',
        'hora',
        'estado',
    ];

    // Relación con el modelo User (cliente)
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id', 'id'); // Definir explícitamente las columnas
    }

    // Relación con el modelo Barber
    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id', 'id'); // Definir explícitamente las columnas
    }


}