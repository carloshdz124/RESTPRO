<?php
$ubicacion = "../../";
$titulo = "MESAS";
include($ubicacion . "config/conexion.php");
include($ubicacion . "includes/header.php");

// Se realiza consulta para revisar si existe alguna reservacion.
$fecha = isset($fecha) ? $fecha : date('Y-m-d');
$sql = "SELECT * FROM mesa_cliente WHERE estado = 1 and fecha='$fecha' ";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultReservaciones = $result->fetchAll(PDO::FETCH_OBJ);
}

// Se realiza una consulta para revisar si existen areas.
$sql = "SELECT * FROM area";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultAreas = array();
}

// Se realiza una consulta para revisar si existen areas.
$sql = "SELECT * FROM mesa_cliente WHERE estado = 0 ";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $ctn_espera = 1;
    $resultEspera = $result->fetchAll(PDO::FETCH_OBJ);
}

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

        $sql = 'SELECT * FROM mesa WHERE (' . $consulta . ') AND n_personas >= ' . $total_personas;
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
                Reservaciones del dia
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



<!-- Modal Registrar Mesa -->
<div class="modal fade" id="modalAsignarMesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar mesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="mesas_procesar.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="formulario" value="registroMesa"></input>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input placeholder="A nombre de quien sera su mesa" type="text" class="form-control" id="nombre"
                            name="tb_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Numero de adultos.</label>
                        <input placeholder="Cantidad de adultos" type="number" class="form-control" id="email"
                            name="tb_nadultos" required>
                    </div>
                    <div class="mb-3">
                        <label for="n_niños" class="form-label">Numero de niños.</label>
                        <input placeholder="Cantidad de niños" type="number" class="form-control" id="n_niños"
                            name="tb_nniños" required>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Area deseada</label>
                        <?php foreach ($resultAreas as $area): ?>
                            <div class="form-check">
                                <input name="cb_areas[]" class="form-check-input" type="checkbox"
                                    value="<?php echo $area->id; ?>" id="<?php echo $area->nombre; ?>" checked>
                                <label class="form-check-label"
                                    for="<?php echo $area->nombre; ?>"><?php echo $area->nombre; ?></label>
                            </div>
                        <?php endforeach ?>
                        <p id="error" style="color: red;"></p> <!-- Mensaje de error -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reservacion -->
<div class="modal fade" id="modalReservacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Reservacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="mesas_procesar.php" method="POST">
                <input type="hidden" name="formulario" value="registroReservacion"></input>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input placeholder="A nombre de quien sera su mesa" type="text" class="form-control" id="nombre"
                            name="tb_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">telefono</label>
                        <input placeholder="Telefono de contacto" type="tel" class="form-control" id="tb_telefono"
                            name="tb_telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="n_adultos" class="form-label">Numero de adultos.</label>
                        <input placeholder="Cantidad de adultos" type="number" class="form-control" id="n_adultos"
                            name="tb_nadultos" required>
                    </div>
                    <div class="mb-3">
                        <label for="n_ninos" class="form-label">Numero de niños.</label>
                        <input placeholder="Cantidad de niños" type="number" class="form-control" id="n_ninos"
                            name="tb_nninos" required>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Area deseada</label>
                        <select name="sb_area" class="form-select" aria-label="Default select example">
                            <option value="salon">Salon</option>
                            <option value="terraza">Terraza</option>
                            <option value="infantil">Area infantil</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha de reservacion</label>
                        <input min="<?php echo isset($fecha) ? $fecha : date('Y-m-d'); ?>" type="date"
                            class="form-control" name="tb_fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Hora (Disponible solo de 12pm a 10pm)</label>
                        <input min="12:00:00" max="21:00:00" type="time" class="form-control" name="tb_hora" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lista de Espera -->
<div class="modal fade" id="modalListaEspera" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lista espera</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="#" method="POST">
                <div class="modal-body" id="modalContent">
                    <!-- Aquí se insertarán los datos con AJAX -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver mesas disponibles para cliente -->
