<?php
$ubicacion = "../";
include_once($ubicacion."/config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización y validación de datos del formulario
    $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
    $tb_nadultos = htmlspecialchars($_POST["tb_nadultos"]);
    $tb_nninos = htmlspecialchars($_POST["tb_nniños"]);
    $sb_area = htmlspecialchars($_POST["sb_area"]);
    $tb_fecha = htmlspecialchars(isset($_POST["tb_fecha"]) ? $_POST["tb_fecha"] : date('Y-m-d'));

    try {
        // Preparar la consulta SQL
        $sql = "INSERT INTO registro_mesa (nombre, n_adultos, n_ninos, area) VALUES (:tb_nombre, :tb_nadultos, :tb_nninos, :sb_area)";
        $ejecucion = $pdo->prepare($sql);

        // Ejecutar la consulta
        $result = $ejecucion->execute(array(
            ":tb_nombre" => $tb_nombre,
            ":tb_nadultos" => intval($tb_nadultos),
            ":tb_nninos" => intval($tb_nninos),
            ":sb_area" => $sb_area
        ));

        if ($result) {
            header("Location: mesas.php?message=ok");
            exit();
        } else {
            print_r($ejecucion->errorInfo());
            header("Location: mesas.php?message=no");
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "No se recibieron datos.";
}


?>