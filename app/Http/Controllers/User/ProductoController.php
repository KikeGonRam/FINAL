<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = Product::all(); // Obtener todos los productos creados por los barberos
        return view('user.productos.index', compact('productos'));
    }
}