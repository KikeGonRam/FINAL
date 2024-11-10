<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Barber;
use Illuminate\Support\Facades\Storage;


class BarberController extends Controller
{
    // Mostrar el formulario de login para el barbero
    public function showLoginForm()
    {
        return view('barber.login');
    }

    // Procesar el login del barbero sin contraseña
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Verificar si el correo existe en la base de datos
        $barber = Barber::where('email', $request->email)->first();

        if ($barber) {
            // Iniciar sesión sin contraseña
            Auth::guard('barber')->login($barber);
            return redirect()->route('barber.dashboard');
        }

        // Si el correo no existe
        return back()->with('error', 'Correo electrónico no encontrado');
    }

    // Mostrar el panel de administración del barbero
    public function dashboard()
    {
        return view('barber.dashboard');
    }


    // Mostrar el formulario de perfil del barbero
    public function showProfile()
    {
        $barber = Auth::guard('barber')->user(); // Obtener el barbero autenticado
        return view('barber.profile', compact('barber'));
    }

    // Actualizar el perfil del barbero
    public function updateProfile(Request $request)
    {
        $barber = Auth::guard('barber')->user(); // Obtener el barbero autenticado

        // Validar la entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:barbers,email,' . $barber->id, // Validar que el correo sea único, excepto el actual
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);

        // Actualizar la información básica
        $barber->name = $request->name;
        $barber->email = $request->email;

        // Si se ha subido una nueva foto
        if ($request->hasFile('photo')) {
            // Eliminar la foto anterior si existe
            if ($barber->photo && Storage::exists('public/' . $barber->photo)) {
                Storage::delete('public/' . $barber->photo);
            }

            // Guardar la nueva foto
            $path = $request->file('photo')->store('barber_photos', 'public');
            $barber->photo = $path;
        }

        // Guardar los cambios
        $barber->save();

        return redirect()->route('barber.profile')->with('success', 'Perfil actualizado correctamente');
    }

    public function logout(Request $request)
    {
        Auth::guard('barber')->logout();  // Cerrar sesión del barbero
        $request->session()->invalidate();  // Invalidar la sesión
        $request->session()->regenerateToken();  // Regenerar el token CSRF

        return redirect('/');  // Redirigir a la página principal
    }
}