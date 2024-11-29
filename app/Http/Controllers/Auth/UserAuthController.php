<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Manejar el login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Redirigir a la página de dashboard del usuario después del login
            return redirect()->intended(route('user.dashboard'));
        }

        // Si no se autentica, retornar con error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Manejar el registro de usuario
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Asegúrate de tener un campo password_confirmation en tu formulario
        ]);

        // Encriptar la contraseña
        $data['password'] = Hash::make($data['password']);

        // Crear el usuario
        $user = User::create($data);

        // Iniciar sesión al nuevo usuario
        Auth::login($user);

        // Redirigir al dashboard del usuario
        return redirect()->route('user.dashboard');
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');  // Redirigir a la página de login
    }
}
