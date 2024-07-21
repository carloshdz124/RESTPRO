<?php
$titulo = "TAREAS PREAPERTURA";
include ("header.php");
include ("navbar.php");

?>

<div class="container mt-5">
    <h1 class="text-center">Tareas PRE - Apertura</h1>
            <form method="POST" action="#">
                <div class="row">
                    <!-- Primera Columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <h2 for="columna1">Meseros</h2>
                            <div class="d-flex justify-content-center">
                                <button id="abreModal1" type="button" class="btn btn-primary">Seleccione al Mesero</button>
                                <div id="meserosModal" class="custom-modal-1">
                                    <div class="custom-modal-content-1">
                                        <span class="cerrar1">&times;</span>
                                        <div class="modal-header">
                                            <h3 class="modal-title">Mesero</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-container-1">
                                                <div class="card-1">
                                                    <img src="imagenes/mesero_1_example.jpeg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 1</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                                <div class="card-1">
                                                    <img src="imagenes/mesero_2_example.jpeg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 2</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                                <div class="card-1">
                                                    <img src="imagenes/mesero_3_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 3</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                                <div class="card-1">
                                                    <img src="imagenes/mesero_4_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Mesero 4</h5>
                                                        <a href="#" class="btn btn-dark">Seleccionar</a>
                                                    </div>
                                                </div>
                                                <div class="card-1">
                                                    <img src="imagenes/mesero_5_example.jpg" class="card-img-top" alt="Cargando...">
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
                            </div>
                        </div>
                    </div>
                    <!-- Segunda Columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <h2 for="columna2">Tareas</h2>
                            <div class="d-flex justify-content-center">
                                <button id="abreModal2" type="button" class="btn btn-primary">Seleccione las Tareas a Asignar</button>
                                <div id="tareasModal" class="custom-modal-2">
                                    <div class="custom-modal-content-2">
                                        <span class="cerrar2">&times;</span>
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tareas para Asignar al Mesero</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-container-1">
                                                <div class="card-2">
                                                    <img src="imagenes/terraza_1_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar Terraza 1</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                                <div class="card-2">
                                                    <img src="imagenes/terraza_2_example.jpeg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar Terraza 2</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                                <div class="card-2">
                                                    <img src="imagenes/salon_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar Salón</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                                <div class="card-2">
                                                    <img src="imagenes/tv_example.jpg" class="card-img-top" alt="Cargando...">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Limpiar TV</h5>
                                                        <a href="#" class="btn btn-dark">Asignar</a>
                                                    </div>
                                                </div>
                                                <div class="card-2">
                                                    <img src="imagenes/mesas_example.jpg" class="card-img-top" alt="Cargando...">
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
                            </div>
                        </div>
                    </div>
                    <!-- Tercera Columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <h2 for="columna3">Tareas Seleccionadas</h2>
                            <select multiple class="form-control" id="columna2" name="columna2[]">
                                <option value="Opción 2-1">Limpiar T1</option>
                                <option value="Opción 2-2">Limpiar T2</option>
                                <option value="Opción 2-3">Limpiar TV</option>
                            </select>
                        </div>
                    </div>
                </div>
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
    // Obtener el modal
    var modal = document.getElementById("meserosModal");

    // Obtener el botón que abre el modal
    var btn = document.getElementById("abreModal1");

    // Obtener el <span> que cierra el modal
    var span = document.getElementsByClassName("cerrar1")[0];

    // Cuando el usuario haga clic en el botón, abre el modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Cuando el usuario haga clic en <span> (x), cierra el modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cuando el usuario haga clic en cualquier lugar fuera del modal, ciérralo
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<!-- Script de las Tareas para Asignar -->
<script>
    // Obtener el modal
    var modal = document.getElementById("tareasModal");

    // Obtener el botón que abre el modal
    var btn = document.getElementById("abreModal2");

    // Obtener el <span> que cierra el modal
    var span = document.getElementsByClassName("cerrar2")[0];

    // Cuando el usuario haga clic en el botón, abre el modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Cuando el usuario haga clic en <span> (x), cierra el modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cuando el usuario haga clic en cualquier lugar fuera del modal, ciérralo
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php

include_once("footer.php");

?>