<?php
$ubicacion = "../../";
include_once($ubicacion . "/config/config.php");

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formulario = isset($_POST["formulario"]) ? $_POST["formulario"] : '';

    if ($formulario == 'registroMesa' || $formulario == 'registroReservacion') {
        //Se registra mesa
        $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
        $tb_nadultos = $_POST["tb_nadultos"];
        $tb_nninos = $_POST["tb_nninos"];
        $cb_areas = implode(",", isset($_POST["cb_areas"]) && is_array($_POST["cb_areas"]) ? $_POST["cb_areas"] : []);
        $tb_telefono = isset($_POST["tb_telefono"]) ? $_POST["tb_telefono"] : null;
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
            header("Location: mesas.php?message=ok");
            exit();
        } else {
            print_r($ejecucion->errorInfo());
            header("Location: mesas.php?message=no");
        }
    }

    if (isset($data)) {
        $accion = $data['accion'];
        if ($accion == 'verMesas') {
            $id_cliente = $data['id'];
            $zonas = $data['zonas'];
            $total_personas = $data['total_personas'];

            // Se transforma a array quitando comas y espacios.
            $areasSelec = array_map('trim', explode(",", $zonas));

            // Se recorre el array y se van añadiendo a un array con en numero de areas deseadas como tamaño
            foreach ($areasSelec as $areaSelec) {
                $condiciones[] = ' area_id = ' . $pdo->quote($areaSelec) . ' AND estado = 0 ';
            }
            //Con implode unimos en una cadena los elementos de del anterior array pero entre ellos un OR 
            $consulta = implode(' OR ', $condiciones);

            $sql = 'SELECT * FROM mesas WHERE (' . $consulta . ') AND n_personas >= ' . $total_personas . ' ORDER BY n_personas ASC ';
            $result = $pdo->query($sql);
            if ($result->rowCount() > 0) {
                // Muestra los resultados
                while ($mesasDisponibles = $result->fetch(PDO::FETCH_OBJ)) {
                    $cantidadPersonas = $mesasDisponibles->n_personas;
                    $nombre_mesa = $mesasDisponibles->nombre;
                    $id_mesa = $mesasDisponibles->id;
                    echo "
                        <tr>
                        <td>" . $nombre_mesa . "</td>
                        <td>" . $cantidadPersonas . "</td>
                        <td><button class='btn btn-primary' onclick='asignarMesa(" . $id_mesa . "," . $id_cliente . ")' type='button' data-bs-dismiss='modal'>
                        Asignar
                        </button>
                        </td>
                        </tr>
                        ";
                }
            } else {
                echo "No hay mesas disponibles.";
            }
        } elseif ($accion == 'verClientes') {
            $id_mesa = $data['id'];
            $id_zona = trim($data['id_zona']);
            $n_personas = $data['n_personas'];
            $estado_mesa = $data['estado_mesa'];

            if ($estado_mesa == 0) {

                // Consulta filtrando, clientes con igual o menor cantidad de personas, y que busqyen en esta zona ordenamos como llegaron
                $sql = "SELECT * FROM `mesa_cliente` WHERE ((n_adultos + n_ninos) <= " . $n_personas . " AND estado = 0) AND zonas_deseadas LIKE '%" . $id_zona . "%' ORDER BY id ASC;";
                $result = $pdo->query($sql);
                if ($result->rowCount() > 0) {
                    while ($clientesDsiponibles = $result->fetch(PDO::FETCH_OBJ)) {
                        $id_cliente = $clientesDsiponibles->id;
                        $nombre_mesa = $clientesDsiponibles->nombre;
                        $total_personas = $clientesDsiponibles->n_adultos + $clientesDsiponibles->n_ninos;
                        $tiempo_espera = $clientesDsiponibles->hora_llegada;
                        $zonas = $clientesDsiponibles->zonas_deseadas;

                        echo "
                            <tr>
                            <td>" . $nombre_mesa . "</td>
                            <td>" . $total_personas . "</td>
                            <td><button class='btn btn-primary' onclick='asignarMesa(" . $id_mesa . "," . $id_cliente . ")' type='button' data-bs-dismiss='modal'>
                            Asignar
                            </button>
                            </td>
                            </tr>
                            ";
                    }
                }else{
                    echo 'No hay Clientes';
                }
            } else {
                $sql = 'SELECT id, nombre FROM mesa_cliente WHERE mesa_id = :id_mesa AND estado = 2';
                $result = $pdo->prepare($sql);
                $result->execute(array(":id_mesa" => $id_mesa));
                if ($result->rowCount() > 0) {
                    $cliente = $result->fetch(PDO::FETCH_OBJ);
                    $id_cliente = $cliente->id;
                    $nombre_cliente = $cliente->nombre;

                    $mesero = 'x';
                    echo '<p><strong>MESA OCUPADA:</strong></p>
                    <p>Cliente: ' . $nombre_cliente . '</p>
                    <p>Atendido por: ' . $mesero . ' <br> <br>
                    <button type="button" onclick="cofirmarLiberacionMesa(' . $id_cliente . ',' . $id_mesa . ');" class="btn btn-primary w-100" data-bs-dismiss="modal">
                        Liberar Mesa
                    </button>';

                }
            }
        } elseif ($accion == 'asignarMesa') {
            $id_mesa = $data['id_mesa'];
            $id_cliente = $data['id_cliente'];

            // Consulta para asignar mesa a cliente, y cambiar estado de la mesa
            $sql = "UPDATE mesas SET estado = 1 WHERE id =:id_mesa";
            $result = $pdo->prepare($sql);
            $result->execute(array(":id_mesa" => $id_mesa));
            if ($result->rowCount() > 0) {
                // Si la consulta es correcta, cambiamos el estado del cliente
                $sql = "UPDATE mesa_cliente SET mesa_id=:id_mesa, estado = 2 WHERE id=:id_cliente";
                $result = $pdo->prepare($sql);
                $result->execute(array(":id_mesa" => $id_mesa, ":id_cliente" => $id_cliente));
                if ($result->rowCount() > 0) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Se asigno mesa correctamente!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
        } elseif ($accion == 'liberarMesa') {
            $id_mesa = $data['id_mesa'];
            $id_cliente = $data['id_cliente'];
            $hora_salida = date('H:i:s');

            // Consulta para asignar mesa a cliente, y cambiar estado de la mesa
            $sql = "UPDATE mesas SET estado = 0 WHERE id =:id_mesa";
            $result = $pdo->prepare($sql);
            $result->execute(array(":id_mesa" => $id_mesa));
            if ($result->rowCount() > 0) {
                // Si la consulta es correcta, cambiamos el estado del cliente
                $sql = "UPDATE mesa_cliente SET mesa_id=:id_mesa, estado = 3, hora_salida =:hora_salida WHERE id=:id_cliente";
                $result = $pdo->prepare($sql);
                $result->execute(array(":id_mesa" => $id_mesa, "hora_salida"=>$hora_salida, ":id_cliente" => $id_cliente));
                if ($result->rowCount() > 0) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>¡Se libero Mesa!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        }elseif ($accion == 'eliminarReservacion'){
            $id_reservacion = $data['id_reservacion'];

            // Eliminamos la reservacion
            $sql = "DELETE FROM mesa_cliente WHERE id = :id_reservacion";
                $result = $pdo->prepare($sql);
                $result->execute(array(":id_reservacion" => $id_reservacion));
                if ($result->rowCount() > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>¡Se Cancelo reservación!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
        }
    }


} else {
    echo "No se recibieron datos.";
}


?>
<script>

</script>