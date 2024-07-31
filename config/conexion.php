<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_restpro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

try {
    $dsn = 'mysql:host=localhost;dbname=db_restpro';
    $pdo = new PDO($dsn, $username, $password);
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexión exitosa\n";
    echo "Error de conexión PDO: " . $e->getMessage();
}

date_default_timezone_set('America/Mexico_City');
?>