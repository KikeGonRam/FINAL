<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barberos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white font-sans p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Lista de Barberos</h1>

    <!-- Contenedor de la tabla -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto bg-gray-800 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-700 text-gray-100">
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Foto</th>
                    <th class="px-6 py-3 text-left">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $barber)
                    <tr class="bg-gray-700 hover:bg-gray-600">
                        <td class="px-6 py-3">{{ $barber->id }}</td>
                        <td class="px-6 py-3">{{ $barber->name }}</td>
                        <td class="px-6 py-3">
                            <img src="{{ asset('storage/barber_photos/' . $barber->photo) }}" alt="{{ $barber->name }}" class="w-20 h-20 rounded-full">
                        </td>
                        <td class="px-6 py-3">{{ $barber->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
