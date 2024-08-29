<?php
$ubicacion = "../../";
$titulo = "Rol";
include($ubicacion . "includes/header.php");

$result = $pdo->query("SELECT * FROM personal");
if ($result->rowCount() > 0) {
    $resultMeseros = $result->fetchAll(PDO::FETCH_OBJ);
    $ctn_meseros = 0;
    $resultMeseros = desordernar($resultMeseros);
}

$result = $pdo->query("SELECT * FROM area");
if ($result->rowCount() > 0) {
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
}

$result = $pdo->query("SELECT * FROM estaciones");
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
        <?php if (isset($resultAreas)) { ?>
            <table class="table table-bordered table-dark" style="width: 500px;">
                <?php foreach ($resultAreas as $area):
                    $nombre_area = $area->nombre;
                    ?>
                    <thead>
                        <tr>
                            <th scope="col"><?php echo $nombre_area; ?></th>
                            <th scope="col">Mesas</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <?php foreach ($resultMeseros as $mesero):
                            if (($ctn_meseros == 8 && $area->id == 1)||($ctn_meseros == 13 && $area->id == 2)||($ctn_meseros == 18 && $area->id == 3)||($ctn_meseros == 23 && $area->id == 4)) {
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
        } ?>
    </div>
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
                <table class="table table-dark" style="width: 300px;">
                    <thead>
                        <tr>
                            <th scope="col"><strong>Día</strong></th>
                            <th scope="col">Ver</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <tr>
                            <th scope="row">23-07-2024</th>
                            <td><button data-bs-toggle="modal" data-bs-target="#modalRol" class="btn btn-success"><i
                                        class="bi bi-eye"></i></button></td>
                        </tr>
                        <tr>
                            <th scope="row">22-07-2024</th>
                            <td><button data-bs-toggle="modal" data-bs-target="#modalRol" class="btn btn-success"><i
                                        class="bi bi-eye"></i></button></td>
                        </tr>
                        <tr>
                            <th scope="row">21-07-2024</th>
                            <td><button data-bs-toggle="modal" data-bs-target="#modalRol" class="btn btn-success"><i
                                        class="bi bi-eye"></i></button></td>
                        </tr>
                    </tbody>
                </table>
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
                <table class="table table-bordered table-dark" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Salon</th>
                            <th scope="col">Mesas</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <tr>
                            <th scope="row">Juan</th>
                            <td>1 - 2 - 10 - 11</td>
                        </tr>
                        <tr>
                            <th scope="row">Pedro</th>
                            <td>3 - 4 - 12 - 13</td>
                        </tr>
                        <tr>
                            <th scope="row">Manuel</th>
                            <td>20 - 21 - 30 - 31</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th scope="col">Terraza</th>
                            <th scope="col">Mesas</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <tr>
                            <th scope="row">Juan</th>
                            <td>1 - 2 - 10 - 11</td>
                        </tr>
                        <tr>
                            <th scope="row">Pedro</th>
                            <td>3 - 4 - 12 - 13</td>
                        </tr>
                        <tr>
                            <th scope="row">Manuel</th>
                            <td>20 - 21 - 30 - 31</td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th scope="col">Area Infantil</th>
                            <th scope="col">Mesas</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">

                        <tr>
                            <th scope="row">Juan</th>
                            <td>1 - 2 - 10 - 11</td>
                        </tr>
                        <tr>
                            <th scope="row">Pedro</th>
                            <td>3 - 4 - 12 - 13</td>
                        </tr>
                        <tr>
                            <th scope="row">Manuel</th>
                            <td>20 - 21 - 30 - 31</td>
                </table>
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
function desordernar($array)
{
    // Copiar el array para no modificar el original
    $arrayCopia = $array;

    // Desordenar el array
    shuffle($arrayCopia);

    // Devolver el array desordenado
    return $arrayCopia;
}
?>