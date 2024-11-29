<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Productos</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .footer p {
            margin: 10px 0;
        }

        .footer p a {
            color: #ffd700;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer p a:hover {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Menú de navegación -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
        <div class="container mx-auto flex items-center justify-between p-4">
            <a class="text-xl font-bold text-white" href="#">Barbería DARKETO</a>
        </div>
    </nav>

    <div class="flex">

        <!-- Sidebar -->
        <div class="w-1/5 h-screen bg-gray-800 text-white p-6">
            <h3 class="text-center text-2xl font-bold mb-6">Panel de Usuario</h3>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('user.dashboard') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('user.profile') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Perfil</a>
                <a href="{{ route('user.citas.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Gestionar Citas</a>
                <a href="{{ route('user.productos.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Productos</a>
                <a href="{{ route('user.barbers') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Barberos</a>
                <a href="{{ route('user.promotions.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Promociones</a>
                <a href="{{ route('user.services.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Servicios</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">Cerrar sesión</button>
                    </form>
            </nav>
        </div>

        <!-- Contenido Principal -->
        <div class="flex-1 p-10 pt-20">
            <h1 class="text-4xl font-bold text-gray-800 mb-10 text-center">
                <span class="bg-gradient-to-r from-blue-600 to-blue-800 text-transparent bg-clip-text">Nuestros Productos</span>
            </h1>

            <!-- Filtro por categoría y rango de precio -->
            <div class="mb-8 text-center">
                <form action="{{ route('user.productos.index') }}" method="GET" class="inline-flex flex-wrap items-center gap-4 justify-center">
                    <!-- Filtro por categoría -->
                    <div class="relative">
                        <select name="category" class="appearance-none bg-white border border-gray-300 text-gray-700 py-2.5 pl-4 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Todas las categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Filtro por rango de precio -->
                    <div>
                        <input 
                            type="number" 
                            name="min_price" 
                            value="{{ request('min_price') }}" 
                            placeholder="Precio mínimo" 
                            class="border border-gray-300 py-2 px-4 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    <div>
                        <input 
                            type="number" 
                            name="max_price" 
                            value="{{ request('max_price') }}" 
                            placeholder="Precio máximo" 
                            class="border border-gray-300 py-2 px-4 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    <!-- Botón de filtro -->
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-2.5 px-6 rounded-lg hover:opacity-90 transition-opacity duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtrar
                        </span>
                    </button>
                </form>
            </div>

            <!-- Mostrar productos -->
            @foreach($categories as $category)
                @if($category->products->isNotEmpty())
                    <div class="mb-12 animate-fadeIn">
                        <h2 class="text-3xl font-semibold text-gray-800 mb-6 flex items-center">
                            <span class="border-b-2 border-blue-600 pb-2">{{ $category->name }}</span>
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($category->products as $producto)
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                                    <div class="aspect-w-16 aspect-h-12 overflow-hidden">
                                        <img 
                                            src="{{ asset('storage/'.$producto->image) }}" 
                                            alt="{{ $producto->name }}" 
                                            class="w-full h-52 object-cover transform transition duration-300 hover:scale-110"
                                            loading="lazy"
                                        >
                                    </div>
                                    <div class="p-6 space-y-4">
                                        <div class="space-y-2">
                                            <h5 class="text-xl font-semibold text-gray-900 line-clamp-1">{{ $producto->name }}</h5>
                                            <p class="text-gray-600 text-sm line-clamp-2">{{ $producto->description }}</p>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <p class="text-2xl font-bold text-gray-800">
                                                <span class="text-green-600 text-lg">$</span>
                                                {{ number_format($producto->price, 2) }}
                                            </p>
                                        </div>

                                        <!-- Botón Agregar al carrito -->
                                        <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                                                Agregar al carrito
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white p-6 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Barbería DARKETO. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>
