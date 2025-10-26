<?php
require __DIR__ . '/../controllers/EstudiantesController.php';
use App\Controllers\EstudiantesController;

$controller = new EstudiantesController();
$estudiantes = $controller->queryAllEstudiantes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de estudiantes</title>
</head>
<body>
    <h1>Lista de estudiantes</h1>
    <a href="estudiante-form.php">Crear nuevo</a>
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
        <?php if (!empty($estudiantes)): ?>
            <?php foreach ($estudiantes as $e): ?>
                <tr>
                    <td><?= $e->get('codigo') ?></td>
                    <td><?= $e->get('nombre') ?></td>
                    <td><?= $e->get('email') ?></td>
                    <td><?= $e->get('programa') ?></td>
                    <td>
                        <a href="estudiante-form.php?cod=<?= $e->get('codigo') ?>">Modificar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No hay registros</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
