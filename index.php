<?php
$titulo = "Index";
$ubicacion = "";
session_start(); // Iniciar la sesión

// Verificar si el usuario está conectado
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $tipo_user = $_SESSION['tipo_user'];
} else {
    header('Location: login.php');
}
include_once "includes/header.php";
?>

<div class="container mt-5 centrar">
    <h1>User: <?php echo $user; ?></h1>
    <h1>Tipo user: <?php echo $tipo_user; ?></h1>
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-icon-container">
                    <i class="bi bi-door-open icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">login</h5>
                    <a href="login.php" class="btn btn-primary">Ir a login</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-icon-container">
                    <i class="bi bi-bounding-box-circles icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Mesas</h5>
                    <a href="vistas/mesas.php" class="btn btn-primary">Ir a mesas</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-icon-container">
                    <i class="bi bi-list-task icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Tareas pre-apertura</h5>
                    <a href="<?php echo $ubicacion; ?>vistas/tareas_preapertura.php" class="btn btn-primary">Ir a tareas</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-icon-container">
                    <i class="bi bi-card-text icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">reportes</h5>
                    <a href="#" class="btn btn-primary">Ir a reportes</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-icon-container">
                <i class="bi bi-device-ssd icon-index"></i>
            </div>
            <div class="card-body">
                <h5 class="card-title">Estaciones</h5>
                <a href="#" class="btn btn-primary">Ir a estaciones</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-icon-container">
                <i class="bi bi-people-fill icon-index"></i>
            </div>
            <div class="card-body">
                <h5 class="card-title">Personal</h5>
                <a href="#" class="btn btn-primary">Ir a personal</a>
            </div>
        </div>
    </div>
</div>
</div>


<?php
include_once "includes/footer.php";
?>