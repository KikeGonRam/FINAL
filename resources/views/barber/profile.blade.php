<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil del Barbero</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <!-- CDN de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

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
                    <form action="{{ route('barber.barber.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Contenido Principal -->
        <div class="container mx-auto flex justify-center items-center min-h-screen p-4 w-4/5">
            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-center text-2xl font-bold text-blue-600">Mi Perfil</h2>
                <h3 class="text-center text-xl mb-4 text-gray-600">ACTUALIZA TU PERFIL</h3>

                <!-- Mensajes de éxito o error -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Formulario para actualizar el perfil -->
                <form action="{{ route('barber.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Foto -->
                    <div class="text-center">
                        @if ($barber->photo)
                        <img src="{{ asset('storage/' . $barber->photo) }}" alt="Foto de Perfil" class="w-24 h-24 rounded-full mx-auto mb-2">
                        @else
                        <p class="text-gray-500">No has subido una foto aún.</p>
                        @endif
                        <label for="photo" class="block text-gray-700 font-semibold">Foto de Perfil</label>
                        <input type="file" id="photo" name="photo" class="mt-2 block w-full text-sm text-gray-600">
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control block w-full p-2 border border-gray-300 rounded" value="{{ $barber->name }}" required>
                    </div>

                    <!-- Correo Electrónico -->
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-control block w-full p-2 border border-gray-300 rounded" value="{{ $barber->email }}" required>
                    </div>

                    <!-- Botón de Enviar -->
                    <div class="text-center">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Actualizar Perfil</button>
                    </div>
                </form>
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
