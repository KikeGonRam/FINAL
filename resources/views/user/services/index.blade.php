<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicios - Barbería DARKETO</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <!-- Tailwind CSS -->
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
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex items-center justify-between p-4">
            <a class="text-lg font-bold text-gray-800" href="#">Barbería DARKETO</a>
            <button class="md:hidden p-2 text-gray-800 focus:outline-none focus:ring-2" aria-label="Toggle navigation">
            </button>
        </div>
    </nav>

    <div class="flex">
        <div class="w-1/5 h-screen bg-gray-800 text-white p-6">
            <h3 class="text-center text-xl font-bold mb-6">Panel de Usuario</h3>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('user.dashboard') }}" class="active bg-gray-700 p-2 rounded-md text-center">Dashboard</a>
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

        <div class="container mx-auto p-6 w-4/5">
            <div class="container mt-5">
                <h1 class="text-center mb-4 text-2xl font-semibold">Servicios Disponibles</h1>

                @if($services->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($services as $service)
                            <div class="card shadow-sm">
                                <img 
                                    src="{{ $service->image_url ?? asset('images/servic.jpg') }}" 
                                    class="card-img-top" 
                                    alt="{{ $service->name }}" 
                                    style="height: 200px; object-fit: cover;">
                                <div class="card-body p-4">
                                    <h5 class="card-title text-xl font-semibold">{{ $service->name }}</h5>
                                    <p class="card-text text-gray-500">{{ Str::limit($service->description, 100) }}</p>
                                    <p class="card-text text-lg font-bold"><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>
                                    <br>
                                    <a href="{{ route('user.services.show', $service->id) }}" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded mt-3">Ver Detalles</a>
                                    <a href="{{ route('user.services.downloadPDF', $service->id) }}" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Solicitar</a>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginación -->
                    <div class="flex justify-center mt-4">
                        {{ $services->links() }}
                    </div>
                @else
                    <div class="alert alert-warning text-center" role="alert">
                        No hay servicios disponibles en este momento. Por favor, vuelve más tarde.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <footer class="footer mt-8 py-4 bg-gray-800 text-white">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Barbería DARKETO. Todos los derechos reservados. 
                <a href="{{ route('privacy-policy') }}" class="hover:underline">Política de Privacidad</a> | 
                <a href="{{ route('terms-and-conditions') }}" class="hover:underline">Términos y Condiciones</a> | 
                <a href="{{ route('contact-us') }}" class="hover:underline">Contáctanos</a>
            </p>
        </div>
    </footer>

</body>

</html>
