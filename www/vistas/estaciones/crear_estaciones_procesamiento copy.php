<?php
$ubicacion = "../../";
include_once ($ubicacion . "/config/config.php");

// Obtener el número de registros a mostrar desde la consulta
$registrosPorPagina = isset($_GET['count']) ? (int)$_GET['count'] : 5;

// Consulta SQL con LIMIT
$sql = "SELECT * FROM estaciones LIMIT :limite";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limite', $registrosPorPagina, PDO::PARAM_INT);
$stmt->execute();
$resultEstaciones = $stmt->fetchAll(PDO::FETCH_OBJ);

// Mostrar los registros en una tabla HTML
echo 
    "<table class='table table-striped'>
    <thead>
        <tr>
            <th>#</th>
            <th>Color</th>
            <th>Nombre</th>
            <th>Mesas</th>
        </tr>
    </thead>
    <tbody>";
foreach ($resultEstaciones as $estacion) {
    $id = $estacion->id;
    $color = $estacion->color;
    $nombre = $estacion->descripcion;
    echo "
        <tr>
            <td><label class='checkbox-label'>
                    <input class='form-check-input' type='checkbox' id='cb_{$id}'>
                </label>
            </td>
            <td><div class='color-box' style='background-color:{$color};'></div></td>
            <td>{$nombre}</td>
            <td>MESAS</td>
        </tr>
    ";
}
echo "</tbody></table>";
?>