<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Distribución de Precios y Duración de Servicios</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Gráfica de Distribución de Precios -->
    <div style="width: 70%; margin: auto;">
        <h2>Distribución de Precios de Servicios</h2>
        <canvas id="priceDistributionChart"></canvas>
    </div>

    <!-- Gráfica de Duración de Servicios -->
    <div style="width: 70%; margin: auto;">
        <h2>Duración de Servicios (en minutos)</h2>
        <canvas id="durationChart"></canvas>
    </div>

    <script>
        // Datos de los servicios (en formato JSON)
        const services = @json($services);
    
        // Extraer los nombres y los precios de los servicios
        const labels = services.map(service => service.name); // Nombres de los servicios
        const priceData = services.map(service => service.price);  // Precios de los servicios
        const durationData = services.map(service => service.duration);  // Duración de los servicios
    
        // Configuración de la gráfica de precios
        const ctxPrice = document.getElementById('priceDistributionChart').getContext('2d');
        const priceChart = new Chart(ctxPrice, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Precio de Servicios (MXN)',
                    data: priceData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 50,
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce',
                }
            }
        });

        // Configuración de la gráfica de duración de los servicios
        const ctxDuration = document.getElementById('durationChart').getContext('2d');
        const durationChart = new Chart(ctxDuration, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Duración de Servicios (min)',
                    data: durationData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Color distinto para las barras
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5, // Intervalo para las marcas del eje Y
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce',
                }
            }
        });
    </script>
</body>
</html>
