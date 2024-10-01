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
            $veces_en_area[] = 0;
        }
    }
    $mesero_array[] = $veces_en_area;
}

$meserosAsignados = acomodar($mesero_array,$n_areas,$meserosxArea);

function acomodar($meseros, $numAreas, $meserosPorArea)
{
    // Array para almacenar los meseros seleccionados por área
    $meserosSeleccionados = array_fill(0, $numAreas, []);
    // Array para llevar el control de los meseros ya asignados
    $meserosAsignados = []; 
    
    // Proceso de selección
    foreach ($meseros as $meseroIndex => $conteosAreas) {
        // Ordenar las áreas en función del número de veces que este mesero ha estado
        asort($conteosAreas);
        
        // Revisar áreas de menor a mayor número de veces que ha estado
        foreach ($conteosAreas as $areaIndex => $veces) {
            // Si aún hay cupo en el área, asignamos al mesero
            if (count($meserosSeleccionados[$areaIndex]) < $meserosPorArea[$areaIndex]) {
                $meserosSeleccionados[$areaIndex][] = $meseroIndex + 1; // Almacenamos el mesero (sumando 1 para la numeración)
                $meserosAsignados[] = $meseroIndex + 1; // Marcar como asignado
                break; // Romper el ciclo para pasar al siguiente mesero
            }
        }
    }
    
    return array_merge(...$meserosSeleccionados); // Devolver array con los meseros seleccionados por área
}