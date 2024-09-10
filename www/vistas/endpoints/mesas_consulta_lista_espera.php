<?php
$ubicacion = "../../";
include_once($ubicacion . "/config/config.php");

// Consulta para revisar si existen áreas
$sql = "SELECT * FROM mesa_cliente WHERE estado = 0";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    $resultEspera = $result->fetchAll(PDO::FETCH_OBJ);
    $ctn_espera = 1;

    // Generar la tabla en HTML
    echo '<table class="table table-dark centrar" style="width:100%;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">N. personas</th>
                        <th scope="col">T. de espera</th>
                        <th scope="col">Opc</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">';

    foreach ($resultEspera as $espera) {
        $id = $espera->id;
        $nombre_mesa = $espera->nombre;
        $total_personas = $espera->n_adultos + $espera->n_ninos;
        $tiempo_espera = $espera->hora_llegada;
        $zonas = $espera->zonas_deseadas;

        echo "<tr>
                    <th>{$ctn_espera}</th>
                    <td>{$nombre_mesa}</td>
                    <td>{$total_personas}</td>
                    <td>" . calcularTiempo($tiempo_espera) . "</td>
                    <td>
                        <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#verMesas'
                                data-id='{$id}' data-zonas='{$zonas}' data-nombre='{$nombre_mesa}'
                                data-tPersonas='{$total_personas}' type='button'>
                                Ver
                        </button>
                    </td>
                  </tr>";
        $ctn_espera++;
    }

    echo '</tbody></table>';
} else {
    echo "No hay lista de espera";
}

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

?>