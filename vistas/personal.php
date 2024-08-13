<?php
$ubicacion = "../";
$titulo = "Personal";
include ($ubicacion . "includes/header.php");
include ($ubicacion . "config/conexion.php");

//Se definen mensajes que mostrara
$message = isset($_GET['message']) ? $_GET['message'] : '';
if ($message == 'ok') {
    $tipo_alerta = 'class="alert alert-success alert-dismissible mt-3"';
    $message = 'Se registro correctamente';
} elseif ($message == 'no') {
    $tipo_alerta = 'class="alert alert-danger alert-dismissible mt-3"';
    $message = 'Error al insertar datos';
} elseif ($message == 'noEdit') {
    $tipo_alerta = 'class="alert alert-warning alert-dismissible mt-3"';
    $message = 'No se modificaron datos.';
} elseif ($message == 'desBloq') {
    $tipo_alerta = 'class="alert alert-success alert-dismissible mt-3"';
    $message = 'Se desbloqueo exitosamente';
} elseif ($message == 'bloq') {
    $tipo_alerta = 'class="alert alert-warning alert-dismissible mt-3"';
    $message = 'Se bloqueo exitosamente';
} elseif ($message == 'delete') {
    $tipo_alerta = 'class="alert alert-danger alert-dismissible mt-3"';
    $message = 'Se elimino exitosamente';
}

$result = $pdo->query("SELECT * FROM personal");
if ($result->rowCount() > 0) {
    $resultMeseros = $result->fetchAll(PDO::FETCH_OBJ);
}


?>
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">


<div class="container mt-3">
    <?php if ($message != '') { ?>
        <div <?php echo $tipo_alerta; ?> style="text-align: center;">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <h1 class="text-center"><?php echo $titulo; ?></h1>
    <button data-bs-toggle="modal" data-bs-target="#modalAgregar" class="btn btn-success mb-1"><i
            class="bi bi-person-plus-fill"></i></button>
    <br>
    <div class="d-flex centrar">
        <?php if (isset($resultMeseros)): ?>
            <table class="table table-border table-dark" style="width: 500px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <td>Nombre</td>
                        <td>Calificacion</td>
                        <td>Estatus</td>
                        <td>Opciones</td>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    <?php foreach ($resultMeseros as $mesero): ?>
                        <tr>
                            <th><?php echo $mesero->id ?></th>
                            <td><?php echo $mesero->nombre . " " . $mesero->apellido; ?></td>
                            <td>
                                <?php for ($star = 0; $star < $mesero->calificacion; $star++):
                                    echo '<i class="bi bi-star-fill"></i>';
                                endfor ?>
                            </td>
                            <td>
                                <?php
                                if ($mesero->estado == 1) {
                                    $icon = '<i class="fs-9 bi-unlock-fill text-success"></i>';
                                    $modal = 'data-bs-target="#modalBloquear"';
                                } else {
                                    $icon = '<i class="fs-9 bi-lock-fill text-danger"></i>';
                                    $modal = ' onclick="confirmarDesbloqueo(' . $mesero->id . ')" ';
                                }
                                ?>
                                <a data-bs-toggle="modal" <?php echo $modal; ?> href="" data-id="<?php echo $mesero->id; ?>"
                                    data-name="<?php echo $mesero->nombre; ?>"
                                    data-estado="<?php echo $mesero->estado; ?>"><?php echo $icon; ?></a>
                            </td>
                            <td>
                                <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar"
                                    data-id="<?php echo $mesero->id; ?>" data-name="<?php echo $mesero->nombre; ?>"
                                    data-apellido="<?php echo $mesero->apellido; ?>">
                                    <i class="fs-9 bi-pencil-square"></i></a>

                                <a href="#" onclick="confirmarEliminacion(<?php echo $mesero->id; ?>)">
                                    <i class="fs-6 bi-trash3-fill text-danger"></i>
                                </a>
                            </td>
                        <tr>
                        <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</div>

<!-- Modal agregar -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="was-validated" method="POST" action="personal_procesamiento.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar datos de mesero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="formulario" value="agregarMesero"></input>
                    <div class="mb-3">
                        <label for="nombre" class="form-label"><strong>Nombre</strong></label>
                        <input placeholder="Nombre de mesero" type="text" class="form-control" id="nombre"
                            name="tb_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label"><strong>Apellido</strong></label>
                        <input placeholder="Apellido de mesero" type="text" class="form-control" id="apellido"
                            name="tb_apellido" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="was-validated" method="POST" action="personal_procesamiento.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar datos de mesero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="formulario" value="editarMesero"></input>
                    <div class="mb-3">
                        <label for="modal-id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="modal-id" name="tb_id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modal-name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="modal-name" name="tb_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="modal-apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="modal-apellido" name="tb_apellido" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal bloquear -->
<div class="modal fade" id="modalBloquear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="was-validated" method="POST" action="personal_procesamiento.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bloquear</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="formulario" value="bloquarMesero">
                        <input type="hidden" class="form-control" id="modal-id" name="tb_id">
                        <input type="hidden" class="form-control" id="modal-estado" name="tb_estado">
                        <label class="form-label"><strong>Tiempo a bloquear a: </strong></label>
                        <label class="form-label" id="modal-name" name="tb_name"></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rb_block" id="opcionHoy"
                                onclick="opcionesExtra()" value="hoy" checked>
                            <label class="form-check-label" for="opcionHoy">Hoy</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rb_block" id="opcionVarios"
                                onclick="opcionesExtra()" value="varios">
                            <label class="form-check-label" for="opcionVarios">Varios días</label>
                        </div>
                    </div>
                    <div id="cuantosDias" class="hidden">
                        <div class="mb-3">
                            <label for="extraOption1" class="form-label">Fecha inicio</label>
                            <input min="<?php echo isset($fecha) ? $fecha : date('Y-m-d'); ?>" type="date"
                                class="form-control" id="startDate" onchange="IngresaMinFechaFin()" name="fechaInicio">
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">Fecha de Fin</label>
                            <input placeholder="Motivo por el que se bloqueara" type="date" class="form-control"
                                id="endDate"  name="fechaFin">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo</label>
                        <input type="text" class="form-control" id="motivo" name="tb_motivo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .hidden {
        display: none;
    }
