<?php

// Mostramos los contenedores cada uno con las diferentes areas
if (isset($resultAreas)) {
    // Inicializar un array global para almacenar los resultados categorizados por estación
    $globalCategorizadoPorColor = [];

    // Si tenemos seleccionamos un rol manualmente, asignamos la variable para cambiar la busqueda.
    $rol_seleccionado = isset($rol_seleccionado_get)?$rol_seleccionado_get : $rol_seleccionado;

    // Iterar sobre los resultados de las áreas
    foreach ($resultAreas as $area) {
        if (isset($bandera_estacion) && isset($rol_seleccionado)) {
            $result = $pdo->query('SELECT * FROM vista_mesas_color WHERE area_id=' . $area->id . ' AND rol=' . $rol_seleccionado . ' ORDER BY nombre ASC');

        } else {
            $result = $pdo->query('SELECT * FROM mesas WHERE area_id=' . $area->id . ' ORDER BY nombre ASC');
            if ($result->rowCount() > 0) {
                // Si se recibieron datos get para crear la estaciones.
                if (isset($meseroxArea)) {
                    // Hacemos consulta para ver número de mesas
                    $n_mesas_x_area = $pdo->query("SELECT COUNT(*) FROM mesas WHERE area_id = $area->id");
                    // Guardamos el resultado
                    $n_mesas_x_area = $n_mesas_x_area->fetchColumn();
                    $mesasxEstacionxArea = calcularNMesasxMesero($n_mesas_x_area, $meseroxArea[$area->id - 1]);
                    $mesasxEstacionxArea = calcularIteracionCambioColor($mesasxEstacionxArea);
                }
            }
        }
        $resultMesas = $result->fetchAll(PDO::FETCH_OBJ);
        // Consulta para ver mesas por zonas

        echo "<p>  $area->nombre</p>";

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
            // Si existe rol seleccionado mostramos los colores.
            } elseif (isset($bandera_estacion) && isset($rol_seleccionado)) {
                $color = $mesa->color;
                // Si el rol seleccionado es por get, entonces no mostramos nombres de meseros
                if(!isset($rol_seleccionado_get)){
                    $tooltip = "<br>Mesero: {$mesa->mesero_nombre}";
                }
            } else {
                $color = 'transparent';
            }
            $tooltip = isset($tooltip)? $tooltip : "";

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
            echo "<div class='d-inline-block border-custom' style='background-color:$color;' id='tooltip-{$mesa->id}' data-bs-placement='top' data-bs-html='true'
                title='N. personas: {$mesa->n_personas}$tooltip'>
                <button type='button' class='btn btn-success' data-id='{$mesa->id}'>
                    {$mesa->nombre}
                </button>
            </div>";
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