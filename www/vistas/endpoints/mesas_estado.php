<?php
$ubicacion = "../../";
include_once($ubicacion . "/config/conexion.php");

// Consulta para obtener el estado de las mesas
$sql = "SELECT id, estado FROM mesas";
$result = $pdo->query($sql);

$estadoMesas = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $estadoMesas[$row['id']] = $row['estado'];
}

header('Content-Type: application/json');
echo json_encode($estadoMesas);
?>