</style>

<script>
    function opcionesExtra() {
        var cuantosDias = document.getElementById('cuantosDias');
        var opcionVarios = document.getElementById('opcionVarios');

        if (opcionVarios.checked) {
            cuantosDias.classList.remove('hidden');
        } else {
            cuantosDias.classList.add('hidden');
        }
    }

    function IngresaMinFechaFin() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate');

        // Establecer la fecha mínima del segundo input como la fecha seleccionada en el primer input
        endDate.min = startDate;
    }

    var modalEditar = document.getElementById('modalEditar');
    modalEditar.addEventListener('show.bs.modal', function (event) {
        // Elemento que activó el modal
        var link = event.relatedTarget;
        // Extraer información de los atributos data-*
        var id = link.getAttribute('data-id');
        var name = link.getAttribute('data-name');
        var apellido = link.getAttribute('data-apellido');

        // Actualizar el contenido del modal
        var modalId = modalEditar.querySelector('#modal-id');
        var modalName = modalEditar.querySelector('#modal-name');
        var modalApellido = modalEditar.querySelector('#modal-apellido');

        modalId.value = id;
        modalName.value = name;
        modalApellido.value = apellido;
    });

    var modalBloquear = document.getElementById('modalBloquear');
    modalBloquear.addEventListener('show.bs.modal', function (event) {
        // Elemento que activó el modal
        var link = event.relatedTarget;
        // Extraer información de los atributos data-*
        var id = link.getAttribute('data-id');
        var name = link.getAttribute('data-name');
        var estado = link.getAttribute('data-estado');

        // Actualizar el contenido del modal
        var modalId = modalBloquear.querySelector('#modal-id');
        var modalName = modalBloquear.querySelector('#modal-name');
        var modalEstado = modalBloquear.querySelector('#modal-estado');

        modalId.value = id;
        modalName.textContent = name;
        modalEstado.value = estado;
    });

    function confirmarDesbloqueo(id) {
        if (confirm("¿Estás seguro de desbloquear al mesero?" + id)) {
            var accion = 'desbloqueo'
            // Si el usuario confirma, redirige a la página PHP para eliminar el registro
            window.location.href = 'personal_procesamiento.php?id=' + id + '&accion=' + accion;
        }
    }

    function confirmarEliminacion(id) {
        if (confirm("¿Estás seguro de eliminar al mesero?" + id)) {
            var accion = 'eliminacion';
            // Si el usuario confirma, redirige a la página PHP para eliminar el registro
            window.location.href = 'personal_procesamiento.php?id=' + id + '&accion=' + accion;
        }
    }

</script>