<div class="modal fade" id="verMesas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mesas disponibles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="#" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre: </l>
                            <label for="id" class="form-label" id="modal-nombre" name="tb_nombre"></label>
                    </div>
                    <div class="mb-3">
                        <label>Zonas: </label>
                        <label for="zonas" class="form-label" id="modal-zonas" name="tb_zonas"></label>
                    </div>
                    <div class="mb-3">
                        <label>Total personas: </label>
                        <label for="personas" class="form-label" id="modal-TPersonas" name="tb_zonas"></label>
                    </div>
                    <div class="mb-3">
                        <p>MESAS LIBRES:</p>
                        <!-- Aqui mostramos los datos siendo una respuesta AJAX -->
                        <div>
                            <p><strong>Clientes a elegir: </strong></p>
                            <table class="table table-dark centrar" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Mesa</th>
                                        <th scope="col">N. personas</th>
                                        <th scope="col">Opc</th>
                                    </tr>
                                </thead>
                                <tbody class="table-secondary" id="mesasDisponibles">
                                    <!-- Aquí se mostrarán los clientes disponibles -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Reservacion Del dia -->
<div class="modal fade" id="modalReservacionHoy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reservaciones del dia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="#" method="POST">
                <div class="modal-body d-flex">
                    <?php if (isset($resultReservaciones)) { ?>
                        <table class="table table-dark centrar" style="width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <td scope="col">Cliente</td>
                                    <td scope="col">Mesa</td>
                                    <td scope="col">N. personas</t>
                                    <td scope="col">Hora</td>
                                </tr>
                            </thead>
                            <tbody class="table-secondary">
                                <?php foreach ($resultReservaciones as $reservaciones): ?>
                                    <tr>
                                        <td scope="row">1</td>
                                        <td><?php echo $reservaciones->nombre; ?></td>
                                        <td>21</td>
                                        <td><?php echo $reservaciones->n_adultos + $reservaciones->n_ninos; ?></td>
                                        <td><?php echo $reservaciones->hora_llegada; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo 'No hay reservaciones hoy';
                    } ?>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Clientes a elegir -->
<div class="modal fade" id="verClientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opciones a elegir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="#" method="POST">
                <div class="modal-body">
                    <div class="mb-3" style="display: none;">
                        <label>Mesa seleccionada: </label>
                        <label class="form-label" id="modal-id" name="tb_id"></label>
                    </div>
                    <div class="mb-3">
                        <label>Mesa seleccionada: </label>
                        <label for="zonas" class="form-label" id="modal-nombre" name="tb_zonas"></label>
                    </div>
                    <div class="border-bottom mb-3">
                        <label>Cantidad de personas: </label>
                        <label for="personas" class="form-label" id="modal-n_personas" name="tb_zonas"></label>
                    </div>
                    <div class="mb-3">
                        <div id="clientesContainer" class="d-none">
                            <p><strong>Clientes a elegir: </strong></p>
                            <table class="table table-dark centrar" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">N. personas</th>
                                        <th scope="col">Opc</th>
                                    </tr>
                                </thead>
                                <tbody class="table-secondary" id="clientesDisponibles">
                                    <!-- Aquí se mostrarán los clientes disponibles -->
                                </tbody>
                            </table>
                        </div>

                        <div id="mesaOcupada" class="d-none">
                            <!-- Respuesta AJX -->
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php if ($message != ''): ?>
    <!-- Modal Ver mesas disponibles despues de registrar mesa -->
    <div class="modal fade" id="modalVerMesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mesas disponibles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="was-validated" action="#" method="POST">
                    <div class="modal-body d-flex">
                        <?php foreach ($resultDisponibles as $mesa):
                            echo $mesa->nombre . '<br>';
                        endforeach ?>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<script src="<?php echo $ubicacion; ?>/assets/tools/scripts/mesas.js"></script>

<?php

include_once($ubicacion . "includes/footer.php");

?>