<?php
$ubicacion = "../../";
include_once($ubicacion . "/config/config.php");

// Consulta para revisar si existen áreas
$sql = "SELECT * FROM mesa_cliente WHERE estado = 1";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    $resultReservaciones = $result->fetchAll(PDO::FETCH_OBJ);

    // Generar la tabla en HTML
    echo '<table class="table table-dark centrar" style="width:100%;">
        <thead>
            <tr>
                <td scope="col">Cliente</td>
                <td scope="col">Fecha</td>
                <td scope="col">N. personas</t>
                <td scope="col">Hora</td>
                <th scope="col">Opción</th>
            </tr>
        </thead>
        <tbody class="table-secondary">';

    foreach ($resultReservaciones as $reservaciones){
        echo "<tr>
            <td>{$reservaciones->nombre}</td>
            <td>{$reservaciones->fecha}</td>
            <td>" . $reservaciones->n_adultos + $reservaciones->n_ninos . "</td>
            <td>{$reservaciones->hora_llegada}</td>
            <td>
                <button type='button' title='Cancelar Reservacion' class='btn btn-danger'
                    onclick='eliminarReservacion({$reservaciones->id},\"$reservaciones->nombre\");'
                    data-bs-dismiss='modal'>
                    <i class='bi bi-person-x-fill'></i>
                </button>
            </td>
        </tr>";
    }
    echo '</tbody></table>';
} else {
    echo "No hay reservaciones";
}

?>