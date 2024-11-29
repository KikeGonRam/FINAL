<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos | Barbería DARKETO</title>
    <link rel="icon" href="{{ asset('images/contacto.png') }}" type="image/png">
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
            --input-bg: #262626;
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

        .contact-info-card, .contact-form-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(188, 147, 85, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-info-card:hover, .contact-form-card:hover {
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

        .contact-info {
            display: grid;
            gap: 1rem;
            margin-top: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(188, 147, 85, 0.1);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(188, 147, 85, 0.2);
        }

        .contact-item i {
            color: var(--secondary-color);
            font-size: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-weight: 500;
        }

        input, textarea {
            width: 100%;
            padding: 1rem;
            background: var(--input-bg);
            border: 1px solid rgba(188, 147, 85, 0.2);
            border-radius: 8px;
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(188, 147, 85, 0.2);
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        button {
            background: var(--gradient);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            width: 100%;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(188, 147, 85, 0.3);
        }

        @media (max-width: 768px) {
            .container {
                padding: 2rem 1rem;
            }

            h1 {
                font-size: 2.5rem;
            }

            .contact-info-card, .contact-form-card {
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

        <div class="header">
            <div class="logo-section">
                <i class="fas fa-cut logo-icon"></i>
            </div>
            <h1>Contáctanos</h1>
            <p>Nos encantaría saber de ti. Si tienes preguntas, comentarios o necesitas asistencia, no dudes en ponerte en contacto con nosotros.</p>
        </div>

        <div class="contact-info-card">
            <h2><i class="fas fa-address-card"></i> Información de Contacto</h2>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Teléfono</strong><br>
                        +123 456 7890
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email</strong><br>
                        contacto@darketo.com
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Dirección</strong><br>
                        Av. Principal #123, Ciudad, País
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form-card">
            <h2><i class="fas fa-paper-plane"></i> Envíanos un Mensaje</h2>
            <!-- Formulario que usará AJAX para enviar datos sin recargar la página -->
            <form id="contactForm">
                @csrf <!-- Token de seguridad de Laravel -->
                
                <!-- Campo para el nombre -->
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" required>
                </div>
        
                <!-- Campo para el correo electrónico -->
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>
        
                <!-- Campo para el mensaje o detalles -->
                <div class="form-group">
                    <label for="details">Detalles</label>
                    <textarea id="details" name="details" required></textarea>
                </div>
        
                <!-- Botón para enviar el formulario -->
                <button type="submit"><i class="fas fa-paper-plane"></i> Enviar Mensaje</button>
            </form>
        
            <!-- Área donde se mostrará el mensaje de éxito o error -->
            <div id="responseMessage" class="mt-4"></div>
        </div>
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <script>
            $(document).ready(function () {
                $('#contactForm').on('submit', function (e) {
                    e.preventDefault(); // Evitar el envío tradicional del formulario
        
                    // Obtener los datos del formulario
                    var formData = $(this).serialize();
        
                    // Enviar los datos por AJAX
                    $.ajax({
                        url: "{{ route('contacts.store') }}", // Ruta para almacenar el contacto
                        type: "POST",
                        data: formData,
                        success: function (response) {
                            // Mostrar mensaje de éxito
                            $('#responseMessage').html('<p class="text-green-500">¡Mensaje enviado exitosamente!</p>');
        
                            // Limpiar el formulario
                            $('#contactForm')[0].reset();
                        },
                        error: function (xhr) {
                            // Mostrar mensaje de error si algo sale mal
                            $('#responseMessage').html('<p class="text-red-500">Hubo un error, por favor intenta nuevamente.</p>');
                        }
                    });
                });
            });
        </script>
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