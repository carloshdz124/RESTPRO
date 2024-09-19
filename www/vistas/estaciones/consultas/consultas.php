<?php
$sql = "SELECT * FROM areas";
$result = $pdo->query($sql);
// Se realiza una consulta para revisar si existen areas -->
$sql = "SELECT * FROM areas";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
    $ctn_areas = $result->rowCount();
} else {
    $resultAreas = array();
}
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    if ($message == 'ok') {
        $alert = 'alert alert-success alert-dismissible mt-3';
        $message = "Se creo la estacion.";
    } else {
        $alert = 'alert alert-warning alert-dismissible mt-3';
        $message = "Ya existe esa estacion";
    }
}

// Consulta para ver numero de meseros
$hoy = date("w");
if ($hoy >= 1 && $hoy <= 4) {
    $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
} else {
    $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy);
}
$ctn_meseros = $result->fetchColumn();

$result = $pdo->query("SELECT * FROM roles WHERE descripcion = $ctn_meseros");
if ($result->rowCount() > 0) {
    $resultRol = $result->fetch(PDO::FETCH_OBJ);
    $rol_seleccionado = $resultRol->id;
    $rol_descripcion = $resultRol->descripcion;
}

// Verificar si se han enviado datos
if (isset($_GET['datos'])) {
    // Obtener el array de datos
    $meseroxArea = $_GET['datos'];
    $meseroxArea = $meseroxArea[0]; // Esto mostrará el array enviado

    // Dividir la cadena en un array usando la coma como delimitador
    $arrayString = explode(',', $meseroxArea);

    // Convertir todos los elementos del array a enteros
    $meseroxArea = array_map('intval', $arrayString);

    $resultConsultaEstaciones = $pdo->query("SELECT * FROM estaciones LIMIT " . array_sum($meseroxArea));
    if ($resultConsultaEstaciones->rowCount() > 0) {
        $resultEstaciones = $resultConsultaEstaciones->fetch(PDO::FETCH_OBJ);
    }
} elseif (isset($_GET['rol'])) {
    $rol_seleccionado = $_GET['rol'];
}

function calcularMeserosxArea($ctn_areas, $pdo, $ctn_meseros)
{
    // Array para almacenar los meseros por area
    $n_meseros_x_area = array();
    for ($area = 1; $area <= $ctn_areas; $area++) {
        //Consultamos el total de mesas por area
        $result = $pdo->query("SELECT COUNT(*) FROM mesas WHERE area_id = {$area}");
        //Guardamos el resultado
        $mesasxarea = $result->fetchColumn();
        //Calculamos el porcentaje de mesas de x area respecto al total de mesas
        $porcentajeMesasArea = round($mesasxarea * 100 / 83);
        //calculamos el numero de meseros por area
        $meserosxarea = round($ctn_meseros * $porcentajeMesasArea / 100);
        //Agreamos el total de meseros por area en el array
        array_push($n_meseros_x_area, $meserosxarea);
    }
    //validamos que no sobren o falten meseros comparado con el total de meseros por area
    if (array_sum($n_meseros_x_area) - $ctn_meseros < 0) {
        //Si faltan, añadimos uno
        $n_meseros_x_area[2] = $n_meseros_x_area[2] + 1;
    } elseif (array_sum($n_meseros_x_area) - $ctn_meseros > 0) {
        //Si sobran, eliminamos uno
        $n_meseros_x_area[0] = $n_meseros_x_area[0] - 1;
    }

    return $n_meseros_x_area;
}

function calcularNMesasxMesero($numero, $partes)
{
    $cociente = intdiv($numero, $partes);  // División entera
    $residuo = $numero % $partes;  // Obtener el residuo

    // Crear un array donde las primeras partes obtienen 1 más si hay residuo
    $resultado = array_fill(0, $partes, $cociente);
    for ($i = 0; $i < $residuo; $i++) {
        $resultado[$i]++;
    }

    return $resultado;
}

function calcularIteracionCambioColor($original)
{
    // Inicializar un array para guardar las sumas acumuladas
    $acumulado = [];

    // Variable para mantener la suma acumulada
    $suma = 0;

    // Recorrer el array original y acumular los valores
    foreach ($original as $cantidad) {
        $suma += $cantidad;  // Acumular el valor actual
        $acumulado[] = $suma;  // Guardar la suma acumulada en el nuevo array
    }

    return $acumulado;
}
?>