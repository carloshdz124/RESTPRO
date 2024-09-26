<?php
$ubicacion = "../../";
$titulo = "Rol";
include($ubicacion . "config/config.php");
include($ubicacion . "includes/header.php");

// Consultas necesarias para rol.php
include("consultas/consultas.php");
// Si existe estaciones con meseros compatible, creamos la a crear.
if (isset($resultEstaciones)) {
    include("consultas/asignarMeserosAEstacion.php");
}

$id_mesero_ordenado = [];
?>
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_vistas.css">

<div class="container mt-3">
    <?php if (isset($message) && $message != '') { ?>
        <div class="<?php echo $alert; ?>" style="text-align: center;">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <h1 class="text-center"><?php echo $titulo; ?></h1>
    <?php if (isset($resultEstaciones)) { ?>
        <div class="row">
            <div class="col">
                <p><strong>FECHA: </strong><?php echo isset($fecha) ? $fecha : date('Y-m-d'); ?></p>
            </div>
            <div class="col centrar">
                Rol para: <?php echo $resultEstaciones[0]->rol_descripcion; ?>
            </div>
            <div class="col" style="text-align: right;">
                <!-- Boton que envia formulario de ids de meseros, esta debajo -->
                <?php if (isset($result_vista_meseros_mesas)) { ?>
                    <!--button data-bs-toggle="modal" data-bs-target="#modalHistorial" class="btn btn-dark">
                        Historial
                    </button-->
                <?php } else { ?>
                    <div id="sendButton">
                        <button class="btn btn-dark">
                            Crear rol
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <br>
        <div class="centrar d-flex">
            <?php
            // Si ya se creo el rol para el dia de hoy, se muestra ese rol.
            if (isset($result_vista_meseros_mesas)) {
                include_once 'consultas/tabla_rol_creado.php';
                // Si no se ah creado se muestra el recomendado.
            } else {
                //Recorremos cada area para mostrarla en la tabla -->
                if (isset($resultAreas)) { ?>
                    <table class="table table-bordered table-dark" style="width: 500px;">
                        <?php // Recorremos las areas para poder mostrarlas
                                    foreach ($resultAreas as $area):
                                        $ctn_meseros_x_area = 0;
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
                                                foreach ($resultMeseros as $mesero):
                                                    // Si el contador de meseros es mayor a numero de meseros o el area_id es distinta al al area_id de la estacion
                                                    // terminamos el ciclo para pasar a la siguiente area
                                                    if ($ctn_meseros > $n_meseros - 1 || $area_id != $resultEstaciones[$ctn_meseros]->area_id) {
                                                        break;
                                                    }
                                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $resultMeseros[$meserosAsignados[$ctn_meseros] - 1]->nombre; ?></th>
                                        <td><?php echo $resultEstaciones[$ctn_meseros]->mesas; ?></td>
                                    </tr>
                                    <?php
                                    // Agregamos a un array el id del mesero, ordenamos como deben ir en el rol.
                                    $id_mesero_ordenado[] = $resultMeseros[$meserosAsignados[$ctn_meseros] - 1]->id;
                                    $ctn_meseros += 1;
                                    $ctn_meseros_x_area += 1;
                                                endforeach ?>
                            </tbody>
                            <?php $ctn_areas += 1; endforeach ?>
                    </table>
                    <?php
                    $jsonData = json_encode($id_mesero_ordenado);
                    ?>
                    <form id="miFormulario" method="POST" action="rol_procesar.php">
                        <input type="hidden" name="datos" value='<?php echo $jsonData; ?>'>
                    </form>
                    <?php
                } else {
                    echo 'No existen areas';
                }
            } ?>
        </div>
        <?php
    } else { ?>
        <div style="text-align:center;">

            <p>
                No existe rol para la cantidad de meseros.
            </p>
            <a href="../estaciones/crear_estaciones.php" title="Crear Rol" class="btn btn-danger">
                Crear rol
            </a>
        </div>
        <?php
    } ?>
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
                <?php
                if (isset($resultRolesPasados)) {
                    foreach ($resultRolesPasados as $rol) {
                        echo "<br>" . $rol->fecha . "<i class='bi bi-eye-fill'></i>";
                    }
                } else {
                    echo "No existen roles pasados.";
                } ?>
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>
<script src="<?php echo $ubicacion; ?>assets/tools/scripts/guardarRol.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>


<?php //Condicion, si existe rol creado, no se existira el script, para evitar errores en consola.
if (!isset($result_vista_meseros_mesas)) { ?>
    <script>
        document.getElementById('sendButton').addEventListener('click', function () {
            document.getElementById('miFormulario').submit();
        });
    </script>

    <?php
}
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