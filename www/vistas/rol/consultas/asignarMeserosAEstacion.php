<?php

$meserosxArea = calcularMeserosxArea($n_areas, $pdo, $n_meseros);

$mesero_array = [];
// Recorremos todos los meseros
foreach ($resultMeseros as $mesero) {
    //Creamos una variable array para almacenar la cantidad de veces que x mesero a estado en x area
    $veces_en_area = [];
    // Recorremos cada area
    foreach ($resultAreas as $area) {
        // Consultamos si existen datos de este mesero en esta area.
        $result = $pdo->query("SELECT * FROM ctn_area_mesero WHERE mesero_id=$mesero->id AND area_id=$area->id");
        // Si existe, solo almacenamos la cantidad de veces que ah estado en cada area
        if ($result->rowCount() > 0) {
            $resultAreaMesero = $result->fetch(PDO::FETCH_OBJ);
            $veces_en_area[] = $resultAreaMesero->contador;
            // Sino creamos un registro de ese mesero en esa area.
        } else {
            $result = $pdo->query("INSERT INTO ctn_area_mesero (mesero_id,area_id) VALUES ($mesero->id, $area->id)");
        }
    }
    //$orden = ordenarAreasMenores($veces_en_area);
    $mesero_array[] = $veces_en_area;
    //print_r($orden);
}
$meserosAsignados = acomodar($mesero_array,$n_areas,$meserosxArea);

function acomodar($meseros, $numAreas, $meserosPorArea)
{
    // Array para almacenar los meseros seleccionados por área
    $meserosSeleccionados = [];
    $meserosAsignados = []; // Array para llevar el control de los meseros ya asignados
    
    // Proceso de selección
    foreach (range(0, $numAreas - 1) as $area) {
        // Array para almacenar meseros y su conteo de visitas a esta área
        $meserosConConteo = [];
        
        foreach (range(0, count($meseros) - 1) as $mesero) {
            // Solo considerar meseros no asignados aún
            if (!in_array($mesero + 1, $meserosAsignados)) {
                $meserosConConteo[$mesero] = $meseros[$mesero][$area]; // Número de veces en el área
            }
        }
        
        // Ordenar meseros por número de veces en esta área (ascendente)
        asort($meserosConConteo);
        
        // Seleccionar meseros según la cantidad necesaria
        $contador = 0;
        foreach ($meserosConConteo as $mesero => $veces) {
            if ($contador < $meserosPorArea[$area]) {
                $meserosSeleccionados[] = $mesero + 1; // Almacenamos el mesero (sumando 1 para la numeración)
                $meserosAsignados[] = $mesero + 1; // Marcar como asignado
                $contador++;
            } else {
                break;
            }
        }
    }
    
    return $meserosSeleccionados; // Devolver un solo array sencillo
}

function ordenarAreasMenores($array)
{
    // Obtener las posiciones en orden ascendente
    $posiciones = array_keys($array);
    array_multisort($array, SORT_ASC, $posiciones);

    // Mostrar resultados
    return ($posiciones);
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