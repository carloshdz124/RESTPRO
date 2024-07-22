<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está conectado
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit(); // Asegura que el script se detenga después de la redirección
}

$titulo = "INICIAR SESIÓN";
include_once "includes/header.php";

if (isset($_GET['respuesta_login'])) {
    // Obtener y sanitizar el valor del parámetro
    $mensaje = htmlspecialchars($_GET['respuesta_login']);
}
?>

<!doctype html>
<html lang="es">

<head>
    <title><?php if (isset($titulo))
        echo $titulo; ?>
    </title>
    <!-- Bootstrap CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="icon" type="assets/imagenes/icono.jpg" href="assets/imagenes/icono.jpg">
    <link href="assets/tools/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

<div class="bg-custom">
    <div class="login-box">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form id="loginForm" method="POST" action="login_process.php">
            <div class="form-group">
                <label for="user">Nombre de usuario</label>
                <input name="user" type="text" class="form-control" id="user" placeholder="Ingresa tu nombre de usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <div class="d-flex justify-content-center">
                <br>
                <button type="submit" id="loginButton" class="btn btn-primary d-block w-50">Ingresar</button>
            </div>
            <?php if (isset($mensaje)) { ?>
                <br>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div class="centrar">
                        <strong>Usuario y/o contraseña incorrectos.</strong>
                    </div>
                </div>
            <?php } ?>
        </form>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe inmediatamente

        var loginButton = document.getElementById('loginButton');
        var originalButtonContent = loginButton.innerHTML;
        loginButton.disabled = true; // Deshabilita el botón
        loginButton.innerHTML = '<img src="imagenes/login.gif" alt="Ingresando..." style="height: 30px;">'; // Muestra el GIF en el botón

        // Espera 3 segundos y luego envía el formulario
        setTimeout(function() {
            document.getElementById('loginForm').submit(); // Envía el formulario
        }, 1000); // 1000 milisegundos = 1 segundos
    });
</script>

<?php include_once "footer.php"; ?>