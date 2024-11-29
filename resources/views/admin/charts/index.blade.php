<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - DARKETO</title>
    <link rel="icon" href="{{ asset('images/admin.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>

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
            opacity: 0.2;
        }

        .stats-card {
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-dark-400 text-white flex min-h-screen" x-data="{ sidebarOpen: true }">
    <!-- Sidebar Toggle (Mobile) -->
    <button 
        @click="sidebarOpen = !sidebarOpen" 
        class="lg:hidden fixed top-4 left-4 z-50 bg-dark-300 p-2 rounded-lg text-beige hover:bg-dark-200">
        <i class="fas" :class="sidebarOpen ? 'fa-times' : 'fa-bars'"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar fixed lg:relative w-64 h-full bg-dark-300 p-6 shadow-xl transform lg:transform-none transition-transform duration-300"
         :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        <div class="flex items-center gap-3 mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-lg">
            <h2 class="text-xl font-bold text-beige">DARKETO</h2>
        </div>

        <nav class="space-y-2">
            <!-- Menu Items -->
            <a href="{{ route('admin.panel')}}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>

            <!-- Gestión de Usuarios -->
            <div class="py-2">
                <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                </a>
                <a href="{{ route('admin.barbers.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-cut"></i>
                    <span>Barberos</span>
                </a>
            </div>

            <!-- Gestión de Citas -->
            <div class="py-2">
                <a href="{{ route('admin.citas.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Citas</span>
                </a>
                <a href="{{ route('admin.contact.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-address-book"></i>
                    <span>Contactos</span>
                </a>
            </div>

            <!-- Gestión de Catálogo -->
            <div class="py-2">
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-th-list"></i>
                    <span>Categorias</span>
                </a>
                <a href="{{ route('admin.services.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Servicios</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-box"></i>
                    <span>Productos</span>
                </a>
            </div>

            <!-- Análisis y Reportes -->
            <div class="py-2">
                <a href="{{ route('admin.tables.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-table"></i>
                    <span>Tablas</span>
                </a>
                <a href="{{ route('admin.charts.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-chart-pie"></i>
                    <span>Graficas</span>
                </a>
            </div>
        </nav>

        <!-- Logout Button -->
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

    <!-- Main Content -->
    <div class="flex-1 ml-0 lg:ml-64 p-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold mb-6 text-beige fade-in">Dashboard - Administrador</h1>

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Métricas de Citas -->
                <div class="col-span-full">
                    <h2 class="text-xl font-semibold text-beige mb-4">Métricas de Citas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="stats-card bg-dark-200 p-6 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-beige">Citas Generales</h3>
                                <i class="fas fa-calendar-check text-beige"></i>
                            </div>
                            <a href="{{ route('admin.chats.cita') }}" class="text-beige hover:text-white flex items-center gap-2">
                                <span>Ver detalles</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="stats-card bg-dark-200 p-6 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-beige">Citas por Barbero</h3>
                                <i class="fas fa-cut text-beige"></i>
                            </div>
                            <a href="{{ route('admin.chats.barber') }}" class="text-beige hover:text-white flex items-center gap-2">
                                <span>Ver detalles</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="stats-card bg-dark-200 p-6 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-beige">Usuarios sin Foto</h3>
                                <i class="fas fa-user-circle text-beige"></i>
                            </div>
                            <a href="{{ route('admin.chats.user') }}" class="text-beige hover:text-white flex items-center gap-2">
                                <span>Ver detalles</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Catálogo y Servicios -->
                <div class="col-span-full mt-8">
                    <h2 class="text-xl font-semibold text-beige mb-4">Catálogo y Servicios</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="stats-card bg-dark-200 p-6 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-beige">Precios de Productos</h3>
                                <i class="fas fa-tag text-beige"></i>
                            </div>
                            <a href="{{ route('admin.chats.product') }}" class="text-beige hover:text-white flex items-center gap-2">
                                <span>Ver detalles</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="stats-card bg-dark-200 p-6 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-beige">Galería de Barberos</h3>
                                <i class="fas fa-images text-beige"></i>
                            </div>
                            <a href="{{ route('admin.charts.galeria') }}" class="text-beige hover:text-white flex items-center gap-2">
                                <span>Ver detalles</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="stats-card bg-dark-200 p-6 rounded-lg shadow-lg">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-beige">Lista de Servicios</h3>
                                <i class="fas fa-list-alt text-beige"></i>
                            </div>
                            <a href="{{ route('admin.charts.price') }}" class="text-beige hover:text-white flex items-center gap-2">
                                <span>Ver detalles</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Promociones -->
                <div class="col-span-full mt-8">
                    <h2 class="text-xl font-semibold text-beige mb-4">Promociones</h2>
                    <div class="stats-card bg-dark-200 p-6 rounded-lg shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-beige">Gestión de Promociones</h3>
                            <i class="fas fa-percent text-beige"></i>
                        </div>
                        <a href="{{ route('admin.charts.promo') }}" class="text-beige hover:text-white flex items-center gap-2">
                            <span>Ver detalles</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>