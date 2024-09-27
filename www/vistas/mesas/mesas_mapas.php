<?php
// Mostramos los contenedores cada uno con las diferentes areas
if (isset($resultAreas)) {
    foreach ($resultAreas as $area) {
        // Consulta para ver mesas por zonas, si venimos de estaciones, ademas añadimos colores a las estaciones
        $result = $pdo->query("SELECT * FROM vista_mesas_color WHERE area_id= $area->id AND rol = $rol_id ORDER BY nombre ASC");
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
                // Botones que representan las mesas
                echo "<div class='d-inline-block border-custom' id='tooltip-$mesa->id' data-bs-placement='top' data-bs-html='true'
                        title='N. personas: {$mesa->n_personas}<br>Mesero: $mesa->mesero_nombre'>
                        <button type='button' data-bs-toggle='modal' data-bs-target='#verClientes' data-estado='$mesa->estado'
                            data-id='$mesa->id' data-nombre='$mesa->nombre' data-n_personas='$mesa->n_personas' data-id_zona='$mesa->area_id'
                            data-mesero='$mesa->mesero_nombre' class='btn'>$mesa->nombre </button>
                    </div>";
            } ?>
        </div>

    <?php }
} else {
    echo 'No existen areas.';
} ?>