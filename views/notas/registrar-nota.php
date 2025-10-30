<?php
require __DIR__ . '/../../controllers/NotasController.php';
use App\Controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new NotasController();
    $resultado = $controller->saveNewNota($_POST);

    if ($resultado === true) {
        header("Location: notas.php");
        exit;
    } elseif ($resultado === "fuera_programa") {
        echo "<h2>No se puede registrar la nota.</h2>";
        echo "<p>La materia no pertenece al programa del estudiante.</p>";
    } else {
        echo "<h2>Error al registrar la nota.</h2>";
        echo "<p>Verifica los datos e intenta nuevamente.</p>";
    }

    echo '<br><a href="nota-form.php">Volver al formulario</a>';
    exit;
} else {
    header("Location: notas.php");
    exit;
}
?>
