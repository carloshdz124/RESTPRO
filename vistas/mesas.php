<?php
$ubicacion = "../";
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
    <!-- Mostramos los contenedores cada uno con las diferentes areas -->
    <?php if (isset($resultAreas)) {
        foreach ($resultAreas as $area) {
            //Consulta para ver mesas por zonas
            $result = $pdo->query('SELECT * FROM mesa WHERE area_id=' . $area->id . ' ORDER BY nombre ASC');
            if ($result->rowCount() > 0) {
                $resultMesas = $result->fetchAll(PDO::FETCH_OBJ);
            } ?>

            <div id="<?php echo $area->id; ?>" class="mapa container active" style="width: 100%; height: 4vh;">
                <p><?php echo $area->nombre; ?></p>
                <?php
                // Variable para identificar cada fila
                $fila = 0;
                foreach ($resultMesas as $mesa) {
                    // Condicionales para identificar caracteristicas de la mesa
                    if ($mesa->estado == 0) {
                        $estadoMesa = 'class="btn btn-success mb-1 me-1"';
                    } elseif ($mesa->estado == 1) {
                        $estadoMesa = 'class="btn btn-danger mb-1 me-1"';
                    } else {
                        $estadoMesa = 'class="btn btn-warning mb-1 me-1"';
                    }
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
                    echo '<div class="d-inline-block" id="tooltip-' . $mesa->id . '" data-bs-placement="top" title="N. personas: ' . $mesa->n_personas . '">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#verClientes" 
                                data-id="' . $mesa->id . '" data-nombre="' . $mesa->nombre . '" data-n_personas="' . $mesa->n_personas . '" data-id_zona="' . $mesa->area_id . '"
                                ' . $estadoMesa . '>'
                                . $mesa->nombre .
                            '</button>
                        </div>';

                } ?>
            </div>
        <?php }
    } else {
        echo 'No existen areas.';
    } ?>
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
                <div class="modal-body">
                    <?php if (isset($resultEspera)) { ?>
                        <table class="table table-dark centrar" style="width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">N. personas</th>
                                    <th scope="col">T. de espera</th>
                                    <th scope="col">Opc</th>
                                </tr>
                            </thead>
                            <tbody class="table-secondary">
                                <?php
                                foreach ($resultEspera as $espera):
                                    $id = $espera->id;
                                    $nombre_mesa = $espera->nombre;
                                    $total_personas = $espera->n_adultos + $espera->n_ninos;
                                    $tiempo_espera = $espera->hora_llegada;
                                    $zonas = $espera->zonas_deseadas;
                                    ?>
                                    <tr>
                                        <th><?php echo $ctn_espera; ?></th>
                                        <td><?php echo $nombre_mesa; ?></td>
                                        <td><?php echo $total_personas; ?></td>
                                        <td><?php echo calcularTiempo($tiempo_espera); ?></td>
                                        <td> <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verMesas"
                                                data-id="<?php echo $id; ?>" data-zonas="<?php echo $zonas; ?>"
                                                data-tPersonas="<?php echo $total_personas; ?>" type="button">
                                                Ver
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $ctn_espera += 1; endforeach ?>
                            </tbody>
                        </table>
                    <?php } else {
                        echo "No hay lista de espera";
                    } ?>
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
                        <label>ID: </l>
                            <label for="id" class="form-label" id="modal-id" name="tb_id"></label>
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
                        <div id="mesasDisponibles"></div>
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
                        <label >Mesa seleccionada: </label>
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
                    <div class=" mb-3">
                        <p><strong>Clientes a elegir: </strong></p>
                        <!-- Aqui mostramos los datos siendo una respuesta AJAX -->
                        <table class="table table-dark centrar" style="width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">N. personas</th>
                                    <th scope="col">Opc</th>
                                </tr>
                            </thead>
                            <tbody class="table-secondary" id="clientesDisponibles">

                            </tbody>
                        </table>
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

