function onClickBorrar(codigo) {
    if (!confirm("¿Seguro que deseas eliminar este estudiante?")) {
        return; // El usuario canceló
    }

    // Enviar la solicitud vía fetch a eliminar-estudiante.php
    fetch("../../views/programas/eliminar-programa.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "codigo=" + encodeURIComponent(codigo),
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "ok") {
            alert("Estudiante eliminado correctamente.");
            location.reload(); // Recargar la lista
        } else if (data.trim() === "error") {
            alert("No se pudo eliminar el estudiante. Es posible que tenga notas registradas.");
        } else {
            alert("Error inesperado: " + data);
        }
    })
    .catch(err => {
        console.error("Error al eliminar estudiante:", err);
        alert("Ocurrió un error al intentar eliminar el estudiante.");
    });
}
