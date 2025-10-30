<?php
require __DIR__ . '/../../controllers/EstudiantesController.php';
use App\Controllers\EstudiantesController;

$controller = new EstudiantesController();
$estudiantes = $controller->queryAllEstudiantes(); 

// Si llega una solicitud POST (por ejemplo, borrar estudiante)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $controller->deleteEstudiante($_POST);

    if ($resultado === true) {
        echo "ok";
    } elseif ($resultado === "notas") {
        echo "tiene_notas";
    } else {
        echo "error";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de estudiantes</title>
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>
<body>
    <h1>Lista de estudiantes</h1>
    <a href="estudiante-form.php">Crear nuevo</a>
    <a href="../home.php">Volver</a>

    <div class="search-box" style="margin-top: 20px;">
        <label for="buscarCodigo">Buscar por código:</label>
        <input type="text" id="buscarCodigo" placeholder="Ej: 1001">
        <button type="button" onclick="buscarEstudiante()">Buscar</button>
    </div>


    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Programa</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($estudiantes)) : ?>
                <?php foreach ($estudiantes as $e): ?>
                    <tr>
                        <td><?= $e->get('codigo') ?></td>
                        <td><?= $e->get('nombre') ?></td>
                        <td><?= $e->get('email') ?></td>
                        <td><?= $e->get('programa') ?></td>
                        <td>
                            <button onclick="onClickBorrar('<?= $e->get('codigo') ?>')">
                                <img src="../../public/res/borrar.svg" alt="Borrar" width="30px">
                            </button>
                            <button>
                                <a href="estudiante-form.php?cod=<?= $e->get('codigo') ?>">
                                    <img src="../../public/res/modificar.svg" alt="Modificar" width="30px">
                                </a>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="5">No hay estudiantes registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <script src="../../public/js/estudiante.js"></script>
</body>
</html>
