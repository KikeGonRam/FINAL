<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Usuarios</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        canvas {
            max-width: 100%;
            margin: 20px 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Barra de navegación -->
        <nav class="bg-gray-800 rounded-lg p-4 mb-8 flex justify-between items-center">
            <div class="flex space-x-4">
                <a href="{{ route('admin.panel')}}" class="text-gray-300 hover:text-teal-400 transition-all duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.charts.index')}}" class="text-gray-300 hover:text-teal-400 transition-all duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"/>
                    </svg>
                    Regresar
                </a>
            </div>
            <a href="{{ route('admin.logout') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                </svg>
                Cerrar Sesión
            </a>
        </nav>

        <!-- Título principal -->
        <h1 class="text-3xl font-bold text-white mb-8 text-center">Dashboard de Usuarios</h1>

        <!-- Contenedor de estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 p-6 rounded-lg">
                <h3 class="text-gray-400 text-sm font-medium">Total Usuarios</h3>
                <p class="text-white text-2xl font-bold mt-2" id="totalUsers">0</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg">
                <h3 class="text-gray-400 text-sm font-medium">Con Foto</h3>
                <p class="text-green-500 text-2xl font-bold mt-2" id="usersWithPhotoCount">0</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg">
                <h3 class="text-gray-400 text-sm font-medium">Sin Foto</h3>
                <p class="text-orange-500 text-2xl font-bold mt-2" id="usersWithoutPhotoCount">0</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg">
                <h3 class="text-gray-400 text-sm font-medium">Porcentaje con Foto</h3>
                <p class="text-blue-500 text-2xl font-bold mt-2" id="photoPercentage">0%</p>
            </div>
        </div>

        <!-- Contenedor de gráficas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gráfica de pastel -->
            <div class="bg-gray-800 p-6 rounded-lg">
                <h2 class="text-white text-xl font-bold mb-4">Distribución de Usuarios</h2>
                <div class="chart-container">
                    <canvas id="usersPhotoPieChart"></canvas>
                </div>
            </div>
            <!-- Gráfica de barras -->
            <div class="bg-gray-800 p-6 rounded-lg">
                <h2 class="text-white text-xl font-bold mb-4">Comparativa de Usuarios</h2>
                <div class="chart-container">
                    <canvas id="usersPhotoBarChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Gráfica de usuarios registrados por fecha -->
        <div class="bg-gray-800 p-6 rounded-lg mt-8">
            <h2 class="text-white text-xl font-bold mb-4">Cantidad de Usuarios por Fecha de Registro</h2>
            <div class="chart-container">
                <canvas id="userRegistrationChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Datos de los usuarios
            const usersData = @json($users);

            // Contamos cuántos usuarios tienen foto y cuántos no
            const usersWithPhoto = usersData.filter(user => user.photo).length;
            const usersWithoutPhoto = usersData.length - usersWithPhoto;
            const totalUsers = usersData.length;
            const photoPercentage = ((usersWithPhoto / totalUsers) * 100).toFixed(1);

            // Actualizar estadísticas
            document.getElementById('totalUsers').textContent = totalUsers;
            document.getElementById('usersWithPhotoCount').textContent = usersWithPhoto;
            document.getElementById('usersWithoutPhotoCount').textContent = usersWithoutPhoto;
            document.getElementById('photoPercentage').textContent = `${photoPercentage}%`;

            // Crear gráfica de pastel
            const ctxPie = document.getElementById('usersPhotoPieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Con Foto', 'Sin Foto'],
                    datasets: [{
                        label: 'Usuarios con y sin foto',
                        data: [usersWithPhoto, usersWithoutPhoto],
                        backgroundColor: ['#4CAF50', '#FF5733'],
                        borderColor: ['#2E7D32', '#C0392B'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: 'white'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw} usuarios`;
                                }
                            }
                        }
                    }
                }
            });

            // Crear gráfica de barras
            const ctxBar = document.getElementById('usersPhotoBarChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Con Foto', 'Sin Foto'],
                    datasets: [{
                        label: 'Usuarios',
                        data: [usersWithPhoto, usersWithoutPhoto],
                        backgroundColor: ['#4CAF50', '#FF5733'],
                        borderColor: ['#2E7D32', '#C0392B'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'white'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'white'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw} usuarios`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfica de usuarios registrados por fecha
            const ctxLine = document.getElementById('userRegistrationChart').getContext('2d');
            const userRegistrationDates = usersData.map(user => new Date(user.created_at).toLocaleDateString());
            const registrationCounts = userRegistrationDates.reduce((acc, date) => {
                acc[date] = (acc[date] || 0) + 1;
                return acc;
            }, {});

            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: Object.keys(registrationCounts),
                    datasets: [{
                        label: 'Usuarios Registrados',
                        data: Object.values(registrationCounts),
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: {
                                color: 'white'
                            },
                            grid: {
                                color: '#444'
                            }
                        },
                        y: {
                            ticks: {
                                color: 'white'
                            },
                            grid: {
                                color: '#444'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return `${tooltipItem.label}: ${tooltipItem.raw} usuarios`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
