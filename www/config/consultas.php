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
    // Si existe, verificamos cuando vence su bloqueo para volver a activarlo.
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

// Consulta para ver numero de meseros
$hoy = date("w");
if($hoy > 0 && $hoy < 5){
    $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != '. $hoy .' AND descanso != "fines" ');
}else{
    $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND (descanso != '. $hoy .' OR descanso = "fines" )');
}
$n_meseros = $result->fetchColumn();

// Consulta para validar si existe estaciones para cantidad de meseros
$result = $pdo->query("SELECT 1 FROM roles WHERE descripcion = $n_meseros");
if ($result->rowCount() > 0) {
    $_SESSION["estaciones"] = true;
    
}else{
    $_SESSION["estaciones"] = false;
}

// Consulta para ver si existe rol de hoy.
$fecha = date('Y-m-d');
$result = $pdo->query("SELECT * FROM vista_mesero_mesa WHERE fecha = '$fecha'");
if ($result->rowCount() > 0) {
    $_SESSION["rol_creado"] = true;
    $n_estaciones = $result->fetch(PDO::FETCH_OBJ);
    $n_estaciones = $n_estaciones->rol;
    // Validamos que sea para el numero correcto de meseros y estaciones
    if ($n_estaciones != $n_meseros) {
        $result = $pdo->query("DELETE FROM `asignacion_meseros` WHERE fecha = '$fecha'");
        $_SESSION["rol_creado"] = false;
    }
}else{
    $_SESSION["rol_creado"] = false;
}

?>