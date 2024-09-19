<?php
// Mostramos los contenedores cada uno con las diferentes areas
if (isset($resultAreas)) {
    foreach ($resultAreas as $area) {
        // Consulta para ver mesas por zonas, si venimos de estaciones, ademas añadimos colores a las estaciones
        if (!isset($bandera_estacion)) {
            $result = $pdo->query('SELECT * FROM mesas WHERE area_id=' . $area->id . ' ORDER BY nombre ASC');
            $opc_boton = ' data-bs-toggle="modal" data-bs-target="#verClientes" ';
        } elseif(isset($bandera_estacion) || isset($crear_estacion)){
            $result = $pdo->query('SELECT * FROM mesas_color WHERE area_id=' . $area->id . ' AND rol=17 ORDER BY nombre ASC');
            $opc_boton = '';
        }
        if ($result->rowCount() > 0) {
            $resultMesas = $result->fetchAll(PDO::FETCH_OBJ);
        } ?>
        <div id="<?php echo $area->id; ?>" class="mapa container active" style="width: 100%;">
            <p><?php echo $area->nombre; ?></p>
            <?php
            // Variable para identificar cada fila
            $fila = 0;
            foreach ($resultMesas as $mesa) {
                // Volvemos a validar si venimos de estaciones, si venimos de estaciones, añadimos los colores de fondo
                if (isset($bandera_estacion)) {
                    $color = $mesa->color;
                } else{
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
                echo '<div class="d-inline-block border-custom" id="tooltip-' . $mesa->id . '" data-bs-placement="top" title="N. personas: ' . $mesa->n_personas . '" style="background-color:' . $color . ';">
                <button type="button" '.$opc_boton. ' data-estado="' . $mesa->estado . '"
                    data-id="' . $mesa->id . '" data-nombre="' . $mesa->nombre . '" data-n_personas="' . $mesa->n_personas . '" data-id_zona="' . $mesa->area_id . '"
                    class="btn">' . $mesa->nombre . '</button>
            </div>';
            } ?>
        </div>

    <?php }
} else {
    echo 'No existen areas.';
} ?>