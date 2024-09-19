<?php
$ubicacion = "../../";
$titulo = "Estaciones";
include($ubicacion . "includes/header.php");

$sql = "SELECT * FROM areas";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultAreas = array();
}
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    if ($message == 'ok')
        echo "La inserción fue exitosa.";
    else
        echo "Ya existe esa estacion";
}
?>
<div class="container mt-3">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <div class="row">
        <div class="col">
            <a href="crear_estaciones.php" title="Crear Zona" class="btn btn-success">
                Crear Zona
            </a>
        </div>
    </div>

    <!-- Si existen areas mostramos mapas de areas -->
    <?php
    $bandera_estacion = true;
    include_once('../estaciones/mesas_mapas.php');
    ?>
</div>


<script src="<?php echo $ubicacion; ?>/assets/tools/scripts/mapa_mesas.js"></script>
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_estaciones.css">



<?php
include_once($ubicacion . "includes/footer.php");
?>