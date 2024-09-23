<table class="table table-bordered table-dark" style="width: 500px;">
    <?php // Recorremos las areas para poder mostrarlas
    foreach ($resultAreas as $iterador_area => $area):
        $nombre_area = $area->nombre;
        $area_id = $area->id;
        ?>
        <thead>
            <tr>
                <th scope="col"><?php echo $nombre_area; ?></th>
                <th scope="col">Mesas</th>
            </tr>
        </thead>
        <tbody class="table-secondary">
            <?php // Recorremos los meseros disponibles en el dia 
                foreach ($result_vista_meseros_mesas as $mesero):
                    if ($meserosxArea_acumulados[$iterador_area] == $ctn_meseros) {
                        break;
                    }
                    $nombre = $result_vista_meseros_mesas[$ctn_meseros]->mesero;
                    $mesas = $result_vista_meseros_mesas[$ctn_meseros]->mesas;
                    $ctn_meseros += 1; ?>
                <tr>
                    <th scope="row"><?php echo $nombre; ?></th>
                    <td><?php echo $mesas; ?></td>
                </tr>
                <?php
                endforeach ?>
        </tbody>
        <?php $ctn_areas += 1; endforeach ?>
</table>