<?php
$ubicacion = "../";
include_once ($ubicacion . "/config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formulario = $_POST["formulario"];

    //Se registra mesa
    $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
    $tb_nadultos = htmlspecialchars($_POST["tb_nadultos"]);
    $tb_nninos = htmlspecialchars($_POST["tb_nniños"]);
    $cb_areas = implode(",",isset($_POST["cb_areas"])? $_POST["cb_areas"] : '');
    $tb_telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
    if ($formulario == "registroMesa") {
        $tb_fecha = htmlspecialchars(isset($fecha) ? $fecha : date('Y-m-d'));
        $tb_hora = date('H:i:s');
        $estado = 0;
    } elseif ($formulario == 'registroReservacion') {
        $tb_fecha = $_POST["tb_fecha"];
        $tb_hora = $_POST["tb_hora"];
        $estado = 1;
    }


    // Preparar la consulta SQL
    $sql = "INSERT INTO mesa_cliente (nombre, telefono, zonas_deseadas, n_adultos, n_ninos, hora_llegada, fecha, estado) 
        VALUES (:tb_nombre, :tb_telefono, :cb_areas ,:tb_nadultos, :tb_nninos, :tb_hora, :tb_fecha, :estado)";
    $ejecucion = $pdo->prepare($sql);

    // Ejecutar la consulta
    $result = $ejecucion->execute(
        array(
            ":tb_nombre" => $tb_nombre,
            ":tb_telefono" => $tb_telefono,
            ":cb_areas" => $cb_areas,
            ":tb_nadultos" => intval($tb_nadultos),
            ":tb_nninos" => intval($tb_nninos),
            ":tb_hora" => $tb_hora,
            ":tb_fecha" => $tb_fecha,
            ":estado" => $estado
        )
    );

    if ($result) {
        $essage = 'ok';
        $queryString = http_build_query(['areas'=>$cb_areas, "message" => $message]);
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