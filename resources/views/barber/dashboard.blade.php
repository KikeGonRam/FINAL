<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel Barbero</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
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

    <!-- Contenedor Principal -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="w-1/5 h-screen bg-gray-800 text-white p-6">
            <h3 class="text-center text-xl font-bold mb-6">Panel Barbero</h3>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('barber.dashboard') }}" class="active bg-gray-700 p-2 rounded-md text-center">Dashboard</a>
                <a href="{{ route('barber.profile') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Perfil</a>
                <a href="{{ route('barber.citas.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Mis Citas</a>
                <a href="{{ route('barber.products.index')}}" class="p-2 rounded-md text-center hover:bg-gray-700">Gestionar Productos</a>
                <!-- Button de Cerrar Sesión -->
                <div class="mt-8 text-center">
                    <a href="{{ route('barber.login') }}" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">
                        Cerrar Sesión
                    </a>
                </div>
            </nav>
        </div>

        <!-- Contenido Principal -->
        <div class="container mx-auto p-6 w-4/5">

            <!-- Main content -->
            <div class="w-full p-8">

                <br><hr>
                <br>
                <!-- Header -->
                <div class="mb-6 text-center">
                    <h1 class="text-3xl font-semibold text-gray-800">¡Bienvenido, Barbero {{ Auth::guard('barber')->user()->name }}!</h1>
                    <p class="text-lg text-gray-600 mt-2">Hoy es un gran día para hacer que tus clientes luzcan increíbles. ¡Hazlo con pasión!</p>
                </div>

                <br><hr>
                <br>

                <!-- Motivational Quote Section -->
                <div class="mb-6">
                    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                        <h5 class="text-2xl font-semibold mb-4">Motivación del Día</h5>
                        <p class="text-lg italic">"El arte de cortar el cabello es más que una habilidad, es una forma de transformar vidas, una sonrisa a la vez."</p>
                        <footer class="mt-4 text-gray-600">- Grace Lara</footer>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Script adicional para confirmar antes de cerrar sesión -->
    <script>
        const logoutButton = document.querySelector('.bg-red-600');
        if (logoutButton) {
            logoutButton.addEventListener('click', function(event) {
                if (!confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                    event.preventDefault();
                }
            });
        }
    </script>

</body>

</html>
