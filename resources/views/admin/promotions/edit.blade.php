<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- resources/views/admin/promotions/edit.blade.php --}}

    <h1>Editar Promoción</h1>

    <form action="{{ route('admin.promotions.update', $promotion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $promotion->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $promotion->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="discount">Descuento (%)</label>
            <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount', $promotion->discount) }}" min="0" max="100" required>
            @error('discount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="start_date">Fecha de Inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $promotion->start_date->toDateString()) }}" required>
            @error('start_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="end_date">Fecha de Fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $promotion->end_date->toDateString()) }}" required>
            @error('end_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Tipo de Promoción</label>
            <select name="type" id="type" class="form-control" required>
                <option value="service" {{ old('type', $promotion->type) == 'service' ? 'selected' : '' }}>Servicio</option>
                <option value="product" {{ old('type', $promotion->type) == 'product' ? 'selected' : '' }}>Producto</option>
                <option value="both" {{ old('type', $promotion->type) == 'both' ? 'selected' : '' }}>Ambos</option>
            </select>
            @error('type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_for_regular_customers">¿Solo para clientes habituales?</label>
            <input type="checkbox" name="is_for_regular_customers" id="is_for_regular_customers" {{ old('is_for_regular_customers', $promotion->is_for_regular_customers) ? 'checked' : '' }}>
            @error('is_for_regular_customers')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Promoción</button>
        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>


</body>
</html>