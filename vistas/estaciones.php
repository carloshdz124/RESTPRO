<?php
$ubicacion = "../";
$titulo = "Estaciones";
include ($ubicacion . "includes/header.php");
?>
<!-- Se realiza una consulta para revisar si existen areas -->
<?php
$sql = "SELECT * FROM area";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultAreas = array();
}
?>
<link href="assets/tools/styles.css" rel="stylesheet">
<div class="container mt-5">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <div class="form-group border border-black bg-dark text-white p-3 rounded-4">
        <h2 class="text-center" for="columna1">Mesas</h2>
        <div class="text-end">
            <div class="dropdown">
                <button class="btn btn-outline-info btn-lg rounded-4 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Cambiar Estación
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                    <?php foreach ($resultAreas as $area) { ?>
                        <li><a onclick="seleccionaMapa('<?php echo $area->id; ?>')" class="dropdown-item"><?php echo $area->nombre ?></a></li>
                    <?php } ?>
                </ul><br><br>
            </div>
        </div>
        <div class="mapa">
            <div class="mesa">Mesa 1 - Z1</div>
            <div class="mesa">Mesa 2 - Z1</div>
            <div class="mesa">Mesa 3 - Z1</div>
            <div class="mesa">Mesa 4 - Z1</div>
            <div class="mesa">Mesa 5 - Z1</div>
            <div class="mesa">Mesa 6 - Z1</div>
            <div class="mesa">Mesa 7 - Z1</div>
            <div class="mesa">Mesa 8 - Z1</div>
            <div class="mesa">Mesa 9 - Z1</div>
            <div class="mesa">Mesa 10 - Z1</div>
            <div class="mesa">Mesa 11 - Z2</div>
            <div class="mesa">Mesa 12 - Z2</div>
            <div class="mesa">Mesa 13 - Z2</div>
            <div class="mesa">Mesa 14 - Z2</div>
            <div class="mesa">Mesa 15 - Z2</div>
            <div class="mesa">Mesa 16 - Z2</div>
            <div class="mesa">Mesa 17 - Z2</div>
            <div class="mesa">Mesa 18 - Z2</div>
            <div class="mesa">Mesa 19 - Z2</div>
            <div class="mesa">Mesa 20 - Z2</div>
            <div class="mesa">Mesa 21 - Z3</div>
            <div class="mesa">Mesa 22 - Z3</div>
            <div class="mesa">Mesa 23 - Z3</div>
            <div class="mesa">Mesa 24 - Z3</div>
            <div class="mesa">Mesa 25 - Z3</div>
            <div class="mesa">Mesa 26 - Z3</div>
            <div class="mesa">Mesa 27 - Z3</div>
            <div class="mesa">Mesa 28 - Z3</div>
            <div class="mesa">Mesa 29 - Z3</div>
            <div class="mesa">Mesa 30 - Z3</div>
        </div>
    </div>
</div>
<?php

include_once($ubicacion."includes/footer.php");

?>