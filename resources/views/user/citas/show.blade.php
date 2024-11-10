<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de la Cita</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Detalles de la Cita</h1>

        <!-- Mostrar detalles de la cita -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h5 class="text-xl font-semibold mb-4 text-gray-800">Barbero: {{ $cita->barber->name }}</h5>

            <!-- Mostrar la foto del barbero -->
            @if($cita->barber->foto)
                <img src="{{ asset('storage/barbers_photos/' . $cita->barber->foto) }}" alt="Foto del Barbero" class="w-32 h-32 object-cover rounded-full mb-4">
            @else
                <p class="text-gray-600">No hay foto disponible</p>
            @endif

            <p class="text-lg text-gray-700 mb-4"><strong>Fecha:</strong> {{ $cita->fecha }}</p>
            <p class="text-lg text-gray-700 mb-4"><strong>Hora:</strong> {{ $cita->hora }}</p>

            <p class="text-lg text-gray-700 mb-4"><strong>Estado:</strong>
                <span class="inline-block px-4 py-2 text-white rounded-full
                    @if($cita->estado == 'pendiente') bg-yellow-500
                    @elseif($cita->estado == 'aceptada') bg-green-500
                    @elseif($cita->estado == 'cancelada') bg-red-500
                    @endif">
                    {{ ucfirst($cita->estado) }}
                </span>
            </p>

            <!-- Botones de acción -->
            <a href="{{ route('user.citas.index') }}" class="mt-4 inline-block px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">
                Volver a Mis Citas
            </a>
        </div>
    </div>

</body>

</html>
