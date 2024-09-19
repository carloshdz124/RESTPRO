<?php
$ubicacion = "../../";
$titulo = "Crear estaciones";
include($ubicacion . "includes/header.php");

// Se realiza una consulta para revisar si existen areas -->
$sql = "SELECT * FROM areas";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultAreas = array();
}

// Consulta para ver numero de meseros
$result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1');
$n_meseros = $result->fetchColumn();

// Consulta para ver estaciones
$result = $pdo->query("SELECT * FROM estaciones");
if ($result->rowCount() > 0) {
    $resultEstaciones = $result->fetchAll(PDO::FETCH_OBJ);
}
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
            Meseros disponibles: <?php echo $n_meseros; ?>
            <br><br>
            <div class="card">
                <div class="card-body">
                    <p>Numero de estaciones:</p>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button onclick="decreaseNumber()" type="button" class="btn btn-primary">-</button>
                        <label id="numberLabel"><?php echo $n_meseros; ?></label>
                        <button onclick="increaseNumber()" type="button" class="btn btn-primary">+</button>
                    </div>
                    <br>
                    <!-- Div para advertencia de diferencia entre meseros y estaciones -->
                    <div class="alert" id="alertMessage" role="alert" style="display: none;"></div>

                    <div id="recordsTable">
                        <!-- Aquí se cargará la tabla de registros mediante PHP y JavaScript -->
                    </div>

                    <!--?php
                    foreach ($resultEstaciones as $estacion):
                        echo $estacion->descripcion . '<br>';
                    endforeach
                    ?-->
                </div>
            </div>
        </div>
    </div>


    <!--script src="<?php echo $ubicacion; ?>/assets/tools/scripts/mapa_mesas.js"></script-->
    <script src="<?php echo $ubicacion; ?>/assets/tools/scripts/estaciones.js"></script>
    <link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">
    <link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_estaciones.css">



    <?php
    include_once($ubicacion . "includes/footer.php");
    ?>