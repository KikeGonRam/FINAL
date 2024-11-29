<!DOCTYPE html>
<html>
<head>
    <title>Export Users</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .icon {
            width: 24px;
            height: 24px;
            vertical-align: middle;
        }

        .title {
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>
<body>
    <h1 class="title">
        <img src="{{ asset('images/pdf.png') }}" alt="PDF Icon" class="icon">
        Lista de Usuarios
    </h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de perfil" width="100" height="100">
                    </td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
