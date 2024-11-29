<?php

// app/Http/Controllers/UserDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Obtener el usuario logueado
        $citas = $user->appointments()->where('estado', 'pendiente')->get(); // Obtener citas pendientes del usuario

        return view('user.dashboard',  compact('citas')); // Esta vista debe existir en resources/views/user/dashboard.blade.php
    }
}