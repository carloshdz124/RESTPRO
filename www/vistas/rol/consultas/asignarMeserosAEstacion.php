<?php

echo "n_meseros: $n_meseros  ";
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
    $mesero_array[] = $veces_en_area;
}
$meserosAsignados = acomodar($mesero_array,$n_areas,$meserosxArea);
echo(count($mesero_array));

function acomodar($meseros, $numAreas, $meserosPorArea)
{
    // Array para almacenar los meseros seleccionados por área
    $meserosSeleccionados = [];
    // Array para llevar el control de los meseros ya asignados
    $meserosAsignados = []; 
    
    // Proceso de selección
    foreach (range(0, $numAreas - 1) as $area) {
        // Array para almacenar meseros y su conteo de visitas a esta área
        $meserosConConteo = [];
        
        foreach (range(0, count($meseros) - 1) as $mesero) {
            // Solo considerar meseros no asignados aún
            if (!in_array($mesero + 1, $meserosAsignados)) {
                // Número de veces en el área
                $meserosConConteo[$mesero] = $meseros[$mesero][$area]; 
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