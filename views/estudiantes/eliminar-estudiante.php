<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: text/plain");

require __DIR__ . '/../../controllers/ProgramaController.php';
use App\Controllers\ProgramaController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'] ?? null;
    $controller = new ProgramaController();
    $resultado = $controller->deletePrograma($codigo);

    if ($resultado === true) {
        echo "ok";
    } elseif ($resultado === "relaciones") {
        echo "relaciones";
    } else {
        echo "error";
    }
} else {
    echo "Método no permitido";
}
