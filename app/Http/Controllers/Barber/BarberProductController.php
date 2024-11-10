<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class BarberProductController extends Controller
{
    // Mostrar la lista de productos
    public function index()
    {
        $products = Product::all(); // Obtiene todos los productos
        return view('barber.products.index', compact('products'));
    }

    // Mostrar el formulario para crear un producto
    public function create()
    {
        return view('barber.products.create');
    }

    // Almacenar el nuevo producto
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048',
        ]);

        // Crear el nuevo producto
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('products_image', 'public');
            $product->image = $photoPath;
        }

        $product->save();

        return redirect()->route('barber.products.index')->with('success', 'Producto creado con éxito.');
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('barber.products.show', compact('product'));
    }

    // Mostrar el formulario para editar un producto
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('barber.products.edit', compact('product'));
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('products_image', 'public');
            $product->photo = $photoPath;
        }

        $product->save();

        return redirect()->route('barber.products.index')->with('success', 'Producto actualizado con éxito.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('barber.products.index')->with('success', 'Producto eliminado con éxito.');
    }


    public function testImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('test_images', 'public');
            return response()->json(['path' => $photoPath]);
        }

        return response()->json(['error' => 'No image uploaded']);
    }
}
