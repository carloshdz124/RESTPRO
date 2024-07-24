<?php
$ubicacion = "../";
$titulo = "Personal";
include ($ubicacion . "includes/header.php");
?>
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">


<div class="container mt-3">
    <h1 class="text-center"><?php echo $titulo; ?></h1>
    <button data-bs-toggle="modal" data-bs-target="#modalAgregar" class="btn btn-success mb-1"><i
            class="bi bi-person-plus-fill"></i></button>
    <br>
    <div class="d-flex centrar">
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
                <tr>
                    <th>#</th>
                    <td>Juan</td>
                    <td>
                        <i class="fs-9 bi-star-fill"></i>
                        <i class="fs-9 bi-star-fill"></i>
                        <i class="fs-9 bi-star-fill"></i>
                        <i class="fs-9 bi-star-fill"></i>
                        <i class="fs-9 bi-star-fill"></i>
                    </td>
                    <td>Activo</td>
                    <td>
                        <a data-bs-toggle="modal" data-bs-target="#modalEditar" href=""><i
                                class="fs-9 bi-pencil-square"></i></a>
                        <a data-bs-toggle="modal" data-bs-target="#modalBloquear" href=""><i
                                class="fs-9 bi-lock-fill text-danger"></i></a>
                        <a href=""><i class="fs-6 bi-trash3-fill text-danger"></i></a>
                    </td>
                <tr>
                <tr>
                    <th>#</th>
                    <td>Pedro</td>
                    <td>
                        <i class="fs-6 bi-star-fill"></i>
                        <i class="fs-9 bi-star-fill"></i>
                        <i class="fs-9 bi-star-fill"></i>
                        <i class="fs-9 bi-star-fill"></i>
                    </td>
                    <td>Activo</td>
                    <td>

                        <a data-bs-toggle="modal" data-bs-target="#modalEditar" href=""><i
                                class="fs-6 bi-pencil-square"></i></a>
                        <a data-bs-toggle="modal" data-bs-target="#modalBloquear" href=""><i
                                class="fs-6 bi-unlock-fill text-success"></i></a>
                        <a href=""><i class="fs-6 bi-trash3-fill text-danger"></i></a>
                    </td>
                <tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal agregar -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar datos de mesero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input placeholder="Nombre de mesero" type="text" class="form-control" id="nombre" name="nombre"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar datos de mesero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input placeholder="Nombre corregido" type="text" class="form-control" id="nombre" name="nombre"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal bloquear -->
<div class="modal fade" id="modalBloquear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bloquear</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label"><strong>Tiempo bloqueado</strong></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rb_block" id="opcionHoy"
                            onclick="toggleOptions()" checked>
                        <label class="form-check-label" for="opcionHoy">Hoy</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rb_block" id="opcionVarios"
                            onclick="toggleOptions()">
                        <label class="form-check-label" for="opcionVarios">Varios días</label>
                    </div>
                </div>
                <div id="cuantosDias" class="hidden">
                    <div class="mb-3">
                        <label for="extraOption1" class="form-label">Fecha inicio</label>
                        <input min="<?php echo date('Y-m-d'); ?>" type="date" class="form-control" id="startDate"
                            onchange="setMinEndDate()">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
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
</script>
</script>