<?php
// Mostramos los contenedores cada uno con las diferentes areas
if (isset($resultAreas)) {
    foreach ($resultAreas as $area) {
        // Consulta para ver mesas por zonas, si venimos de estaciones, ademas añadimos colores a las estaciones
        $fecha = date('Y-m-d');
        $result = $pdo->query("SELECT * FROM vista_mesas_color WHERE area_id = $area->id  AND fecha = '$fecha' ORDER BY nombre ASC");
        if ($result->rowCount() > 0) {
            $resultMesas = $result->fetchAll(PDO::FETCH_OBJ);
        } ?>
        <div id="<?php echo $area->id; ?>" class="mapa container active" style="width: 100%;">
            <p><?php echo $area->nombre; ?></p>
            <?php
            // Variable para identificar cada fila
            $fila = 0;
            foreach ($resultMesas as $mesa) {
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
                // Validamos si esta separada
                if ($mesa->mesa_separada_id != null) {
                    $separada = 1;
                }
                $separada = isset($mesa->nombre_mesa_separadas)?1:0;
                $mesa_id = isset($mesa->mesa_separada_id)?$mesa->mesa_separada_id:$mesa->id;
                $mesa_nombre = isset($mesa->nombre_mesa_separadas)?$mesa->nombre_mesa_separadas:$mesa->nombre;
                $mesa_n_personas = isset($mesa->n_personas_separadas)?$mesa->n_personas_separadas:$mesa->n_personas;
                $mesa_estado = isset($mesa->estado_mesa_separadas)?$mesa->estado_mesa_separadas:$mesa->estado;

                // Botones que representan las mesas
                echo "<div class='d-inline-block border-custom' id='tooltip-$mesa_id' data-bs-placement='top' data-bs-html='true'
                        title='N. personas: {$mesa_n_personas}<br>Mesero: $mesa->mesero_nombre'>
                        <button type='button' data-bs-toggle='modal' data-bs-target='#verClientes' 
                            data-separada='$separada'
                            data-estado='$mesa_estado'
                            data-id='$mesa_id' 
                            data-nombre='$mesa_nombre' 
                            data-n_personas='$mesa_n_personas' 
                            data-id_zona='$mesa->area_id'
                            data-mesero='$mesa->mesero_nombre' 
                            data-id-mesero='$mesa->mesero_id'
                            class='btn'>$mesa_nombre </button>
                    </div>";
            } ?>
        </div>

    <?php }
} else {
    echo 'No existen areas.';
} ?>