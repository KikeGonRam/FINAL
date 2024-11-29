<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $service->name }}</title>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-10 p-4">
        <h1 class="text-3xl font-bold text-center text-gray-800">{{ $service->name }}</h1>
        
        <div class="mt-6 max-w-2xl mx-auto shadow-lg rounded-lg overflow-hidden bg-white">
            <img 
                src="{{ $service->image_url ?? asset('images/service.jpeg') }}" 
                alt="{{ $service->name }}" 
                class="w-full h-72 object-cover rounded-t-lg">
            
            <div class="p-6">
                <p class="text-gray-700 text-lg mb-4">{{ $service->description }}</p>
                <p class="text-gray-900 font-semibold text-xl"><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>
            </div>
        </div>

        <div class="flex justify-center mt-6">
            <a href="{{ route('user.services.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-300">Volver a servicios</a>
        </div>
    </div>

</body>
</html>
