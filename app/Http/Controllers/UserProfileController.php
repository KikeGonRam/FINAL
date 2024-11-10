<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    // Función para mostrar el perfil del usuario
    public function show()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        return view('user.profile', compact('user')); // Pasar los datos del usuario a la vista
    }

    // Función para actualizar la información del usuario
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Actualizar la información del usuario
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('profile_photos', 'public');
            $user->photo = $imagePath;
        }

        $user->save(); // Guardar los cambios

        return redirect()->route('user.profile')->with('success', 'Perfil actualizado correctamente');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            $user->photo = $request->file('photo')->store('photos', 'public');
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Perfil actualizado exitosamente.');
    }

    // Método para eliminar la foto de perfil
    public function deletePhoto()
    {
        $user = Auth::user();

        // Verificar si el usuario tiene una foto
        if ($user->photo) {
            // Eliminar la foto del almacenamiento
            Storage::delete('public/' . $user->photo);

            // Eliminar la ruta de la foto en la base de datos
            $user->photo = null;
            $user->save();
        }

        return redirect()->route('user.profile')->with('success', 'Foto eliminada con éxito.');
    }
}
