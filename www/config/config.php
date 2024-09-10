<?php
// Configurar zona horaria
date_default_timezone_set('America/Mexico_City');

// Configuración de la base de datos
$servername = getenv('DB_HOST') ?: 'localhost';
$username   = getenv('DB_USER') ?: 'root';
$password   = getenv('DB_PASS') ?: '';
$dbname     = getenv('DB_NAME') ?: 'db_restpro';
$fecha      = '2024-07-05';

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
