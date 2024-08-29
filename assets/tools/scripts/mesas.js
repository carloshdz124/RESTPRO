    // Llamamos al endpoint de lista de espera para que se muestre la lista actualizada en todo momento.
    $(document).ready(function () {
        $('#modalListaEspera').on('show.bs.modal', function () {
            $.ajax({
                url: '../endpoints/mesas_consulta_lista_espera.php', // Ruta al archivo PHP que consulta los datos
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

    function cofirmarLiberacionMesa(id_cliente, id_mesa) {
        if (confirm('Esta seguro de que ya se retiro el cliente de la mesa y esta lista para otro cliente?')) {
            var data = {
                id_cliente: id_cliente,
                id_mesa: id_mesa,
                accion: 'liberarMesa'
            };

            sendAJAX(data);
        }
    }

    //Llamamos endpoint para que los estados esten actualizados junto con su color
    function actualizarEstados() {
        fetch('../endpoints/mesas_estado.php') // Cambia a la ruta de tu endpoint
            .then(response => response.json())
            .then(data => {
                // Recorre todos los botones y actualiza su clase según el estado
                Object.keys(data).forEach(id => {
                    const estado = data[id];
                    const button = document.querySelector(`#tooltip-${id} button`);

                    if (estado == 0) {
                        button.className = 'btn btn-success border';
                    } else if (estado == 1) {
                        button.className = 'btn btn-danger border';
                    } else {
                        button.className = 'btn btn-warning border';
                    }
                    // Actualiza el atributo data-estado
                    button.setAttribute('data-estado', estado);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Actualiza el estado cada 2 segundos (2000 ms)
    setInterval(actualizarEstados, 2000);

    // Llama a la función inmediatamente al cargar la página
    actualizarEstados();

    // Asignamos mesa a cliente
    function asignarMesa(id_mesa, id_cliente) {
        var data = {
            id_mesa: id_mesa,
            id_cliente: id_cliente,
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

        if (data.accion == 'verMesas') {
            id_div_respuesta = '#mesasDisponibles';
            document.getElementById('mesaOcupada').classList.add('d-none');
            document.getElementById('clientesContainer').classList.remove('d-none');
        } else if (data.accion == 'verClientes') {
            if (data.estado_mesa == 0) {
                id_div_respuesta = '#clientesDisponibles';
                document.getElementById('mesaOcupada').classList.add('d-none');
                document.getElementById('clientesContainer').classList.remove('d-none');
            } else {
                id_div_respuesta = '#mesaOcupada';
                document.getElementById('clientesContainer').classList.add('d-none');
                document.getElementById('mesaOcupada').classList.remove('d-none');
            }
        } else if (data.accion == 'asignarMesa' || data.accion == 'liberarMesa') {
            id_div_respuesta = '#alertPlaceholder';
        }
        console.log(data.accion);
        console.log(id_div_respuesta);

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

    // Inicializar todos los tooltips en la página
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Inicializa el tooltip en el div específico
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[id^="tooltip-"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
