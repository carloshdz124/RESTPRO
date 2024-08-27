<?php
$ubicacion = "../";
$titulo = "TAREAS PREAPERTURA";
include ($ubicacion."includes/header.php");
include ($ubicacion."config/conexion.php");

$result = $pdo->query("SELECT * FROM personal");
if ($result->rowCount() > 0) {
    $resultMeseros = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultMeseros = array();
}
?>
<div class="container mt-5">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <div class="form-group border border-black bg-dark text-white p-3 rounded-4 btn-group btn-group-lg">
        <button data-bs-toggle="modal" data-bs-target="#modalBloquear" class="btn btn-outline-danger btn-lg rounded-4 mx-2" title="BLOQUEAR"><i class="bi bi-lock-fill"></i></button>
        <button data-bs-toggle="modal" data-bs-target="#modalDesbloquear" class="btn btn-outline-success btn-lg rounded-4 mx-2" title="DESBLOQUEAR"><i class="bi bi-unlock-fill"></i></button>
        <button data-bs-toggle="modal" data-bs-target="#modalBuscar" class="btn btn-outline-info btn-lg rounded-4 mx-2" title="BUSCAR"><i class="bi bi-search"></i></button>
    </div>
    <form method="POST" action="#">
        <div class="row">
            <!-- Primera Columna -->
            <div class="col-md-8">
                <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                    <h2 class="text-center" for="columna1">Meseros</h2><br>
                    <div class="justify-content-center">
                        <ul class="list-group">
                            <?php foreach ($resultMeseros as $mesero): ?>
                                <li class="list-group-item">
                                    <div class="input-group mb-0">
                                        <div class="input-group-text bg-dark">
                                            <input class="form-check-input mt-0" type="checkbox" name="meseros[]" id="mesero<?php echo $mesero->id; ?>" value="<?php echo $mesero->id; ?>">
                                        </div>
                                        <label class="form-control text-primary-emphasis bg-primary-subtle border border-primary-subtle d-flex justify-content-between align-items-center p-3" for="mesero<?php echo $mesero->id; ?>">
                                            <?php echo htmlspecialchars($mesero->nombre . " " . $mesero->apellido); ?>
                                        </label>
                                        <button data-bs-toggle="modal" data-bs-target="#modalEditar" class="btn btn-outline-warning btn-lg rounded-4 mx-2" title="DETALLES">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </li>
                            <?php endforeach; ?>
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

<!-- JS con los Tooltips (función que hace el cursor cuando lo pasamos por un boton) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});
</script>