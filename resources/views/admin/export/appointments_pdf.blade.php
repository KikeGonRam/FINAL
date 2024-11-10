<!DOCTYPE html>
<html>
<head>
    <title>Citas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Listado de Citas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Barbero</th>
                <th>Cliente</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->barber->name }}</td> <!-- Nombre del barbero -->
                    <td>{{ $appointment->cliente->name }}</td> <!-- Nombre del cliente -->
                    <td>{{ \Carbon\Carbon::parse($appointment->fecha . ' ' . $appointment->hora)->format('d/m/Y H:i') }}</td> <!-- Fecha y hora de la cita -->
                    <td>{{ $appointment->estado }}</td> <!-- Estado de la cita -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
