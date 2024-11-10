<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barber;;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    // Método para mostrar la lista de barberos
    public function index()
    {
        $barbers = Barber::all(); // Obtener todos los barberos
        return view('admin.barbers.index', compact('barbers'));
    }

    // Método para mostrar el formulario de creación de un barbero
    public function create()
    {
        return view('admin.barbers.create');
    }

    // Método para almacenar un nuevo barbero
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:barbers,email',
            'photo' => 'nullable|image|max:2048',
        ]);

        $barber = new Barber();
        $barber->name = $request->name;
        $barber->email = $request->email;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('barbers_photos', 'public');
            $barber->photo = $photoPath;
        }

        $barber->save();

        return redirect()->route('admin.barbers.index')->with('success', 'Barbero creado con éxito.');
    }

    // Método para mostrar el formulario de edición de un barbero
    public function edit(Barber $barber)
    {
        return view('admin.barbers.edit', compact('barber'));
    }

    // Método para actualizar un barbero
    public function update(Request $request, Barber $barber)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:barbers,email,' . $barber->id,
            'photo' => 'nullable|image|max:2048',
        ]);

        $barber->name = $request->name;
        $barber->email = $request->email;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('barbers_photos', 'public');
            $barber->photo = $photoPath;
        }

        $barber->save();

        return redirect()->route('admin.barbers.index')->with('success', 'Barbero actualizado con éxito.');
    }

    // Método para eliminar un barbero
    public function destroy(Barber $barber)
    {
        $barber->delete();

        return redirect()->route('admin.barbers.index')->with('success', 'Barbero eliminado con éxito.');
    }
}