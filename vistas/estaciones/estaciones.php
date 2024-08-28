<?php
$ubicacion = "../../";
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
            <?php if (isset($resultAreas)) {
            foreach ($resultAreas as $area) {
                // Consulta para ver mesas por zonas
                $result = $pdo->query('SELECT * FROM mesa WHERE area_id=' . $area->id . ' ORDER BY nombre ASC');
                if ($result->rowCount() > 0) {
                    $resultMesas = $result->fetchAll(PDO::FETCH_OBJ);
                } ?>
                <div id="<?php echo $area->id; ?>" class="mapa">
                    <p><?php echo htmlspecialchars($area->nombre); ?></p>
                    <?php
                    // Variable para identificar cada fila
                    $fila = 0;
                    foreach ($resultMesas as $mesa) {
                        // Condicion para hacaer salto de linea si se cambia de fila
                        // Si el nombre solo son dos digitos, hara el salto de fila cuando identifique que cambio el primer caracter
                        if (strlen($mesa->nombre) == 2) {
                            if (strlen($mesa->nombre[0] != $fila)) {
                                // Actualizamos el elemento de la fila actual.
                                $fila = $mesa->nombre[0];
                                echo '<br>';
                            }
                            // Si el nombre son 3 digitos, hara salto de fila en el segudo caracter.
                        } elseif (strlen($mesa->nombre) == 3) {
                            if (strlen($mesa->nombre[1] != $fila)) {
                                // Actualizamos el elemento de la fila actual.
                                $fila = $mesa->nombre[1];
                                echo '<br>';
                            }
                        }
                        // Botones que representan las mesas
                        echo '<div class="mesa" id="tooltip-' . $mesa->id . '" data-bs-placement="top" title="N. personas: ' . $mesa->n_personas . '">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#verClientes" data-estado="' . $mesa->estado . '"
                            data-id="' . $mesa->id . '" data-nombre="' . $mesa->nombre . '" data-n_personas="' . $mesa->n_personas . '" data-id_zona="' . $mesa->area_id . '"
                            >' . $mesa->nombre . '</button>
                    </div>';
                    } ?>
                </div>
            <?php }
        } else {
            echo 'No existen areas.';
        } ?>
        </div>
    </div>
</div>
<?php

include_once($ubicacion."includes/footer.php");

?>