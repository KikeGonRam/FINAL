<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'nombre' => 'Administrador',
            'email' => 'admin@darketo.com',
            'password' => Hash::make('admin123'), // Usamos Hash::make para la contraseña
        ]);
    }
}