<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - DARKETO</title>
    <link rel="icon" href="{{ asset('images/admin.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        beige: '#D4B895',
                        dark: {
                            100: '#2D2D2D',
                            200: '#242424',
                            300: '#1A1A1A',
                            400: '#121212'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, #D4B895 0%, transparent 100%);
            opacity: 0;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            z-index: -1;
        }

        .sidebar-link:hover::before {
            width: 100%;
            opacity: 0.1;
        }

        .stats-card {
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        /* Animación para el loader */
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
    </style>
</head>
<body class="bg-dark-400 text-white flex min-h-screen">
    <!-- Barra lateral -->
    <div class="sidebar fixed w-64 h-full bg-dark-300 p-6 shadow-xl">
        <div class="flex items-center gap-3 mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-lg">
            <h2 class="text-xl font-bold text-beige">DARKETO</h2>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('admin.panel')}}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200 transition-all duration-300">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>

            <a href="{{ route('admin.barbers.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-cut"></i>
                <span>Barberos</span>
            </a>

            <a href="{{ route('admin.citas.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-calendar-alt"></i>
                <span>Citas</span>
            </a>

            <a href="{{ route('admin.contact.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-address-book"></i>
                <span>Contactos</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-address-book"></i>
                <span>Categorias</span>
            </a>

            <a href="{{ route('admin.services.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-address-book"></i>
                <span>Servicios</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-box"></i>
                <span>Productos</span>
            </a>

            <a href="{{ route('admin.tables.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-address-book"></i>
                <span>Tablas</span>
            </a>

            <a href="{{ route('admin.charts.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-address-book"></i>
                <span>Graficas</span>
            </a>

            <a href="{{ route('admin.promotions.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-address-book"></i>
                <span>Promociones</span>
            </a>

        </nav>

        <div class="absolute bottom-6 left-6 right-6">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white rounded-lg flex items-center justify-center gap-2 transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="flex-1 ml-64 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-beige">Panel de Administración</h1>
                <p class="text-gray-400 mt-1">Bienvenido de nuevo, Admin</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="p-2 rounded-lg bg-dark-300 hover:bg-dark-200 transition-colors">
                    <i class="fas fa-bell text-beige"></i>
                </button>
            </div>
        </header>

        <!-- Estadísticas y Citas de Hoy -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Estadísticas -->
            <div class="stats-card bg-dark-300 p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-beige">
                        <p class="text-sm text-gray-400">Total Usuarios</p>
                        <h3 class="text-2xl font-bold">{{ $totalUsuarios }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-beige bg-opacity-10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-beige text-xl"></i>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-green-400">+12%</span>
                    <span class="text-gray-400">vs mes anterior</span>
                </div>
            </div>

            <!-- Citas de Hoy -->
            <div class="stats-card bg-dark-300 p-6 rounded-xl shadow-lg col-span-2">
                <h2 class="text-xl font-bold mb-4 text-beige">Citas de Hoy</h2>
            
                <!-- Total de usuarios -->
                <p class="text-sm text-gray-400">Total de usuarios registrados: {{ $totalUsuarios }}</p>
            
                <!-- Verificar si hay citas para hoy -->
                @if($appointmentsToday->isEmpty())
                    <p class="text-gray-400 mt-4">No hay citas para hoy.</p>
                @else
                    <!-- Tabla para mostrar las citas de hoy -->
                    <table class="min-w-full mt-4 table-auto text-sm text-left text-gray-400">
                        <thead class="bg-dark-200">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Cliente</th>
                                <th class="px-4 py-2">Barbero</th>
                                <th class="px-4 py-2">Fecha</th>
                                <th class="px-4 py-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointmentsToday as $appointment)
                                <tr>
                                    <td class="px-4 py-2">{{ $appointment->id }}</td>
                                    <td class="px-4 py-2">{{ $appointment->cliente->name }}</td>
                                    <td class="px-4 py-2">{{ $appointment->barber->name }}</td>
                                    <td class="px-4 py-2">{{ $appointment->fecha }}</td>
                                    <td class="px-4 py-2">
                                        <span class="badge {{ $appointment->estado == 'pendiente' ? 'bg-yellow-500' : ($appointment->estado == 'aceptada' ? 'bg-green-500' : 'bg-red-500') }}">
                                            {{ ucfirst($appointment->estado) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            
        </div>

        <!-- Barberos Activos -->
        <div class="bg-dark-300 p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-bold mb-4 text-beige">Barberos Activos</h2>
            <p class="text-sm text-gray-400">Total de barberos activos: {{ $activeBarbers }}</p>
            <div class="mt-4 text-center">
                <h3 class="text-3xl font-bold text-beige">{{ $activeBarbers }}</h3>
            </div>
        </div>
    </div>

    
</body>
</html>
