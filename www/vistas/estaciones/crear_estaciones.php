<?php
$ubicacion = "../../";
$titulo = "Crear estaciones";
include($ubicacion . "includes/header.php");

// Se realiza una consulta para revisar si existen areas -->
$sql = "SELECT * FROM area";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultAreas = array();
}
?>

<link href="assets/tools/styles.css" rel="stylesheet">
<div class="container mt-3">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <p class="text-center">Seleccione las mesas para asignar a cierta zona</p>
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