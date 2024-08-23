<?php
$ubicacion = "../";
include_once($ubicacion . "/config/conexion.php");

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formulario = isset($_POST["formulario"]) ? $_POST["formulario"] : '';

    if ($formulario == 'registroMesa' || $formulario == 'registroMesa') {
        //Se registra mesa
        $tb_nombre = htmlspecialchars($_POST["tb_nombre"]);
        $tb_nadultos = htmlspecialchars($_POST["tb_nadultos"]);
        $tb_nninos = htmlspecialchars($_POST["tb_nniños"]);
        $cb_areas = implode(",", isset($_POST["cb_areas"]) ? $_POST["cb_areas"] : '');
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
            $queryString = http_build_query(['areas' => $cb_areas, "message" => $message]);
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
            $id = $data['id'];
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

            $sql = 'SELECT * FROM mesa WHERE (' . $consulta . ') AND n_personas >= ' . $total_personas . ' ORDER BY n_personas ASC ';
            $result = $pdo->query($sql);
            if ($result->rowCount() > 0) {
                // Muestra los resultados
                while ($mesasDisponibles = $result->fetch(PDO::FETCH_OBJ)) {
                    $cantidadPersonas = $mesasDisponibles->n_personas;
                    echo "<button class='btn btn-success mb-2 me-1' type='button' data-bs-toggle='tooltip' data-bs-placement='top' 
                    data-bs-html='true'
                    title='N. personas: " . $cantidadPersonas . " <br> 
                    <a class=\"btn btn-primary\" id=\"alertButton\"
                    data-id=\"123\" data-name=\"Ejemplo\">Seleccionar</a>' >"
                        . $mesasDisponibles->nombre .
                        "</button>";
                }
            } else {
                echo "No hay mesas disponibles.";
            }
        } elseif ($accion == 'verClientes') {
            $id = $data['id'];
            $id_zona = trim($data['id_zona']);
            $n_personas = $data['n_personas'];

            // Consulta filtrando, clientes con igual o menor cantidad de personas, y que busqyen en esta zona ordenamos como llegaron
            $sql = "SELECT * FROM `mesa_cliente` WHERE ((n_adultos + n_ninos) <= ". $n_personas ." AND estado = 0) AND zonas_deseadas LIKE '%". $id_zona ."%' ORDER BY id ASC;";
            $result = $pdo->query($sql);
            if ($result->rowCount() > 0) {
                while ($clientesDsiponibles = $result->fetch(PDO::FETCH_OBJ)) {
                    $id = $clientesDsiponibles->id;
                    $nombre_mesa = $clientesDsiponibles->nombre;
                    $total_personas = $clientesDsiponibles->n_adultos + $clientesDsiponibles->n_ninos;
                    $tiempo_espera = $clientesDsiponibles->hora_llegada;
                    $zonas = $clientesDsiponibles->zonas_deseadas;
                    echo "
                        <tr>
                            <td>" .$nombre_mesa . "</td>
                            <td>" .$total_personas. "</td>
                            <td><button class='btn btn-primary' type='button'>
                                    Asignar
                                </button>
                            </td>
                        </tr>
                    ";
                }
            }

        } elseif ($accion == 'seleccionar_mesa') {
            echo 'Bieeeeeeeeeeeeeeeeeeeeeeeeen';
        }
    }


} else {
    echo "No se recibieron datos.";
}


?>
<script>

</script>