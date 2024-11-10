<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/icono.png') }}" type="image/png">

</head>
<body>
    {{-- resources/views/barber/citas/create.blade.php --}}

    <div class="container">
        <h1>Crear Nueva Cita</h1>

        {{-- Mostrar errores o mensajes de éxito --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario para crear una cita --}}
        <form action="{{ route('barber.citas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="barber_id">Barbero</label>
                <input type="text" name="barber_id" value="{{ Auth::user()->id }}" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Crear Cita</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>