<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Barber;
use App\Models\User;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Método para mostrar la lista de citas
    public function index()
    {
        // Obtener todas las citas junto con los detalles de cliente y barbero
        $citas = Cita::with(['cliente', 'barber'])->get();
        return view('admin.citas.index', compact('citas'));
    }

    // Método para mostrar el formulario de creación de una cita
    public function create()
    {
        // Obtener todos los clientes y barberos para mostrarlos en los select
        $clientes = User::all();
        $barberos = Barber::all();
        return view('admin.citas.create', compact('clientes', 'barberos'));
    }

    // Método para almacenar una nueva cita
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:users,id', // Cambiado a 'users'
            'barber_id' => 'required|exists:barbers,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'estado' => 'required|in:pendiente,aceptada,cancelada',
        ]);

        // Crear la cita con los datos validados
        Cita::create($request->all());

        return redirect()->route('admin.citas.index')->with('success', 'Cita creada correctamente');
    }

    // Método para mostrar el formulario de edición de una cita
    public function edit(Cita $cita)
    {
        // Obtener todos los clientes y barberos para los select
        $clientes = User::all();
        $barberos = Barber::all();
        return view('admin.citas.edit', compact('cita', 'clientes', 'barberos'));
    }

    // Método para actualizar una cita
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'cliente_id' => 'required|exists:users,id', // Cambiado a 'users'
            'barber_id' => 'required|exists:barbers,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'estado' => 'required|in:pendiente,aceptada,cancelada',
        ]);

        // Actualizar la cita con los nuevos datos
        $cita->update($request->all());

        return redirect()->route('admin.citas.index')->with('success', 'Cita actualizada correctamente');
    }

    // Método para eliminar una cita
    public function destroy(Cita $cita)
    {
        // Eliminar la cita
        $cita->delete();

        return redirect()->route('admin.citas.index')->with('success', 'Cita eliminada correctamente');
    }
}
