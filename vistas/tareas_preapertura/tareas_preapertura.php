<?php
$ubicacion = "../../";
$titulo = "TAREAS PREAPERTURA";
include ($ubicacion."includes/header.php");
include ($ubicacion."config/conexion.php");

// Query para seleccionar todos los elementos que hay en la tabla de meseros.
$result = $pdo->query("SELECT * FROM personal");
if ($result->rowCount() > 0) {
    $resultMeseros = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultMeseros = array();
}

// Query para seleccionar todos los elementos que hay en la tabla de tareas pre-apertura.
$result = $pdo->query("SELECT * FROM tareas_preapertura");
if ($result->rowCount() > 0) {
    $resultTareasPreApertura = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultTareasPreApertura = array();
}
?>
<div class="container mt-5">
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <div class="form-group border border-black bg-dark text-white p-3 rounded-4 btn-group btn-group-lg">
        <button data-bs-toggle="modal" data-bs-target="#modalBloquear" class="btn btn-outline-danger btn-lg rounded-4 mx-2" title="BLOQUEAR MESERO"><i class="bi bi-lock-fill"></i></button>
        <button data-bs-toggle="modal" data-bs-target="#modalDesbloquear" class="btn btn-outline-success btn-lg rounded-4 mx-2" title="DESBLOQUEAR MESERO"><i class="bi bi-unlock-fill"></i></button>
        <button data-bs-toggle="modal" data-bs-target="#modalBuscar" class="btn btn-outline-info btn-lg rounded-4 mx-2" title="BUSCAR MESERO"><i class="bi bi-search"></i></button>
    </div>
    <form method="POST" action="#">
        <div class="row">
            <!-- Primera Columna -->
            <div class="col-md-4">
                <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                    <h2 class="text-center" for="columna1">Meseros</h2><br>
                    <div class="justify-content-center">
                        <ul class="list-group">
                            <?php foreach ($resultMeseros as $mesero): ?>
                                <li class="list-group-item">
                                    <div class="input-group mb-0">
                                        <div class="input-group-text bg-dark">
                                            <input class="form-check-input mt-0" type="checkbox" name="meseros[]" id="mesero<?php echo $mesero->id; ?>" value="<?php echo htmlspecialchars($mesero->nombre . " " . $mesero->apellido); ?>" onchange="updateSelectedMeseros()">
                                        </div>
                                        <label class="form-control text-primary-emphasis bg-primary-subtle border border-primary-subtle d-flex justify-content-between align-items-center p-3" for="mesero<?php echo $mesero->id; ?>">
                                            <?php echo htmlspecialchars($mesero->nombre . " " . $mesero->apellido); ?>
                                        </label>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Segunda Columna -->
            <div class="col-md-5">
                <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                    <h2 class="text-center" for="columna2">Meseros Seleccionados</h2><br>
                    <div class="justify-content-center">
                        <ul class="list-group" id="selectedMeserosList">
                            <!-- Aquí se mostrarán los meseros seleccionados -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Tercer Columna -->
            <div class="col-md-3">
                <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                    <h2 class="text-center" for="columna3">Tareas</h2><br>
                    <div class="justify-content-center">
                        <ul class="list-group">
                            <?php foreach ($resultTareasPreApertura as $tareaspreapertura): ?>
                                <li class="list-group-item">
                                    <div class="input-group mb-0">
                                        <span class="form-control text-primary-emphasis bg-success-subtle border border-success-subtle d-flex justify-content-between align-items-center p-3" for="tareaspreapertura<?php echo $tareaspreapertura->id; ?>">
                                            <?php echo htmlspecialchars($tareaspreapertura->nombre); ?>
                                        </span>
                                        <button data-bs-toggle="modal" data-bs-target="#modalMostrar" class="btn btn-outline-dark btn-lg rounded-4 mx-2" title="MOSTRAR">
                                            <i class="bi bi-clipboard-fill"></i>
                                        </button>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
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

<!-- Modal Editar Mesero -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- Modal Mostar Mesero -->
<div class="modal fade" id="modalMostrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<!-- JS con los CheckBox (función que hace al seleccionar o quitar la selección de meseros a traves del checkbox en tiempo real) -->
<script>
    function updateSelectedMeseros() {
        // Obtener todos los checkbox que están seleccionados
        const selectedCheckboxes = document.querySelectorAll('input[name="meseros[]"]:checked');
        
        // Obtener el contenedor de la lista de meseros seleccionados
        const selectedMeserosList = document.getElementById('selectedMeserosList');
        
        // Limpiar la lista actual
        selectedMeserosList.innerHTML = '';
        
        // Añadir cada mesero seleccionado a la lista
        selectedCheckboxes.forEach(function(checkbox) {
            // Crear el elemento li
            const listItem = document.createElement('li');
            listItem.className = 'form-control text-primary-emphasis bg-primary-subtle border border-primary-subtle d-flex justify-content-between align-items-center p-3 mb-2';
            
            // Crear el texto del mesero
            const meseroText = document.createElement('span');
            meseroText.textContent = checkbox.value;
            
            // Crear el botón
            const removeButton = document.createElement('button');
            removeButton.className = 'btn btn-outline-warning btn-lg rounded-4 mx-2';
            removeButton.innerHTML = '<i class="bi bi-eye"></i>'; // Icono de Detalles
            removeButton.title = 'Quitar';
            
            // Agregar un evento para quitar el mesero de la lista
            removeButton.onclick = function() {
                checkbox.checked = false; // Desmarcar el checkbox
                updateSelectedMeseros(); // Actualizar la lista
            };
            
            // Añadir el texto y el botón al li
            listItem.appendChild(meseroText);
            listItem.appendChild(removeButton);
            
            // Añadir el li a la lista de meseros seleccionados
            selectedMeserosList.appendChild(listItem);
        });
    }
</script>

<button data-bs-toggle="modal" data-bs-target="#modalEditar" class="btn btn-outline-warning btn-lg rounded-4 mx-2" title="DETALLES">
                                            
                                        </button>