<?php
require __DIR__ . '/../../controllers/MateriasController.php';
use App\Controllers\MateriaController;

// Crear instancia del controlador
$controller = new MateriaController();
$materia = $controller->queryAllMaterias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de materias</title>
</head>
<body>
    <h1>Lista de materias</h1>
    <a href="materia-form.php">Crear nueva materia</a>
    <a href="../home.php">Volver</a>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Programa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($materias)) : ?>
                <?php foreach ($materias as $m): ?>
                    <tr>
                        <td><?= $m->codigo ?></td>
                        <td><?= $m->nombre ?></td>
                        <td><?= $m->programa ?></td>
                        <td>
                            <button onclick="onClickBorrar('<?= $m->codigo ?>')">
                                <img src='../../public/res/borrar.svg' alt='Borrar' width='30px'>
                            </button>
                            <button>
                                <a href='materia-form.php?cod=<?= $m->codigo ?>'>
                                    <img src='../../public/res/modificar.svg' alt='Modificar' width='30px'>
                                </a>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="4">No hay materias registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script src='../../public/js/materia.js'></script>
</body>
</html>
