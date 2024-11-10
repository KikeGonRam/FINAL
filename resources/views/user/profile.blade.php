<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil de Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Menú de navegación -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex items-center justify-between p-4">
            <a class="text-lg font-bold text-gray-800" href="#">Barbería DARKETO</a>
            <button class="md:hidden p-2 text-gray-800 focus:outline-none focus:ring-2" aria-label="Toggle navigation">
            </button>
        </div>
    </nav>

    <div class="flex flex-1 min-h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 h-full bg-gray-800 text-white p-6">
            <h3 class="text-center text-xl font-bold mb-6">Panel de Usuario</h3>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('user.dashboard') }}" class="active bg-gray-700 p-2 rounded-md text-center">Dashboard</a>
                <a href="{{ route('user.profile') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Perfil</a>
                <a href="{{ route('user.citas.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Gestionar Citas</a>
                <a href="{{ route('user.productos.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Productos</a>
                <!-- Formulario para cerrar sesión -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md mt-4">Cerrar sesión</button>
                </form>
            </nav>
        </div>

        <!-- Contenedor de perfil de usuario -->
        <div class="flex-1 bg-white p-6">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-semibold text-gray-800">Perfil de {{ $user->name }}</h2>
            </div>

            <!-- Imagen del perfil -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 text-center">Foto de Perfil</h3>
                <div class="text-center mt-4">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de perfil"
                            class="w-32 h-32 object-cover rounded-full mx-auto">
                        <form action="{{ route('user.profile.deletePhoto') }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta foto?')">
                            @csrf
                            <button type="submit"
                                class="mt-4 py-2 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">Eliminar Foto</button>
                        </form>
                    @else
                        <p class="text-gray-600">No hay foto disponible. Por favor, agrega una foto de perfil.</p>
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar por defecto"
                            class="w-32 h-32 object-cover rounded-full mx-auto mt-4">
                    @endif
                </div>
            </div>

            <!-- Formulario para actualizar la información del perfil -->
            <div class="bg-white p-6 rounded-lg shadow-md mt-8">
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full mt-2 p-3 border border-gray-300 rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full mt-2 p-3 border border-gray-300 rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="photo" class="block text-lg font-medium text-gray-700">Foto de perfil</label>
                        <input type="file" id="photo" name="photo"
                            class="w-full mt-2 p-3 border border-gray-300 rounded-lg">
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Actualizar Perfil</button>
                </form>
            </div>

        </div>
    </div>

</body>

</html>
