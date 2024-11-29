<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Barberos - Darketo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Barra de Navegación -->
    <nav class="bg-white shadow-md p-4">
        <div class="flex justify-between items-center container mx-auto">
            <a href="{{ route('admin.panel') }}" class="text-gray-800 flex items-center space-x-2 hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.charts.index') }}" class="text-gray-800 flex items-center space-x-2 hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                <span>Regresar</span>
            </a>
            <a href="{{ route('admin.logout') }}" class="text-gray-800 flex items-center space-x-2 hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                </svg>
                <span>Cerrar Sesión</span>
            </a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <section class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-center text-indigo-600 mb-12">Nuestros Barberos</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($barbers as $barber)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ $barber->photo ? asset('storage/' . $barber->photo) : 'https://via.placeholder.com/150' }}" 
                         alt="{{ $barber->name }}" 
                         class="w-full h-48 object-cover transition-transform transform hover:scale-105">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $barber->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $barber->email }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</body>
</html>
