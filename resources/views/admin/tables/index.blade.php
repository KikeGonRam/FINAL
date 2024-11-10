<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exportar Tablas</title>
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

    <div class="container mx-auto mt-8 px-6">
        <!-- Sidebar -->
        <aside class="w-64 h-screen bg-dark-300 fixed left-0 top-0 shadow-xl">
            <div class="p-6 flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center gap-3 mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Darketo Logo" class="w-10 h-10 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-beige">DARKETO</h2>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2 flex-grow">
                    <a href="{{ route('admin.panel')}}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200 transition-all duration-300">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200 transition-all duration-300">
                        <i class="fas fa-users w-5"></i>
                        <span>Usuarios</span>
                    </a>
                    
                    <a href="{{ route('admin.barbers.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200 transition-all duration-300">
                        <i class="fas fa-cut w-5"></i>
                        <span>Barberos</span>
                    </a>
                    
                    <a href="{{ route('admin.citas.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200 transition-all duration-300">
                        <i class="fas fa-calendar-alt w-5"></i>
                        <span>Citas</span>
                    </a>
                </nav>

                <!-- Logout Button -->
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit" class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white rounded-lg flex items-center justify-center gap-2 transition-colors duration-300 shadow-md">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 ml-64 p-8">
            <div class="max-w-7xl mx-auto">
                <header class="mb-8">
                    <h1 class="text-3xl font-semibold text-white">Exportar Tablas de Datos</h1>
                </header>
            </div>

            <div class="container mt-5">
                <h1 class="text-center mb-4">Exportar Tablas de Datos</h1>
            
                <div class="container mt-5">
                    <p class="text-center mb-4">Seleccione un formato para exportar los datos:</p>
            
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Sección de Usuarios -->
                        <div class="bg-dark-200 p-6 rounded-lg shadow-lg text-white hover:scale-105 transition-transform duration-300">
                            <h3 class="text-xl font-semibold mb-4">Usuarios</h3>
                            <a href="{{ route('admin.tables.export', ['format' => 'pdf', 'table' => 'users']) }}" 
                               class="btn bg-red-600 text-white py-2 px-4 w-full rounded-lg text-center flex items-center justify-center space-x-2">
                                <i class="fas fa-file-pdf"></i>
                                <span>Exportar como PDF</span>
                            </a>
                        </div>
            
                        <!-- Sección de Productos -->
                        <div class="bg-dark-200 p-6 rounded-lg shadow-lg text-white hover:scale-105 transition-transform duration-300">
                            <h3 class="text-xl font-semibold mb-4">Productos</h3>
                            <a href="{{ route('admin.tables.export', ['format' => 'pdf', 'table' => 'products']) }}" 
                               class="btn bg-red-600 text-white py-2 px-4 w-full rounded-lg text-center flex items-center justify-center space-x-2">
                                <i class="fas fa-file-pdf"></i>
                                <span>Exportar como PDF</span>
                            </a>
                        </div>
            
                        <!-- Sección de Citas -->
                        <div class="bg-dark-200 p-6 rounded-lg shadow-lg text-white hover:scale-105 transition-transform duration-300">
                            <h3 class="text-xl font-semibold mb-4">Citas</h3>
                            <a href="{{ route('admin.tables.export', ['format' => 'pdf', 'table' => 'appointments']) }}" 
                               class="btn bg-red-600 text-white py-2 px-4 w-full rounded-lg text-center flex items-center justify-center space-x-2">
                                <i class="fas fa-file-pdf"></i>
                                <span>Exportar como PDF</span>
                            </a>
                        </div>
            
                        <!-- Sección de Barberos -->
                        <div class="bg-dark-200 p-6 rounded-lg shadow-lg text-white hover:scale-105 transition-transform duration-300">
                            <h3 class="text-xl font-semibold mb-4">Barberos</h3>
                            <a href="{{ route('admin.tables.export', ['format' => 'pdf', 'table' => 'barbers']) }}" 
                               class="btn bg-red-600 text-white py-2 px-4 w-full rounded-lg text-center flex items-center justify-center space-x-2">
                                <i class="fas fa-file-pdf"></i>
                                <span>Exportar como PDF</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>
    </div>

    <!-- Script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
