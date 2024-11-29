<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos - Exportación PDF</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 0.5px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        td {
            font-size: 0.95em;
        }

        /* Columnas específicas */
        td:nth-child(1) { /* ID */
            font-weight: bold;
            color: #3498db;
            width: 8%;
        }

        td:nth-child(2) { /* Nombre */
            width: 20%;
        }

        td:nth-child(3) { /* Email */
            width: 25%;
            color: #2980b9;
        }

        td:nth-child(4) { /* Mensaje */
            width: 32%;
        }

        td:nth-child(5) { /* Fecha */
            width: 15%;
            color: #7f8c8d;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            th, td {
                padding: 8px;
                font-size: 0.9em;
            }

            h1 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <h1>Lista de Contactos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->details }}</td>
                    <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>