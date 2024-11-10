<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de las citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    
<div class="container">
    <h1>Detalles de la Cita</h1>
    <p><strong>ID:</strong> {{ $cita->id }}</p>
    <p><strong>Cliente:</strong> {{ $cita->cliente->name }}</p>
    <p><strong>Barbero:</strong> {{ $cita->barber->name }}</p>
    <p><strong>Fecha:</strong> {{ $cita->fecha }}</p>
    <p><strong>Hora:</strong> {{ $cita->hora }}</p>
    <p><strong>Estado:</strong> {{ $cita->estado }}</p>
    <a href="{{ route('admin.citas.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
<!-- Incluir Bootstrap JS y dependencias desde un CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>