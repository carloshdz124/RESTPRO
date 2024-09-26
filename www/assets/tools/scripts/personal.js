    function opcionesExtra() {
        var cuantosDias = document.getElementById('cuantosDias');
        var opcionVarios = document.getElementById('opcionVarios');

        if (opcionVarios.checked) {
            cuantosDias.classList.remove('hidden');
        } else {
            cuantosDias.classList.add('hidden');
        }
    }

    function IngresaMinFechaFin() {
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate');

        // Establecer la fecha mínima del segundo input como la fecha seleccionada en el primer input
        endDate.min = startDate;
    }

    var modalEditar = document.getElementById('modalEditar');
    modalEditar.addEventListener('show.bs.modal', function (event) {
        // Elemento que activó el modal
        var link = event.relatedTarget;
        // Extraer información de los atributos data-*
        var id = link.getAttribute('data-id');
        var name = link.getAttribute('data-name');
        var apellido = link.getAttribute('data-apellido');
        var descanso = link.getAttribute('data-descanso');

        // Actualizar el contenido del modal
        var modalId = modalEditar.querySelector('#modal-id');
        var modalName = modalEditar.querySelector('#modal-name');
        var modalApellido = modalEditar.querySelector('#modal-apellido');
        var modalDescanso = modalEditar.querySelector('#modal-descanso');

        modalId.value = id;
        modalName.value = name;
        modalApellido.value = apellido;
        modalDescanso.value = descanso;
    });

    var modalBloquear = document.getElementById('modalBloquear');
    modalBloquear.addEventListener('show.bs.modal', function (event) {
        // Elemento que activó el modal
        var link = event.relatedTarget;
        // Extraer información de los atributos data-*
        var id = link.getAttribute('data-id');
        var name = link.getAttribute('data-name');
        var estado = link.getAttribute('data-estado');

        // Actualizar el contenido del modal
        var modalId = modalBloquear.querySelector('#modal-id');
        var modalName = modalBloquear.querySelector('#modal-name');
        var modalEstado = modalBloquear.querySelector('#modal-estado');

        modalId.value = id;
        modalName.textContent = name;
        modalEstado.value = estado;
    });

    function confirmarDesbloqueo(id) {
        if (confirm("¿Estás seguro de desbloquear al mesero?" + id)) {
            var accion = 'desbloqueo'
            // Si el usuario confirma, redirige a la página PHP para eliminar el registro
            window.location.href = 'personal_procesamiento.php?id=' + id + '&accion=' + accion;
        }
    }

    function confirmarEliminacion(id) {
        if (confirm("¿Estás seguro de eliminar al mesero?" + id)) {
            var accion = 'eliminacion';
            // Si el usuario confirma, redirige a la página PHP para eliminar el registro
            window.location.href = 'personal_procesamiento.php?id=' + id + '&accion=' + accion;
        }
    }
