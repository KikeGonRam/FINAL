<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión de Productos</title>
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
                <i class="fas fa-table"></i>
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

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-primary">Gestión de Productos | Administrador</h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary py-2 px-4 bg-beige text-dark-100 rounded-lg hover:bg-dark-200 transition-colors">Crear Producto</a>
        </div>

        <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4 flex gap-4 items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar productos..." class="py-2 px-4 bg-dark-200 text-white rounded-lg" />
            <button type="submit" class="py-2 px-4 bg-beige text-dark-100 rounded-lg hover:bg-dark-200 transition-colors">
                Buscar
            </button>
        </form>
        

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success bg-green-500 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de productos -->
        <table class="min-w-full bg-dark-200 table-auto rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="py-3 px-4 text-left text-beige">Nombre</th>
                    <th class="py-3 px-4 text-left text-beige">Descripción</th>
                    <th class="py-3 px-4 text-left text-beige">Precio</th>
                    <th class="py-3 px-4 text-center text-beige">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="py-3 px-4 text-white">{{ $product->name }}</td>
                        <td class="py-3 px-4 text-white">{{ $product->description }}</td>
                        <td class="py-3 px-4 text-white">${{ number_format($product->price, 2) }}</td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg">Editar</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-white py-3">No hay productos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
        

    </div>
</body>
</html>
