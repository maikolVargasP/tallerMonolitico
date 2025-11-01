<?php
require __DIR__ . '/../../controllers/NotasController.php';

use App\Controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new NotasController();
    $resultado = $controller->saveNewNota($_POST);

    if ($resultado === true) {
        header("Location: notas.php");
        exit;
    } elseif ($resultado === "no_coincide_programa") {
        echo "<h3>Error: La materia no pertenece al programa del estudiante seleccionado.</h3>";
        echo '<a href="nota-form.php">Volver</a>';
    } else {
        echo "<h3>Error al registrar la nota.</h3>";
        echo '<a href="nota-form.php">Volver</a>';
    }
} else {
    header("Location: notas.php");
    exit;
}
?>
