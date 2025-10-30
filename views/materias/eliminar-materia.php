<?php
require __DIR__ . '/../../controllers/MateriasController.php';
use App\Controllers\MateriasController;

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new MateriasController();
    $resultado = $controller->deleteMateria($_POST);

    if ($resultado === true) {
        echo "ok";
    } elseif ($resultado === "notas") {
        echo "tiene_notas";
    } else {
        echo "error";
    }
    exit;
} else {
    echo "invalid_request";
    exit;
}
?>
