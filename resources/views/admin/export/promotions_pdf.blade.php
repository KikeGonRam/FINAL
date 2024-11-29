{{-- resources/views/admin/promotions/pdf.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promociones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Listado de Promociones</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Descuento (%)</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Tipo</th>
                <th>Para Clientes Habituales</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $promotion)
                <tr>
                    <td>{{ $promotion->name }}</td>
                    <td>{{ $promotion->description }}</td>
                    <td>{{ $promotion->discount }}%</td>
                    <td>{{ $promotion->start_date->format('d/m/Y') }}</td>
                    <td>{{ $promotion->end_date->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($promotion->type) }}</td>
                    <td>{{ $promotion->is_for_regular_customers ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
