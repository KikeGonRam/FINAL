<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promoción - {{ $promotion->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }
        .content p {
            margin: 10px 0;
            font-size: 16px;
            line-height: 1.6;
        }
        .content p strong {
            color: #007bff;
        }
        .highlight {
            background-color: #e9f7fe;
            border-left: 5px solid #007bff;
            padding: 10px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px auto;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Promoción: {{ $promotion->name }}</div>

        <div class="content">
            <p><strong>Descripción:</strong> {{ $promotion->description }}</p>
            <p><strong>Descuento:</strong> {{ $promotion->discount }}%</p>
            <p><strong>Válida desde:</strong> {{ $promotion->start_date->format('d/m/Y') }} <strong>hasta:</strong> {{ $promotion->end_date->format('d/m/Y') }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($promotion->type) }}</p>
        </div>

        <div class="highlight">
            ¡Aprovecha esta promoción y ahorra en tus compras! No dejes pasar la oportunidad de obtener tus productos favoritos a un precio especial.
        </div>

        <div class="footer">
            <p>Gracias por interesarte en nuestras promociones. Si tienes dudas, contáctanos en <strong>admin@darketo.com</strong>.</p>
        </div>
    </div>
</body>
</html>
