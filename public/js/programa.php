function onClickBorrar(codigo) {
    if (!confirm("¿Seguro que deseas eliminar este programa de formación?")) {
        return; // El usuario canceló
    }

    // Enviar la solicitud vía fetch a eliminar-programa.php
    fetch("eliminar-programa.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "codigo=" + encodeURIComponent(codigo),
    })
    .then(response => response.text())
    .then(data => {
        const mensaje = data.trim();

        if (mensaje === "ok") {
            alert("Programa eliminado correctamente.");
            location.reload(); // recarga la lista actual
        } 
        else if (mensaje === "relaciones") {
            alert("No se puede eliminar el programa: tiene estudiantes o materias asociadas.");
        } 
        else if (mensaje === "error") {
            alert("No se pudo eliminar el programa por un error en el servidor.");
        } 
        else {
            alert("Respuesta inesperada del servidor: " + mensaje);
        }
    })
    .catch(err => {
        console.error("Error al eliminar programa:", err);
        alert("Ocurrió un error al intentar eliminar el programa.");
    });
}
