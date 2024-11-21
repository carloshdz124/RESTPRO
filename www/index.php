<?php
$titulo = "Index";

include_once "includes/header.php";
?>
<style>
    #mensaje {
        margin-top: 20px;
        font-size: 20px;
        font-weight: bold;
    }
</style>

<div class="container mt-5 centrar">
    <h1>User: <?php echo $user; ?></h1>
    <h1>Tipo user: <?php echo $tipo_user; ?></h1>
    <div class="row">
        <div class="col">
            <div class="card" style="width: 14rem; margin: 0 auto;">
                <div class="card-icon-container">
                    <i class="bi bi-bounding-box-circles icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Mesas</h5>
                    <a href="<?php echo $ubicacion; ?>vistas/mesas/mesas.php" class="btn btn-primary">Ir a mesas</a>
                </div>
            </div>
        </div>
        <!--div class="col">
            <div class="card" style="width: 14rem; margin: 0 auto;">
                <div class="card-icon-container">
                    <i class="bi bi-list-task icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Tareas pre-apertura</h5>
                    <a href="<?php echo $ubicacion; ?>vistas/tareas_preapertura/tareas_preapertura.php"
                        class="btn btn-primary">Ir a
                        tareas</a>
                </div>
            </div>
        </div-->
        <div class="col">
            <div class="card" style="width: 14rem; margin: 0 auto;">
                <div class="card-icon-container">
                    <i class="bi bi-file-earmark-plus icon-index"></i>
                    
                </div>
                <div class="card-body">
                    <h5 class="card-title">Agregar</h5>
                    <a href="<?php echo $ubicacion; ?>vistas/agregar/agregar.php" class="btn btn-primary">Ir a
                        agregar</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 14rem; margin: 0 auto;">
                <div class="card-icon-container">
                    <i class="bi bi-device-ssd icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Estaciones</h5>
                    <a href="<?php echo $ubicacion; ?>vistas/estaciones/estaciones.php" class="btn btn-primary">Ir a
                        estaciones</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 14rem; margin: 0 auto;">
                <div class="card-icon-container">
                    <i class="bi bi-table icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rol</h5>
                    <a href="<?php echo $ubicacion; ?>vistas/rol/rol.php" class="btn btn-primary">Rol</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 14rem; margin: 0 auto;">
                <div class="card-icon-container">
                    <i class="bi bi-people-fill icon-index"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Personal</h5>
                    <a href="<?php echo $ubicacion; ?>vistas/personal/personal.php" class="btn btn-primary">Ir a
                        personal</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>