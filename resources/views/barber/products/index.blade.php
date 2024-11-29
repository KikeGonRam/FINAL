<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis Productos</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <!-- Incluyendo Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen">

    <!-- Menú de navegación -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex items-center justify-between p-4">
            <a class="text-lg font-bold text-gray-800" href="#">Barbería DARKETO</a>
            <button class="md:hidden p-2 text-gray-800 focus:outline-none focus:ring-2" aria-label="Toggle navigation">
            </button>
        </div>
    </nav>

    <!-- Contenedor Principal -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <div class="w-1/5 bg-gray-800 text-white p-6">
            <h3 class="text-center text-xl font-bold mb-6">Panel Barbero</h3>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('barber.dashboard') }}" class="active bg-gray-700 p-2 rounded-md text-center">Dashboard</a>
                <a href="{{ route('barber.profile') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Perfil</a>
                <a href="{{ route('barber.citas.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Mis Citas</a>
                <a href="{{ route('barber.products.index')}}" class="p-2 rounded-md text-center hover:bg-gray-700">Gestionar Productos</a>
                <!-- Button de Cerrar Sesión -->
                <div class="mt-8 text-center">
                    <a href="{{ route('barber.barber.logout') }}" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">
                        Cerrar Sesión
                    </a>
                </div>
            </nav>
        </div>

        <!-- Contenido Principal -->
        <div class="container mx-auto p-6 w-4/5 flex-1">

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Título de la página -->
            <h1 class="text-3xl font-semibold text-gray-800 mb-4">Mis Productos</h1>

            <!-- Botón para crear producto -->
            <a href="{{ route('barber.products.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md mb-4 inline-block">
               Crear Producto
            </a>

            <!-- Tabla de productos -->
            <table class="min-w-full bg-white shadow-md rounded-md overflow-hidden">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Nombre</th>
                        <th class="py-3 px-4 text-left">Descripción</th>
                        <th class="py-3 px-4 text-left">Precio</th>
                        <th class="py-3 px-4 text-left">Foto</th>
                        <th class="py-3 px-4 text-left">Categoria</th>
                        <th class="py-3 px-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">{{ $product->name }}</td>
                            <td class="py-3 px-4">{{ $product->description }}</td>
                            <td class="py-3 px-4">${{ number_format($product->price, 2) }}</td>
                            <td class="py-3 px-4">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del producto" width="200">
                            </td>
                            <td class="py-3 px-4">{{ $product->category ? $product->category->name : 'Sin Categoría' }}</td>
                            <td class="py-3 px-4 flex items-center space-x-2">
                                <a href="{{ route('barber.products.show', $product->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md">Ver</a>
                                <a href="{{ route('barber.products.edit', $product->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded-md">Editar</a>
                                <form action="{{ route('barber.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md"
                                            onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</body>

</html>
