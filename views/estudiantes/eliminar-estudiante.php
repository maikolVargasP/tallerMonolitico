<?php
require __DIR__ . '/../../controllers/EstudiantesController.php';
use App\Controllers\EstudiantesController;

if (isset($_POST['codigo'])) {
    $controller = new EstudiantesController();
    $resultado = $controller->deleteEstudiante($_POST);

    if ($resultado) {
        echo "ok";
    } else {
        echo "error";
    }
} else {
    echo "no-data";
}
?>
