<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
        }
        ul {
            list-style-type: none;
        }
    </style>
</head>
<body>
    <h1>Ticket de Compra</h1>

    <p>Gracias por tu compra en Darketo. Aquí está el resumen de tu compra:</p>

    <ul>
        @foreach ($cart->items as $item)
            <li>{{ $item->name }} - ${{ $item->price }}</li>
        @endforeach
    </ul>

    <p class="total">Total: ${{ $cart->total }}</p>

    <p>Fecha de compra: {{ $cart->created_at }}</p>

    <p>Si tienes alguna pregunta, por favor contacta a <strong>admin@darketo.com</strong></p>
</body>
</html>
