<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Editar usuario - Panel de administración Darketo">
    <title>Editar Usuario | Darketo</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/admin.png') }}" type="image/png">
    
    <!-- External CSS -->
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
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
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

        .form-input:focus {
            box-shadow: 0 0 0 2px rgba(212, 184, 149, 0.2);
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
                <a href="{{ route('admin.')}}" class="sidebar-link flex items-center gap-3 py-3 px-4 rounded-lg text-beige hover:bg-dark-200 transition-all duration-300">
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

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <header class="mb-8">
                <h1 class="text-3xl font-semibold text-white">Editar Usuario</h1>
                <p class="text-gray-400 mt-2">Modifica los datos del usuario</p>
            </header>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-md flex items-center gap-3">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Card -->
            <div class="bg-dark-300 rounded-xl shadow-xl p-6">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-beige">
                            Nombre
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full px-4 py-2 bg-dark-200 border border-dark-100 rounded-lg focus:outline-none focus:border-beige text-white placeholder-gray-500 form-input"
                        >
                    </div>

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-beige">
                            Correo Electrónico
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full px-4 py-2 bg-dark-200 border border-dark-100 rounded-lg focus:outline-none focus:border-beige text-white placeholder-gray-500 form-input"
                        >
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-beige">
                            Nueva Contraseña <span class="text-gray-400">(opcional)</span>
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="w-full px-4 py-2 bg-dark-200 border border-dark-100 rounded-lg focus:outline-none focus:border-beige text-white placeholder-gray-500 form-input"
                            placeholder="Deja en blanco para mantener la contraseña actual"
                        >
                        <p class="text-sm text-gray-400 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Deja este campo en blanco si no deseas cambiar la contraseña
                        </p>
                    </div>

                    <!-- Password Confirmation Field -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-beige">
                            Confirmar Nueva Contraseña
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="w-full px-4 py-2 bg-dark-200 border border-dark-100 rounded-lg focus:outline-none focus:border-beige text-white placeholder-gray-500 form-input"
                            placeholder="Confirma la nueva contraseña"
                        >
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-300 flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            <span>Guardar Cambios</span>
                        </button>
                        
                        <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors duration-300 flex items-center gap-2">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>