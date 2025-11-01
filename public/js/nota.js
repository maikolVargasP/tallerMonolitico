function onClickBorrar(id) {
    if (!confirm("¿Seguro que deseas eliminar esta nota?")) {
        return;
    }

    fetch("notas.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + encodeURIComponent(id)
    })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "ok") {
                alert("Nota eliminada correctamente.");
                location.reload();
            } else {
                alert("Error al eliminar la nota.");
            }
        })
        .catch(error => {
            console.error("Error al eliminar nota:", error);
            alert("Ocurrió un error al intentar eliminar la nota.");
        });
}

function buscarNotas() {
    const codigo = document.getElementById("buscarCodigo").value.trim();

    if (codigo === "") {
        alert("Por favor ingresa un código de estudiante.");
        return;
    }

    fetch(`../notas/buscar-nota.php?codigo=${encodeURIComponent(codigo)}`)
        .then(response => {
            if (!response.ok) throw new Error("Error HTTP");
            return response.text();
        })
        .then(html => {
            document.querySelector("#tablaNotas tbody").innerHTML = html;
        })
        .catch(error => {
            console.error("Error en la búsqueda:", error);
            alert("Ocurrió un error al buscar las notas.");
        });
}
