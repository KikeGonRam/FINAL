<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact; // Asegúrate de tener el modelo adecuado
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AContactController extends Controller
{
    // Muestra la lista de contactos
    public function index(Request $request)
    {
        $query = Contact::query();

        // Filtrado por nombre o correo
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Paginación de los resultados
        $contacts = $query->paginate(10); // Puedes cambiar 10 por el número de elementos que deseas mostrar por página

        return view('admin.contact.index', compact('contacts'));
    }

    // Muestra los detalles de un contacto específico
    public function show($id)
    {
        $contact = Contact::findOrFail($id); // Encuentra el contacto por ID
        return view('admin.contact.show', compact('contact')); // Pasa el contacto a la vista
    }

    // Elimina un contacto
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id); // Encuentra el contacto por ID

        // Elimina el contacto
        $contact->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('admin.contact.index')->with('success', 'Contacto eliminado correctamente.');
    }
}
