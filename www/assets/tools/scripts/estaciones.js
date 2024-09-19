let currentNumber = parseInt(document.getElementById('numberLabel').textContent, 10);
    
// Definir los límites
const lowerLimit = currentNumber; // Ajusta según sea necesario
const upperLimit = currentNumber; // Ajusta según sea necesario

function updateLabel() {
    const alertElement = document.getElementById('alertMessage');
    alertElement.className = 'alert'; // La clase básica para alertas de Bootstrap
    if(currentNumber < 1) {
        currentNumber = 1;
        alertElement.classList.add('alert-danger'); // Ejemplo de clase para advertencia
        alertElement.style.display = 'block'; // Mostrar la alerta
    }
    if(currentNumber > 30){
        currentNumber = 30;
        alertElement.classList.add('alert-danger'); // Ejemplo de clase para advertencia
        alertElement.style.display = 'block'; // Mostrar la alerta
    }else{
        alertElement.style.display = 'none';
    }
    document.getElementById('numberLabel').textContent = currentNumber;
}

function increaseNumber() {
    currentNumber++;
    updateLabel();
    loadRecords();
    checkLimits();
}

function decreaseNumber() {
    currentNumber--;
    updateLabel();
    loadRecords();
    checkLimits();
}

// Verificar si el número supera los límites y mostrar un mensaje
function checkLimits() {
    const alertElement = document.getElementById('alertMessage');
    if (currentNumber > upperLimit) {
        alertElement.textContent = `Solo tienes ${upperLimit} meseros, tienes mas estaciones que meseros`;
        alertElement.classList.add('alert-warning'); // Ejemplo de clase para advertencia
        alertElement.style.display = 'block'; // Mostrar la alerta
    if(currentNumber == 30) alertElement.textContent = `Solo puedes añadir un maximo de 30 estaciones`;
    } else if (currentNumber < lowerLimit) {
        alertElement.textContent = `Tienes ${lowerLimit} meseros, tienes mas meseros que estaciones`;
        alertElement.classList.add('alert-warning'); // Ejemplo de clase para advertencia
        alertElement.style.display = 'block'; // Mostrar la alerta
        if(currentNumber == 1) alertElement.textContent = `Tienes que tener un minimo de 1 estacion`;
    } else {
        alertElement.style.display = 'none'; // Ocultar la alerta si está dentro de los límites
    }
}

let previouslySelectedCheckbox = null;

// Función para cargar los registros
function loadRecords() {
    fetch(`crear_estaciones_procesamiento.php?count=${currentNumber}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('recordsTable').innerHTML = data;
            attachRowClickHandlers(); // Reasignar manejadores de eventos
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Función para manejar los clics en las filas
function attachRowClickHandlers() {
    const tableBody = document.querySelector('table tbody');
    if (tableBody) {
        tableBody.addEventListener('click', (event) => {
            const clickedRow = event.target.closest('tr');
            if (clickedRow) {
                const checkbox = clickedRow.querySelector('input[type="checkbox"]');
                if (checkbox) {
                    // Deseleccionar checkbox previamente seleccionado
                    if (previouslySelectedCheckbox && previouslySelectedCheckbox !== checkbox) {
                        previouslySelectedCheckbox.checked = false;
                        updateMesas(previouslySelectedCheckbox, ''); // Limpiar información de mesas
                    }
                    // Marcar el checkbox de la fila clicada
                    checkbox.checked = !checkbox.checked;
                    // Actualizar la información de la columna "Mesas"
                    updateMesas(checkbox, checkbox.checked ? 'Información nueva' : ''); 
                    // Actualizar la referencia al checkbox actualmente seleccionado
                    previouslySelectedCheckbox = checkbox.checked ? checkbox : null;
                }
            }
        });
    } else {
        console.error('Table body not found after loading records');
    }
}

// Función para actualizar la información en la columna "Mesas"
function updateMesas(checkbox, info) {
    const row = checkbox.closest('tr');
    if (row) {
        const mesasCell = row.querySelector('td:nth-child(4)'); // La columna "Mesas" es la cuarta columna
        if (mesasCell) {
            mesasCell.textContent = info;
        }
    }
}

// Cargar registros al iniciar
document.addEventListener('DOMContentLoaded', () => {
    loadRecords();
    checkLimits();

});

