<?php
$ubicacion = "../../";
$titulo = "Agregar";
include ($ubicacion . "includes/header.php");
include ($ubicacion . "config/conexion.php");

$result = $pdo->query("SELECT * FROM area");
if ($result->rowCount() > 0) {
    $existeArea = 'ok';
    $resultAreas = $result->fetchAll(PDO::FETCH_OBJ);
}

$result = $pdo->query('SELECT * FROM mesa ORDER BY nombre ASC');
if ($result->rowCount() > 0) {
    $resultMesas = $result->fetchAll(PDO::FETCH_OBJ);
}

$message = isset($_GET['message']) ? $_GET['message'] : '';
if ($message == 'ok') {
    $message = 'Se registro correctamente';
} else if ($message == 'no') {
    $message = 'Error al insertar datos';
}
?>
<style>
    .card a {
        color: inherit;
        /* Elimina el color del enlace */
        text-decoration: none;
        /* Elimina el subrayado del enlace */
    }

    .card {
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
        /* Añade sombra al card al pasar el mouse */
    }
</style>

<div class="container mt-3">
    <!-- Alerta de aviso de accion -->
    <?php if ($message != '') { ?>
        <div class="alert alert-success mt-3" style="text-align: center;">
            <?php echo $message; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <h1 class="text-center"><?php echo $titulo; ?></h1><br>
    <div class="row ">
        <div class="col">
            <div class="card centrar" style="width:200px; margin: 0 auto;">
                <a href="" data-bs-toggle="modal" data-bs-target="#agregarMesa" class="stretched-link">
                    <img class="card-img-top" src="<?php echo $ubicacion; ?>assets/imagenes/icon_add_mesa.jpg">
                    <div class="card-body">
                        Insertar Mesa
                    </div>
                </a>
            </div>


            <br>
            <div class="centrar">
                <table class="table table-bordered table-dark" style="width: 50%px;">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">area</th>
                            <th scope="col">estado</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <?php foreach ($resultMesas as $mesa): ?>
                            <tr>
                                <?php if ($mesa->estado == 0) {
                                    $estado = 'success';
                                }
                                if ($mesa->estado == 1) {
                                    $estado = 'danger';
                                }
                                if ($mesa->estado == 2) {
                                    $estado = 'warning';
                                } ?>
                                <td scope="row"><?php echo $mesa->nombre; ?></td>
                                <td scope="row"><?php echo $mesa->area_id; ?></td>
                                <td scope="row"><button class="btn btn-<?php echo $estado; ?>">x</button></td>
                            </tr>
                        <?php endforeach ?>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="card centrar" style="width:200px; margin: 0 auto;">
                <a href="" data-bs-toggle="modal" data-bs-target="#agregarArea" class="stretched-link">
                    <img class="card-img-top" src="<?php echo $ubicacion; ?>assets/imagenes/icon_add_area.jpg">
                    <div class="card-body">
                        Insertar area
                    </div>
                </a>
            </div>
            <br>
            <div>
                <table class="table table-bordered table-dark" style="width: 50%px;">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <?php foreach ($resultAreas as $area): ?>
                            <tr>
                                <td scope="row"><?php echo $area->nombre; ?></td>
                                <td scope="row"><?php echo $area->descripcion; ?></td>
                            </tr>
                        <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar Mesas al restaurante -->
<div class="modal fade" id="agregarMesa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar mesa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="agregar_procesamiento.php" method="POST">
                <?php if (isset($existeArea)) { ?>
                    <div class="modal-body">
                        <input type="hidden" name="formulario" value="agregarMesa"></input>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input placeholder="Nombre o numero de mesa" type="text" class="form-control" id="nombre"
                                name="tb_nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="area" class="form-label">Area</label>
                            <select aria-label="Default select example" class="form-select" id="area" name="sb_area">
                                <?php foreach ($resultAreas as $area):
                                    echo '<option value=" ' . $area->id . ' ">' . $area->nombre . '</option>';
                                endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="n_personas" class="form-label">Numero de personas</label>
                            <input placeholder="Nombre o numero de mesa" type="num" class="form-control" id="n_personas"
                                name="tb_nPersonas" required>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="modal-body">
                        No existen areas, primero ingresa un area
                    </div>
                <?php } ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <?php if (isset($existeArea)) { ?>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para agregar Areas al restaurante -->
<div class="modal fade" id="agregarArea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Area</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="was-validated" action="agregar_procesamiento.php" method="POST">
                <input type="hidden" name="formulario" value="agregarArea"></input>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input placeholder="Nombre de area" type="text" class="form-control" id="nombre"
                            name="tb_nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Descripción.</label>
                        <input placeholder="Descripcion de area" type="text" class="form-control" id="nombre"
                            name="tb_descripcion" required>
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