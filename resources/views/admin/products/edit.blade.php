<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
</head>

<body class="bg-gray-100 font-sans">
    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded-md mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Editar Producto</h1>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Campo Categoría -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 text-lg font-medium mb-2">Categoría</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Seleccione una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nombre del producto -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-lg font-medium mb-2">Nombre</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $product->name }}" required>
            </div>

            <!-- Descripción del producto -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-lg font-medium mb-2">Descripción</label>
                <textarea name="description" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $product->description }}</textarea>
            </div>

            <!-- Precio del producto -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-lg font-medium mb-2">Precio</label>
                <input type="number" name="price" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $product->price }}" required step="0.01">
            </div>

            <!-- Foto del producto -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-lg font-medium mb-2">Foto</label>
                <input type="file" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="image" onchange="previewImage(event)">
                
                <!-- Muestra de imagen actual si existe -->
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del producto" width="200">
                @endif

                <!-- Vista previa de la nueva foto seleccionada -->
                <div class="mt-4 flex justify-center" id="imagePreviewContainer" style="display: none;">
                    <p class="text-gray-600 text-center mb-2">Vista previa de la nueva foto:</p>
                    <img id="imagePreview" class="rounded-md shadow-sm max-w-full h-auto mx-auto">
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-between mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-1/2 mr-2">
                    Actualizar
                </button>

                <a href="{{ route('barber.products.index') }}" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 w-1/2 ml-2 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle mr-2" viewBox="0 0 16 16">
                        <path d="M8 16a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8 1a7 7 0 1 1 0 14 7 7 0 0 1 0-14ZM4.5 5.5a.5.5 0 0 1 .707-.707L8 7.293l2.793-2.793a.5.5 0 0 1 .707.707L8.707 8l2.793 2.793a.5.5 0 0 1-.707.707L8 8.707l-2.793 2.793a.5.5 0 0 1-.707-.707L7.293 8 4.5 5.5z"/>
                    </svg>
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            var file = event.target.files[0];
            reader.onload = function() {
                var imagePreview = document.getElementById('imagePreview');
                var imagePreviewContainer = document.getElementById('imagePreviewContainer');
                imagePreview.src = reader.result;
                imagePreviewContainer.style.display = 'flex';
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
