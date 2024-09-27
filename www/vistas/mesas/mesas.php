<?php
$ubicacion = "../../";
$titulo = "MESAS";
include($ubicacion . "config/config.php");
include($ubicacion . "includes/header.php");

include("consultas/consultas.php");

// Se valida si recibe datos get, despues de la insercion para ver mesas disponibles en areas deseadas.
if (isset($_GET["message"])) {
    $message = 'Se registro mesa correctamente';
    // Consulta del ultimo elemento insertado para mostrar mesas disponibles.
    $sql = "SELECT * FROM mesa_cliente ORDER BY id DESC LIMIT 1";
    $result = $pdo->query($sql);
    if ($result->rowCount() == 1) {
        $condiciones = [];
        $areasSeleccionadas = $result->fetch(PDO::FETCH_OBJ);
        $areasSelec = $areasSeleccionadas->zonas_deseadas;
        $total_personas = $areasSeleccionadas->n_adultos + $areasSeleccionadas->n_ninos;
        // Se transforma a array quitando comas y espacios.
        $areasSelec = array_map('trim', explode(",", $areasSelec));

        // Se recorre el array y se van añadiendo a un array con en numero de areas deseadas como tamaño
        foreach ($areasSelec as $areaSelec) {
            $condiciones[] = ' area_id = ' . $pdo->quote($areaSelec) . ' AND estado = 0 ';
        }
        //Con implode unimos en una cadena los elementos de del anterior array pero entre ellos un OR 
        $consulta = implode(' OR ', $condiciones);

        $sql = 'SELECT * FROM mesas WHERE (' . $consulta . ') AND n_personas >= ' . $total_personas;
        $result = $pdo->query($sql);
        if ($result->rowCount() > 0) {
            $resultDisponibles = $result->fetchAll(PDO::FETCH_OBJ);
        }
    }
} else {
    $message = '';
}

?>
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">

<div class="container mt-3">
    <div id="alertPlaceholder"></div>
    <!-- Alerta de aviso de accion -->
    <?php if ($message != '') { ?>
        <div class="alert alert-success alert-dismissible mt-3" style="text-align: center;">
            <?php echo $message;
            if (isset($resultDisponibles)) { ?>
                <br>
                <button class="btn-open" data-bs-toggle="modal" data-bs-target="#modalVerMesa">
                    Ver Mesas disponibles</button>
            <?php } else { ?>
                <br><i class="bi bi-exclamation-triangle-fill"></i>
                <strong> No hay mesas disponibles </strong>
            <?php } ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <!-- Botones principales -->
    <h1 class="text-center">MESAS</h1>
    <div class="row centrar">
        <div class="col">
            <button class="btn btn-estilo" data-bs-toggle="modal" data-bs-target="#modalAsignarMesa">
                Registrar mesa
            </button>
        </div>
        <div class="col">
            <button class="btn btn-estilo " data-bs-toggle="modal" data-bs-target="#modalReservacion">
                Registrar reservacion
            </button>
        </div>
        <div class="col">
            <button class="btn btn-estilo " data-bs-toggle="modal" data-bs-target="#modalReservacionHoy">
                Reservaciones
            </button>
        </div>
        <div class="col">
            <button class="btn btn-estilo" data-bs-toggle="modal" data-bs-target="#modalListaEspera">
                Lista de espera
            </button>
        </div>
    </div>
    <br>
    <!-- Boton para seleccionar areas y mostrarlas -->
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
    <!-- Si existen areas mostramos mapas de areas -->
    <?php
    include_once('mesas_mapas.php');
    ?>
</div>

<?php
include_once "consultas/modals.php";
?>

<script src="<?php echo $ubicacion; ?>/assets/tools/scripts/mesas.js"></script>
<script src="<?php echo $ubicacion; ?>/assets/tools/scripts/mapa_mesas.js"></script>

<?php

include_once($ubicacion . "includes/footer.php");

?>