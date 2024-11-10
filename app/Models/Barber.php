<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Barber extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'photo'];

    protected $hidden = [
        'password', // No usaremos contraseñas, así que podemos omitir este campo
    ];

    public $timestamps = true;

    protected $table = 'barbers'; // Cambia 'barbers' al nombre correcto de la tabla si es necesario

    public function appointments()
    {
        return $this->hasMany(Cita::class);
    }
}