<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</head>
<body>

    <h1>Editar Producto</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control" id="description">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Precio</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}" required step="0.01">
        </div>

        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" name="image" class="form-control" id="image">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Imagen del producto" width="100">
            @endif
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Producto</button>
    </form>

</body>
</html>