<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Servicios</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        h1 { text-align: center; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f4f4f4; text-align: left; }
    </style>
</head>
<body>
    <h1>Listado de Servicios</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio (MXN)</th>
                <th>Duración (minutos)</th>
                <th>Fechas Especiales</th>
                <th>Paquetes Especiales</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->price }}</td>
                    <td>{{ $service->duration }}</td>
                    <td>{{ $service->special_dates ? 'Sí' : 'No' }}</td>
                    <td>{{ $service->special_packages }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
