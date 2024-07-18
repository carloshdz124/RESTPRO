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
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </form>
        </div>
    </div>

<?php include_once"footer.php"; ?>
