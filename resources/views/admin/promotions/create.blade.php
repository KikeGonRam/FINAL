<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Promoción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <h1>Crear Nueva Promoción</h1>

        <form action="{{ route('admin.promotions.store') }}" method="POST">
            @csrf

            <!-- Nombre -->
            <div class="form-group mb-3">
                <label for="name">Nombre de la Promoción</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="form-group mb-3">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Descuento -->
            <div class="form-group mb-3">
                <label for="discount">Descuento (%)</label>
                <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount') }}" min="0" max="100" required>
                @error('discount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Fecha de Inicio -->
            <div class="form-group mb-3">
                <label for="start_date">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Fecha de Fin -->
            <div class="form-group mb-3">
                <label for="end_date">Fecha de Fin</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
                @error('end_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tipo de Promoción -->
            <div class="form-group mb-3">
                <label for="type">Tipo de Promoción</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="service" {{ old('type') == 'service' ? 'selected' : '' }}>Servicio</option>
                    <option value="product" {{ old('type') == 'product' ? 'selected' : '' }}>Producto</option>
                    <option value="both" {{ old('type') == 'both' ? 'selected' : '' }}>Ambos</option>
                </select>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Clientes Habituales -->
            <div class="form-group mb-3">
                <label for="is_for_regular_customers">¿Solo para clientes habituales?</label>
                <input type="checkbox" name="is_for_regular_customers" id="is_for_regular_customers" {{ old('is_for_regular_customers') ? 'checked' : '' }}>
                @error('is_for_regular_customers')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones -->
            <button type="submit" class="btn btn-success">Guardar Promoción</button>
            <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
