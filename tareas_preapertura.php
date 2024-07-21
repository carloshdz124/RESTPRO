<?php
$titulo = "TAREAS PREAPERTURA";
include ("header.php");
include ("navbar.php");

?>

<div class="container mt-5">
    <h2 class="text-center">Tareas PRE - Apertura</h2>
            <form method="POST" action="procesar.php">
                <div class="row">
                    <!-- Primera Columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="columna1">Seleccione Mesero</label>
                            <select multiple class="form-control" id="columna1" name="columna1[]">
                                <option value="Opción 1-1">Mesero 1</option>
                                <option value="Opción 1-2">Mesero 2</option>
                                <option value="Opción 1-3">Mesero 3</option>
                            </select>
                        </div>
                    </div>
                    <!-- Segunda Columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="columna2">Tareas</label>
                            <select multiple class="form-control" id="columna2" name="columna2[]">
                                <option value="Opción 2-1">Limpiar T1</option>
                                <option value="Opción 2-2">Limpiar T2</option>
                                <option value="Opción 2-3">Limpiar TV</option>
                            </select>
                        </div>
                    </div>
                    <!-- Tercera Columna -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="columna3">Asignadas</label>
                            <select multiple class="form-control" id="columna3" name="columna3[]">
                                <option value="Opción 3-1">
                                    Mesero 1 ✅
                                        - Limpiar T1.
                                        - Limpiar T2.
                                        - Limpiar TV.
                                </option>
                                <option value="Opción 3-2">
                                    Mesero 2 ✅
                                        - Limpiar T1.
                                        - Limpiar T2.
                                        - Limpiar TV.
                                </option>
                                <option value="Opción 3-3">
                                    Mesero 3 ✅
                                        - Limpiar T1.
                                        - Limpiar T2.
                                        - Limpiar TV.
                                </option>
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
            </form>
    </div>
<?php

include_once("footer.php");

?>