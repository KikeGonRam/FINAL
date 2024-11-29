<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barberos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
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
        <div class="flex-1 p-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-10 text-center">Nuestros Barberos</h1>

            <!-- Lista de Barberos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                @foreach($barbers as $barber)
                    <div class="bg-white rounded-lg shadow-2xl overflow-hidden transform transition hover:scale-110 hover:shadow-3xl duration-300">
                        <div class="overflow-hidden rounded-t-lg">
                            <!-- Muestra la foto del barbero -->
                            <img src="{{ asset('storage/'.$barber->photo) }}" alt="{{ $barber->name }}" class="w-full h-52 object-cover transform transition hover:scale-105 duration-300">
                        </div>
                        <div class="p-6">
                            <h5 class="text-2xl font-semibold text-gray-900 mb-2">{{ $barber->name }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</body>

</html>
