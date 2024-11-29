<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Producto</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <!-- Incluyendo Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Contenedor Principal -->
    <div class="container mx-auto p-6 max-w-lg bg-white shadow-md rounded-lg">

        <!-- Título -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Crear Producto</h1>

        <!-- Mensajes de Error -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('barber.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
                        <!-- Campo Categoría -->
                        <div>
                            <label for="category_id" class="block text-gray-700 font-semibold mb-2">Categoría</label>
                            <select name="category_id" id="category_id" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                                <option value="" disabled selected>Seleccionar categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
            
            <!-- Campo Nombre -->
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre del Producto</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                       class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" 
                       required>
            </div>

            <!-- Campo Descripción -->
            <div>
                <label for="description" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                <textarea id="description" name="description" 
                          class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" 
                          required>{{ old('description') }}</textarea>
            </div>

            <!-- Campo Precio -->
            <div>
                <label for="price" class="block text-gray-700 font-semibold mb-2">Precio</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" 
                       class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" 
                       required>
            </div>

            <!-- Campo Imagen -->
            <div>
                <label for="image" class="block text-gray-700 font-semibold mb-2">Imagen del Producto</label>
                <input type="file" id="image" name="image" accept="image/*" 
                       class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" 
                       required>
            </div>

            <!-- Botones de Acción -->
            <div class="flex justify-between">
                <!-- Botón de Envío -->
                <button type="submit" 
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Crear Producto
                </button>

                <!-- Botón de Cancelar -->
                <a href="{{ route('barber.products.index') }}" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle mr-2" viewBox="0 0 16 16">
                        <path d="M8 16a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8 1a7 7 0 1 1 0 14 7 7 0 0 1 0-14ZM4.5 5.5a.5.5 0 0 1 .707-.707L8 7.293l2.793-2.793a.5.5 0 0 1 .707.707L8.707 8l2.793 2.793a.5.5 0 0 1-.707.707L8 8.707l-2.793 2.793a.5.5 0 0 1-.707-.707L7.293 8 4.5 5.5z"/>
                    </svg>
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>

</html>
