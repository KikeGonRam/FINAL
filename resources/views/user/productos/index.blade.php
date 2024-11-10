<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Productos</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Menú de navegación -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
        <div class="container mx-auto flex items-center justify-between p-4">
            <a class="text-xl font-bold text-white" href="#">Barbería DARKETO</a>
        </div>
    </nav>

    <div class="flex">

        <!-- Sidebar -->
        <div class="w-1/5 h-screen bg-gray-800 text-white p-6">
            <h3 class="text-center text-2xl font-bold mb-6">Panel de Usuario</h3>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('user.dashboard') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('user.profile') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Perfil</a>
                <a href="{{ route('user.citas.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Gestionar Citas</a>
                <a href="{{ route('user.productos.index') }}" class="p-2 rounded-md text-center hover:bg-gray-700">Ver Productos</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md mt-6">Cerrar sesión</button>
                </form>
            </nav>
        </div>

        <!-- Contenido Principal -->
        <div class="flex-1 p-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-10 text-center">Nuestros Productos</h1>

            <!-- Lista de productos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                @foreach($productos as $producto)
                    <div class="bg-white rounded-lg shadow-2xl overflow-hidden transform transition hover:scale-110 hover:shadow-3xl duration-300">
                        <div class="overflow-hidden rounded-t-lg">
                            <img src="{{ asset('storage/'.$producto->image) }}" alt="{{ $producto->name }}" class="w-full h-52 object-cover transform transition hover:scale-105 duration-300">
                        </div>
                        <div class="p-6">
                            <h5 class="text-2xl font-semibold text-gray-900 mb-2">{{ $producto->name }}</h5>
                            <p class="text-gray-700 text-sm mb-4">{{ Str::limit($producto->description, 80) }}</p>
                            <p class="text-xl font-bold text-gray-800 mb-4"><span class="text-green-600">$</span>{{ number_format($producto->price, 2) }}</p>
                            
                            <!-- Botones de acción -->
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold py-2 rounded-lg hover:from-blue-700 hover:to-blue-900 transition duration-300">
                                Agregar al carrito
                            </button>

                            <!-- Botón de compra (opcional, puede ser redirigido a un proceso de pago) -->
                            <button class="w-full bg-gradient-to-r from-green-600 to-green-800 text-white font-semibold py-2 rounded-lg hover:from-green-700 hover:to-green-900 transition duration-300">
                                Comprar ahora
                            </button>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</body>

</html>
