<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administrador</title>
    <link rel="icon" href="{{ asset('images/admin.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #f39c12;
            --hover-color: #e67e22;
            --background-dark: #1a1a1a;
            --input-bg: #2a2a2a;
            --text-color: #ffffff;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        body {
            margin: 0;
            padding: 0;
            background: #000;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Partículas originales mejoradas */
        .particle {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, 
                rgba(243, 156, 18, 0.1) 0%, 
                rgba(0, 0, 0, 0.8) 50%,
                rgba(230, 126, 34, 0.1) 100%
            );
            pointer-events: none;
            animation: float 20s infinite linear;
        }

        .particle:nth-child(2) {
            animation-duration: 25s;
            animation-delay: -5s;
            opacity: 0.5;
        }

        .particle:nth-child(3) {
            animation-duration: 30s;
            animation-delay: -10s;
            opacity: 0.3;
        }

        @keyframes float {
            0% {
                transform: translate(-50%, -50%) rotate(0deg) scale(1);
            }
            50% {
                transform: translate(-50%, -50%) rotate(180deg) scale(1.1);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg) scale(1);
            }
        }

        .login-container {
            background: rgba(34, 34, 34, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 400px;
            position: relative;
            z-index: 2;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideIn 1s forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 120px;
            height: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        h2 {
            color: var(--text-color);
            font-size: 2em;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.2em;
        }

        input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            background: var(--input-bg);
            border: 2px solid transparent;
            border-radius: 10px;
            color: var(--text-color);
            font-size: 1em;
            outline: none;
        }

        input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(243, 156, 18, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary-color);
        }

        button {
            width: 100%;
            padding: 15px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            background: var(--hover-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(243, 156, 18, 0.2);
        }

        button:active {
            transform: translateY(0);
        }

        .error {
            background: rgba(231, 76, 60, 0.1);
            border-left: 4px solid var(--error-color);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .error ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .error li {
            color: var(--error-color);
            font-size: 0.9em;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Loading animation for button */
        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #fff;
            border-radius: 50%;
            border-left-color: transparent;
            animation: rotate 1s infinite linear;
        }

        @keyframes rotate {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Partículas animadas -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="login-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Barbería" class="logo">
        </div>
        <h2>Acceso Administrador</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" id="loginForm">
            @csrf
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required>
            </div>
            
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <i class="fas fa-eye password-toggle" id="passwordToggle"></i>
            </div>

            <button type="submit" id="submitBtn">Iniciar Sesión</button>
        </form>
    </div>

    <script>
        // Toggle password visibility
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordInput = document.getElementById('password');

        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Form submission with loading state
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');

        loginForm.addEventListener('submit', function(e) {
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = 'Iniciando sesión...';
        });

        // Input validation and feedback
        const inputs = document.querySelectorAll('input');

        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.validity.valid) {
                    this.style.borderColor = 'var(--success-color)';
                } else {
                    this.style.borderColor = 'var(--error-color)';
                }
            });
        });
    </script>
</body>
</html>