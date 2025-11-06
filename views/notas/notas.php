<?php
require __DIR__ . '/../../controllers/NotasController.php';

use App\Controllers\NotasController;

$controller = new NotasController();
$notas = $controller->queryAllNotas();

// Manejar eliminación vía POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $resultado = $controller->deleteNota($id);

    echo $resultado ? "ok" : "error";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Notas</title>
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <ul>
                <li class="title"><h1>Sistema notas</h1></li>
                <li class="search-item">
                    <div class="search-box">
                        <label for="buscarCodigo"></label>
                        <input type="text" id="buscarCodigo" placeholder="Ingrese el codigo del estudiante a revisar sus notas">
                        <button type="button" onclick="buscarNotas()">
                            <img src="../../public/res/busqueda.svg" class="icon" >
                        </button>
                    </div>

                </li>
                <li><a href="../estudiantes/estudiantes.php">Estudiantes</a></li>
                <li><a href="../programas/programas.php">Programas</a></li>
                <li><a href="../notas/notas.php">Notas</a></li>
            </ul>
            </nav>
        </header>
    
        <a href="../home.php"><img src="../../public/res/home.svg" alt="" class="icon"></a>
        <a href="nota-form.php"><img src="../../public/res/create.svg" class="icon"></a>

    <div class="tabla-container">
    <table id="tablaNotas" border="1" cellpadding="5" class="programa-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Materia</th>
                <th>Estudiante</th>
                <th>Actividad</th>
                <th>Nota</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($notas)) : ?>
                <?php foreach ($notas as $n) : ?>
                    <tr>
                        <td><?= $n->get('id') ?></td>
                        <td><?= $n->get('materia') ?></td>
                        <td><?= $n->get('estudiante') ?></td>
                        <td><?= $n->get('actividad') ?></td>
                        <td><?= $n->get('nota') ?></td>
                        <td>
                            <button onclick="onClickBorrar(<?= $n->get('id') ?>)">
                                <img src='../../public/res/borrar.svg' width='30px'>
                            </button>
                            <a href="nota-form.php?id=<?= $n->get('id') ?>">
                                <img src='../../public/res/modificar.svg' width='30px'>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="6">No hay notas registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>

    <script src="../../public/js/nota.js"></script>
</body>
</html>
