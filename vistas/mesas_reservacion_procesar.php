<?php
$ubicacion = "../";
include_once ($ubicacion . "/config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización y validación de datos del formulario
    $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
    $tb_telefono = htmlspecialchars($_POST["tb_telefono"]);
    $tb_nadultos = htmlspecialchars($_POST["tb_nadultos"]);
    $tb_nninos = htmlspecialchars($_POST["tb_nninos"]);
    $sb_area = htmlspecialchars($_POST["sb_area"]);
    $tb_fecha = $_POST["tb_fecha"];
    $tb_hora = $_POST["tb_hora"];

    // Preparar la consulta SQL
    $sql = "INSERT INTO reservaciones (nombre, telefono, n_adultos, n_ninos, fecha, hora) VALUES (:tb_nombre, :tb_telefono, :tb_nadultos, :tb_nninos, :tb_fecha, :tb_hora)";
    $ejecucion = $pdo->prepare($sql);

    // Ejecutar la consulta
    $result = $ejecucion->execute(array(
            ":tb_nombre" => $tb_nombre,
            ":tb_telefono" => intval($tb_telefono),
            ":tb_nadultos" => intval($tb_nadultos),
            ":tb_nninos" => intval($tb_nninos),
            ":tb_fecha" => $tb_fecha,
            ":tb_hora" => $tb_hora
        ));

    if ($result) {
        header("Location: mesas.php?message=ok");
        exit();
    } else {
        print_r($ejecucion->errorInfo());
        header("Location: mesas.php?message=no");
    }

} else {
    echo "No se recibieron datos.";
}


?>