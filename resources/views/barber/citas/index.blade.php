<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis Citas</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
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

    <!-- Contenedor principal con Sidebar y contenido -->
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

        <!-- Contenido principal -->
        <div class="flex-1 container mx-auto p-6">

            <!-- Título -->
            <h1 class="text-3xl font-semibold text-center mb-6">Mis Citas</h1>

            <!-- Mostrar los mensajes de sesión -->
            @if (session('success'))
                <div class="alert alert-success bg-green-500 text-white p-4 mb-4 rounded">
                    {{ session('success') }}
                    <button type="button" class="text-white ml-2" data-bs-dismiss="alert" aria-label="Close">×</button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger bg-red-500 text-white p-4 mb-4 rounded">
                    {{ session('error') }}
                    <button type="button" class="text-white ml-2" data-bs-dismiss="alert" aria-label="Close">×</button>
                </div>
            @endif

            <!-- Tabla de citas -->
            <table class="min-w-full bg-white shadow-md rounded-md overflow-hidden">
                <thead>
                    <tr class="bg-gray-700 text-white">
                        <th class="py-2 px-4 border text-white">Cliente</th>
                        <th class="py-2 px-4 border text-white">Fecha</th>
                        <th class="py-2 px-4 border text-white">Hora</th>
                        <th class="py-2 px-4 border text-white">Estado</th>
                        <th class="py-2 px-4 border text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr class="hover:bg-gray-100">
                            <!-- Nombre del cliente -->
                            <td class="py-2 px-4 border">{{ $cita->cliente->name }}</td>

                            <!-- Fecha y hora -->
                            <td class="py-2 px-4 border">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td class="py-2 px-4 border">{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>

                            <!-- Estado de la cita con colores -->
                            <td class="py-2 px-4 border">
                                @if($cita->estado == 'pendiente')
                                    <span class="bg-yellow-500 text-black py-1 px-2 rounded" title="Cita pendiente">{{ ucfirst($cita->estado) }}</span>
                                @elseif($cita->estado == 'aceptada')
                                    <span class="bg-green-500 text-white py-1 px-2 rounded" title="Cita aceptada">{{ ucfirst($cita->estado) }}</span>
                                @elseif($cita->estado == 'cancelada')
                                    <span class="bg-red-500 text-white py-1 px-2 rounded" title="Cita cancelada">{{ ucfirst($cita->estado) }}</span>
                                @endif
                            </td>

                            <!-- Formulario para actualizar el estado -->
                            <td class="py-2 px-4 border">
                                <form action="{{ route('barber.citas.updateStatus', $cita->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <select name="estado" class="form-select py-2 px-3 bg-gray-800 text-white rounded" required>
                                            <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="aceptada" {{ $cita->estado == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
                                            <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">Actualizar Estado</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <!-- Scripts necesarios para el funcionamiento de Tailwind CSS -->
    <script>
        // Activar tooltips si es necesario
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>


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
