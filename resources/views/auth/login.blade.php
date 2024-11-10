<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Página de inicio de sesión para usuarios" />
    <title>Iniciar sesión</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              dmSans: ["DM Sans", "sans-serif"],
            },
            colors: {
              primary: {
                DEFAULT: '#000000',
                hover: '#1a1a1a'
              }
            },
            animation: {
              'fade-in': 'fadeIn 0.5s ease-in-out',
              'slide-up': 'slideUp 0.5s ease-out'
            },
            keyframes: {
              fadeIn: {
                '0%': { opacity: '0' },
                '100%': { opacity: '1' }
              },
              slideUp: {
                '0%': { transform: 'translateY(20px)', opacity: '0' },
                '100%': { transform: 'translateY(0)', opacity: '1' }
              }
            }
          },
        },
      };
    </script>

    <style>
      .form-group:focus-within i {
        color: #000;
        transform: translateX(-5px);
      }
      
      .form-input {
        transition: all 0.3s ease;
        padding-left: 2rem;
      }

      .form-input:focus::placeholder {
        opacity: 0;
        transform: translateX(10px);
      }

      .black-block {
        transition: transform 1s ease-in-out;
        transform-origin: center;
      }

      .error-shake {
        animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
      }

      @keyframes shake {
        10%, 90% { transform: translate3d(-1px, 0, 0); }
        20%, 80% { transform: translate3d(2px, 0, 0); }
        30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
        40%, 60% { transform: translate3d(4px, 0, 0); }
      }
    </style>
  </head>

  <body class="bg-gradient-to-br from-gray-50 to-gray-100 font-dmSans min-h-screen flex justify-center items-center p-4">
    <article class="bg-white p-8 lg:p-12 rounded-2xl shadow-xl grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-4xl w-full relative overflow-hidden animate-fade-in">
      <!-- Bloque negro de fondo -->
      <div class="absolute inset-0 bg-black w-[200%] h-[200%] transform rotate-[57deg] translate-x-1/4 -translate-y-1/2 transition-transform duration-1000 black-block"></div>

      <!-- Formulario de Inicio de Sesión -->
      <form method="POST" action="{{ route('login') }}" class="relative z-10 space-y-6 animate-slide-up" novalidate>
        @csrf
        
        <header class="text-center mb-8">
          <h1 class="text-3xl font-bold mb-2">Iniciar sesión</h1>
          <div class="w-12 h-1 bg-black rounded-full mx-auto"></div>
        </header>

        <!-- Campo Email -->
        <div class="form-group relative">
          <i class="bx bxs-envelope absolute left-0 top-1/2 -translate-y-1/2 transition-all duration-300 text-gray-500"></i>
          <input 
            type="email" 
            id="email"
            name="email" 
            class="form-input w-full border-b-2 border-gray-300 focus:border-black pb-2 outline-none transition-all bg-transparent" 
            placeholder="Correo Electrónico"
            required
            autocomplete="email"
            aria-label="Correo Electrónico"
          />
          @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Campo Contraseña -->
        <div class="form-group relative">
          <i class="bx bxs-lock-alt absolute left-0 top-1/2 -translate-y-1/2 transition-all duration-300 text-gray-500"></i>
          <input 
            type="password" 
            id="password"
            name="password" 
            class="form-input w-full border-b-2 border-gray-300 focus:border-black pb-2 outline-none transition-all bg-transparent" 
            placeholder="Contraseña"
            required
            autocomplete="current-password"
            aria-label="Contraseña"
          />
          @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Botón de Inicio de Sesión -->
        <button 
          type="submit"
          class="w-full bg-primary hover:bg-primary-hover text-white py-3 rounded-full transform hover:scale-[1.02] transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
        >
          Iniciar sesión
        </button>

        <!-- Enlace a Registro -->
        <p class="text-center text-gray-600">
          ¿No tienes cuenta?
          <a 
            href="{{ route('register') }}" 
            class="font-semibold text-primary hover:underline transition-all ml-1"
          >
            Regístrate
          </a>
        </p>
      </form>

      <!-- Contenido Lateral -->
      <div class="hidden lg:flex flex-col justify-center text-right space-y-4 relative z-10 text-white">
        <h2 class="text-4xl font-bold uppercase tracking-wide">¡Bienvenido!</h2>
        <p class="text-lg max-w-[300px] ml-auto opacity-90">
          Inicia sesión para acceder a tu cuenta y gestionar tus citas.
        </p>
      </div>
    </article>

    <!-- Validación del formulario -->
    <script>
      const form = document.querySelector('form');
      const blackBlock = document.querySelector('.black-block');
      
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Validación básica
        const inputs = form.querySelectorAll('input[required]');
        let isValid = true;
        
        inputs.forEach(input => {
          if (!input.value) {
            isValid = false;
            input.parentElement.classList.add('error-shake');
            setTimeout(() => {
              input.parentElement.classList.remove('error-shake');
            }, 820);
          }
        });

        // Si el formulario es válido, lo enviamos
        if (isValid) {
          form.submit();
        }
      });
    </script>
  </body>
</html>
