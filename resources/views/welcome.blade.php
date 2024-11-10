<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos a Barbería DARKETO</title>
    <link rel="icon" href="{{ asset('images/barber.png') }}" type="image/png">

    <!-- Asegúrate de incluir el CSS correcto -->
    @vite('resources/css/welcome.css')
</head>
<body>
    <!-- Barra de navegación superior -->
    <header>
        <div class="navbar">
            <div class="logo">
                <h2>Barbería DARKETO</h2>
            </div>
            <div class="auth-links">
                <!-- Si el usuario ya está autenticado, mostrar su nombre -->
                @auth
                    <span>Bienvenido, {{ Auth::user()->name }}!</span>
                    <a href="{{ route('logout') }}" class="btn btn-logout">Cerrar sesión</a>
                @else
                    <!-- Enlace de inicio de sesión para el barbero -->
                    <a href="{{ route('barber.login') }}" class="btn btn-login">Iniciar sesión como Barbero</a>
                    
                    <!-- Enlace de inicio de sesión para el administrador -->
                    <a href="{{ route('admin.login') }}" class="btn btn-login">Iniciar sesión como Administrador</a>
                    
                    <!-- Enlace de inicio de sesión para usuario normal -->
                    <a href="{{ route('login') }}" class="btn btn-login">Iniciar sesión</a>

                    <!-- Enlace de registro para nuevos usuarios -->
                    <a href="{{ route('register') }}" class="btn btn-register">Registrar</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Sección de bienvenida -->
    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenidos a Barbería DARKETO</h1>
            <p>Ofrecemos los mejores cortes de cabello y servicio al cliente. Reserva tu cita ahora.</p>
            <a href="{{ Auth::check() ? route('user.citas.create') : route('register') }}" class="btn btn-primary">
                Reservar Cita
            </a>
        </div>
    </section>

    <!-- Sección de quienes somos -->
    <section class="about">
        <h2>¿Quiénes Somos?</h2>
        <p>Somos un equipo de barberos apasionados por el estilo y la estética. En DARKETO ofrecemos cortes personalizados para cada uno de nuestros clientes, brindando una experiencia única.</p>
    </section>

    <!-- Sección de servicios -->
    <section class="services">
        <h2>Nuestros Servicios</h2>
        <ul>
            <li>Cortes de cabello</li>
            <li>Afeitado</li>
            <li>Arreglo de barba</li>
            <li>Tratamientos capilares</li>
        </ul>
    </section>

    <!-- Pie de página (footer) -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Barbería DARKETO. Todos los derechos reservados.</p>
    </footer>

    <!-- Incluir el JS -->
    @vite('resources/js/welcome.js')
</body>
</html>
