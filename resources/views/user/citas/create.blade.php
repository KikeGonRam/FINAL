<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Cita</title>
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

    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Crear Cita</h1>

        <a href="{{ route('user.profile') }}" class="text-blue-500 hover:underline">Mi Perfil</a>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success mt-4 mb-4 p-4 bg-green-200 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger mt-4 mb-4 p-4 bg-red-200 text-red-800 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.citas.store') }}" method="POST">
            @csrf

            <!-- Campo oculto para cliente_id -->
            <input type="hidden" name="cliente_id" value="{{ Auth::user()->id }}">

            <!-- Mostrar solo el nombre del usuario autenticado -->
            <div class="form-group mb-4">
                <label for="cliente_nombre" class="block text-gray-700 font-semibold">Cliente</label>
                <input type="text" id="cliente_nombre" class="mt-2 p-2 w-full border border-gray-300 rounded-md" value="{{ Auth::user()->name }}" disabled>
            </div>

            <!-- Selección de barbero -->
            <div class="form-group mb-4">
                <label for="barber_id" class="block text-gray-700 font-semibold">Barbero</label>
                <select name="barber_id" id="barber_id" class="mt-2 p-2 w-full border border-gray-300 rounded-md" required>
                    @foreach($barbers as $barber)
                        <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Selección de fecha -->
            <div class="form-group mb-4">
                <label for="fecha" class="block text-gray-700 font-semibold">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="mt-2 p-2 w-full border border-gray-300 rounded-md" required>
            </div>

            <!-- Selección de hora -->
            <div class="form-group mb-4">
                <label for="hora" class="block text-gray-700 font-semibold">Hora</label>
                <input type="time" name="hora" id="hora" class="mt-2 p-2 w-full border border-gray-300 rounded-md" required>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-between">
                <button type="submit" class="w-full sm:w-auto mt-6 p-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md">
                    Crear Cita
                </button>

                <a href="{{ route('user.citas.index') }}" class="w-full sm:w-auto mt-6 p-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-md text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

    <footer class="footer">
        <p>
            &copy; 2024 Barbería DARKETO. Todos los derechos reservados.
            <a href="{{ route('privacy-policy') }}">Política de Privacidad</a> |
            <a href="{{ route('terms-and-conditions') }}">Términos y Condiciones</a> |
            <a href="{{ route('contact-us') }}">Contáctanos</a>
        </p>
    </footer>

</body>

</html>
