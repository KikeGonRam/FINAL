<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;


class ServicioController extends Controller
{
    public function __construct()
    {
        // Asegurar que solo usuarios autenticados puedan acceder a estos métodos
        $this->middleware('auth');
    }

    public function index()
    {
        // Obtener solo los servicios disponibles con paginación
        $services = Service::where('is_available', true)->paginate(10);

        // Devolver la vista con los servicios
        return view('user.services.index', compact('services'));
    }

    public function show(Service $service)
    {
        // Devolver la vista con los detalles del servicio
        return view('user.services.show', compact('service'));
    }

    public function downloadPDF(Service $service)
    {
        // Generar el PDF utilizando la vista
        $pdf = PDF::loadView('user.services.pdf', compact('service'));

        // Descargar el archivo PDF
        return $pdf->download('servicio_' . $service->id . '.pdf');
    }
}
