<?php
$ubicacion = "../../";
include_once($ubicacion . "/config/config.php");
include("IA.php");


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
            //Con implode unimos en una cadena los elementos del anterior array pero entre ellos un OR 
            $consulta = implode(' OR ', $condiciones);

            // Consulta para ver numero de meseros
            $hoy = date("w");
            if ($hoy > 0 && $hoy < 5) {
                $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND descanso != ' . $hoy . ' AND descanso != "fines" ');
            } else {
                $result = $pdo->query('SELECT COUNT(*) FROM personal WHERE estado = 1 AND (descanso != ' . $hoy . ' OR descanso = "fines" )');
            }
            $n_meseros = $result->fetchColumn();

            // Consulta para seleccionar el rol del dia
            $result = $pdo->query("SELECT * FROM roles WHERE descripcion = $n_meseros");
            if ($result->rowCount() > 0) {
                $resultRol = $result->fetch(PDO::FETCH_OBJ);
                $rol_id = $resultRol->id;
            }
            //Realizamos la busqueda usando la vista de con los meseros asignados.
            $fecha = date('Y-m-d');
            $sql = "SELECT * FROM vista_mesas_color WHERE ($consulta AND n_personas >= $total_personas) AND fecha='$fecha' ORDER BY n_personas ASC ";
            $result = $pdo->query($sql);
            if ($result->rowCount() > 0) {
                // Muestra los resultados
                while ($mesasDisponibles = $result->fetch(PDO::FETCH_OBJ)) {
                    $cantidadPersonas = $mesasDisponibles->n_personas;
                    $nombre_mesa = $mesasDisponibles->nombre;
                    $id_mesa = $mesasDisponibles->id;
                    $id_mesero = $mesasDisponibles->mesero_id;
                    echo "
                        <tr>
                        <td>" . $nombre_mesa . "</td>
                        <td>" . $cantidadPersonas . "</td>
                        <td><button class='btn btn-primary' onclick='asignarMesa($id_mesa,$id_cliente,$id_mesero)' type='button' data-bs-dismiss='modal'>
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
            $mesero = $data['mesero'];
            $id_mesero = $data['mesero_id'];

            // Verificamos si esta desocupada
            if ($estado_mesa == 0) {
                // Consulta filtrando, clientes con igual o menor cantidad de personas, y que busqyen en esta zona ordenamos como llegaron
                $sql = "SELECT * FROM `mesa_cliente` WHERE ((n_adultos + n_ninos) <= " . $n_personas . " AND estado = 0) AND zonas_deseadas LIKE '%" . $id_zona . "%' ORDER BY id ASC;";
                $result = $pdo->query($sql);
                if ($n_personas > 5) {
                    echo "<button type='button' class='btn btn-primary w-100' onclick='separarMesa($id_mesa)' data-bs-dismiss='modal'>Separar</button>";
                }
                if ($result->rowCount() > 0) {
                    echo "<p><strong>Clientes a elegir: </strong></p>
                            <table class='table table-dark centrar' style='width:100%;'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Cliente</th>
                                        <th scope='col'>N. personas</th>
                                        <th scope='col'>Opc</th>
                                    </tr>
                                </thead>
                                <tbody class='table-secondary' id='clientesDisponibles'>";
                    // Aquí se mostrarán los clientes disponibles -->

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
                            <td><button class='btn btn-primary' onclick='asignarMesa($id_mesa,$id_cliente,$id_mesero)' type='button' data-bs-dismiss='modal'>
                            Asignar
                            </button>
                            </td>
                            </tr>
                            ";
                    }
                    echo "</tbody>";
                } else {
                    echo 'No hay Clientes';
                }
                // Sino, esta desocupada
            } else {
                $result = $pdo->query("SELECT * FROM mesas_separadas WHERE id = '$id_mesa'");
                // Si se encuentra un resultado, entonces no esta separada
                if ($result->rowCount() > 0) {
                    $mesa_separada_id = $id_mesa;
                    $id_mesa = $result->fetch(PDO::FETCH_OBJ)->mesa_id;
                }
                $mesa_separada = isset($mesa_separada_id) ? "= $mesa_separada_id" : " IS NULL";
                $mesa_separada_id = isset($mesa_separada_id) ? $mesa_separada_id : 0;
                $sql = "SELECT mesa_cliente.id AS cliente_id, 
                            mesas.nombre AS nombre_mesa, 
                            mesa_cliente.nombre AS nombre_cliente, 
                            personal.nombre AS nombre_mesero 
                        FROM cliente_mesa_mesero 
                        LEFT JOIN mesas ON cliente_mesa_mesero.mesa_id = mesas.id 
                        LEFT JOIN mesa_cliente ON cliente_mesa_mesero.cliente_id = mesa_cliente.id 
                        LEFT JOIN personal ON cliente_mesa_mesero.mesero_id = personal.id 
                        WHERE mesa_id = $id_mesa AND mesa_separada_id $mesa_separada
                        AND mesa_cliente.estado = 2";
                $result = $pdo->query($sql);
                if ($result->rowCount() > 0) {
                    $cliente = $result->fetch(PDO::FETCH_OBJ);
                    $id_cliente = $cliente->cliente_id;
                    $nombre_cliente = $cliente->nombre_cliente;
                    $nombre_mesero = $cliente->nombre_mesero;
                    $mesa_separada = isset($mesa_separada) ? $mesa_separada : 0;

                    echo '<p><strong>MESA OCUPADA:</strong></p>
                    <p>Cliente: ' . $nombre_cliente . '</p>
                    <p>Atendido por: ' . $nombre_mesero . ' <br> <br>
                    <button type="button" onclick="cofirmarLiberacionMesa(' . $id_cliente . ',' . $id_mesa . ',' . $mesa_separada_id . ');" class="btn btn-primary w-100" data-bs-dismiss="modal">
                        Liberar Mesa
                    </button>';

                }
            }
        } elseif ($accion == 'asignarMesa') {
            $id_mesa = $data['id_mesa'];
            $id_cliente = $data['id_cliente'];
            $id_mesero = $data['id_mesero'];
            $fecha = date('Y-m-d');

            // Verificamos si es una mesa separada
            $result = $pdo->query("SELECT * FROM mesas_separadas WHERE id = '$id_mesa'");
            // Si se encuentra un resultado, entonces no esta separada
            if ($result->rowCount() > 0) {
                $mesa = $result->fetch(PDO::FETCH_OBJ);
                $id_mesa = $mesa->mesa_id;
                $id_mesa_separada = $mesa->id;
                $result = $pdo->query("UPDATE mesas_separadas SET estado = 1 WHERE id =$id_mesa_separada");

                // Sino, entonces es separada.
            } else {
                $result = $pdo->query("UPDATE mesas SET estado = 1 WHERE id =$id_mesa");
            }
            $id_mesa_separada = isset($id_mesa_separada) ? $id_mesa_separada : "null";

            // Consulta para asignar mesa a cliente, y cambiar estado de la mesa
            $sql = "INSERT INTO cliente_mesa_mesero (cliente_id,mesero_id,mesa_id,mesa_separada_id,fecha) VALUES ($id_cliente,$id_mesero,$id_mesa,$id_mesa_separada,'$fecha')";
            $result = $pdo->query($sql);
            if ($result->rowCount() > 0) {
                // Si la consulta es correcta, cambiamos el estado del cliente
                $sql = "UPDATE mesa_cliente SET estado = 2 WHERE id=:id_cliente";
                $result = $pdo->prepare($sql);
                $result->execute(array(":id_cliente" => $id_cliente));
                
                if ($result->rowCount() > 0) {
                    // Una vez se cambia el estado obtenemos el numero de personas para calcular la hora a la que se iran.
                    $sql = "SELECT * FROM mesa_cliente WHERE id = $id_cliente";
                    $result = $pdo->query($sql);
                    $result = $result->fetch(PDO::FETCH_OBJ);
                    $no_personas = $result->n_adultos+$result->n_ninos;

                    $arrayDatos = array(
                        "dia" => date('N'),
                        "no_personas" => $no_personas,
                        "hora" => date('H'),
                        "minutos" => date('i')
                    );
        
                    // Convertir el array a JSON 
                    $jsonDatos = json_encode($arrayDatos);
                    
                    // Obtenemos la hora de salida.
                    $salida = predict_IA($jsonDatos);
                    $hora = $salida["Hora:"];
                    $minuto = sprintf("%02d",$salida["Minuto:"]);
                    $salida = "$hora:$minuto";

                    $sql = "INSERT INTO `prediccion_salida`(`mesa`, `fecha`, `hora`, `minuto`) 
                    VALUES ($id_mesa,'$fecha',$hora,$minuto)";
                    $result = $pdo->query($sql);

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>¡Se asigno mesa correctamente!</strong>
                            <br>Hora estimada de salida: '. $salida .'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        } elseif ($accion == 'liberarMesa') {
            $id_mesa = $data['id_mesa'];
            $id_cliente = $data['id_cliente'];
            $id_mesa_separada = $data['id_mesa_separada'];
            $hora_salida = date('H:i:s');

            if ($id_mesa_separada != 0) {
                $sql = "UPDATE mesas_separadas SET estado = 0 WHERE id = $id_mesa_separada";
            } else {
                $sql = "UPDATE mesas SET estado = 0 WHERE id =$id_mesa";
            }
            // Consulta para asignar mesa a cliente, y cambiar estado de la mesa
            $result = $pdo->query($sql);
            if ($result->rowCount() > 0) {
                // Si la consulta es correcta, cambiamos el estado del cliente
                $sql = "UPDATE mesa_cliente SET estado = 3, hora_salida =:hora_salida WHERE id=:id_cliente";
                $result = $pdo->prepare($sql);
                $result->execute(array("hora_salida" => $hora_salida, ":id_cliente" => $id_cliente));
                if ($result->rowCount() > 0) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>¡Se libero Mesa!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } else {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>¡NOOOOOOOOOOOOOOOOOOOO!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        } elseif ($accion == 'eliminarReservacion') {
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
        } elseif ($accion == 'separarMesa') {
            $id_mesa = $data['id_mesa'];
            // Consultamos los datos de la mesa original para trabajar con sus datos
            $result = $pdo->query("SELECT * FROM mesas WHERE id = $id_mesa");
            $resultMesaOriginal = $result->fetch(PDO::FETCH_OBJ);
            // Consultamos mesas separadas para ver si existe, y sino crearla
            $result = $pdo->query("SELECT * FROM mesas_separadas WHERE mesa_id = $id_mesa AND activa = 0");
            if ($result->rowCount() > 0) {
                // Si encuentra mesas, no activas las activa
                $result = $pdo->query("UPDATE mesas_separadas SET activa = 1 WHERE mesa_id = $id_mesa");
            } else {
                $mesa_id = $resultMesaOriginal->id;
                $nombre1 = $resultMesaOriginal->nombre;
                $nombre2 = $resultMesaOriginal->nombre . "A";
                $area_id = $resultMesaOriginal->area_id;
                $n_personas = intval($resultMesaOriginal->n_personas) / 2;

                $sql = "INSERT INTO mesas_separadas (nombre,mesa_id,area_id,n_personas) VALUES ('$nombre1',$mesa_id,$area_id,$n_personas),
                                                                                                ('$nombre2',$mesa_id,$area_id,$n_personas)";
                $result = $pdo->query($sql);
            }

            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>¡Se separo mesa!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

        }
    }


} else {
    echo "No se recibieron datos.";
}


?>
<script>

</script>