<?php
require __DIR__ . '/../../controllers/NotasController.php';
use App\Controllers\NotasController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new NotasController();
    $resultado = $controller->deleteNota($_POST);

    if ($resultado === true) {
        echo "ok";
    } else {
        echo "error";
    }
    exit;
} else {
    echo "invalid";
    exit;
}
?>
