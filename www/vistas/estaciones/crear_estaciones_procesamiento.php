<?php
$ubicacion = "../../";
include_once($ubicacion . "/config/config.php");

if (isset($_POST['datos'])) {
    // Obtener los datos de POST (que esperas que estén en formato JSON)
    $jsonData = $_POST['datos'];

    // Decodificar el JSON para convertirlo en un array PHP
    $dataEstaciones = json_decode($jsonData, true);

    // Consultamos todos los roles para buscar si ya existe uno para esa cantidad de estaciones.
    $result = $pdo->query("SELECT * FROM roles");
    if ($result->rowCount() > 0) {
        $resultRoles = $result->fetchAll(PDO::FETCH_OBJ);
        $bandera_existeRol = false;
        foreach ($resultRoles as $rol) {
            if (count($dataEstaciones) == $rol->descripcion) {
                $bandera_existeRol = true;
            }
        }
        // Validamos si la bandera se activo entonces ya existe un rol.
        if ($bandera_existeRol != true) {
            // Si no existe creamos un nuevo rol para esa cantidad de estaciones.
            $sql = "INSERT INTO roles (descripcion) VALUES (" . count($dataEstaciones) . ")";
            $result = $pdo->query($sql);
            $area_id = $pdo->lastInsertId();
            $sql = "INSERT INTO asignacion_mesas (mesa_id,estacion_id,rol_id) VALUES ";
            foreach ($dataEstaciones as $estacionId => $mesas) {
                foreach ($mesas as $mesa) {
                    $sql .= "(" . $mesa['id'] . "," . $estacionId . "," . $pdo->lastInsertId() . "),";
                }
            }
            $sql = substr($sql, 0, -1);
            $result = $pdo->prepare($sql);
            if ($result->execute()) {
                header("Location: estaciones.php?message=ok");
                exit();
            } else {
                echo "Error en la inserción";
            }
        } else {
            header("Location: estaciones.php?message=no");
            exit();
        }
    } else {
        echo "Error al decodificar el JSON.";
    }
} else {
    echo "No se recibieron datos.";
}
?>