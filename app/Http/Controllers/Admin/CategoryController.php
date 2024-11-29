<?php


namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Mostrar el listado de categorías
    public function index(Request $request)
    {
        $search = $request->input('search'); // Obtener el término de búsqueda

        $categories = Category::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })
            ->paginate(10); // Paginación de 10 elementos por página

        return view('admin.categories.index', compact('categories'));
    }


    // Mostrar el formulario para crear una categoría
    public function create()
    {
        return view('admin.categories.create');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada con éxito');
    }

    // Mostrar el formulario para editar una categoría
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Actualizar una categoría
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada con éxito');
    }

    // Eliminar una categoría
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Categoría eliminada con éxito');
    }
}
