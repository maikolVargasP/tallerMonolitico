<?php
require __DIR__ . '/../../controllers/EstudiantesController.php';
use App\Controllers\EstudiantesController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EstudiantesController();
    $resultado = $controller->saveNewEstudiante($_POST);

    if ($resultado) {
        // Registro exitoso → vuelve a la lista
        header("Location: estudiantes.php");
        exit;
    } else {
        // Error de validación o de inserción
        echo "<h2>Error al registrar el estudiante.</h2>";
        echo "<p>Verifica los datos ingresados e intenta nuevamente.</p>";
        echo '<a href="estudiante-form.php">Volver al formulario</a>';
    }
} else {
    // Si no llega por POST, redirige por seguridad
    header("Location: estudiantes.php");
    exit;
}
?>
