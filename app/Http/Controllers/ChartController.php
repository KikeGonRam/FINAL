<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Carbon\Carbon;
use App\Models\Barber;
use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\Promotion;


class ChartController extends Controller
{
    public function cita()
    {
        // Consultar la cantidad de citas agrupadas por estado
        $estadisticas = Cita::select('estado', \DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->pluck('total', 'estado');

        // Estructurar los datos para Chart.js
        $data = [
            'labels' => $estadisticas->keys(),  // Etiquetas de los estados
            'datasets' => [
                [
                    'label' => 'Citas por Estado',
                    'data' => $estadisticas->values(),  // Datos de las citas por estado
                    'backgroundColor' => $this->generateColors(count($estadisticas)) // Aplicar colores
                ],
            ],
        ];

        return view('admin.charts.cita', compact('data'));
    }

    // Método para generar colores dinámicamente
    private function generateColors($count)
    {
        // Colores más neutros y suaves
        $colors = [
            '#A9A9A9', // Gris oscuro
            '#D3D3D3', // Gris claro
            '#B0C4DE', // Azul claro
            '#F0E68C', // Amarillo pálido
            '#98FB98', // Verde claro
            '#AFEEEE', // Azul verdoso claro
            '#F08080', // Rojo claro
            '#FFD700', // Dorado
            '#C0C0C0'  // Gris plateado
        ];

        return array_slice($colors, 0, $count); // Limita la cantidad de colores según el número de estados
    }


    public function index()
    {
        return view('admin.charts.index');
    }

    public function getAppointmentsByBarber()
    {
        $appointments = Cita::selectRaw('barber_id, count(*) as total_citas')
            ->groupBy('barber_id')
            ->get();

        // Obtener los nombres de los barberos
        $barbers = Barber::pluck('name', 'id');

        // Asignar nombres a los barberos en la consulta
        $appointments = $appointments->map(function ($appointment) use ($barbers) {
            $appointment->barber_name = $barbers[$appointment->barber_id];
            return $appointment;
        });

        return view('admin.charts.barber', compact('appointments'));
    }


    public function showPricesChart()
    {
        $products = Product::all();

        // Extraer nombres y precios
        $productNames = $products->pluck('name');
        $productPrices = $products->pluck('price');

        return view('admin.charts.prices', compact('productNames', 'productPrices'));
    }


    public function galeria()
    {
        $barbers = Barber::all(); // Obtener todos los barberos
        return view('admin.charts.galeria', compact('barbers'));
    }

    public function showPriceDistribution()
    {
        // Obtener los servicios con precio y duración
        $services = Service::select('price', 'name', 'duration')->get();

        // Pasar tanto los precios como las duraciones a la vista
        return view('admin.charts.price', compact('services'));
    }


    public function showPromotionsCharts()
    {
        // Obtener las promociones
        $promotions = Promotion::select('id', 'name', 'discount', 'type', 'start_date', 'end_date')->get();

        // 1. Descuentos Promocionales por Tipo (Distribución de Descuentos)
        $discountsByType = $promotions->groupBy('type')->map(function ($group) {
            // Calcular el descuento promedio por tipo
            return $group->avg('discount');
        });

        // 2. Duración de Promociones (Rango de Fechas)
        $promotionsDuration = $promotions->map(function ($promotion) {
            // Calcular la duración de cada promoción
            $start = \Carbon\Carbon::parse($promotion->start_date);
            $end = \Carbon\Carbon::parse($promotion->end_date);
            $duration = $start->diffInDays($end);  // Duración en días
            return $duration;
        });

        // Obtener los nombres de las promociones y duraciones para pasarlos a la vista
        $promotionNames = $promotions->pluck('name');
        $promotionDurations = $promotionsDuration;


        // Retornar la vista con los datos necesarios
        return view('admin.charts.promo', compact('discountsByType', 'promotionNames', 'promotionDurations'));
    }


    public function showUsersChart()
    {
        // 1. Gráfica de Cantidad de Usuarios por Fecha de Registro
        $usersByDate = User::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $users = User::all();
        return view('admin.charts.usuario', compact('users', 'usersByDate'));
    }
}