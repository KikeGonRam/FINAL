<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Barber;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class CitaController extends Controller
{
    // Método para mostrar la lista de citas
    public function index(Request $request)
    {
        // Obtener el término de búsqueda
        $search = $request->get('search');

        // Obtener las citas con paginación y filtrado si se proporcionó un término de búsqueda
        $citas = Cita::with(['cliente', 'barber'])
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('cliente', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('barber', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(5); // Paginación de 10 elementos por página

        return view('admin.citas.index', compact('citas', 'search'));
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
