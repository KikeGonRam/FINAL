<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Barbería</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #D4B895;
            --secondary-color: #B88B4A;
            --dark-bg: #1a202c;
            --nav-bg: #2d3748;
            --hover-bg: #4a5568;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, var(--dark-bg), #2d3436);
            color: white;
            margin: 0;
            min-height: 100vh;
            padding-bottom: 2rem;
        }

        .header {
            background: rgba(45, 55, 72, 0.95);
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        h1 {
            text-align: center;
            margin: 0;
            font-size: 2.2rem;
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            padding: 1.5rem 0;
            animation: fadeIn 1s ease;
        }

        nav {
            display: flex;
            justify-content: center;
            gap: 2rem;
            padding: 1rem 0;
            flex-wrap: wrap;
        }

        nav a {
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
        }

        nav a:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.2);
            color: var(--primary-color);
        }

        nav a.logout {
            background: rgba(239, 68, 68, 0.9);
        }

        nav a.logout:hover {
            background: rgba(239, 68, 68, 1);
            color: white;
        }

        .chart-container {
            background: rgba(45, 55, 72, 0.8);
            border-radius: 16px;
            padding: 2rem;
            margin: 2rem auto;
            max-width: 1000px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(8px);
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 0 2rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            animation: fadeIn 1s ease;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin: 0.5rem 0;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Estadísticas de Barberos</h1>
        <nav>
            <a href="{{ route('admin.panel')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.charts.index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                Regresar
            </a>
            <a href="{{ route('admin.logout') }}" class="logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                </svg>
                Cerrar Sesión
            </a>
        </nav>
    </header>

    <div class="chart-container">
        <canvas id="appointmentsBarChart"></canvas>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total de Citas</h3>
            <div class="stat-number">{{ array_sum($appointments->pluck('total_citas')->toArray()) }}</div>
        </div>
        <div class="stat-card">
            <h3>Barberos Activos</h3>
            <div class="stat-number">{{ count($appointments) }}</div>
        </div>
        <div class="stat-card">
            <h3>Promedio de Citas</h3>
            <div class="stat-number">
                {{ round(array_sum($appointments->pluck('total_citas')->toArray()) / count($appointments)) }}
            </div>
        </div>
    </div>

    <script>
        const appointmentsData = @json($appointments);
        const barbers = appointmentsData.map(appointment => appointment.barber_name);
        const citas = appointmentsData.map(appointment => appointment.total_citas);

        const ctx = document.getElementById('appointmentsBarChart').getContext('2d');
        const appointmentsBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: barbers,
                datasets: [{
                    label: 'Citas por Barbero',
                    data: citas,
                    backgroundColor: 'rgba(212, 184, 149, 0.8)',
                    borderColor: 'rgba(184, 139, 74, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    hoverBackgroundColor: 'rgba(212, 184, 149, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'white'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: 'white'
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    </script>
</body>
</html>