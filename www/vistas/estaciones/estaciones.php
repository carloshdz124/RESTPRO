<?php
$ubicacion = "../../";
$titulo = "Estaciones";

session_start(); // Iniciar la sesión

// Si no existe estacion, entonces redireccionamos a craer
if ($_SESSION["estaciones"] == false) {
    header('Location: crear_estaciones.php');
}

include($ubicacion . "config/config.php");
include($ubicacion . "includes/header.php");

include('consultas/consultas.php');

if (isset($rol_seleccionado)) {
    $sql = "SELECT COUNT(*) FROM asignacion_mesas WHERE rol_id = $rol_seleccionado";
    $result = $pdo->query($sql);
    $n_mesasEstacion = $result->fetchColumn();
    $msj_button = 'Ver detalles de zona';

} else {
    $_SESSION["estaciones"] = false;
    $n_mesasEstacion = 0;
    echo '<script type="text/javascript">
            window.location.reload();
          </script>';
}

$sql = "SELECT COUNT(*) FROM mesas";
$result = $pdo->query($sql);
$n_mesas = $result->fetchColumn();

$sql = "SELECT * FROM roles ORDER BY descripcion DESC";
$result = $pdo->query($sql);
if ($result->rowCount() > 0) {
    $resultRoles = $result->fetchAll(PDO::FETCH_OBJ);
}
$message = isset($message) ? $message : '';

// Comparamos el total de mesas con el total de las mesas registradas en esa estacion
$diferencia = $n_mesas - $n_mesasEstacion;

?>

<div class="container mt-3">
    <?php if ($message != '') { ?>
        <div class="<?php echo $alert; ?>" style="text-align: center;">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <div class="col" style="text-align: right;">
        <strong>Meseros Disponibles: <?php echo $ctn_meseros; ?></strong>
    </div>
    <div class="row">
        <div class="col">
            <a href="crear_estaciones.php" title="Crear Zona" class="btn btn-success">
                Ver detalles
            </a>
        </div>
        <div class="col" style="text-align: center;">
            <p>
                ROL PARA <?php echo $rol_descripcion; ?>
            </p>
            <br>
                <button onclick="recargar();" class="btn btn-primary">
                    Elegir rol de hoy
                </button>
        </div>
        <div class="col">
            <?php if($diferencia == 0) { ?>
            <!-- Boton para seleccionar areas y mostrarlas -->
            <div class="dropdown" style="text-align: right;">
                <button type="button" class="btn btn-secondary dropdown-toggle" style="background-color:grey"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Ver otros roles
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <?php foreach ($resultRoles as $rol) { ?>
                        <li><a onclick="seleccionaRol('<?php echo $rol->id; ?>')"
                                class="dropdown-item"><?php echo $rol->descripcion; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Si existen areas mostramos mapas de areas -->
    <?php
    $bandera_estacion = true;
    include_once('mesas_mapas.php');
    ?>
</div>


<!--script src="<?php echo $ubicacion; ?>/assets/tools/scripts/mapa_mesas.js"></script-->
<link rel="stylesheet" href="<?php echo $ubicacion; ?>/assets/tools/styles/estilos_estaciones.css">
<script>

    function seleccionaRol(nombre) {
        window.location.href = 'estaciones.php?rol=' + nombre;
    }

    function recargar() {
        window.location.href = 'estaciones.php';
    }
</script>

<?php
include_once($ubicacion . "includes/footer.php");
?>