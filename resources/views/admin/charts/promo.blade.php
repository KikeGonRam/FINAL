<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gráficas de Promociones</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 0;
            margin: 0;
        }
        h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #4CAF50;
        }
        .chart-container {
            width: 80%;
            margin: auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        canvas {
            border-radius: 10px;
        }
        .chart-container:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <h2>Descuentos Promocionales por Tipo</h2>
        <canvas id="discountDistributionChart"></canvas>
    </div>

    <div class="chart-container">
        <h2>Duración de Promociones</h2>
        <canvas id="promotionsDurationChart"></canvas>
    </div>

    <script>
        // Datos de la vista
        const discountsByType = @json($discountsByType); // Descuentos por tipo
        const promotionNames = @json($promotionNames); // Nombres de las promociones
        const promotionDurations = @json($promotionDurations); // Duraciones de las promociones

        // Gráfica 1: Descuentos Promocionales por Tipo
        const ctx1 = document.getElementById('discountDistributionChart').getContext('2d');
        const discountChart = new Chart(ctx1, {
            type: 'bar', // Tipo de gráfico (barra)
            data: {
                labels: Object.keys(discountsByType), // Tipos de promociones
                datasets: [{
                    label: 'Descuento Promocional (%)',
                    data: Object.values(discountsByType), // Valores de los descuentos
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ], 
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(75, 192, 192, 0.6)',
                    hoverBorderColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        backgroundColor: '#4CAF50',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                    }
                },
                animation: {
                    duration: 1500, // Tiempo de animación
                    easing: 'easeOutBounce' // Efecto de animación
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#333',
                        },
                    },
                    x: {
                        ticks: {
                            color: '#333',
                        },
                    }
                }
            }
        });

        // Gráfica 2: Duración de las Promociones (Rango de Fechas)
        const ctx2 = document.getElementById('promotionsDurationChart').getContext('2d');
        const durationChart = new Chart(ctx2, {
            type: 'line', // Tipo de gráfico (línea)
            data: {
                labels: promotionNames, // Nombres de las promociones
                datasets: [{
                    label: 'Duración de Promociones (días)',
                    data: promotionDurations, // Duraciones de las promociones
                    fill: false,
                    borderColor: '#4CAF50',
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#ff6347', // Color de los puntos
                    borderWidth: 3,
                    hoverBorderColor: '#ff6347',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        backgroundColor: '#4CAF50',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                    }
                },
                animation: {
                    duration: 2000, // Tiempo de animación
                    easing: 'easeOutExpo', // Efecto de animación
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#333',
                        },
                    },
                    x: {
                        ticks: {
                            color: '#333',
                        },
                    }
                }
            }
        });
    </script>
</body>
</html>
