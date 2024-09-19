<?php

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
}

// Mostramos los contenedores cada uno con las diferentes areas
if (isset($resultAreas)) {
// Inicializar un array global para almacenar los resultados categorizados por estación
$globalCategorizadoPorColor = [];

// Iterar sobre los resultados de las áreas
foreach ($resultAreas as $area) {
    // Consulta para ver mesas por zonas
    $result = $pdo->query('SELECT * FROM mesas WHERE area_id=' . $area->id . ' ORDER BY nombre ASC');

    if ($result->rowCount() > 0) {
        $resultMesas = $result->fetchAll(PDO::FETCH_OBJ);
        if (isset($meseroxArea)) {
            // Hacemos consulta para ver número de mesas
            $n_mesas_x_area = $pdo->query("SELECT COUNT(*) FROM mesas WHERE area_id = $area->id");
            // Guardamos el resultado
            $n_mesas_x_area = $n_mesas_x_area->fetchColumn();
            $mesasxEstacionxArea = calcularNMesasxMesero($n_mesas_x_area, $meseroxArea[$area->id - 1]);
            $mesasxEstacionxArea = calcularIteracionCambioColor($mesasxEstacionxArea);
        }
    }
    ?>
    <p><?php echo $area->nombre; ?></p>
    <?php
    // Variable para identificar cada fila
    $fila = 0;
    $categorizadoPorColor = [];

    // Iterar sobre los resultados de las mesas
    foreach ($resultMesas as $indiceMesa => $mesa) {
        // Obtener el color para la mesa
        if (isset($mesasxEstacionxArea)) {
            if (in_array($indiceMesa, $mesasxEstacionxArea)) {
                $resultEstaciones = $resultConsultaEstaciones->fetch(PDO::FETCH_OBJ);
            }
            $color = isset($resultEstaciones) ? $resultEstaciones->color : 'transparent';
            $estacion_id = $resultEstaciones->id;

            // Agregar el nombre de la mesa al array categorizado
            if (!isset($categorizadoPorColor[$estacion_id])) {
                $categorizadoPorColor[$estacion_id] = [];
            }
            $categorizadoPorColor[$estacion_id][] = ['id' => $mesa->id, 'nombre' => $mesa->nombre];
        } else {
            $color = 'transparent';
        }

        // Condición para hacer salto de línea si se cambia de fila
        if (strlen($mesa->nombre) == 2) {
            if ($mesa->nombre[0] != $fila) {
                $fila = $mesa->nombre[0];
                echo '<br>';
            }
        } elseif (strlen($mesa->nombre) == 3) {
            if ($mesa->nombre[1] != $fila) {
                $fila = $mesa->nombre[1];
                echo '<br>';
            }
        }

        // Botones que representan las mesas
        echo "
        <div class='d-inline-block border-custom' style='background-color:$color;' id='tooltip-{$mesa->id}' data-bs-placement='top' title='N. personas: {$mesa->n_personas}'>
            <button type='button' class='btn btn-success' data-id='{$mesa->id}'>
                {$mesa->nombre}
            </button>
        </div>
        ";
    }

    // Si hay datos en $_GET['datos'], hacer fetch adicional
    if (isset($_GET['datos'])) {
        $resultEstaciones = $resultConsultaEstaciones->fetch(PDO::FETCH_OBJ);
    }

    // Almacenar los resultados categorizados en el array global
    foreach ($categorizadoPorColor as $estacion_id => $mesas) {
        if (!isset($globalCategorizadoPorColor[$estacion_id])) {
            $globalCategorizadoPorColor[$estacion_id] = [];
        }
        $globalCategorizadoPorColor[$estacion_id] = array_merge($globalCategorizadoPorColor[$estacion_id], $mesas);
    }
}

    /*/ (Opcional) Mostrar las mesas categorizadas por color globalmente
    foreach ($globalCategorizadoPorColor as $estacion_id => $mesas) {
        echo "<h3>Mesas con color $estacion_id</h3>";
        foreach ($mesas as $nombreMesa) {
            echo "<p>$nombreMesa</p>";
        }
    }

    print_r($globalCategorizadoPorColor['17']);
    */
} else {
    echo 'No existen areas.';
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

<script>
    // Inicializar todos los tooltips en la página
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Inicializa el tooltip en el div específico
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[id^="tooltip-"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>