function onClickBorrar(materia, estudiante, actividad) {
    if (!confirm(`¿Seguro que deseas eliminar la nota "${actividad}" del estudiante ${estudiante}?`)) {
        return;
    }

    fetch("eliminar-nota.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `materia=${encodeURIComponent(materia)}&estudiante=${encodeURIComponent(estudiante)}&actividad=${encodeURIComponent(actividad)}`
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "ok") {
            alert("Nota eliminada correctamente.");
            location.reload();
        } else {
            alert("Error al eliminar la nota: " + data);
        }
    })
    .catch(err => {
        console.error("Error al eliminar nota:", err);
        alert("Ocurrió un error al intentar eliminar la nota.");
    });
}
