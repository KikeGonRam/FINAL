<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos a Barbería DARKETO</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/barber.png') }}" type="image/png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-color: #1E1E1E;
            --secondary-color: #BC9355;
            --accent-color: #FF4433;
            --light-color: #F5F5F5;
            --dark-color: #121212;
            --gradient: linear-gradient(135deg, var(--secondary-color), #8B6B43);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-color);
            color: var(--light-color);
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Oswald', sans-serif;
            text-transform: uppercase;
        }

        /* Navbar Styles */
        .navbar {
            background-color: rgba(18, 18, 18, 0.95);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            z-index: 1000;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(188, 147, 85, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-icon {
            font-size: 2rem;
            color: var(--secondary-color);
        }

        .logo h2 {
            color: var(--light-color);
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .auth-links {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .btn-login {
            background-color: transparent;
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        .btn-login:hover {
            background-color: var(--secondary-color);
            color: var(--dark-color);
            transform: translateY(-2px);
        }

        .btn-register {
            background: var(--gradient);
            color: var(--light-color);
            border: none;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(188, 147, 85, 0.3);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                        url('/api/placeholder/1920/1080') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(to top, var(--dark-color), transparent);
        }

        .hero-content {
            max-width: 900px;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: var(--light-color);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #e0e0e0;
        }

        .btn-primary {
            background: var(--gradient);
            color: var(--light-color);
            padding: 1.2rem 2.5rem;
            font-size: 1.1rem;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(188, 147, 85, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(188, 147, 85, 0.4);
        }

        /* Services Grid */
        .services {
            padding: 8rem 5%;
            background-color: var(--primary-color);
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .service-card {
            background: var(--dark-color);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
            border: 1px solid rgba(188, 147, 85, 0.1);
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .service-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .service-card h3 {
            color: var(--light-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .service-card p {
            color: #a0a0a0;
            font-size: 0.9rem;
        }

        /* About Section */
        .about {
            padding: 8rem 5%;
            background-color: var(--dark-color);
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .about h2 {
            color: var(--secondary-color);
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        .about p {
            color: #a0a0a0;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            background-color: var(--primary-color);
            padding: 4rem 5% 2rem;
            text-align: center;
            border-top: 1px solid rgba(188, 147, 85, 0.1);
        }

        .social-links {
            margin-bottom: 2rem;
        }

        .social-links a {
            color: var(--secondary-color);
            font-size: 1.5rem;
            margin: 0 1rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--light-color);
        }

        .footer p {
            color: #707070;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }

            .auth-links {
                margin-top: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .btn {
                padding: 0.6rem 1.2rem;
            }
        }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('images/barb.jpeg') }}') no-repeat center center;
            url('../imges/barb.jpeg') no-repeat center center;
    background-size: cover;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
}

.footer {
    background-color: #000;
    color: #fff;
    text-align: center;
    padding: 20px;
    font-family: Arial, sans-serif;
}

.social-links a {
    margin: 0 10px;
    color: #fff;
    font-size: 24px;
    transition: transform 0.3s ease, color 0.3s ease;
}

.social-links a:hover {
    transform: scale(1.2) rotate(10deg);
    color: #ffd700; /* Cambia el color en hover */
}

.social-links a:active {
    transform: scale(1.1) rotate(-10deg);
}

.footer p {
    margin: 10px 0;
}

.footer p a {
    color: #ffd700;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer p a:hover {
    color: #fff;
    text-decoration: underline;
}




    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <i class="fas fa-cut logo-icon"></i>
                <h2>DARKETO</h2>
            </div>
            <div class="auth-links">
                <a href="{{ route('barber.login') }}" class="btn btn-login"><i class="fas fa-user-tie"></i> Barbero</a>
                <a href="{{ route('admin.login') }}" class="btn btn-login"><i class="fas fa-user-shield"></i> Admin</a>
                <a href="{{ route('login')}}" class="btn btn-login"><i class="fas fa-user"></i> Cliente</a>
                <a href="{{ route('register')}}" class="btn btn-register"><i class="fas fa-user-plus"></i> Registrar</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>El Arte del Estilo Masculino</h1>
            <p>Descubre la experiencia única de un corte de cabello personalizado por maestros barberos. Tradición y estilo en cada detalle.</p>

                <a href="{{ route('register') }}" class="btn btn-primary">
                    <i class="far fa-calendar-alt"></i> Regístrate para reservar tu cita
                </a>
        </div>
    </section>
    

    <section class="services">
        <div class="section-title">
            <h2>Nuestros Servicios</h2>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <i class="fas fa-cut service-icon"></i>
                <h3>Corte de Cabello</h3>
                <p>Cortes personalizados adaptados a tu estilo y tipo de cabello, realizados por expertos barberos.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-razor service-icon"></i>
                <h3>Afeitado Clásico</h3>
                <p>Experimenta el ritual del afeitado tradicional con navaja y toallas calientes.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-beard service-icon"></i>
                <h3>Diseño de Barba</h3>
                <p>Perfilado y mantenimiento de barba para resaltar tus mejores rasgos.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-pump-soap service-icon"></i>
                <h3>Tratamientos</h3>
                <p>Tratamientos especializados para el cuidado del cabello y cuero cabelludo.</p>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="about-content">
            <h2>Nuestra Historia</h2>
            <p>Desde 2020, DARKETO se ha convertido en el referente del cuidado masculino en la ciudad. Combinamos técnicas tradicionales con las últimas tendencias para ofrecerte un servicio excepcional.</p>
            <p>Nuestro equipo de maestros barberos está comprometido con la excelencia y la satisfacción del cliente en cada visita.</p>
        </div>
    </section>

    <footer class="footer">
        <div class="social-links">
            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
            <a href="https://es-la.facebook.com/"><i class="fab fa-facebook"></i></a>
            <a href="https://web.whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
            <a href="https://www.tiktok.com/es/"><i class="fab fa-tiktok"></i></a>
        </div>
        <p>
            &copy; 2024 Barbería DARKETO. Todos los derechos reservados.
            <a href="{{ route('privacy-policy') }}">Política de Privacidad</a> |
            <a href="{{ route('terms-and-conditions') }}">Términos y Condiciones</a> |
            <a href="{{ route('contact-us') }}">Contáctanos</a>
        </p>
    </footer>
    
    
</body>
</html>