<?php
$ubicacion = "../../";
include_once($ubicacion . "/config/config.php");

// Consulta para obtener el estado de las mesas
$fecha = date('Y-m-d');
$sql = "SELECT id, estado FROM mesas";
$sql = "SELECT * FROM vista_mesas_color WHERE fecha = '$fecha'";
$result = $pdo->query($sql);

$estadoMesas = [];
while ($row = $result->fetch(PDO::FETCH_OBJ)) {
    $id = isset($row->mesa_separada_id)?$row->mesa_separada_id:$row->id;
    $estadoMesas[$id] = isset($row->mesa_separada_id)?$row->estado_mesa_separadas:$row->estado;
}

header('Content-Type: application/json');
echo json_encode($estadoMesas);
?>