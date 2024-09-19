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
