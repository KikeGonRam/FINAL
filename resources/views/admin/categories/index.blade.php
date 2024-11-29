<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categorias</title>
    <link rel="icon" href="{{ asset('images/admin.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>

        <!-- Tailwind Configuration -->
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            beige: {
                                DEFAULT: '#D4B895',
                                light: '#E5D4BC',
                                dark: '#C3A074'
                            },
                            dark: {
                                100: '#2D2D2D',
                                200: '#242424',
                                300: '#1A1A1A',
                                400: '#121212',
                                500: '#0A0A0A'
                            }
                        },
                        fontFamily: {
                            'poppins': ['Poppins', 'sans-serif']
                        },
                        transitionDuration: {
                            '400': '400ms'
                        }
                    }
                }
            }
        </script>
    
        <!-- Custom Styles -->
        <style>
            /* Base Styles */
            * {
                font-family: 'Poppins', sans-serif;
            }
    
            /* Sidebar Animations */
            .sidebar {
                transition: all 0.4s ease;
            }
    
            .sidebar-link {
                position: relative;
                transition: all 0.3s ease;
            }
    
            .sidebar-link::before {
                content: '';
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                width: 0;
                height: 100%;
                background: linear-gradient(90deg, var(--tw-color-beige) 0%, transparent 100%);
                opacity: 0;
                transition: all 0.3s ease;
                border-radius: 0.5rem;
                z-index: -1;
            }
    
            .sidebar-link:hover::before {
                width: 100%;
                opacity: 0.15;
            }
    
            /* Card Animations */
            .stats-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
    
            .stats-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            }
    
            /* Table Styles */
            .table-row-hover:hover {
                background-color: rgba(212, 184, 149, 0.05);
            }
        </style>

</head>
<body class="bg-dark-400 text-white font-poppins min-h-screen flex">

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

        <main class="flex-1 ml-64 p-8">
            <div class="max-w-7xl mx-auto">
                <header class="mb-8">
                    <h1 class="text-3xl font-semibold text-white">Gestión de Categorias</h1>
                </header>

                <!-- Action Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.categories.create') }}" 
                        class="bg-beige hover:bg-beige-dark text-dark-400 font-medium py-2 px-6 rounded-lg inline-flex items-center gap-2 transition-colors duration-300 shadow-md">
                        <i class="fas fa-plus"></i>
                        <span>Crear Categoria</span>
                    </a>
                </div>

                        <!-- Formulario de búsqueda -->
        <div class="mb-6 flex items-center gap-4">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="w-full max-w-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar Categoría..." 
                       class="w-full py-2 px-4 rounded-lg text-dark-400 bg-dark-300 border border-dark-200 focus:outline-none">
            </form>
        </div>

                            <!-- Notifications -->
                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-md flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-lg mb-6 shadow-md flex items-center gap-3">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="bg-dark-300 rounded-xl shadow-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead class="bg-dark-200">
                                <tr>
                                    <th class="py-4 px-6 text-left text-sm font-semibold text-beige">Nombre</th>
                                    <th class="py-4 px-6 text-left text-sm font-semibold text-beige">Descripción</th>
                                    <th class="py-4 px-6 text-center text-sm font-semibold text-beige">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr class="border-t border-dark-200 table-row-hover transition-colors duration-200">
                                    <td class="py-4 px-6">{{ $category->name }}</td>
                                        <td class="py-4 px-6">{{ $category->description }}</td>
                                        <td class="py-4 px-6">

                                            <div class="flex items-center justify-center gap-3">
                                                <a href="{{ route('admin.categories.edit', $category) }}" 
                                                   class="bg-yellow-500 hover:bg-yellow-600 text-dark-400 py-2 px-4 rounded-md transition-colors duration-300 flex items-center gap-2">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Editar</span>
                                                </a>

                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition-colors duration-300 flex items-center gap-2"
                                                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">>
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span>Eliminar</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                    
                </div>
                <!-- Paginación -->
            <div class="py-4 px-6 flex justify-between items-center">
                <div class="text-sm text-beige">
                    Mostrando {{ $categories->firstItem() }} a {{ $categories->lastItem() }} de {{ $categories->total() }} resultados
                </div>
                <div>
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
            </div>
        </main>

</body>
</html>