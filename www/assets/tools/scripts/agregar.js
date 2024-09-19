function confirmarEliminacion(id, nombre) {
    if (confirm("¿Estás seguro de eliminar la mesa " + nombre +"?")) {
        var accion = 'eliminacion';
        // Si el usuario confirma, redirige a la página PHP para eliminar el registro
        window.location.href = 'agregar_procesamiento.php?id=' + id + '&accion=' + accion;
    }
}
