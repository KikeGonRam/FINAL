<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index(Request $request)
    {
        // Consulta principal para las categorías
        $categoriesQuery = Category::with(['products' => function ($query) use ($request) {
            // Filtrar por rango de precios
            if ($request->has('min_price') && $request->min_price !== null) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('max_price') && $request->max_price !== null) {
                $query->where('price', '<=', $request->max_price);
            }
        }]);

        // Filtrar por categoría si se selecciona una
        if ($request->has('category') && $request->category !== null) {
            $categoriesQuery->where('id', $request->category);
        }

        // Obtener las categorías con sus productos
        $categories = $categoriesQuery->get();

        return view('user.productos.index', compact('categories'));
    }
}
