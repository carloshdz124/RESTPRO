<?php
$ubicacion = "../";
$titulo = "MESAS";
include ($ubicacion . "config/conexion.php");
include ($ubicacion . "includes/header.php");

$sql = "SELECT * FROM mesa_cliente WHERE estado = 1 and fecha='2024-07-05' ";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultReservaciones = $result->fetchAll(PDO::FETCH_OBJ);
}else{
    $resultReservaciones = array();
}

$message = isset($_GET['message']) ? $_GET['message'] : '';
if ($message == 'ok') {
    $message = 'Se registro mesa correctamente';
} else if ($message == 'no') {
    $message = 'Error al insertar datos';
}
echo date('H:i:s');
?>
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">

<div class="container mt-3">
    <!-- Alerta de aviso de accion -->
    <?php if ($message != '') { ?>
        <div class="alert alert-success mt-3" style="text-align: center;">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>


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
    <div style="text-align: right;">
        <button type="button" class="btn dropdown-toggle" style="background-color:#ce9477" data-bs-toggle="dropdown"
            aria-expanded="false">
            mapas
        </button>
        <ul class="dropdown-menu" style="background-color:#ce9477">
            <li><a onclick="seleccionaMapa('mapa1')" class="dropdown-item">mapa 1</a></li>
            <li><a onclick="seleccionaMapa('mapa2')" class="dropdown-item">mapa 2</a></li>
        </ul>
    </div>
    <div id="mapa1" class="mapa container active" style="width: 100%; height: 45vh;">
        <p>Mapa 1</p>
        <img class="img-fluid" src="<?php echo $ubicacion; ?>/assets/imagenes/mapa1.png">
    </div>
    <div id="mapa2" class="mapa container" style="width: 100%; height: 45vh;">
        <p>Mapa 2</p>
        <img class="img-fluid" src="<?php echo $ubicacion; ?>/assets/imagenes/mapa2.png">
    </div>
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
                        <select name="sb_area" class="form-select" aria-label="Default select example">
                            <option value="salon">Salon</option>
                            <option value="terraza">Terraza</option>
                            <option value="infantil">Area infantil</option>
                        </select>
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
                <div class="modal-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">N. personas</th>
                                <th scope="col">zona</th>
                                <th scope="col">Tiempo de espera</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Juan</td>
                                <td>8</td>
                                <td>Salón</td>
                                <td>0:15</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Manuel</td>
                                <td>6</td>
                                <td>Terraza</td>
                                <td>0:13</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>6</td>
                                <td>Area Infantil</td>
                                <td>0:05</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Registrar</button>
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
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



<script>
    function seleccionaMapa(containerId) {
        // Oculta todos los contenedores
        document.querySelectorAll('.mapa').forEach(function (container) {
            container.style.display = 'none';
        });
        // Muestra el contenedor seleccionado
        document.getElementById(containerId).style.display = 'block';
    }

</script>

<?php

include_once ($ubicacion . "includes/footer.php");

?>