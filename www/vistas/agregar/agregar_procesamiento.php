<?php
$ubicacion = "../../";
include_once ($ubicacion . "/config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formulario = $_POST["formulario"];

    // Se inserta en caso de que insertar mesa
    if ($formulario == "agregarMesa") {
        $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
        $sb_area = htmlspecialchars($_POST["sb_area"]);
        $tb_nPersonas = htmlspecialchars($_POST["tb_nPersonas"]);
        // Preparar la consulta SQL
        $sql = "INSERT INTO mesas (nombre, area_id, n_personas) VALUES (:tb_nombre, :sb_area, :tb_nPersonas)";
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
    }

    // Se inserta en caso de ser area
    if ($formulario == "agregarArea") {
        $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
        $tb_descripcion = htmlspecialchars($_POST["tb_descripcion"]);
        try {
            // Preparar la consulta SQL
            $sql = "INSERT INTO areas (nombre, descripcion) VALUES (:tb_nombre, :tb_descripcion)";
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
    }
    if ($formulario == "agregarTarea") {
        $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
        $tb_descripcion = htmlspecialchars($_POST["tb_descripcion"]);
        try {
            // Preparar la consulta SQL
            $sql = "INSERT INTO tareas_preapertura (nombre, descripcion) VALUES (:tb_nombre, :tb_descripcion)";
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
    }
} else {
    echo "No se recibieron datos.";
}