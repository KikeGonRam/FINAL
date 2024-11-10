<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles del Producto</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-6 max-w-lg bg-white rounded-lg shadow-md">

        <!-- Título -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Detalles del Producto</h1>

        <!-- Detalles del Producto -->
        <div class="space-y-4">

            <!-- Nombre del Producto -->
            <div>
                <label class="block text-gray-700 text-lg font-medium mb-1">Nombre</label>
                <input type="text" name="name" value="{{ $product->name }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none" disabled>
            </div>

            <!-- Descripción del Producto -->
            <div>
                <label class="block text-gray-700 text-lg font-medium mb-1">Descripción</label>
                <textarea name="description" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none" 
                          disabled>{{ $product->description }}</textarea>
            </div>

            <!-- Precio del Producto -->
            <div>
                <label class="block text-gray-700 text-lg font-medium mb-1">Precio</label>
                <input type="number" name="price" value="{{ $product->price }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none" 
                       disabled step="0.01">
            </div>

            <!-- Imagen del Producto -->
            <div>
                <label class="block text-gray-700 text-lg font-medium mb-1">Foto</label>
                <div class="flex justify-center border border-gray-300 rounded-md p-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del producto" class="w-48 h-48 object-cover rounded-md">
                </div>
            </div>

            <!-- Botón Regresar -->
            <div class="flex justify-center mt-4">
                <a href="{{ route('barber.products.index') }}" class="flex items-center text-blue-500 hover:text-blue-700 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mr-2" viewBox="0 0 16 16">
                        <path d="M8 16a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8 1a7 7 0 1 1 0 14 7 7 0 0 1 0-14ZM4 8.5a.5.5 0 0 1 .5-.5h4.5V4a.5.5 0 0 1 1 0v5a.5.5 0 0 1-.5.5H4.5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    Regresar
                </a>
            </div>
        </div>

    </div>

</body>

</html>
