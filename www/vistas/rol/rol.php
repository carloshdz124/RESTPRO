<?php
$ubicacion = "../../";
$titulo = "Rol";
include($ubicacion . "includes/header.php");


$hoy = date("w");
if ($hoy >= 1 && $hoy <= 4) {
    $result = $pdo->query('SELECT * FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
    $resultCount = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
} else {
    $result = $pdo->query('SELECT * FROM personal WHERE estado = 1 AND descanso != ' . $hoy);
    $resultCount = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy);
}
$resultMeseros = $result->fetchAll(PDO::FETCH_OBJ);
$ctn_meseros = 0;
$resultMeseros = asignarMeseros($resultMeseros);
$n_meseros = $resultCount->fetchColumn();
echo $n_meseros;

$result = $pdo->query("SELECT * FROM areas");
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
}

$result = $pdo->query("SELECT * FROM vista_mesas_estaciones WHERE rol_descripcion = $n_meseros");
if ($result->rowCount() > 0) {
    $resultEstaciones = $result->fetchAll(PDO::FETCH_OBJ);
}


?>
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">

<div class="container mt-3">
    <!-- Alerta -->
    <div id="alertGenerar" class="alert alert-warning alert-dismissible fade" role="alert" style="display: none;">
        <strong>En proceso:</strong> Aquí generará roles distintos cada que se presione.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <h1 class="text-center"><?php echo $titulo; ?></h1>
    <div class="row">
        <div class="col">
            <p><?php echo isset($fecha) ? $fecha : date('Y-m-d'); ?></p>
        </div>

        <div class="col" style="text-align: right;">
            <button onclick="window.location.reload();" class="btn btn-dark">Generar</button>
            <button data-bs-toggle="modal" data-bs-target="#modalHistorial" class="btn btn-dark">Historial</button>
        </div>
    </div>
    <br>
    <div class="centrar d-flex">
        <?php if (isset($resultEstaciones)) {
            //Recorremos cada area para mostrarla en la tabla -->
            if (isset($resultAreas)) { ?>
                <table class="table table-bordered table-dark" style="width: 500px;">
                    <?php foreach ($resultAreas as $area):
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
                            <?php foreach ($resultMeseros as $mesero):
                                if ($ctn_meseros > $n_meseros - 1 || $area_id != $resultEstaciones[$ctn_meseros]->area_id) {
                                    break;
                                }
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $resultMeseros[$ctn_meseros]->nombre; ?></th>
                                    <td><?php echo $resultEstaciones[$ctn_meseros]->mesas; ?></td>
                                </tr>
                                <?php $ctn_meseros += 1; endforeach ?>
                        </tbody>
                    <?php endforeach ?>
                </table>
            <?php } else {
                echo 'No existen areas';
            }
        } else { ?>
        </div>
        <div style="text-align:center;">

            <p>
                No existe rol para la cantidad de meseros.
            </p>
            <a href="../estaciones/crear_estaciones.php" title="Crear Zona" class="btn btn-danger">
                Crear rol
            </a>
        </div>
    <?php }
        ?>
</div> <!-- Final del container -->

<!-- Modal Lista de días de roles -->
<div class="modal fade" id="modalHistorial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Roles de días anteriores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex centrar">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dentro de modal de roles anteriores -->
<div class="modal fade" id="modalRol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rol dia xx-xx-xxxx</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body centrar d-flex">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="exportToPDF" data-bs-dismiss="modal"><i
                        class="bi bi-printer"></i></button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('showAlertGenerar').addEventListener('click', function () {
        const alert = document.getElementById('alertGenerar');
        alert.style.display = 'block';
        alert.classList.add('show');
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>
<script src="<?php echo $ubicacion; ?>assets/tools/scripts/guardarRol.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

<?php
function asignarMeseros($array)
{
    // Copiar el array para no modificar el original
    $arrayCopia = $array;

    // Desordenar el array
    shuffle($arrayCopia);

    // Devolver el array desordenado
    return $arrayCopia;
}
?>