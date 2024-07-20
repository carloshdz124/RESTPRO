<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está conectado
if (isset($_SESSION['user'])) {
    header('Location: index.php');
}

$titulo = "INICIAR SESIÓN";
include_once "header.php";
if (isset($_GET['respuesta_login'])) {
    // Obtener y sanitizar el valor del parámetro
    $mensaje = htmlspecialchars($_GET['respuesta_login']);
}
?>

<div class="bg-custom">
    <div class="login-box">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form method="POST" action="login_process.php">
            <div class="form-group">
                <label for="user">Nombre de usuario</label>
                <input name="user" type="text" class="form-control" id="user" placeholder="Ingresa tu nombre de usuario"
                    required>
            </div>
            <br>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input name="password" type="password" class="form-control" id="password"
                    placeholder="Ingresa tu contraseña" required>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <br>
                <button type="submit" class="btn btn-primary btn-block d-block w-50">Ingresar</button>
            </div>
            <div class="loading">
                <img src="imagenes/login.gif" alt="Ingresando...">
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
    document.getElementById('loginForm').addEventListener('button', function (event) {
        event.preventDefault(); // Evita que el formulario se envíe
        document.querySelector('.login-box form').style.display = 'none'; // Oculta el formulario
        document.querySelector('.loading').style.display = 'block'; // Muestra el GIF de carga
    });
</script>

<?php include_once "footer.php"; ?>