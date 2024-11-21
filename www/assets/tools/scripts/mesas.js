

// Llamamos al endpoint de lista de espera para que se muestre la lista de espera actualizada en tiempo real.
$(document).ready(function () {
    $('#verListaSalida').on('show.bs.modal', function () {
        $.ajax({
            // Ruta al archivo PHP que consulta los datos
            url: '../endpoints/lista_prediccion.php',
            method: 'GET',
            success: function (response) {
                // Inserta el contenido generado en el modal
                $('#tablaResultados').html(response);
            },
            error: function () {
                $('#tablaResultados').html('Hubo un error al cargar los datos.');
            }
        });
    });
});


// Elimina los parámetros GET de la URL
window.history.replaceState({}, document.title, window.location.pathname);

// Funcion para eliminar reservacion    
function eliminarReservacion(id_reservacion, nombre){
    if(confirm('¿Estas seguro que deseas eliminar la reservacion de ' + nombre +'?')){
        var data = {
            id_reservacion : id_reservacion,
            accion: 'eliminarReservacion'
        };
        sendAJAX(data);
    }
}

// Llamamos al endpoint de lista de espera para que se muestre la lista de espera actualizada en tiempo real.
$(document).ready(function () {
    $('#modalListaEspera').on('show.bs.modal', function () {
        $.ajax({
            // Ruta al archivo PHP que consulta los datos
            url: '../endpoints/mesas_consulta_lista_espera.php',
            method: 'GET',
            success: function (response) {
                // Inserta el contenido generado en el modal
                $('#modalContent').html(response);
            },
            error: function () {
                $('#modalContent').html('Hubo un error al cargar los datos.');
            }
        });
    });
});

// Llamamos al endpoint de lista de espera para que se muestre la lista de reservaciones en tiempo real.
$(document).ready(function () {
    $('#modalReservacionHoy').on('show.bs.modal', function () {
        $.ajax({
            url: '../endpoints/mesas_consulta_reservaciones.php', // Ruta al archivo PHP que consulta los datos
            method: 'GET',
            success: function (response) {
                // Inserta el contenido generado en el modal
                $('#modalContentReservaciones').html(response);
            },
            error: function () {
                $('#modalContentReservaciones').html('Hubo un error al cargar los datos.');
            }
        });
    });
});

// Funcion para liberar mesa y dejarla disponible
function cofirmarLiberacionMesa(id_cliente, id_mesa, id_mesa_separada) {
    if (confirm('Esta seguro de que ya se retiro el cliente de la mesa y esta lista para otro cliente?')) {
        var data = {
            id_cliente: id_cliente,
            id_mesa: id_mesa,
            id_mesa_separada: id_mesa_separada,
            accion: 'liberarMesa'
        };

        sendAJAX(data);
    }
}

function separarMesa(id_mesa) {
    if (confirm('Esta seguro que desea separar mesa?')) {
        var data = {
            id_mesa: id_mesa,
            accion: 'separarMesa'
        };

        sendAJAX(data);
    }
}

// Asignamos mesa a cliente
function asignarMesa(id_mesa, id_cliente,id_mesero) {
    var data = {
        id_mesa: id_mesa,
        id_cliente: id_cliente,
        id_mesero: id_mesero,
        accion: 'asignarMesa'
    };
    sendAJAX(data);
}

// Validar que se seleccione por lo menos una opcion del combobox de registrar mesa
document.querySelector('form').addEventListener('submit', function (event) {
    // Obtener todos los checkboxes con el nombre 'cb_areas[]'
    const checkboxes = document.querySelectorAll('input[name="cb_areas[]"]');
    // Convertir NodeList a Array para poder usar métodos como some()
    const algunaSeleccionada = Array.from(checkboxes).some(checkbox => checkbox.checked);

    if (!algunaSeleccionada) {
        // Evitar que el formulario se envíe
        event.preventDefault();
        // Mostrar mensaje de error
        document.getElementById('error').textContent = 'Por favor, selecciona al menos un área.';
    } else {
        // Limpiar mensaje de error si la validación es exitosa
        document.getElementById('error').textContent = '';
    }
});

