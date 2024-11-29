<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - DARKETO</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/admin.png') }}" type="image/png">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Configuración de Tailwind -->
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

    <!-- Estilos personalizados -->
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

        @keyframes pulse {
            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
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
            <a href="{{ route('admin.panel') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
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
                <i class="fas fa-list"></i>
                <span>Categorías</span>
            </a>
            <a href="{{ route('admin.services.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-concierge-bell"></i>
                <span>Servicios</span>
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-box"></i>
                <span>Productos</span>
            </a>
        </nav>

        <!-- Botón de cerrar sesión -->
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
            <button class="p-2 rounded-lg bg-dark-300 hover:bg-dark-200 transition-colors">
                <i class="fas fa-bell text-beige"></i>
            </button>
        </header>

        <!-- Gráfico de Usuarios Registrados -->
        <div class="bg-dark-300 p-6 rounded-xl shadow-lg mb-8">
            <h2 class="text-xl font-bold text-beige mb-4">Usuarios Registrados esta Semana</h2>
            <canvas id="weeklyRegistrationsChart" class="w-full"></canvas>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="stats-card bg-dark-300 p-6 rounded-xl shadow-lg">
                <p class="text-sm text-gray-400">Total Usuarios</p>
                <h3 class="text-2xl font-bold text-beige">{{ $totalUsuarios }}</h3>
            </div>
            <div class="stats-card bg-dark-300 p-6 rounded-xl shadow-lg">
                <p class="text-sm text-gray-400">Total Citas</p>
                <h3 class="text-2xl font-bold text-beige">{{ $totalCitas }}</h3>
            </div>
        </div>
    </div>

    <!-- Script del gráfico -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('weeklyRegistrationsChart').getContext('2d');
            const data = @json($weeklyRegistrations);
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Usuarios Registrados',
                        data: data.values,
                        backgroundColor: 'rgba(212, 184, 149, 0.5)',
                        borderColor: 'rgba(212, 184, 149, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true, ticks: { color: '#ffffff' } },
                        x: { ticks: { color: '#ffffff' } }
                    }
                }
            });
        });
    </script>

</body>
</html>
