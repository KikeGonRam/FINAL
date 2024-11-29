<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Promociones Activas</title>
    <!-- Agregar Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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


        <div class="container mx-auto p-8">
            <h1 class="text-4xl font-semibold text-center text-blue-600 mb-8">Promociones Activas</h1>
    
            @if($promotions->isEmpty())
                <p class="text-center text-xl text-gray-700">No hay promociones activas en este momento.</p>
            @else
                <ul class="space-y-6">
                    @foreach($promotions as $promotion)
                        <li class="bg-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold text-blue-500 mb-2">{{ $promotion->name }}</h3>
                            <p class="text-gray-700 mb-4">{{ $promotion->description }}</p>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <p><strong>Descuento:</strong> {{ $promotion->discount }}%</p>
                                <p><strong>Válida desde:</strong> {{ $promotion->start_date->format('d/m/Y') }} hasta: {{ $promotion->end_date->format('d/m/Y') }}</p>
                            </div>
                            <p class="mt-4 text-gray-500"><strong>Tipo:</strong> {{ ucfirst($promotion->type) }}</p>
    
                            <a href="{{ route('user.promotions.download', $promotion) }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Solicitar PDF
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
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
