<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad | Barbería DARKETO</title>
    <link rel="icon" href="{{ asset('images/politica.png') }}" type="image/png">
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
        }

        .subtitle {
            color: var(--secondary-color);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
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

        .policy-card h2 {
            font-family: 'Oswald', sans-serif;
            color: var(--secondary-color);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .policy-card h2 i {
            font-size: 1.5rem;
        }

        .policy-card p {
            color: #a0a0a0;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .policy-card ul {
            list-style: none;
            margin: 1rem 0;
            padding-left: 1.5rem;
        }

        .policy-card ul li {
            color: #a0a0a0;
            margin-bottom: 0.5rem;
            position: relative;
        }

        .policy-card ul li::before {
            content: '•';
            color: var(--secondary-color);
            position: absolute;
            left: -1.5rem;
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

        .footer {
            text-align: center;
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(188, 147, 85, 0.1);
            color: #707070;
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

            .policy-card h2 {
                font-size: 1.5rem;
            }
        }

        a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #d4af7a;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Enlace a la página principal -->
        <div class="home-link" >
            <p>Ir a la <a href="{{ url('/') }}">Página Principal</a></p>
        </div>
        
        <header class="header">
            <div class="logo-section">
                <i class="fas fa-cut logo-icon"></i>
                <h2>DARKETO</h2>
            </div>
            <h1>Política de Privacidad</h1>
            <p class="subtitle">Tu privacidad es nuestra prioridad. Conoce cómo protegemos y manejamos tu información personal.</p>
        </header>

        <div class="policy-card">
            <h2><i class="fas fa-shield-alt"></i> Información que Recopilamos</h2>
            <p>Para brindarte el mejor servicio, recopilamos la siguiente información:</p>
            <ul>
                <li>Datos personales (nombre, correo electrónico, teléfono)</li>
                <li>Preferencias de servicios y horarios</li>
                <li>Historial de citas y servicios</li>
                <li>Información de pago (procesada de forma segura)</li>
            </ul>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-tasks"></i> Uso de la Información</h2>
            <p>Utilizamos tu información para:</p>
            <ul>
                <li>Gestionar tus citas y reservas</li>
                <li>Personalizar tu experiencia</li>
                <li>Enviar recordatorios importantes</li>
                <li>Mejorar nuestros servicios</li>
            </ul>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-user-shield"></i> Protección de Datos</h2>
            <p>Implementamos estrictas medidas de seguridad para proteger tu información:</p>
            <ul>
                <li>Encriptación de datos sensibles</li>
                <li>Acceso restringido a personal autorizado</li>
                <li>Monitoreo constante de seguridad</li>
                <li>Copias de seguridad regulares</li>
            </ul>
        </div>

        <div class="policy-card">
            <h2><i class="fas fa-user-lock"></i> Tus Derechos</h2>
            <p>Como usuario, tienes derecho a:</p>
            <ul>
                <li>Acceder a tu información personal</li>
                <li>Solicitar correcciones o actualizaciones</li>
                <li>Pedir la eliminación de tus datos</li>
                <li>Oponerte al procesamiento de información</li>
            </ul>
        </div>

        <div class="contact-section">
            <h2>¿Tienes Preguntas?</h2>
            <p>Estamos aquí para ayudarte con cualquier duda sobre tu privacidad</p>
            <a href="{{ route('contact-us') }}" class="btn-contact">Contáctanos</a>
        </div>

        <footer class="footer">
            <p>
                &copy; 2024 Barbería DARKETO. Todos los derechos reservados.
                <a href="{{ route('privacy-policy') }}">Política de Privacidad</a> |
                <a href="{{ route('terms-and-conditions') }}">Términos y Condiciones</a> |
                <a href="{{ route('contact-us') }}">Contáctanos</a>
            </p>
        </footer>
    </div>
</body>
</html>
