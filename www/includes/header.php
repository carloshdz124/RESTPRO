<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Solo inicia la sesión si no hay una activa
}
// Verificar si el usuario está conectado
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $tipo_user = $_SESSION['tipo_user'];
} else {
    header('Location: ' . $ubicacion . 'login.php');
    exit();
}

if (!isset($ubicacion)) {
    $ubicacion = "";
}
?>
<!doctype html>
<html lang="es">

<head>
    <title><?php if (isset($titulo))
        echo $titulo; ?>
    </title>
    <!-- Bootstrap CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="icon" type="<?php echo $ubicacion; ?>assets/imagenes/icono.jpg"
        href="<?php echo $ubicacion; ?>assets/imagenes/icono.jpg">
    <link href="<?php echo $ubicacion; ?>assets/tools/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    include_once $ubicacion . "includes/navbar.php";
    ?>

    <div class="container mt-5 centrar">
        <?php if ($_SESSION["estaciones"] == false) { ?>
            <div class="alert alert-danger alert-dismissible mt-3" style="text-align: center;">
                <?php echo "No hay estaciones compatibles!!! <br>
                        <a href='$ubicacion/vistas/estaciones/crear_estaciones.php'>Favor de crearla.</a>"; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?> <?php if ($_SESSION["rol_creado"] == false) { ?>
            <div class="alert alert-danger alert-dismissible mt-3" style="text-align: center;">
                <?php echo "No se ah crado un rol para el dia de hoy!!! <br>
                        <a href='$ubicacion/vistas/rol/rol.php'>Favor de crearlo.</a>"; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
    </div>