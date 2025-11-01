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
        const resultado = data.trim();

        if (resultado === "ok") {
            alert("Programa eliminado correctamente.");
            location.reload(); // Recargar la tabla
        } else if (resultado === "relaciones") {
            alert("No se puede eliminar el programa porque tiene estudiantes o materias asociadas.");
        } else if (resultado === "error") {
            alert("No se pudo eliminar el programa por un error en el servidor.");
        } else {
            alert("Respuesta inesperada: " + resultado);
        }
    })
    .catch(err => {
        console.error("Error al eliminar programa:", err);
        alert("Ocurrió un error al intentar eliminar el programa.");
    });
}
// public/js/programa.js
// versión robusta: registra debug en consola, atacha evento y expone la fn en window

function buscarPrograma() {
    const input = document.getElementById("buscarCodigo");
    if (!input) {
        console.error("buscarPrograma: no existe el input #buscarCodigo");
        return;
    }
    const codigo = input.value.trim();
    console.log("[buscarPrograma] codigo:", codigo);

    if (codigo === "") {
        alert("Por favor ingresa un código para buscar.");
        return;
    }

    // ruta relativa desde views/programas/programas.php -> ../programas/buscar-programa.php
    const url = `buscar-programa.php?codigo=${encodeURIComponent(codigo)}`;
    console.log("[buscarPrograma] fetch ->", url);

    fetch(url)
        .then(response => {
            console.log("[buscarPrograma] response.status:", response.status);
            if (!response.ok) throw new Error("HTTP " + response.status);
            return response.text();
        })
        .then(html => {
            console.log("[buscarPrograma] html recibido:", html);
            const tbody = document.querySelector("#tablaProgramas tbody");
            if (!tbody) {
                console.error("buscarPrograma: no se encontró #tablaProgramas tbody");
                return;
            }
            tbody.innerHTML = html;
        })
        .catch(error => {
            console.error("Error en la búsqueda:", error);
            alert("Ocurrió un error al buscar el programa. Revisa la consola (F12).");
        });
}

// Exponer al scope global por compatibilidad con onclick inline
window.buscarPrograma = buscarPrograma;

// también atachar por evento (mejor práctica)
document.addEventListener("DOMContentLoaded", () => {
    const boton = document.querySelector("#botonBuscarPrograma");
    if (boton) {
        boton.addEventListener("click", buscarPrograma);
        console.log("programa.js -> boton #botonBuscarPrograma atachado");
    } else {
        console.log("programa.js -> no existe #botonBuscarPrograma (usando onclick inline?)");
    }
});

