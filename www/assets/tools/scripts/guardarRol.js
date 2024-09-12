// Definir la función para exportar la tabla a PDF
function exportTableToPDF() {
    const { jsPDF } = window.jspdf;

    // Crear una nueva instancia de jsPDF
    const doc = new jsPDF();

    // Obtener la tabla HTML
    const table = document.getElementById("myTable");

    // Usar autoTable para convertir la tabla HTML en una tabla en el PDF con colores personalizados
    doc.autoTable({
        html: table,
        styles: {
            fillColor: [220, 220, 220], // Color de fondo para las celdas
            textColor: [0, 0, 0], // Color del texto
            halign: 'center', // Alineación horizontal del texto
            valign: 'middle', // Alineación vertical del texto
            lineColor: [44, 62, 80], // Color del borde
            lineWidth: 0.5 // Grosor del borde
        },
        headStyles: {
            fillColor: [52, 152, 219], // Color de fondo para las celdas del encabezado
            textColor: [255, 255, 255], // Color del texto del encabezado
            fontStyle: 'bold' // Estilo de fuente del encabezado
        },
        alternateRowStyles: {
            fillColor: [245, 245, 245] // Color de fondo para las filas alternas
        },
        margin: { top: 20 }
    });

    // Guardar el PDF (se sobrescribirá si ya existe uno con el mismo nombre)
    doc.save("tabla.pdf");
}

// Añadir el event listener cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('exportToPDF').addEventListener('click', exportTableToPDF);
});