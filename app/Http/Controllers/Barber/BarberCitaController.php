<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarberCitaController extends Controller
{
    // Mostrar todas las citas del barbero
    public function index()
    {
        // Obtener las citas del barbero autenticado
        $citas = Cita::where('barber_id', Auth::user()->id)->get();
        
        return view('barber.citas.index', compact('citas'));
    }

    // Cambiar el estado de la cita
    public function updateStatus(Request $request, Cita $cita)
    {
        // Validar que el barbero está intentando cambiar el estado de su propia cita
        if ($cita->barber_id !== Auth::user()->id) {
            return redirect()->route('barber.citas.index')->with('error', 'No tienes permisos para modificar esta cita.');
        }

        // Validar el nuevo estado
        $request->validate([
            'estado' => 'required|in:pendiente,aceptada,cancelada',
        ]);

        // Actualizar el estado de la cita
        $cita->estado = $request->estado;
        $cita->save();

        return redirect()->route('barber.citas.index')->with('success', 'Estado de la cita actualizado correctamente.');
    }
}