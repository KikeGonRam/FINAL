<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Precios</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: space-between;
            background-color: #333;
            padding: 10px 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        nav a svg {
            margin-right: 8px;
        }

        nav a:hover {
            color: #00aaff;
        }

        canvas {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('admin.panel') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Dashboard
        </a>
        <a href="{{ route('admin.charts.index') }}">
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

    <div class="container">
        <h1>Gráfico de Precios de Productos</h1>
        <canvas id="pricesChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('pricesChart').getContext('2d');
        const pricesChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico: Barras
            data: {
                labels: {!! json_encode($productNames) !!}, // Nombres de los productos
                datasets: [{
                    label: 'Precios de Productos ($)',
                    data: {!! json_encode($productPrices) !!}, // Precios de los productos
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de las barras
                    borderColor: 'rgba(54, 162, 235, 1)', // Borde de las barras
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true, // El eje Y comienza en 0
                        title: {
                            display: true,
                            text: 'Precio ($)',
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Productos',
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
