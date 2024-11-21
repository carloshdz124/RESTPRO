<?php
$ubicacion = "../../";
include_once($ubicacion . "/config/config.php");

$fecha = date('Y-m-d');
$sql = "SELECT mesas.nombre, mesas.n_personas, prediccion_salida.*
FROM prediccion_salida
JOIN mesas ON prediccion_salida.mesa = mesas.id
WHERE fecha = '$fecha' AND mesas.estado = 1";

$result = $pdo->query($sql);

$resultados = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- El código HTML donde se mostrará la tabla -->

    <?php foreach ($resultados as $row): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td><?php echo htmlspecialchars($row['n_personas']); ?></td>
        <td><?php echo $row['hora'] . ":" . $row['minuto']; ?></td>
      </tr>
    <?php endforeach; ?>
