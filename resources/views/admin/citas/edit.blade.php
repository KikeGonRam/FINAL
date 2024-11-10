<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Cita | Darketo</title>
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

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <header class="mb-8">
                <h1 class="text-3xl font-semibold text-white">Editar Cita</h1>
                <p class="text-gray-400 mt-2">Modifica los datos Citas</p>
            </header>

        <!-- Mensaje de éxito o error -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Formulario de edición -->
        <form action="{{ route('admin.citas.update', $cita->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <!-- Selección de cliente -->
            <div class="form-group">
                <label for="cliente_id" class="text-lg font-semibold text-black">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black" required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $cliente->id == $cita->cliente_id ? 'selected' : '' }}>{{ $cliente->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Selección de barbero -->
            <div class="form-group">
                <label for="barber_id" class="text-lg font-semibold text-black" >Barbero</label>
                <select name="barber_id" id="barber_id" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black" required>
                    @foreach($barberos as $barber)
                        <option value="{{ $barber->id }}" {{ $barber->id == $cita->barber_id ? 'selected' : '' }}>{{ $barber->name }}</option>
                    @endforeach
                </select>
                
            </div>

            <!-- Campo para seleccionar el estado de la cita -->
<div class="form-group">
    <label for="estado" class="text-lg font-semibold text-black">Estado</label>
    <select name="estado" id="estado" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black" required>
        <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="aceptada" {{ $cita->estado == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
        <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
    </select>
</div>


            <!-- Fecha de la cita -->
            <div class="form-group">
                <label for="fecha" class="text-lg font-semibold text-black">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black" value="{{ $cita->fecha }}" required>
            </div>

            <!-- Hora de la cita -->
            <div class="form-group">
                <label for="hora" class="text-lg font-semibold text-black">Hora</label>
                <input type="time" name="hora" id="hora" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black" value="{{ $cita->hora }}" required>
            </div>

            <!-- Botón de actualización -->
            <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition duration-300">Actualizar Cita</button>
            <button type="submit" class="w-full bg-red-600 text-white font-semibold py-3 rounded-lg hover:bg-red-700 transition duration-300">Cancelar</button>

        </form>

        </div>
    </main>
</body>
</html>