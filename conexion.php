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

echo "Conexión exitosa";

try {
    $dsn = 'mysql:host=localhost;dbname=db_restpro';
    $pdo = new PDO($dsn, $username, $password);
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión PDO: " . $e->getMessage();
}
?>