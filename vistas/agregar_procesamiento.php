<?php
$ubicacion = "../";
include_once ($ubicacion . "/config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
    $tb_descripcion = htmlspecialchars(isset($_POST["tb_descripcion"]) ? $_POST["tb_descripcion"] : "");
    $sb_area = htmlspecialchars(isset($_POST["sb_area"]) ? $_POST["sb_area"] : "");
    $tb_nPersonas = htmlspecialchars(isset($_POST["tb_nPersonas"]) ? $_POST["tb_nPersonas"] : "");

    if ($tb_descripcion != "") {
        // Se inserta en caso de ser area
        try {
            // Preparar la consulta SQL
            $sql = "INSERT INTO area (nombre, descripcion) VALUES (:tb_nombre, :tb_descripcion)";
            $ejecucion = $pdo->prepare($sql);

            // Ejecutar la consulta
            $result = $ejecucion->execute(
                array(
                    ":tb_nombre" => $tb_nombre,
                    ":tb_descripcion" => $tb_descripcion
                )
            );

            if ($result) {
                header("Location: agregar.php?message=ok");
                exit();
            } else {
                print_r($ejecucion->errorInfo());
                header("Location: agregar.php?message=error");
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        // Se inserta en caso de que insertar mesa
        try {
            // Preparar la consulta SQL
            $sql = "INSERT INTO mesa (nombre, area, n_personas) VALUES (:tb_nombre, :sb_area, :tb_nPersonas)";
            $ejecucion = $pdo->prepare($sql);

            // Ejecutar la consulta
            $result = $ejecucion->execute(
                array(
                    ":tb_nombre" => $tb_nombre,
                    ":sb_area" => intval($sb_area),
                    ":tb_nPersonas" => intval($tb_nPersonas)
                )
            );
            if ($result) {
                header("Location: agregar.php?message=ok");
                exit();
            } else {
                print_r($ejecucion->errorInfo());
                header("Location: agregar.php?message=no");
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
} else {
    echo "No se recibieron datos.";
}