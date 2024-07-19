<?php
$titulo = "INICIAR SESIÓN";
include_once"header.php";
?>
    <div class="bg-custom">
        <div class="login-box">
            <h2 class="text-center mb-4">Iniciar Sesión</h2>
            <form>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico">
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña">
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <br>
                <button type="button" class="btn btn-primary btn-block d-block w-50">Ingresar</button>
                </div>
                <div class="loading">
                    <img src="imagenes/login.gif" alt="Ingresando...">
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('button', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe
            document.querySelector('.login-box form').style.display = 'none'; // Oculta el formulario
            document.querySelector('.loading').style.display = 'block'; // Muestra el GIF de carga
        });
    </script>

<?php include_once"footer.php"; ?>