// Enviar datos a modal y llamar funcion ajax para consulta
var verClientes = document.getElementById('verClientes');
verClientes.addEventListener('show.bs.modal', function (event) {
    // Elemento que activó el modal
    var link = event.relatedTarget;
    // Extraer información de los atributos data-*
    var id = link.getAttribute('data-id');
    var nombre = link.getAttribute('data-nombre');
    var n_personas = link.getAttribute('data-n_personas');
    var id_zona = link.getAttribute('data-id_zona');
    var estado_mesa = link.getAttribute('data-estado');
    var mesero = link.getAttribute('data-mesero');
    var mesero_id = link.getAttribute('data-id-mesero');
    var separada = link.getAttribute('data-separada');

    // Actualizar el contenido del modal
    var modalId = verClientes.querySelector('#modal-id');
    var modalNombre = verClientes.querySelector('#modal-nombre');
    var modaln_personas = verClientes.querySelector('#modal-n_personas');

    modalId.textContent = id;
    modalNombre.textContent = nombre;
    modaln_personas.textContent = n_personas;

    var data = {
        id: id,
        nombre: nombre,
        n_personas: n_personas,
        id_zona: id_zona,
        estado_mesa: estado_mesa,
        mesero: mesero,
        mesero_id: mesero_id,
        separada: separada,
        accion: 'verClientes'
    };

    sendAJAX(data);
});

// Enviar datos a modal y llamar funcion ajax para consulta
var verMesas = document.getElementById('verMesas');
verMesas.addEventListener('show.bs.modal', function (event) {
    // Elemento que activó el modal
    var link = event.relatedTarget;
    // Extraer información de los atributos data-*
    var id = link.getAttribute('data-id');
    var zonas = link.getAttribute('data-zonas');
    var total_personas = link.getAttribute('data-tPersonas');
    var nombre = link.getAttribute('data-nombre');

    // Actualizar el contenido del modal
    var modalNombre = verMesas.querySelector('#modal-nombre');
    var modalZonas = verMesas.querySelector('#modal-zonas');
    var modalTPersonas = verMesas.querySelector('#modal-TPersonas');

    modalNombre.textContent = nombre;
    modalZonas.textContent = zonas;
    modalTPersonas.textContent = total_personas;

    var data = {
        id: id,
        zonas: zonas,
        total_personas: total_personas,
        accion: 'verMesas'
    };

    sendAJAX(data);
});

// Funcion para llamada AJAX y reibir de respuesta datos del modal.
function sendAJAX(data) {
    var id_div_respuesta;
    //Recibimos los datos JSON

    // Verificamos la accion a realizar, si venimos de verMesas
    if (data.accion == 'verMesas') {
        id_div_respuesta = '#mesasDisponibles';
        document.getElementById('mesaOcupada').classList.add('d-none');
        document.getElementById('clientesDisponibles').classList.remove('d-none');
    // Verifixamos si es de verClientes
    } else if (data.accion == 'verClientes') {
        // Verificamos si la mesa está desocupada
        if (data.estado_mesa == 0) { // Mesa desocupada
            id_div_respuesta = '#clientesDisponibles';
            document.getElementById('mesaOcupada').classList.add('d-none');
            document.getElementById('clientesDisponibles').classList.remove('d-none');
        } else { // Mesa ocupada
            id_div_respuesta = '#mesaOcupada';
            document.getElementById('clientesDisponibles').classList.add('d-none');
            document.getElementById('mesaOcupada').classList.remove('d-none');
        }
    } else{
        id_div_respuesta = '#alertPlaceholder';
    }
    /*else if (data.accion == 'asignarMesa' || data.accion == 'liberarMesa' || data.accion == 'eliminarReservacion') {
        id_div_respuesta = '#alertPlaceholder';
    }*/

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "mesas_procesar.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var resultContainer = document.querySelector(id_div_respuesta);
            resultContainer.innerHTML = xhr.responseText;
        }
    };
    xhr.send(JSON.stringify(data));
}

function seleccionaMapa(containerId) {
    // Oculta todos los contenedores
    document.querySelectorAll('.mapa').forEach(function (container) {
        container.style.display = 'none';
    });
    // Muestra el contenedor seleccionado
    document.getElementById(containerId).style.display = 'block';
}
