<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exportar Tablas</title>
    <link rel="icon" href="{{ asset('images/admin.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Exportar Datos de las Tablas</h1>
        
        <!-- Tabla de usuarios -->
        <h3>Usuarios</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <!-- Opciones para exportar -->
                            <a href="{{ route('admin.export', ['format' => 'pdf', 'table' => 'users']) }}" class="btn btn-primary btn-sm">PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Agregar más tablas según sea necesario -->

    </div>

    <!-- Agregar script de Bootstrap para las funcionalidades interactivas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
