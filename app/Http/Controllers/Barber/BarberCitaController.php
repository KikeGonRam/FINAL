<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF; // Importar la clase PDF

class BarberCitaController extends Controller
{
    // Mostrar todas las citas del barbero
    public function index(Request $request)
    {
        $query = Cita::with('cliente');

        // Filtro por búsqueda de cliente o ID
        if ($request->has('search') && !empty($request->search)) {
            $query->where('cliente_id', 'like', '%' . $request->search . '%')
                ->orWhereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
        }

        // Filtro por estado
        if ($request->has('estado') && !empty($request->estado)) {
            $query->where('estado', $request->estado);
        }

        // Paginación
        $citas = $query->paginate(5);

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

    // Descargar citas filtradas como PDF
    // Función para descargar el PDF
    public function downloadPDF(Request $request)
    {
        $query = Cita::with('cliente');

        // Filtro por búsqueda de cliente o ID
        if ($request->has('search') && !empty($request->search)) {
            $query->where('cliente_id', 'like', '%' . $request->search . '%')
                ->orWhereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
        }

        // Filtro por estado
        if ($request->has('estado') && !empty($request->estado)) {
            $query->where('estado', $request->estado);
        }

        // Obtener las citas filtradas
        $citas = $query->get();

        // Generar el PDF
        $pdf = PDF::loadView('barber.citas.pdf', compact('citas'));

        // Descargar el PDF
        return $pdf->download('citas.pdf');
    }
}
