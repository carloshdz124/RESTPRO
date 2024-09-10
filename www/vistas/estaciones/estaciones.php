<?php
$ubicacion = "../../";
$titulo = "Estaciones";
include($ubicacion . "includes/header.php");
// Se realiza una consulta para revisar si existen areas -->
$sql = "SELECT * FROM area";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultAreas = array();
}
include_once ('../endpoints/colores_estaciones.php');
?>
<link href="assets/tools/styles.css" rel="stylesheet">
<div class="container mt-3">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <div class="row">
        <div class="col">
            <a href="crear_estaciones.php" title="Crear Zona" class="btn btn-success">
                Crear Zona
            </a>
        </div>
        <div class="col">
            <div class="dropdown" style="text-align: right;">
                <button type="button" class="btn btn-secondary dropdown-toggle" style="background-color:grey"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Areas
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <?php foreach ($resultAreas as $area) { ?>
                        <li><a onclick="seleccionaMapa('<?php echo $area->id; ?>')"
                                class="dropdown-item"><?php echo $area->nombre ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>


    <!-- Si existen areas mostramos mapas de areas -->
    <?php
    include_once('../mesas/mesas_mapas.php');
    ?>
</div>


<script src="<?php echo $ubicacion; ?>/assets/tools/scripts/mesas.js"></script>
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_estaciones.css">



<?php
include_once($ubicacion . "includes/footer.php");
?>