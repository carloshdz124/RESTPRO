<?php
$ubicacion = "../";
$titulo = "Reportes";
include ($ubicacion . "includes/header.php");
?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    canvas {
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .container {
        max-width: 600px;
        margin: auto;
    }
</style>
<!-- Incluir Chart.js desde un CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container mt-3">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>

    <div class="container">
        <h1>Gráfico de Barras con Chart.js</h1>
        <!-- Elemento canvas para el gráfico -->
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Esperar a que el DOM esté completamente cargado
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener el contexto del canvas
            const ctx = document.getElementById('myChart').getContext('2d');
            // Crear el gráfico
            const myChart = new Chart(ctx, {
                type: 'bar', // Tipo de gráfico
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'], // Etiquetas en el eje X
                    datasets: [{
                        label: 'Ventas Mensuales', // Etiqueta del conjunto de datos
                        data: [12, 19, 3, 5, 2, 3], // Datos para las barras
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo de las barras
                        borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
                        borderWidth: 1 // Ancho del borde de las barras
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Comenzar el eje Y en cero
                        }
                    }
                }
            });
        });
    </script>
</div>