<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Términos y Condiciones | Barbería DARKETO</title>
    <link rel="icon" href="{{ asset('images/terminos.png') }}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');

        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #BC9355;
            --accent-color: #FF4433;
            --text-color: #e2e8f0;
            --bg-color: #121212;
            --card-bg: #1E1E1E;
            --gradient: linear-gradient(135deg, var(--secondary-color), #8B6B43);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.8;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
        }

        .header::after {
            content: '';
            display: block;
            width: 100px;
            height: 3px;
            background: var(--gradient);
            margin: 2rem auto;
        }

        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .logo-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
        }

        h1 {
            font-family: 'Oswald', sans-serif;
            font-size: 3rem;
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .policy-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(188, 147, 85, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .policy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-family: 'Oswald', sans-serif;
            color: var(--secondary-color);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        p {
            color: #a0a0a0;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .contact-section {
            text-align: center;
            margin-top: 4rem;
            padding: 2rem;
            background: linear-gradient(rgba(188, 147, 85, 0.1), rgba(188, 147, 85, 0.05));
            border-radius: 15px;
        }

        .btn-contact {
            display: inline-block;
            padding: 1rem 2rem;
            background: var(--gradient);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-contact:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(188, 147, 85, 0.3);
        }

        a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #d4af7a;
        }

        @media (max-width: 768px) {
            .container {
                padding: 2rem 1rem;
            }

            h1 {
                font-size: 2.5rem;
            }

            .policy-card {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }
        }

        .home-link {
            text-align: center;
            bottom: 2rem;
            left: 50%; 
            transform: translateX(-50%); 
            font-size: 1.2rem;
        }

        .home-link a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease, text-decoration 0.3s ease; /* Suaviza la transición del color y subrayado */
        }

        .home-link a:hover {
            text-decoration: underline;
            color: var(--hover-color, #e2e8f0); /* Color de hover personalizable */

        }
    </style>
</head>
<body>

    <div class="container">

        <!-- Enlace a la página principal -->
        <div class="home-link" >
            <p>Ir a la <a href="{{ url('/') }}">Página Principal</a></p>
        </div>
        <div class="header">
            <div class="logo-section">
                <i class="fas fa-cut logo-icon"></i>
            </div>
            <h1>Términos y Condiciones</h1>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-file-contract"></i> Introducción</h2>
            <p>Estos Términos y Condiciones regulan el uso de nuestro sitio web y los servicios ofrecidos por Barbería DARKETO. Al acceder o utilizar nuestro sitio, aceptas estos términos.</p>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-cut"></i> 1. Servicios</h2>
            <p>Ofrecemos servicios de barbería y venta de productos relacionados. Al realizar una compra o reservar una cita, confirmas que has leído y aceptado estos términos.</p>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-credit-card"></i> 2. Pagos</h2>
            <p>Los pagos se realizan en línea de manera segura a través de nuestro sitio web. Aceptamos PayPal y tarjetas de crédito. Los precios están sujetos a cambios sin previo aviso.</p>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-calendar-alt"></i> 3. Cancelaciones y Reembolsos</h2>
            <p>Las citas pueden ser canceladas o reprogramadas hasta 24 horas antes de la hora reservada. No se otorgarán reembolsos para cancelaciones fuera de este plazo.</p>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-copyright"></i> 4. Propiedad Intelectual</h2>
            <p>Todo el contenido en nuestro sitio, incluyendo logotipos y gráficos, es propiedad de Barbería DARKETO y está protegido por derechos de autor.</p>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-sync-alt"></i> 5. Cambios en los Términos</h2>
            <p>Nos reservamos el derecho de actualizar estos Términos y Condiciones en cualquier momento. Te recomendamos revisarlos periódicamente.</p>
        </div>

        <div class="contact-section">
            <p>Para más información, por favor</p>
            <a href="{{ route('contact-us') }}" class="btn-contact">Contáctanos</a>
        </div>
    </div>


    <footer class="footer">
        <p>
            &copy; 2024 Barbería DARKETO. Todos los derechos reservados.
            <a href="{{ route('privacy-policy') }}">Política de Privacidad</a> |
            <a href="{{ route('terms-and-conditions') }}">Términos y Condiciones</a> |
            <a href="{{ route('contact-us') }}">Contáctanos</a>
        </p>
    </footer>
</body>
</html>