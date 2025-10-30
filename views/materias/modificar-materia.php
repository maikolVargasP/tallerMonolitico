<?php
require __DIR__ . '/../../controllers/MateriasController.php';

use App\Controllers\MateriasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new MateriasController();
    $resultado = $controller->updateMateria($_POST);

    if ($resultado === true) {
        header("Location: materias.php");
        exit;
    } elseif ($resultado === "relaciones") {
        echo "<h2>No se puede modificar el programa</h2>";
        echo "<p>La materia tiene estudiantes relacionados.</p>";
        echo '<a href="materias.php">Volver</a>';
    } else {
        echo "<h2>Error al modificar la materia.</h2>";
        echo '<a href="materia-form.php?cod=' . $_POST['codigo'] . '">Volver al formulario</a>';
    }
} else {
    header("Location: materias.php");
    exit;
}
?>
