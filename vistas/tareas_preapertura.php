<?php
$ubicacion = "../";
$titulo = "TAREAS PREAPERTURA";
include ($ubicacion."includes/header.php");
?>
<div class="container mt-5">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <div class="form-group border border-black bg-dark text-white p-3 rounded-4 btn-group btn-group-lg">
        <button data-bs-toggle="modal" data-bs-target="#modalBloquear" class="btn btn-outline-danger btn-lg rounded-4 mx-2"><i class="bi bi-lock-fill"></i></button>
        <button data-bs-toggle="modal" data-bs-target="#modalDesbloquear" class="btn btn-outline-success btn-lg rounded-4 mx-2"><i class="bi bi-unlock-fill"></i></button>
        <button data-bs-toggle="modal" data-bs-target="#modalBuscar" class="btn btn-outline-info btn-lg rounded-4 mx-2"><i class="bi bi-search"></i></button>
    </div>
    <form method="POST" action="#">
        <div class="row">
            <!-- Primera Columna -->
            <div class="col-md-8">
                <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                    <h2 class="text-center" for="columna1">Meseros</h2><br>
                    <div class="justify-content-center">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero1" value="Mesero 1">
                                    </div>
                                    <label class="form-control" for="mesero1">
                                        Mesero 1
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero2" value="Mesero 2">
                                    </div>
                                    <label class="form-control" for="mesero2">
                                        Mesero 2
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero3" value="Mesero 3">
                                    </div>
                                    <label class="form-control" for="mesero3">
                                        Mesero 3
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero4" value="Mesero 4">
                                    </div>
                                    <label class="form-control" for="mesero4">
                                        Mesero 4
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero5" value="Mesero 5">
                                    </div>
                                    <label class="form-control" for="mesero5">
                                        Mesero 5
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero6" value="Mesero 6">
                                    </div>
                                    <label class="form-control" for="mesero6">
                                        Mesero 6
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero7" value="Mesero 7">
                                    </div>
                                    <label class="form-control" for="mesero7">
                                        Mesero 7
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero8" value="Mesero 8">
                                    </div>
                                    <label class="form-control" for="mesero8">
                                        Mesero 8
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero9" value="Mesero 9">
                                    </div>
                                    <label class="form-control" for="mesero9">
                                        Mesero 9
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero10" value="Mesero 10">
                                    </div>
                                    <label class="form-control" for="mesero10">
                                        Mesero 10
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero11" value="Mesero 11">
                                    </div>
                                    <label class="form-control" for="mesero11">
                                        Mesero 11
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero12" value="Mesero 12">
                                    </div>
                                    <label class="form-control" for="mesero12">
                                        Mesero 12
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero13" value="Mesero 13">
                                    </div>
                                    <label class="form-control" for="mesero13">
                                        Mesero 13
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero14" value="Mesero 14">
                                    </div>
                                    <label class="form-control" for="mesero14">
                                        Mesero 14
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero15" value="Mesero 15">
                                    </div>
                                    <label class="form-control" for="mesero15">
                                        Mesero 15
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero16" value="Mesero 16">
                                    </div>
                                    <label class="form-control" for="mesero16">
                                        Mesero 16
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero17" value="Mesero 17">
                                    </div>
                                    <label class="form-control" for="mesero17">
                                        Mesero 17
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero18" value="Mesero 18">
                                    </div>
                                    <label class="form-control" for="mesero18">
                                        Mesero 18
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero19" value="Mesero 19">
                                    </div>
                                    <label class="form-control" for="mesero19">
                                        Mesero 19
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="input-group mb-0">
                                    <div class="input-group-text bg-dark">
                                        <input class="form-check-input mt-0" type="checkbox" name="mesero" id="mesero20" value="Mesero 20">
                                    </div>
                                    <label class="form-control" for="mesero20">
                                        Mesero 20
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Segunda Columna -->
            <div class="col-md-4">
                <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                    <h2 class="text-center" for="columna2">Tareas</h2><br>
                    <div class="justify-content-center">
                        
                    </div>
                </div>
            </div>
        </div><br>
        <!-- Termina la columna e inicia la otra -->
        <div class="row">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-custom">EDITAR 📝</button>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-danger btn-custom">ELIMINAR ❌</button>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success btn-custom">CHECK ✅</button>
                </div>
            </div>
        </div><br><br><br>
    </form>
</div>

<!-- Script de los checkbox para solo selecionar uno a la vez -->
<script>
    // Selecciona todas las casillas de verificación
    const checkboxes = document.querySelectorAll('.form-check-input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            // Desmarcar todas las casillas de verificación excepto la seleccionada
            checkboxes.forEach(box => {
                if (box !== checkbox) {
                    box.checked = false;
                }
            });
        });
    });
</script>

<!-- Modal Bloquear Mesero -->
<div class="modal fade" id="modalBloquear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bloquear Mesero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label"><strong>Tiempo Bloqueado</strong></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rb_block" id="opcionHoy"
                            onclick="toggleOptions()" checked>
                        <label class="form-check-label" for="opcionHoy">Hoy</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rb_block" id="opcionVarios"
                            onclick="toggleOptions()">
                        <label class="form-check-label" for="opcionVarios">Varios Días</label>
                    </div>
                </div>
                <div id="cuantosDias" class="hidden">
                    <div class="mb-3">
                        <label for="extraOption1" class="form-label"><strong>Fecha de Inicio</strong></label>
                        <input min="<?php echo isset($fecha)? $fecha : date('Y-m-d'); ?>" type="date" class="form-control" id="startDate"
                            onchange="setMinEndDate()">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label"><strong>Fecha de Fin</strong></label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Bloquear</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Desbloquear Mesero -->
<div class="modal fade" id="modalDesbloquear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Desbloquear Mesero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label"><strong>Motivo Desbloqueo</strong></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rb_block" id="opcionHoy"
                            onclick="toggleOptions()" checked>
                        <label class="form-check-label" for="opcionHoy">Fin Descanso</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rb_block" id="opcionVarios"
                            onclick="toggleOptions()">
                        <label class="form-check-label" for="opcionVarios">Fin Vacaciones</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rb_block" id="opcionVarios"
                            onclick="toggleOptions()">
                        <label class="form-check-label" for="opcionVarios">Fin Castigo</label>
                    </div>
                </div>
                <div id="cuantosDias" class="hidden">
                    <div class="mb-3">
                        <label for="extraOption1" class="form-label"><strong>Fecha de Desbloqueo</strong></label>
                        <input min="<?php echo isset($fecha)? $fecha : date('Y-m-d'); ?>" type="date" class="form-control" id="startDate"
                            onchange="setMinEndDate()">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Desbloquear</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buscar Mesero -->
<div class="modal fade" id="modalBuscar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buscar Mesero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label"><strong>Ingrese el Nombre del Mesero</strong></label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Mesero" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php

include_once($ubicacion."includes/footer.php");

?>