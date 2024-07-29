<?php
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

    <link rel="icon" type="<?php echo $ubicacion; ?>assets/imagenes/icono.jpg"
        href="<?php echo $ubicacion; ?>assets/imagenes/icono.jpg">
    <link href="<?php echo $ubicacion; ?>assets/tools/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<bod¿>
    <?php
    include_once $ubicacion."includes/navbar.php";
    ?>