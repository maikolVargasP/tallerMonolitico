<?php
require __DIR__ . '/../../controllers/MateriasController.php';
use App\Controllers\MateriasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new MateriasController();
    $resultado = $controller->saveNewMateria($_POST);

    if ($resultado) {
        header("Location: materias.php");
        exit;
    } else {
        echo "<h2>Error al registrar la materia.</h2>";
        echo "<p>Verifica los datos ingresados e intenta nuevamente.</p>";
        echo '<a href="materia-form.php">Volver al formulario</a>';
    }
} else {
    header("Location: materias.php");
    exit;
}
?>
