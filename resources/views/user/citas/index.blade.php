<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis Citas - Panel de Usuario</title>
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
            <h3 class="text-center text-xl font-bold mb-6">Panel de Usuario</h3>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('user.dashboard') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('user.profile') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Perfil</a>
                <a href="{{ route('user.citas.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Gestionar Citas</a>
                <a href="{{ route('user.productos.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Productos</a>
                <!-- Button de Cerrar Sesión -->
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md w-full">Cerrar sesión</button>
                </form>
            </nav>
        </div>

        <!-- Contenido Principal -->
        <div class="container mx-auto p-6 w-4/5">

            <!-- Header -->
            <div class="mb-6 text-center">
                <h1 class="text-3xl font-semibold text-gray-800">Mis Citas</h1>
                <p class="text-lg text-gray-600 mt-2">A continuación se muestra el estado de tus citas programadas.</p>
            </div>

            <!-- Tabla de Citas -->
            <div class="overflow-x-auto bg-white shadow rounded-lg p-4">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">Barbero</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                            <th class="px-4 py-2 text-left">Hora</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citas as $cita)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $cita->barber->name }}</td>
                                <td class="px-4 py-2">{{ $cita->fecha }}</td>
                                <td class="px-4 py-2">{{ $cita->hora }}</td>
                                <td class="px-4 py-2">
                                    <span class="inline-block px-3 py-1 text-sm rounded-full
                                        @if($cita->estado == 'pendiente') bg-yellow-500 text-white
                                        @elseif($cita->estado == 'aceptada') bg-green-500 text-white
                                        @elseif($cita->estado == 'cancelada') bg-red-500 text-white
                                        @endif">
                                        {{ ucfirst($cita->estado) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <!-- Botón de ver detalles -->
                                    <a href="{{ route('user.citas.show', $cita->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 text-sm">Ver Detalles</a>

                                    <!-- Botón de editar cita -->
                                    <a href="{{ route('user.citas.edit', $cita->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600 text-sm">Editar</a>

                                    <!-- Botón de eliminar cita -->
                                    <form action="{{ route('user.citas.destroy', $cita->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cita?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 text-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center px-4 py-2">No tienes citas programadas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('user.citas.create') }}" class="mt-4 bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700">Crear Cita</a>
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
