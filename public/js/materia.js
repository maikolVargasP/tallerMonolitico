function onClickBorrar(codigo) {
    if (!confirm("¿Seguro que deseas eliminar esta materia?")) {
        return; // cancelado
    }

    fetch("eliminar-materia.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "codigo=" + encodeURIComponent(codigo),
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "ok") {
            alert("Materia eliminada correctamente.");
            location.reload();
        } else if (data.trim() === "tiene_notas") {
            alert("No se puede eliminar la materia porque tiene notas registradas.");
        } else {
            alert("Error al eliminar la materia.");
        }
    })
    .catch(err => {
        console.error("Error al eliminar materia:", err);
        alert("Error en el servidor al intentar eliminar la materia.");
    });
}
function onClickBorrar(codigo) {
    if (!confirm("¿Seguro que deseas eliminar esta materia?")) {
        return;
    }

    fetch("eliminar-materia.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "codigo=" + encodeURIComponent(codigo),
    })
    .then(response => response.text())
    .then(data => {
        const resultado = data.trim();

        if (resultado === "ok") {
            alert("Materia eliminada correctamente.");
            location.reload();
        } else if (resultado === "notas") {
            alert("No se puede eliminar la materia porque tiene notas registradas.");
        } else {
            alert("Error al eliminar la materia.");
        }
    })
    .catch(err => {
        console.error("Error al eliminar materia:", err);
        alert("Ocurrió un error al intentar eliminar la materia.");
    });
}

function buscarMateria() {
    const input = document.getElementById("buscarCodigo");
    const codigo = input.value.trim();

    if (codigo === "") {
        alert("Por favor ingresa un código para buscar.");
        return;
    }

    const url = `buscar-materia.php?codigo=${encodeURIComponent(codigo)}`;
    console.log("[buscarMateria] ->", url);

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error("HTTP " + response.status);
            return response.text();
        })
        .then(html => {
            const tbody = document.querySelector("#tablaMaterias tbody");
            if (!tbody) {
                console.error("No se encontró el tbody de materias");
                return;
            }
            tbody.innerHTML = html;
        })
        .catch(error => {
            console.error("Error en la búsqueda:", error);
            alert("Ocurrió un error al buscar la materia. Revisa la consola.");
        });
}

window.buscarMateria = buscarMateria;

document.addEventListener("DOMContentLoaded", () => {
    const boton = document.querySelector("#botonBuscarMateria");
    if (boton) boton.addEventListener("click", buscarMateria);
});

