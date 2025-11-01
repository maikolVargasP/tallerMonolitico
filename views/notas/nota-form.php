<?php
require __DIR__ . '/../../controllers/NotasController.php';
require __DIR__ . '/../../controllers/EstudiantesController.php';
require __DIR__ . '/../../controllers/MateriasController.php';

use App\Controllers\NotasController;
use App\Controllers\EstudiantesController;
use App\Controllers\MateriasController;

$controller = new NotasController();
$estudiantesCtrl = new EstudiantesController();
$materiasCtrl = new MateriasController();

$estudiantes = $estudiantesCtrl->queryAllEstudiantes();
$materias = $materiasCtrl->queryAllMaterias();

$id = $_GET["id"] ?? null;
$titulo = empty($id) ? "Registrar nota" : "Modificar nota";
$action = empty($id) ? "registrar-nota.php" : "modificar-nota.php";

// Si se está editando, obtener la nota
$nota = null;
if (!empty($id)) {
    $nota = $controller->queryNotaById($id);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>
<body>
    <a href="notas.php"><img src="../../public/res/back.svg" alt="" class="icon"></a>
    <br>
    <div class="form-container">
    <h1><?= $titulo ?></h1>
    

    <form action="<?= $action ?>" method="post">
        <?php if (!empty($id)) : ?>
            <input type="hidden" name="id" value="<?= $id ?>">
        <?php endif; ?>

        <?php if (empty($id)) : ?>
            <div class="form-group">
                <label for="materia">Materia:</label>
                <select name="materia" id="materia" required>
                    <option value="">Seleccione una materia</option>
                    <?php foreach ($materias as $m): ?>
                        <option value="<?= $m->get('codigo') ?>"><?= $m->get('nombre') ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="estudiante">Estudiante:</label>
                <select name="estudiante" id="estudiante" required>
                    <option value="">Seleccione un estudiante</option>
                    <?php foreach ($estudiantes as $e): ?>
                        <option value="<?= $e->get('codigo') ?>"><?= $e->get('nombre') ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="actividad">Actividad:</label>
                <input type="text" name="actividad" id="actividad" required>
            </div>
        <?php else: ?>
            
            <p><strong>Materia:</strong> <?= $nota->get('materia') ?></p>
            <p><strong>Estudiante:</strong> <?= $nota->get('estudiante') ?></p>
            <p><strong>Actividad:</strong> <?= $nota->get('actividad') ?></p>
        <?php endif; ?>

        <div class="form-group">
            <label for="nota">Nota:</label>
            <input type="number" name="nota" id="nota" step="0.01" min="0" max="5"
                value="<?= $nota ? $nota->get('nota') : '' ?>" required>
        </div>

        <button type="submit" class="btn-guardar">Guardar</button>
    </form>
    </div>
</body>
</html>
