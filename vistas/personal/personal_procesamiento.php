<?php
$ubicacion = "../../";
include_once ($ubicacion . "/config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formulario = $_POST["formulario"];

    // Se inserta en caso de que inserte mesero
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
        // Se edita mesero
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


        // Se bloquea mesero
    } elseif ($formulario == "bloquarMesero") {
        $tb_id = htmlspecialchars($_POST["tb_id"]);
        $tb_motivo = htmlspecialchars($_POST["tb_motivo"]);
        $rb_block = htmlspecialchars($_POST["rb_block"]);
        if ($rb_block == "hoy") {
            $tb_fechaInicio = isset($fecha) ? $fecha : date('Y-m-d');
            $tb_fechaFin = calcularDiaSiguiente($tb_fechaInicio);
        }
        else{
            $tb_fechaInicio = $_POST["fechaInicio"];
            $tb_fechaFin = $_POST["fechaFin"];;
        }
        $sql = "INSERT INTO personal_bloqueado (personal_id, fecha_inicio, fecha_fin, motivo) VALUES (:tb_id, :tb_fechaInicio, :tb_fechaFin, :tb_motivo)";
        $ejecucion = $pdo->prepare($sql);
        $result = $ejecucion->execute(
            array(
                ":tb_id" => $tb_id,
                ":tb_fechaInicio" => $tb_fechaInicio,
                ":tb_fechaFin" => $tb_fechaFin,
                ":tb_motivo" => $tb_motivo
            )
        );
        if ($result) {
            //Si se ejecuto la inserción, modificamos el estado del elemento
            $sql = "UPDATE personal SET estado = 0 WHERE id = :tb_id";
            $ejecucion = $pdo->prepare($sql);
            $ejecucion->execute(array(":tb_id" => $tb_id));
            header("Location: personal.php?message=bloq");
            exit();
        } else {
            header("Location: personal.php?message=noEdit");
            exit();
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $accion = $_GET['accion'];

    //Validamos si se desbloqueara un mesero
    if ($accion == 'desbloqueo') {
        $sql = "UPDATE personal SET estado = 1 WHERE id = :tb_id";
        $ejecucion = $pdo->prepare($sql);

        $result = $ejecucion->execute(array(":tb_id" => $id));
        if ($result) {
            $sql = "UPDATE personal_bloqueado SET vigencia = 1 WHERE personal_id = :tb_id";
            $ejecucion = $pdo->prepare($sql);
            $result = $ejecucion->execute(array(":tb_id" => $id));

            if ($result) {
                header("Location: personal.php?message=desBloq");
                exit();
            } else {
                echo 'Error al modificar estado de bloqueado';
            }
        } else {
            echo 'Error al modificar estado de mesero';
        }


        //Validamos si se eliminara mesero
    } elseif ($accion == 'eliminacion') {
        $sql = "DELETE FROM personal WHERE id = :tb_id  ";
        $ejecucion = $pdo->prepare($sql);
        $result = $ejecucion->execute(array(":tb_id" => $id));

        header("Location: personal.php?message=delete");
        exit();
    } else {
        echo "No se recibieron datos.";
    }

}


function calcularDiaSiguiente($fecha_inicio)
{
    $fechaDateTime = new DateTime($fecha_inicio);

    // Crear un intervalo de 1 día
    $intervalo = new DateInterval('P1D');

    // Sumar el intervalo a la fecha
    $fechaDateTime->add($intervalo);

    // Obtener la fecha del día siguiente en formato 'Y-m-d'
    return $fechaDateTime->format('Y-m-d');
}