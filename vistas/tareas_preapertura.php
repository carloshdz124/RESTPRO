<?php
$ubicacion="../";
$titulo = "TAREAS PREAPERTURA";
include ($ubicacion."includes/header.php");

?>

<div class="container mt-5">
    <h1 class="text-center">Tareas PRE Apertura</h1><br><br>
            <form method="POST" action="#">
                <div class="row">
                    <!-- Primera Columna -->
                    <div class="col-md-4">
                        <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                            <h2 class="text-center" for="columna1">Meseros</h2><br>
                            <div class="d-flex justify-content-center">
                                <button id="abreModal1" type="button" class="btn btn-primary btn-lg d-block w-75">Seleccione Mesero</button>
                                <div id="meserosModal" class="custom-modal">
                                    <div class="custom-modal-content">
                                        <span class="cerrar1">&times;</span>
                                        <div class="modal-header">
                                            <h3 class="modal-title">Mesero</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-container">
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/mesero_1_example.jpeg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 1</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/mesero_2_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 2</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/mesero_3_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 3</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/mesero_4_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 4</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/mesero_5_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 5</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                            <h2 class="text-center" for="columna3">Mesero Seleccionado</h2><br>
                            <div class="justify-content-center">
                                <ul class="list-group">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                    <li class="list-group-item">A fourth item</li>
                                    <li class="list-group-item">And a fifth one</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Segunda Columna -->
                    <div class="col-md-4">
                        <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                            <h2 class="text-center" for="columna2">Tareas</h2><br>
                            <div class="d-flex justify-content-center">
                                <button id="abreModal2" type="button" class="btn btn-primary btn-lg d-block w-75">Seleccione Tareas</button>
                                <div id="tareasModal" class="custom-modal">
                                    <div class="custom-modal-content">
                                        <span class="cerrar2">&times;</span>
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tareas para Asignar al Mesero</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-container">
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/terraza_1_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar Terraza 1</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/terraza_2_example.jpeg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar Terraza 2</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/salon_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar Salón</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/tv_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar TV</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="<?php echo $ubicacion; ?>/assets/imagenes/mesas_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar Mesas</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                            <h2 class="text-center" for="columna3">Tareas Seleccionadas</h2><br>
                            <div class="justify-content-center">
                                <ul class="list-group">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                    <li class="list-group-item">A fourth item</li>
                                    <li class="list-group-item">And a fifth one</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Tercera Columna -->
                    <div class="col-md-4">
                        <div class="form-group border border-black bg-dark text-white p-3 rounded-4"> <!-- Aqui puedo editar los borde -->
                            <h2 class="text-center" for="columna3">Checking</h2><br>
                            <div class="justify-content-center">
                                <ul class="list-group">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                    <li class="list-group-item">A fourth item</li>
                                    <li class="list-group-item">And a fifth one</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Termina la columna e inicia la otra -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-primary btn-custom">EDITAR 📝</button>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-danger btn-custom">ELIMINAR ❌</button>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-success btn-custom">CHECK ✅</button>
                        </div>
                    </div>
                </div>
                <br><br>
            </form>
    </div>

<!-- Script de los Meseros -->
<script>
    // Obtener el modal 1
    var modal1 = document.getElementById("meserosModal");

    // Obtener el botón que abre el modal 1
    var btn1 = document.getElementById("abreModal1");

    // Obtener el <span> que cierra el modal 1
    var span1 = document.querySelector("#meserosModal .cerrar1");

    // Cuando el usuario haga clic en el botón, abrir el modal 1
    btn1.onclick = function() {
        modal1.style.display = "block";
    }

    // Cuando el usuario haga clic en <span> (x), cerrar el modal 1
    span1.onclick = function() {
        modal1.style.display = "none";
    }

    // Cuando el usuario haga clic en cualquier lugar fuera del modal, cerrar el modal 1
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
    }
</script>

<!-- Script de las Tareas para Asignar -->
<script>
    // Obtener el modal 2
    var modal2 = document.getElementById("tareasModal");

    // Obtener el botón que abre el modal 2
    var btn2 = document.getElementById("abreModal2");

    // Obtener el <span> que cierra el modal 2
    var span2 = document.querySelector("#tareasModal .cerrar2");

    // Cuando el usuario haga clic en el botón, abrir el modal 2
    btn2.onclick = function() {
        modal2.style.display = "block";
    }

    // Cuando el usuario haga clic en <span> (x), cerrar el modal 2
    span2.onclick = function() {
        modal2.style.display = "none";
    }

    // Cuando el usuario haga clic en cualquier lugar fuera del modal, cerrar el modal 2
    window.onclick = function(event) {
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
</script>

<?php

include_once($ubicacion."includes/footer.php");

?>