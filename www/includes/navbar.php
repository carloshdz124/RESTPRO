
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand color-text-navbar" href="<?php echo $ubicacion; ?>index.php">
            <img src="<?php echo $ubicacion; ?>assets/imagenes/logo-white.png" width="100" height="100" alt="...">
            RestPro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header sidebar-color-tittle">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Restpro</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body sidebar-color">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="<?php echo $ubicacion; ?>vistas/mesas/mesas.php" class="nav-link align-middle px-0"
                            style="color:#212529;">
                            <i class="fs-4 bi-house"></i>
                            <span class="ms-1">MESAS</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $ubicacion; ?>vistas/rol/rol.php" class="nav-link px-0 align-middle"
                            style="color:#212529;">
                            <i class="fs-4 bi-table"></i> <span class="ms-1">ROL</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $ubicacion; ?>vistas/tareas_preapertura/tareas_preapertura.php"
                            style="color:#212529;" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-list-task icon-index"></i>
                            <span class="ms-1">TAREAS PREAPERTURA</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $ubicacion; ?>vistas/reportes/reportes.php"
                            class="nav-link px-0 align-middle" style="color:#212529;">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1">REPORTES</span> </a>
                    </li>
                    <li>
                        <a href="<?php echo $ubicacion; ?>vistas/estaciones/estaciones.php"
                            class="nav-link px-0 align-middle" style="color:#212529;">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1">ESTACIONES</span> </a>
                    </li>
                    <li>
                        <a href="<?php echo $ubicacion; ?>vistas/personal/personal.php"
                            class="nav-link px-0 align-middle" style="color:#212529;">
                            <i class="fs-4 bi-people"></i> <span class="ms-1">PERSONAL</span> </a>
                    </li>
                    <li>
                        <a href="<?php echo $ubicacion; ?>vistas/agregar/agregar.php" class="nav-link px-0 align-middle"
                            style="color:#212529;">
                            <i class="fs-4 bi-file-earmark-plus"></i> <span class="ms-1">Agregar</span> </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="nav-link d-flex align-items-center text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="color:#212529;">
                        <i class="fs-4 bi-person-circle"></i>
                        <span class="mx-1">Usuario</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php echo $ubicacion; ?>config/eliminar_sesion.php">Cerrar
                                sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>