<script>
    // Validar que se seleccione por lo menos una opcion
    document.querySelector('form').addEventListener('submit', function (event) {
        // Obtener todos los checkboxes con el nombre 'cb_areas[]'
        const checkboxes = document.querySelectorAll('input[name="cb_areas[]"]');
        // Convertir NodeList a Array para poder usar métodos como some()
        const algunaSeleccionada = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!algunaSeleccionada) {
            // Evitar que el formulario se envíe
            event.preventDefault();
            // Mostrar mensaje de error
            document.getElementById('error').textContent = 'Por favor, selecciona al menos un área.';
        } else {
            // Limpiar mensaje de error si la validación es exitosa
            document.getElementById('error').textContent = '';
        }
    });

    // Enviar datos a modal y llamar funcion ajax para consulta
    var verClientes = document.getElementById('verClientes');
    verClientes.addEventListener('show.bs.modal', function (event) {
        // Elemento que activó el modal
        var link = event.relatedTarget;
        // Extraer información de los atributos data-*
        var id = link.getAttribute('data-id');
        var nombre = link.getAttribute('data-nombre');
        var n_personas = link.getAttribute('data-n_personas');
        var id_zona = link.getAttribute('data-id_zona')

        // Actualizar el contenido del modal
        var modalId = verClientes.querySelector('#modal-id');
        var modalNombre = verClientes.querySelector('#modal-nombre');
        var modaln_personas = verClientes.querySelector('#modal-n_personas');

        modalId.textContent = id;
        modalNombre.textContent = nombre;
        modaln_personas.textContent = n_personas;

        consultaMesas(id, id_zona, n_personas, 'verClientes');
    });

    // Enviar datos a modal y llamar funcion ajax para consulta
    var verMesas = document.getElementById('verMesas');
    verMesas.addEventListener('show.bs.modal', function (event) {
        // Elemento que activó el modal
        var link = event.relatedTarget;
        // Extraer información de los atributos data-*
        var id = link.getAttribute('data-id');
        var zonas = link.getAttribute('data-zonas');
        var total_personas = link.getAttribute('data-tPersonas');

        // Actualizar el contenido del modal
        var modalId = verMesas.querySelector('#modal-id');
        var modalZonas = verMesas.querySelector('#modal-zonas');
        var modalTPersonas = verMesas.querySelector('#modal-TPersonas');

        modalId.textContent = id;
        modalZonas.textContent = zonas;
        modalTPersonas.textContent = total_personas;


        consultaMesas(id, zonas, total_personas, 'verMesas');
    });

    // Funcion para llamada AJAX y reibir de respuesta datos del modal.
    function consultaMesas(id, valor1, valor2, accion) {
        if (accion == 'verMesas') {
            var data = {
                id: id,
                zonas: valor1,
                total_personas: valor2,
                accion: accion
            };
            var id_div_respuesta = '#mesasDisponibles';
        } if (accion == 'verClientes') {
            var data = {
                id: id,
                id_zona: valor1,
                n_personas: valor2,
                accion: accion
            };
            var id_div_respuesta = '#clientesDisponibles';
        }
        console.log(valor1);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "mesas_procesar.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var resultContainer = document.querySelector(id_div_respuesta); // Asegúrate de que este selector es correcto
                resultContainer.innerHTML = xhr.responseText;

                // Inicializa los tooltips después de que el contenido se haya actualizado
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        };
        xhr.send(JSON.stringify(data));
    }

    document.addEventListener('click', function (event) {
        // Verifica si el clic fue en un enlace dentro del tooltip
        if (event.target.matches('a.btn-primary')) { // Usa un selector más general
            event.preventDefault(); // Evita la acción predeterminada del enlace

            // Recupera los datos necesarios de los atributos data-*
            var id_mesa = event.target.getAttribute('data-id_mesa');
            var id_cliente = event.target.getAttribute('data-id_cliente');

            // Ahora puedes enviar estos datos al servidor usando una solicitud AJAX
            var data = {
                id_mesa: id_mesa,
                id_cliente: id_cliente,
                accion: 'seleccionar_mesa'  // Define una acción específica para esta solicitud en tu backend
            };

            // Realiza una solicitud ajax al backend
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "procesar_mesa.php", true); // Cambia a procesar_mesa.php si es el script adecuado
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Procesa la respuesta si es necesario
                    console.log('Respuesta del servidor:', xhr.responseText);
                }
            };
            xhr.send(JSON.stringify(data)); // Se envían datos como JSON
        }
    });

    function seleccionaMapa(containerId) {
        // Oculta todos los contenedores
        document.querySelectorAll('.mapa').forEach(function (container) {
            container.style.display = 'none';
        });
        // Muestra el contenedor seleccionado
        document.getElementById(containerId).style.display = 'block';
    }
    // Inicializar todos los tooltips en la página
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.addEventListener('DOMContentLoaded', function () {
    // Inicializa el tooltip en el div específico
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[id^="tooltip-"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

</script>

<?php
function calcularTiempo($hora)
{
    $horaActual = date('H:i:s');

    // Convertir las horas a timestamps
    $timestampHoraLlegada = strtotime($hora);
    $timestampHoraActual = strtotime($horaActual);

    // Calcular la diferencia en segundos
    $diferenciaSegundos = $timestampHoraActual - $timestampHoraLlegada;

    // Asegúrate de que la diferencia no sea negativa (si es necesario)
    if ($diferenciaSegundos < 0) {
        $diferenciaSegundos += 24 * 3600; // Añadir un día completo en segundos para manejar la diferencia negativa
    }

    // Convertir la diferencia a horas, minutos y segundos
    $diferenciaHoras = floor($diferenciaSegundos / 3600);
    $diferenciaMinutos = floor(($diferenciaSegundos % 3600) / 60);
    $diferenciaSegundos = $diferenciaSegundos % 60;

    // Formatear la diferencia en 'H:i:s'
    $diferenciaFormato = sprintf('%02d:%02d:%02d', $diferenciaHoras, $diferenciaMinutos, $diferenciaSegundos);

    return $diferenciaFormato;
}
include_once($ubicacion . "includes/footer.php");

?>