<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar Tablas - DARKETO</title>
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
            opacity: 0.2;
        }

        .export-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .export-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(212,184,149,0.1) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .export-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .export-card:hover::before {
            opacity: 1;
        }

        .export-button {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            background: linear-gradient(45deg, #dc2626, #991b1b);
        }

        .export-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: transform 0.6s ease;
        }

        .export-button:hover::before {
            transform: translateX(200%);
        }

        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            backdrop-filter: blur(4px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .loading-spinner {
            animation: spin 1s linear infinite;
        }

        .info-card {
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #D4B895, transparent);
        }

        .export-icon {
            transition: transform 0.3s ease;
        }

        .export-card:hover .export-icon {
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="bg-dark-400 text-white flex min-h-screen">
    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="bg-dark-300 p-8 rounded-xl shadow-2xl flex flex-col items-center transform transition-all duration-300">
            <div class="loading-spinner text-beige text-4xl mb-4">
                <i class="fas fa-spinner"></i>
            </div>
            <p class="text-beige font-medium">Generando exportación...</p>
            <p class="text-sm text-gray-400 mt-2">Por favor, espere un momento</p>
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-dark-300 fixed left-0 top-0 shadow-xl">
        <div class="p-6 flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Darketo Logo" class="w-10 h-10 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-beige">DARKETO</h2>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2 flex-grow">
                <a href="{{ route('admin.panel')}}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-users w-5"></i>
                    <span>Usuarios</span>
                </a>
                
                <a href="{{ route('admin.barbers.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-cut w-5"></i>
                    <span>Barberos</span>
                </a>
                
                <a href="{{ route('admin.citas.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-calendar-alt w-5"></i>
                    <span>Citas</span>
                </a>

                <a href="{{ route('admin.contact.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-address-book w-5"></i>
                    <span>Contactos</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-tags w-5"></i>
                    <span>Categorías</span>
                </a>

                <a href="{{ route('admin.services.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-concierge-bell w-5"></i>
                    <span>Servicios</span>
                </a>

                <a href="{{ route('admin.tables.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige bg-dark-200">
                    <i class="fas fa-table w-5"></i>
                    <span>Gestionar Tablas</span>
                </a>

                <a href="{{ route('admin.charts.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span>Gráficas</span>
                </a>

                <a href="{{ route('admin.promotions.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                    <i class="fas fa-address-book"></i>
                    <span>Promociones</span>
                </a>
            </nav>

            <!-- Logout Button -->
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg flex items-center justify-center gap-2 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 ml-64 p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <header class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <i class="fas fa-file-export text-3xl text-beige"></i>
                    <h1 class="text-3xl font-semibold text-white">Exportar Tablas de Datos</h1>
                </div>
                <p class="text-gray-400">Seleccione la tabla que desea exportar y el formato deseado</p>
            </header>

            <!-- Export Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Cards for each table -->
                @foreach ([
                    ['name' => 'Usuarios', 'icon' => 'users', 'route' => 'users', 'description' => 'Lista completa de usuarios registrados'],
                    ['name' => 'Productos', 'icon' => 'box', 'route' => 'products', 'description' => 'Catálogo completo de productos'],
                    ['name' => 'Citas', 'icon' => 'calendar-alt', 'route' => 'appointments', 'description' => 'Registro de citas programadas'],
                    ['name' => 'Barberos', 'icon' => 'cut', 'route' => 'barbers', 'description' => 'Lista de barberos activos'],
                    ['name' => 'Contactos', 'icon' => 'address-book', 'route' => 'contacts', 'description' => 'Lista de mensajes de contacto'],
                    ['name' => 'Categorías', 'icon' => 'tags', 'route' => 'categories', 'description' => 'Lista de categorías de servicios'],
                    ['name' => 'Servicios', 'icon' => 'concierge-bell', 'route' => 'services', 'description' => 'Catálogo de servicios disponibles'],
                    ['name' => 'Promociones', 'icon' => 'percentage', 'route' => 'promotions', 'description' => 'Lista de promociones activas']
                ] as $item)
                <div class="export-card bg-dark-200 rounded-xl shadow-lg">
                    <div class="p-6">
                        <div class="text-beige mb-4 export-icon">
                            <i class="fas fa-{{ $item['icon'] }} text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $item['name'] }}</h3>
                        <p class="text-gray-400 text-sm mb-4">{{ $item['description'] }}</p>
                        <a href="{{ route('admin.tables.export', ['format' => 'pdf', 'table' => $item['route']]) }}" 
                           onclick="showLoading()"
                           class="export-button w-full py-2 px-4 rounded-lg flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
                            <i class="fas fa-file-pdf"></i>
                            <span>Exportar PDF</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Information Section -->
            <div class="mt-8 bg-dark-300 rounded-xl p-6 info-card shadow-lg">
                <div class="flex items-start gap-4">
                    <div class="text-beige text-xl bg-dark-200 p-3 rounded-lg shadow-inner">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-3 text-beige">Información sobre las exportaciones</h3>
                        <ul class="text-gray-400 space-y-3">
                            <li class="flex items-center gap-3">
                                <i class="fas fa-check text-green-500"></i>
                                Los archivos se exportan en formato PDF para mejor compatibilidad
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-clock text-blue-500"></i>
                                La generación puede tomar unos segundos dependiendo del volumen de datos
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-calendar-check text-purple-500"></i>
                                Los archivos incluyen marca de tiempo de exportación
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function showLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.style.display = 'flex';
            
            setTimeout(() => {
                overlay.style.opacity = '1';
            }, 50);

            // Simular tiempo de carga
            setTimeout(() => {
                overlay.style.opacity = '0';
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 300);
            }, 2000);
        }

        // Enhance card interactivity
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.export-card');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('.export-icon');
                    icon.style.transform = 'translateY(-3px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('.export-icon');
                    icon.style.transform = 'translateY(0)';
                });
            });
        });
    </script>

</body>
</html>