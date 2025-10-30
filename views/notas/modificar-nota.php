<?php
require __DIR__ . '/../../controllers/NotasController.php';
use App\Controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new NotasController();
    $resultado = $controller->updateNota($_POST);

    if ($resultado) {
        header("Location: notas.php");
        exit;
    } else {
        echo "<h2>Error al modificar la nota.</h2>";
        echo "<p>Solo se puede cambiar el valor de la nota, no los demás campos.</p>";
        echo '<br><a href="nota-form.php">Volver al formulario</a>';
    }
    exit;
} else {
    header("Location: notas.php");
    exit;
}
?>
