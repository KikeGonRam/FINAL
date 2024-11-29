<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contactos - Panel de Administración</title>
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

            <a href="{{ route('admin.tables.index') }}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200">
                <i class="fas fa-address-book"></i>
                <span>Gestionar Tablas</span>
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
    <main class="flex-1 ml-64 p-8">
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-white">Contactos</h1>
        </header>

            <!-- Formulario de búsqueda -->
    <div class="mb-4">
        <form method="GET" action="{{ route('admin.contact.index') }}" class="flex items-center gap-4">
            <input type="text" name="search" value="{{ request()->search }}" placeholder="Buscar por nombre o correo..." class="p-2 rounded-lg bg-dark-200 text-white">
            <button type="submit" class="px-4 py-2 bg-beige text-dark-100 rounded-lg hover:bg-beige-500">Buscar</button>
        </form>
    </div>

        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg mt-8">
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left">Nombre</th>
                        <th class="py-2 px-4 text-left">Correo Electrónico</th>
                        <th class="py-2 px-4 text-left">Fecha de Contacto</th>
                        <th class="py-2 px-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td class="py-2 px-4">{{ $contact->name }}</td>
                            <td class="py-2 px-4">{{ $contact->email }}</td>
                            <td class="py-2 px-4">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('admin.contact.show', $contact->id) }}" class="text-blue-500 hover:underline">Ver Detalles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
            <!-- Paginación -->
            <div class="mt-4">
                {{ $contacts->links() }}
            </div>
</body>
</html>
