<?php
// Configuración de la base de datos
$servername = 'db'; // Nombre del servicio en Docker Compose
$username   = 'root';
$password   = 'root';
$dbname     = 'db_restpro';

// Conexión MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión MySQLi
if ($conn->connect_error) {
    die("MySQLi Connection failed: " . $conn->connect_error);
}

// Conexión PDO
try {
    $dsn = "mysql:host=$servername;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión PDO: " . $e->getMessage());
}
?>
