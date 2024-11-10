<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Cita</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Editar Cita</h1>

        <form action="{{ route('user.citas.update', $cita->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="barber_id" class="block text-lg font-medium text-gray-700">Barbero</label>
                <select name="barber_id" id="barber_id" class="mt-2 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    @foreach($barbers as $barber)
                        <option value="{{ $barber->id }}" {{ $barber->id == $cita->barber_id ? 'selected' : '' }}>
                            {{ $barber->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-lg font-medium text-gray-700">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="mt-2 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ $cita->fecha }}" required>
            </div>

            <div class="mb-4">
                <label for="hora" class="block text-lg font-medium text-gray-700">Hora</label>
                <input type="time" name="hora" id="hora" class="mt-2 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ $cita->hora }}" required>
            </div>

            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Actualizar Cita</button>
        </form>

    </div>

</body>

</html>
