<?php
include_once 'config.php';

// Consulta para validar el estado de los meseros.
$sql = 'SELECT personal.id, personal.estado, personal_bloqueado.fecha_fin FROM personal
INNER JOIN personal_bloqueado
ON personal.id = personal_bloqueado.personal_id
where personal_bloqueado.vigencia = 0';
$result = $pdo->query("$sql");
if ($result->rowCount() > 0) {
    $resultEstados = $result->fetchAll(PDO::FETCH_OBJ);
}

if (isset($resultEstados)) {
    $fecha = '2024-07-05';
    $fechaUsada = isset($fecha) ? $fecha : date('Y-m-d');
    foreach ($resultEstados as $meseroEstado) {
        if ($meseroEstado->fecha_fin <= $fechaUsada) {
            $sql = "UPDATE personal SET estado = 1 WHERE id = :tb_id";
            $ejecucion = $pdo->prepare($sql);
            $ejecucion->execute(array(":tb_id" => $meseroEstado->id));

            $sql = "UPDATE personal_bloqueado SET vigencia = 1 WHERE personal_id = :tb_id";
            $ejecucion = $pdo->prepare($sql);
            $ejecucion->execute(array(":tb_id" => $meseroEstado->id));
        }
    }
}

function mesasDisponibles($Zonas){
    echo ' ';
}

?>