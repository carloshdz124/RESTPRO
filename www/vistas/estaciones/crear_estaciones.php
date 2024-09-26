<?php
$ubicacion = "../../";
$titulo = "Crear estaciones";
include($ubicacion . "config/config.php");
include($ubicacion . "includes/header.php");

include('consultas/consultas.php');

$crear_estacion = true;

?>

<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_estaciones.css">

<div class="container mt-3">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <p class="text-center">Seleccione las mesas para asignar a cierta zona</p>
    <!-- Si existen areas mostramos mapas de areas -->
    <div class="row">
        <div class="col">
            <?php
            include_once('mesas_mapas.php');
            ?>
        </div>
        <div class="col">
            <br><br>
            <div class="card">
                <div class="card-body">
                    Meseros disponibles: <?php echo $ctn_meseros; ?>
                    <br>

                    <?php

                    $meserosxArea = calcularMeserosxArea($ctn_areas, $pdo, $ctn_meseros);
                    $meserosxAreaJson = json_encode($meserosxArea);

                    ?>
                    <br>
                    <?php
                    if (isset($_GET['datos'])) {
                        $jsonData = json_encode($globalCategorizadoPorColor);
                        ?>
                        <form action="crear_estaciones_procesamiento.php" method="POST" id="formEstaciones">
                            <input type="hidden" name="datos"
                                value='<?php echo $jsonData; ?>'>
                            <button type="submit" class="btn btn-success w-100">Confirmar</button>
                        </form>
                        <?php
                    } else {
                        ?>
                        <button onclick="enviarDatos(<?php echo $meserosxAreaJson; ?>)" class="btn btn-primary w-100">
                            Crear Estaciones
                        </button>
                        <?php
                    }
                    // Consulta para ver estaciones
                    if (isset($_GET['datos'])) {
                        $result = $pdo->query("SELECT * FROM estaciones LIMIT " . array_sum($meseroxArea));
                        if ($result->rowCount() > 0) {
                            $listaresultEstaciones = $result->fetchAll(PDO::FETCH_OBJ);
                            echo
                                "<table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <th>Color</th>
                                            <th>Nombre</th>
                                            <th>Mesas</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            // Mostrar mesas de un color específico en una sola línea
                            foreach ($listaresultEstaciones as $estacion) {
                                $id = $estacion->id;
                                $color = $estacion->color;
                                $nombre = $estacion->descripcion;

                                // Asegúrate de que $globalCategorizadoPorColor esté inicializado y contiene los datos necesarios
                                if (isset($globalCategorizadoPorColor[$id])) {
                                    // Obtener los nombres y IDs de las mesas para la estación actual
                                    $mesasDeseadas = $globalCategorizadoPorColor[$id];
                                    $mesasdeEstacion = array_map(function ($mesa) {
                                        return $mesa['nombre'];
                                    }, $mesasDeseadas);
                                    $mesasdeEstacion = implode(', ', $mesasdeEstacion);
                                }

                                echo "
                                    <tr>
                                        <td><div class='color-box' style='background-color:{$color};'></div></td>
                                        <td>{$nombre}</td>
                                        <td>
                                        $mesasdeEstacion
                                        </td>
                                    </tr>
                                ";
                            }
                            echo "</tbody></table>";
                        }
                    }
                    ?>

                    <div id="recordsTable">
                        <!-- Aquí se cargará la tabla de registros mediante PHP y JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--script src="<?php echo $ubicacion; ?>/assets/tools/scripts/mapa_mesas.js"></script-->
    <!--script src="<?php echo $ubicacion; ?>/assets/tools/scripts/estaciones.js"></script-->
    <link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">
    <link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_estaciones.css">

    <script>
        function enviarDatos(datos) {
            let url = 'crear_estaciones.php?' + new URLSearchParams({ 'datos[]': datos }).toString();
            window.location.href = url;
        }

    </script>

    <?php

    

    include_once($ubicacion . "includes/footer.php");
    ?>