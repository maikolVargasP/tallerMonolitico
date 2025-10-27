<?php
require __DIR__ . '/../../controllers/EstudiantesController.php';

use App\Controllers\EstudiantesController;

// Verifica que la solicitud venga del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EstudiantesController();

    // Ejecuta la actualización a través del controlador
    $resultado = $controller->updateEstudiante($_POST);

    if ($resultado) {
        // Si todo sale bien, redirige de nuevo a la lista
        header("Location: estudiantes.php");
        exit;
    } else {
        echo "<h3>Error al modificar el estudiante. Verifica los datos.</h3>";
        echo '<a href="estudiante-form.php?cod=' . htmlspecialchars($_POST['codigo']) . '">Volver al formulario</a>';
    }
} else {
    // Si no llegó por POST, redirige a la lista
    header("Location: estudiantes.php");
    exit;
}
?>
