<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'details' => 'required|string',
        ]);

        // Lógica para almacenar los datos, por ejemplo, enviar un correo, guardar en la base de datos, etc.
        // En este ejemplo, solo retornamos una respuesta de éxito.
        return response()->json(['message' => 'Mensaje enviado exitosamente!']);
    }
}