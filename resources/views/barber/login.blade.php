<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Barbero</title>

    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900">

    <!-- Contenedor del video -->
    <div class="video-container absolute inset-0 w-full h-full overflow-hidden">
        <video autoplay muted loop class="object-cover w-full h-full">
            <source src="{{ asset('video/login-barbero.mp4') }}" type="video/mp4">
            Tu navegador no soporta el video.
        </video>
    </div>

    <!-- Contenedor Principal -->
    <div class="relative z-10 flex justify-center items-center h-screen bg-black bg-opacity-50">

        <!-- Formulario de Login -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Iniciar sesión como Barbero</h2>

            <!-- Mensaje de error -->
            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded-md mb-4 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulario de inicio de sesión -->
            <form action="{{ route('barber.login') }}" method="POST">
                @csrf

                <!-- Campo de correo electrónico -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Botón de iniciar sesión -->
                <div class="text-center">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Iniciar Sesión
                    </button>
                </div>
            </form>

            <!-- Enlace para registro de usuarios -->
            <div class="mt-4 text-center">
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 text-sm">¿No eres barbero? Regístrate como usuario</a>
            </div>
        </div>
    </div>

</body>

</html>
