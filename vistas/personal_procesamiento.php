<?php
$ubicacion = "../";
include_once ($ubicacion . "/config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formulario = $_POST["formulario"];

    // Se inserta en caso de que insertar mesa
    if ($formulario == "agregarMesero") {
        $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
        $tb_apellido = htmlspecialchars($_POST["tb_apellido"]);
        // Preparar la consulta SQL
        $sql = "INSERT INTO personal (nombre, apellido) VALUES (:tb_nombre, :tb_apellido)";
        $ejecucion = $pdo->prepare($sql);

        // Ejecutar la consulta
        $result = $ejecucion->execute(
            array(
                ":tb_nombre" => $tb_nombre,
                ":tb_apellido" => $tb_apellido
            )
        );
        if ($result) {
            header("Location: personal.php?message=ok");
            exit();
        } else {
            print_r($ejecucion->errorInfo());
            header("Location: personal.php?message=no");
        }
    } elseif ($formulario == "editarMesero") {
        $tb_id = htmlspecialchars($_POST["tb_id"]);
        $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
        $tb_apellido = htmlspecialchars($_POST["tb_apellido"]);
        // Preparar la consulta SQL
        $sql = "UPDATE personal SET nombre = :tb_nombre, apellido = :tb_apellido WHERE id = :tb_id";
        $ejecucion = $pdo->prepare($sql);
        $ejecucion->execute(
            array(
                ":tb_id" => $tb_id,
                ":tb_nombre" => $tb_nombre,
                ":tb_apellido" => $tb_apellido
            )
        );
        if ($ejecucion->rowCount() > 0) {
            header("Location: personal.php?message=ok");
            exit();
        } else {
            header("Location: personal.php?message=noEdit");
            exit();
        }
    }
} else {
    echo "No se recibieron datos.";
}