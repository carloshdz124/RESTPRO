<?php
include_once("../../config/config.php");

//Consultamos todas las areas para mostrarlas en el rol
$result = $pdo->query("SELECT * FROM areas");
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
    $result = $pdo->query("SELECT COUNT(*) FROM areas");
    $n_areas = $result->fetchColumn();
}

if (isset($_POST['datos'])) {
    // Obtener los datos de POST (que esperas que estén en formato JSON)
    $meserosOrdenados = $_POST['datos'];
    // Eliminamos los corchetes de la cadena
    $meserosOrdenados = trim($meserosOrdenados, "[]");
    // y los convertimos a un array separando por comas cada elemento.
    $meserosOrdenados = explode(",", $meserosOrdenados);

    $n_meseros = count($meserosOrdenados);

    // Calculamos cuantos meseros son por zona, y acumulamos los resultados para saber cuando cambia de area cada mesero
    $meserosxArea = sumarPosiciones(calcularMeserosxArea($n_areas, $pdo, $n_meseros));

    // Consultamos los roles cuando para ver cual es el activo.
    $result = $pdo->query("SELECT * FROM roles WHERE descripcion = $n_meseros");
    if ($result->rowCount() > 0) {
        $resultRol = $result->fetch(PDO::FETCH_OBJ);
        // Guardamos el rol_id
        $rol_seleccionado = $resultRol->id;
    }
    // Creamos la consulta para crear el nuevo rol que asigna estacion, mesas y mesero
    $sql = "INSERT INTO asignacion_meseros (mesero_id,estacion_id,rol_id,fecha) VALUES ";
    $fecha = date("Y-m-d");
    foreach ($meserosOrdenados as $estacion_id => $mesero_id) {
        $sql .= "($mesero_id," . $estacion_id + 1 . ",$rol_seleccionado,'$fecha'),";
    }
    $sql = substr($sql, 0, -1);
    $result = $pdo->query($sql);
    $ctn_n_areas = 0;
    // Ahora recorreremos a todos los meseros para aumentar en su contador de area una unidad
    foreach ($meserosOrdenados as $estacion_id => $mesero_id){
        // Recorremos las areas para ver que area es la que le toco cada mesero y aumentar el contador
        foreach ($resultAreas as $area) {
            if($estacion_id == $meserosxArea[$ctn_n_areas]){
                $ctn_n_areas += 1;
            }else{
                $sql = "UPDATE ctn_area_mesero SET contador = contador + 1 WHERE mesero_id = $mesero_id AND area_id= " .$resultAreas[$ctn_n_areas]->id;
                $result = $pdo->query($sql);
                break;
            }
        }
    }
    if ($result->rowCount() > 0) {
        header("Location: rol.php?message=ok");
        exit();
    }

} else {
    echo 'No se recibieron datos...';
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