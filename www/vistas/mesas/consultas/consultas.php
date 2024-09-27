<?php
$sql = "SELECT * FROM areas";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
} else {
    $resultAreas = array();
}

// Se realiza consulta para revisar si existe alguna reservacion.
$sql = "SELECT * FROM mesa_cliente WHERE estado = 1";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultReservaciones = $result->fetchAll(PDO::FETCH_OBJ);
}

// Se realiza una consulta para revisar si existen areas.
$sql = "SELECT * FROM mesa_cliente WHERE estado = 0 ";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $ctn_espera = 1;
    $resultEspera = $result->fetchAll(PDO::FETCH_OBJ);
}

// Consulta para ver numero de meseros
$hoy = date("w");
if($hoy > 0 && $hoy < 5){
    $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != '. $hoy .' AND descanso != "fines" ');
}else{
    $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND (descanso != '. $hoy .' OR descanso = "fines" )');
}
$n_meseros = $result->fetchColumn();

// Consulta para seleccionar el rol del dia
$result = $pdo->query("SELECT * FROM roles WHERE descripcion = $n_meseros");
if ($result->rowCount() > 0) {
    $resultRol = $result->fetch(PDO::FETCH_OBJ);
    $rol_id = $resultRol->id;
}

?>