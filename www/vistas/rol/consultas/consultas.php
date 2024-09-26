<?php
// Verificamos el dia de hoy
$hoy = date("w");
// Verificamos segun el dia, los meseros disponibles.
if ($hoy >= 1 && $hoy <= 4) {
    $result = $pdo->query('SELECT * FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
    $resultCount = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
} else {
    $result = $pdo->query('SELECT * FROM personal WHERE estado = 1 AND (descanso != ' . $hoy . ' OR descanso = "fines" )');
    $resultCount = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND (descanso != ' . $hoy . ' OR descanso = "fines" )');
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

//Consultamos la vista mesas estacion para mostrar todas las mesas de cada estacion
$result = $pdo->query("SELECT * FROM vista_mesas_estaciones WHERE rol_descripcion = $n_meseros");
if ($result->rowCount() > 0) {
    $resultEstaciones = $result->fetchAll(PDO::FETCH_OBJ);
}

// Consulta para ver si existe rol de hoy.
$fecha = date('Y-m-d');
$result = $pdo->query("SELECT * FROM vista_mesero_mesa WHERE fecha = '$fecha'");
if ($result->rowCount() > 0) {
    $result_vista_meseros_mesas = $result->fetchAll(PDO::FETCH_OBJ);
    // Calculamos cuantos meseros son por zona, y acumulamos los resultados para saber cuando cambia de area cada mesero
    $meserosxArea_acumulados = sumarPosiciones(calcularMeserosxArea($n_areas, $pdo, $n_meseros));
}

// Consulta para ver roles pasados.
$result = $pdo->query("SELECT DISTINCT fecha FROM vista_mesero_mesa ORDER BY fecha DESC");
if($result->rowCount() > 0){
    $resultRolesPasados = $result->fetchAll(PDO::FETCH_OBJ);
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];

    if ($message == 'ok') {
        $alert = 'alert alert-success alert-dismissible mt-3';
        $message = 'Se creo rol Correctamente!!!';
    } else {
        echo "Mensaje recibido: $message";
    }
}



function sumarPosiciones($array) {
    $resultado = [];
    $suma = 0;
    
    foreach ($array as $valor) {
        $suma += $valor;
        $resultado[] = $suma;
    }
    
    return $resultado;
}
function calcularMeserosxArea($n_areas, $pdo, $n_meseros)
{
    // Array para almacenar los meseros por area
    $n_meseros_x_area = array();
    for ($area = 1; $area <= $n_areas; $area++) {
        //Consultamos el total de mesas por area
        $result = $pdo->query("SELECT COUNT(*) FROM mesas WHERE area_id = {$area}");
        //Guardamos el resultado
        $mesasxarea = $result->fetchColumn();
        //Calculamos el porcentaje de mesas de x area respecto al total de mesas
        $porcentajeMesasArea = round($mesasxarea * 100 / 83);
        //calculamos el numero de meseros por area
        $meserosxarea = round($n_meseros * $porcentajeMesasArea / 100);
        //Agreamos el total de meseros por area en el array
        array_push($n_meseros_x_area, $meserosxarea);
    }
    //validamos que no sobren o falten meseros comparado con el total de meseros por area
    if (array_sum($n_meseros_x_area) - $n_meseros < 0) {
        //Si faltan, añadimos uno
        $n_meseros_x_area[2] = $n_meseros_x_area[2] + 1;
    } elseif (array_sum($n_meseros_x_area) - $n_meseros > 0) {
        //Si sobran, eliminamos uno
        $n_meseros_x_area[0] = $n_meseros_x_area[0] - 1;
    }

    return $n_meseros_x_area;
}