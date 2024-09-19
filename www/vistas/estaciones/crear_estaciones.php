<?php
$ubicacion = "../../";
$titulo = "Crear estaciones";
include($ubicacion . "includes/header.php");

// Se realiza una consulta para revisar si existen areas -->
$sql = "SELECT * FROM areas";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
    $ctn_areas = $result->rowCount();
} else {
    $resultAreas = array();
}

// Consulta para ver numero de meseros
$hoy = date("w");
if ($hoy >= 1 && $hoy <= 4) {
    $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
} else {
    $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy);
}
$ctn_meseros = $result->fetchColumn();

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
            include_once('../estaciones/mesas_mapas.php');
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

    function calcularMeserosxArea($ctn_areas, $pdo, $ctn_meseros)
    {
        // Array para almacenar los meseros por area
        $n_meseros_x_area = array();
        for ($area = 1; $area <= $ctn_areas; $area++) {
            //Consultamos el total de mesas por area
            $result = $pdo->query("SELECT COUNT(*) FROM mesas WHERE area_id = {$area}");
            //Guardamos el resultado
            $mesasxarea = $result->fetchColumn();
            //Calculamos el porcentaje de mesas de x area respecto al total de mesas
            $porcentajeMesasArea = round($mesasxarea * 100 / 83);
            //calculamos el numero de meseros por area
            $meserosxarea = round($ctn_meseros * $porcentajeMesasArea / 100);
            //Agreamos el total de meseros por area en el array
            array_push($n_meseros_x_area, $meserosxarea);
        }
        //validamos que no sobren o falten meseros comparado con el total de meseros por area
        if (array_sum($n_meseros_x_area) - $ctn_meseros < 0) {
            //Si faltan, añadimos uno
            $n_meseros_x_area[2] = $n_meseros_x_area[2] + 1;
        } elseif (array_sum($n_meseros_x_area) - $ctn_meseros > 0) {
            //Si sobran, eliminamos uno
            $n_meseros_x_area[0] = $n_meseros_x_area[0] - 1;
        }

        return $n_meseros_x_area;
    }

    include_once($ubicacion . "includes/footer.php");
    ?>