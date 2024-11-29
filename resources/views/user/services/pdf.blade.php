<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .container {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .service-details {
            margin-top: 30px;
            text-align: left;
        }
        .service-details p {
            font-size: 18px;
            line-height: 1.6;
        }
        .price {
            font-size: 22px;
            font-weight: bold;
            color: #e74c3c;
        }
        .payment-info {
            margin-top: 40px;
            font-size: 16px;
            font-weight: bold;
            color: #16a085;
        }
        .footer {
            margin-top: 50px;
            font-size: 14px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>{{ $service->name }}</h1>

        <div class="service-details">
            <p><strong>Descripción del Servicio:</strong></p>
            <p>{{ $service->description }}</p>
            
            <p><strong>Duración Estimada:</strong> {{ $service->duration }} minutos</p>

            <p class="price"><strong>Precio:</strong> ${{ number_format($service->price, 2) }}</p>
        </div>

        <div class="payment-info">
            <p><strong>Forma de Pago:</strong></p>
            <p>Este servicio puede ser pagado en efectivo o mediante transferencia bancaria.</p>
            <p>Si desea pagar en efectivo, simplemente abone el monto al final de su cita.</p>
        </div>

        <div class="footer">
            <p>Gracias por elegirnos. Esperamos que disfrute de su experiencia con nosotros.</p>
            <p>Para más información, no dude en contactarnos.</p>
        </div>
    </div>

</body>
</html>
