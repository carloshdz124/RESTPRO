<?php
// Verificamos el dia de hoy
$hoy = date("w");
// Verificamos segun el dia, los meseros disponibles.
if ($hoy >= 1 && $hoy <= 4) {
    $result = $pdo->query('SELECT * FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
    $resultCount = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
} else {
    $result = $pdo->query('SELECT * FROM personal WHERE estado = 1 AND descanso != ' . $hoy);
    $resultCount = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy);
}
//Guardamos los resultados de los meseros
$resultMeseros = $result->fetchAll(PDO::FETCH_OBJ);
//Creamos un contador para recorrer los meseros.
$ctn_meseros = 0;
$ctn_areas = 0;

$n_meseros = $resultCount->fetchColumn();

//Consultamos todas las areas para mostrarlas en el rol
$result = $pdo->query("SELECT * FROM areas");
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
    $result = $pdo->query("SELECT COUNT(*) FROM areas");
    $n_areas = $result->fetchColumn();
}

//Consultamos la vista mesas estacion para mostrar ya todas las mesas de cada estacion
$result = $pdo->query("SELECT * FROM vista_mesas_estaciones WHERE rol_descripcion = $n_meseros");
if ($result->rowCount() > 0) {
    $resultEstaciones = $result->fetchAll(PDO::FETCH_OBJ);
}