<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Barbero | Darketo</title>

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
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <header class="mb-8">
                <h1 class="text-3xl font-semibold text-white">Crear Barbero | Darketo</h1>
                <p class="text-gray-400 mt-2">Introduce los datos del nuevo Barbero</p>
            </header>

            <div class="bg-dark-300 rounded-xl shadow-xl p-6">
                <!-- Formulario para crear barbero -->
                <form action="{{ route('admin.barbers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" id="name" name="name" class="form-input w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-beige text-black" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-input w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-beige text-black" required>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto</label>
                        <input type="file" id="photo" name="photo" class="form-input w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-beige">
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-beige hover:bg-dark-200 text-white rounded-lg transition-all duration-300">Crear Barbero</button>
                    <button 
                            type="button" 
                            onclick="window.location.href='{{ route('admin.barbers.index') }}'" 
                             class="w-full py-3 px-4 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-all duration-300 mt-4">
                             Cancelar
                    </button>

                </form>
            </div>
        </div>
    </main>
</body>
</html>
