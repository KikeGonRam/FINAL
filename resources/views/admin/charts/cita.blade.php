<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estadísticas de Citas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-gradient {
            background: linear-gradient(-45deg, #1e293b, #0f172a, #1e3a8a, #164e63);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .stats-number {
            animation: countUp 2s ease-out forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="text-gray-100 animate-gradient min-h-screen">
    <!-- Header con animación -->
    <header class="bg-gray-800 bg-opacity-90 backdrop-blur-md shadow-lg py-4 fixed w-full z-10 animate__animated animate__fadeInDown">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <nav class="flex items-center space-x-6">
                <a href="{{ route('admin.panel')}}" class="text-gray-300 hover:text-teal-400 transition-all duration-300 flex items-center">
                    Dashboard
                </a>
                <a href="{{ route('admin.charts.index')}}" class="text-gray-300 hover:text-teal-400 transition-all duration-300 flex items-center">
                    Regresar
                </a>
                <a href="{{ route('admin.logout') }}" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition-all duration-300 flex items-center">
                    Cerrar Sesión
                </a>
            </nav>
        </div>
    </header>

    <!-- Contenido principal con animaciones -->
    <main class="container mx-auto px-4 pt-24 pb-12">
        <!-- Gráfico principal -->
        <section class="bg-gray-800 bg-opacity-50 backdrop-blur-md p-8 rounded-xl shadow-xl animate__animated animate__fadeIn">
            <h2 class="text-center text-3xl font-semibold text-teal-400 mb-6">Estadísticas de Citas</h2>
            <p class="text-center text-gray-400 mb-8">Visualiza el estado de las citas gestionadas en la barbería.</p>
            <div class="flex justify-center">
                <canvas id="appointmentsChart" class="w-full max-w-xl" width="400" height="200"></canvas>
            </div>
        </section>
    </main>

    <!-- Footer mejorado -->
    <footer class="bg-gray-800 bg-opacity-90 backdrop-blur-md py-6 animate__animated animate__fadeInUp">
        <div class="container mx-auto px-4">
            <div class="text-center text-gray-500 mt-4">
                © 2024 DARKETO Barbería - Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('appointmentsChart').getContext('2d');
            const data = @json($data);

            // Colores personalizados con transparencia
            const colors = [
                'rgba(6, 182, 212, 0.8)',   // Cyan
                'rgba(59, 130, 246, 0.8)',  // Blue
                'rgba(139, 92, 246, 0.8)',  // Purple
                'rgba(236, 72, 153, 0.8)',  // Pink
                'rgba(248, 113, 113, 0.8)', // Red
            ];

            data.datasets[0].backgroundColor = colors;
            data.datasets[0].borderColor = colors.map(color => color.replace('0.8', '1'));
            data.datasets[0].borderWidth = 2;

            new Chart(ctx, {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: '#ffffff',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                padding: 20
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let total = context.dataset.data.reduce((sum, val) => sum + val, 0);
                                    let percentage = ((context.raw / total) * 100).toFixed(1);
                                    return `${context.label}: ${context.raw} (${percentage}%)`;
                                }
                            },
                            backgroundColor: 'rgba(15, 23, 42, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
