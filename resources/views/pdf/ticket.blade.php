<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .alert {
            margin: 20px 0;
            padding: 15px;
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
            border-radius: 5px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
            color: #343a40;
        }
        .note {
            margin-top: 20px;
            font-style: italic;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Gracias por tu compra!</h1>
        <div class="alert">
            <strong>Atención:</strong> Tu compra ha sido registrada con éxito. Tu forma de pago será **efectivo** al momento de la entrega.
        </div>
        <h3>Detalles de la compra:</h3>
        <ul>
            @foreach($cart->products as $product)
                <li>
                    <strong>Producto:</strong> {{ $product->name }}<br>
                    <strong>Cantidad:</strong> {{ $product->pivot->quantity }}<br>
                    <strong>Precio:</strong> ${{ $product->pivot->price }}<br>
                    <strong>Subtotal:</strong> ${{ $product->pivot->quantity * $product->pivot->price }}
                </li>
            @endforeach
        </ul>
        <p class="total">Total: ${{ $cart->total }}</p>
        <p class="note">Puedes pagar en efectivo al momento de la entrega. Gracias por tu preferencia.</p>
    </div>
</body>
</html>
