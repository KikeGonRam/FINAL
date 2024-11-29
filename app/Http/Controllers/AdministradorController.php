<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Cita;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Barber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    // Mostrar el formulario de login
    public function mostrarFormularioLogin()
    {
        return view('admin.login');
    }

    // Manejar el login del administrador
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verificar las credenciales usando el guard 'admin'
        if (Auth::guard('admin')->attempt($credenciales)) {
            $request->session()->regenerate();

            // Redirigir al panel de administrador
            return redirect()->route('admin.panel');
        }

        // Si las credenciales no son correctas, mostrar error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }


    // Mostrar el panel de administración
    public function mostrarPanel()
    {
        $appointments = Cita::all(); // O puedes usar un filtro específico
        $totalUsuarios = User::count();
        $appointmentsToday = Cita::whereDate('fecha', Carbon::today())->get(); // Filtra las citas por la fecha actual
        $activeBarbers = Barber::all()->count();

        return view('admin.panel', compact('appointments', 'totalUsuarios', 'appointmentsToday', 'activeBarbers'));
    }

    // Cerrar sesión
    public function cerrarSesion(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}