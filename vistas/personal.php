<?php
$ubicacion = "../";
$titulo = "Personal";
include ($ubicacion . "includes/header.php");
include ($ubicacion . "config/conexion.php");


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
}

$result = $pdo->query("SELECT * FROM personal");
if ($result->rowCount() > 0) {
    $resultMeseros = $result->fetchAll(PDO::FETCH_OBJ);
    $contMeseros = 1;
}

$result = $pdo->query("SELECT * FROM personal_bloqueado where estatus = 0");
if ($result->rowCount() > 0) {
    $resultEstado = $result->fetchAll(PDO::FETCH_OBJ);
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
                            <th><?php echo $contMeseros ?></th>
                            <td><?php echo $mesero->nombre . " " . $mesero->apellido; ?></td>
                            <td>
                                <?php for ($star = 0; $star < $mesero->calificacion; $star++):
                                    echo '<i class="bi bi-star-fill"></i>';
                                endfor ?>
                            </td>
                            <td><?php echo $mesero->estado; ?></td>
                            <td>
                                <?php validarEstado($mesero->id, $resultEstado,$pdo);
                                if ($mesero->estado == 1) {
                                    $icon = '<i class="fs-9 bi-unlock-fill text-success"></i>';
                                } else {
                                    $icon = '<i class="fs-9 bi-lock-fill text-danger"></i>';
                                } ?>
                                <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar"
                                    data-id="<?php echo $mesero->id; ?>" data-name="<?php echo $mesero->nombre; ?>"
                                    data-apellido="<?php echo $mesero->apellido; ?>">
                                    <i class="fs-9 bi-pencil-square"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#modalBloquear" href=""
                                    data-id="<?php echo $mesero->id; ?>"
                                    data-estado="<?php echo $mesero->estado; ?>"><?php echo $icon; ?></a>
                                <a href="">
                                    <i class="fs-6 bi-trash3-fill text-danger"></i>
                                </a>
                            </td>
                        <tr>
                            <?php $contMeseros += 1; endforeach ?>
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
                        <input type="hidden" name="formulario" value="bloquarMesero"></input>
                        <div class="mb-3">
                            <label for="modal-id" class="form-label">ID</label>
                            <input type="text" class="form-control" id="modal-id" name="tb_id" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="modal-estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="modal-estado" name="tb_estado" required>
                        </div>
                        <label for="nombre" class="form-label"><strong>Tiempo bloqueado</strong></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rb_block" id="opcionHoy"
                                onclick="toggleOptions()" value="hoy" checked>
                            <label class="form-check-label" for="opcionHoy">Hoy</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rb_block" id="opcionVarios"
                                onclick="toggleOptions()" value="varios">
                            <label class="form-check-label" for="opcionVarios">Varios días</label>
                        </div>
                    </div>
                    <div id="cuantosDias" class="hidden">
                        <div class="mb-3">
                            <label for="extraOption1" class="form-label">Fecha inicio</label>
                            <input min="<?php echo isset($fecha) ? $fecha : date('Y-m-d'); ?>" type="date"
                                class="form-control" id="startDate" onchange="setMinEndDate()" name="fechaInicio">
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">Fecha de Fin</label>
                            <input placeholder="Motivo por el que se bloqueara" type="date" class="form-control"
                                id="endDate" name="endDate" name="fechaFin">
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
    function toggleOptions() {
        var cuantosDias = document.getElementById('cuantosDias');
        var opcionVarios = document.getElementById('opcionVarios');

        if (opcionVarios.checked) {
            cuantosDias.classList.remove('hidden');
        } else {
            cuantosDias.classList.add('hidden');
        }
    }

    function setMinEndDate() {
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
        var estado = link.getAttribute('data-estado');

        // Actualizar el contenido del modal
        var modalId = modalBloquear.querySelector('#modal-id');
        var modalEstado = modalBloquear.querySelector('#modal-estado');

        modalId.value = id;
        modalEstado.value = estado;
    });
</script>
<?php
function validarEstado($id, $resultEstados,$pdo){
    $fecha = '2024-07-06';
    $fechaUsada = isset($fecha) ? $fecha : date('Y-m-d');
    foreach ($resultEstados as $meseroEstado) {
        if ($meseroEstado->personal_id == $id && $meseroEstado->fecha_fin == $fechaUsada) {
            $sql = "UPDATE personal SET estado = 1 WHERE id = :tb_id";
            $ejecucion = $pdo->prepare($sql);
            $ejecucion->execute(array(":tb_id" => $id));

            $sql = "UPDATE personal_bloqueado SET estatus = 0 WHERE id = :tb_id";
            $ejecucion = $pdo->prepare($sql);
            $ejecucion->execute(array(":tb_id" => $id));
        }
    }
}
?>