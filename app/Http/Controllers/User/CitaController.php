<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    // Mostrar todas las citas del usuario
    public function index()
    {
        // Obtener las citas del usuario autenticado
        $citas = Cita::where('cliente_id', Auth::user()->id)->get();

        return view('user.citas.index', compact('citas'));
    }

    // Mostrar el formulario para crear una nueva cita
    public function create()
    {
        // Obtener solo los barberos
        $barbers = Barber::all();

        return view('user.citas.create', compact('barbers'));
    }

    // Guardar la nueva cita
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
        ]);

        // Crear la cita
        Cita::create([
            'cliente_id' => $request->cliente_id,
            'barber_id' => $request->barber_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente', // Estado por defecto
        ]);

        return redirect()->route('user.citas.index')->with('success', 'Cita creada con éxito.');
    }

    // Mostrar el formulario para editar una cita
    public function edit($id)
    {
        // Obtener la cita
        $cita = Cita::where('id', $id)->where('cliente_id', Auth::user()->id)->first();

        // Si no existe la cita o no pertenece al usuario autenticado, redirigir
        if (!$cita) {
            return redirect()->route('user.citas.index')->with('error', 'Cita no encontrada o no pertenece a este usuario.');
        }

        // Obtener los barberos
        $barbers = Barber::all();

        return view('user.citas.edit', compact('cita', 'barbers'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
        ]);

        // Obtener la cita
        $cita = Cita::where('id', $id)->where('cliente_id', Auth::user()->id)->first();

        // Si no existe la cita o no pertenece al usuario autenticado, redirigir
        if (!$cita) {
            return redirect()->route('user.citas.index')->with('error', 'Cita no encontrada o no pertenece a este usuario.');
        }

        // Actualizar la cita
        $cita->update([
            'barber_id' => $request->barber_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);

        return redirect()->route('user.citas.index')->with('success', 'Cita actualizada con éxito.');
    }

    // Eliminar una cita
    public function destroy($id)
    {
        // Obtener la cita
        $cita = Cita::where('id', $id)->where('cliente_id', Auth::user()->id)->first();

        // Si no existe la cita o no pertenece al usuario autenticado, redirigir
        if (!$cita) {
            return redirect()->route('user.citas.index')->with('error', 'Cita no encontrada o no pertenece a este usuario.');
        }

        // Eliminar la cita
        $cita->delete();

        return redirect()->route('user.citas.index')->with('success', 'Cita eliminada con éxito.');
    }

    public function show($id)
    {
        // Obtener la cita por su ID
        $cita = Cita::with('barber')->findOrFail($id);

        // Pasar los datos a la vista
        return view('user.citas.show', compact('cita'));
    }
}
