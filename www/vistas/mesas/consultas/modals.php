<!-- Modal Registrar Mesa -->
<div class="modal fade" id="modalAsignarMesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar mesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="mesas_procesar.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="formulario" value="registroMesa"></input>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input placeholder="A nombre de quien sera su mesa" type="text" class="form-control" id="nombre"
                            name="tb_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Numero de adultos.</label>
                        <input placeholder="Cantidad de adultos" type="number" class="form-control" id="email"
                            name="tb_nadultos" required>
                    </div>
                    <div class="mb-3">
                        <label for="n_niños" class="form-label">Numero de niños.</label>
                        <input placeholder="Cantidad de niños" type="number" class="form-control" id="n_niños"
                            name="tb_nninos" required>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Area deseada</label>
                        <?php foreach ($resultAreas as $area): ?>
                            <div class="form-check">
                                <input name="cb_areas[]" class="form-check-input" type="checkbox"
                                    value="<?php echo $area->id; ?>" id="<?php echo $area->nombre; ?>" checked>
                                <label class="form-check-label"
                                    for="<?php echo $area->nombre; ?>"><?php echo $area->nombre; ?></label>
                            </div>
                        <?php endforeach ?>
                        <p id="error" style="color: red;"></p> <!-- Mensaje de error -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reservacion -->
<div class="modal fade" id="modalReservacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Reservacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="mesas_procesar.php" method="POST">
                <input type="hidden" name="formulario" value="registroReservacion"></input>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input placeholder="A nombre de quien sera su mesa" type="text" class="form-control" id="nombre"
                            name="tb_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">telefono</label>
                        <input placeholder="Telefono de contacto" type="tel" class="form-control" id="tb_telefono"
                            name="tb_telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="n_adultos" class="form-label">Numero de adultos.</label>
                        <input placeholder="Cantidad de adultos" type="number" class="form-control" id="n_adultos"
                            name="tb_nadultos" required>
                    </div>
                    <div class="mb-3">
                        <label for="n_ninos" class="form-label">Numero de niños.</label>
                        <input placeholder="Cantidad de niños" type="number" class="form-control" id="n_ninos"
                            name="tb_nninos" required>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Area deseada</label>
                        <select name="sb_area" class="form-select" aria-label="Default select example">
                            <option value="salon">Salon</option>
                            <option value="terraza">Terraza</option>
                            <option value="infantil">Area infantil</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha de reservacion</label>
                        <input min="<?php echo isset($fecha) ? $fecha : date('Y-m-d'); ?>" type="date"
                            class="form-control" name="tb_fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Hora (Disponible solo de 12pm a 10pm)</label>
                        <input min="12:00:00" max="21:00:00" type="time" class="form-control" name="tb_hora" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lista de Espera -->
<div class="modal fade" id="modalListaEspera" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lista espera</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="#" method="POST">
                <div class="modal-body" id="modalContent">
                    <!-- Aquí se insertarán los datos con AJAX -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver mesas disponibles para cliente -->
<div class="modal fade" id="verMesas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mesas disponibles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="#" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre: </l>
                            <label for="id" class="form-label" id="modal-nombre" name="tb_nombre"></label>
                    </div>
                    <div class="mb-3">
                        <label>Zonas: </label>
                        <label for="zonas" class="form-label" id="modal-zonas" name="tb_zonas"></label>
                    </div>
                    <div class="mb-3">
                        <label>Total personas: </label>
                        <label for="personas" class="form-label" id="modal-TPersonas" name="tb_zonas"></label>
                    </div>
                    <div class="mb-3">
                        <!-- Aqui mostramos los datos siendo una respuesta AJAX -->
                        <div>
                            <p><strong>MESAS LIBRES: </strong></p>
                            <table class="table table-dark centrar" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Mesa</th>
                                        <th scope="col">N. personas</th>
                                        <th scope="col">Opc</th>
                                    </tr>
                                </thead>
                                <tbody class="table-secondary" id="mesasDisponibles">
                                    <!-- Aquí se mostrarán los clientes disponibles -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Reservaciones registradas -->
<div class="modal fade" id="modalReservacionHoy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reservaciones del dia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="#" method="POST">
                <div class="modal-body" id="modalContentReservaciones">
                    <!-- Aquí se insertarán los datos con AJAX -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Clientes a elegir -->
<div class="modal fade" id="verClientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opciones a elegir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="#" method="POST">
                <div class="modal-body">
                    <div class="mb-3" style="display: none;">
                        <label>Mesa seleccionada: </label>
                        <label class="form-label" id="modal-id" name="tb_id"></label>
                    </div>
                    <div class="mb-3">
                        <label>Mesa seleccionada: </label>
                        <label for="zonas" class="form-label" id="modal-nombre" name="tb_zonas"></label>
                    </div>
                    <div class="border-bottom mb-3">
                        <label>Cantidad de personas: </label>
                        <label for="personas" class="form-label" id="modal-n_personas" name="tb_zonas"></label>
                    </div>
                    <div class="mb-3">
                        <!-- Si esta desocupada la mesa, entonces mostramos opciones de clientes a elegir-->
                        <div id="clientesContainer" class="d-none">
                            <p><strong>Clientes a elegir: </strong></p>
                            <table class="table table-dark centrar" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">N. personas</th>
                                        <th scope="col">Opc</th>
                                    </tr>
                                </thead>
                                <tbody class="table-secondary" id="clientesDisponibles">
                                    <!-- Aquí se mostrarán los clientes disponibles -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Si ya esta ocupada la mesa, entonces mostramos datos del cliente-->
                        <div id="mesaOcupada" class="d-none">
                            <!-- Respuesta AJX -->
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<?php if ($message != ''): ?>
    <!-- Modal Ver mesas disponibles despues de registrar mesa -->
    <div class="modal fade" id="modalVerMesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mesas disponibles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="was-validated" action="#" method="POST">
                    <div class="modal-body d-flex">
                        <?php foreach ($resultDisponibles as $mesa):
                            echo $mesa->nombre . '<br>';
                        endforeach ?>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>