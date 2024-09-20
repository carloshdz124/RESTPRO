<?php
if (isset($_POST['datos'])) {
    // Obtener los datos de POST (que esperas que estén en formato JSON)
    $jsonData = $_POST['datos'];

    print_r($jsonData);

}