<!DOCTYPE html>
<html>
<head>
    <title>Citas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
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

        /* Estilo para la marca de agua */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: -1;
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
                    <td>{{ $appointment->barber->name }}</td>
                    <td>{{ $appointment->cliente->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->fecha . ' ' . $appointment->hora)->format('d/m/Y H:i') }}</td>
                    <td>{{ $appointment->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
