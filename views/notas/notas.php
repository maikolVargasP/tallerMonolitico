<?php
require __DIR__ . '/../../controllers/NotasController.php';
use App\Controllers\NotasController;

$controller = new NotasController();
$notas = $controller->queryAllNotas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de notas</title>
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>
<body>
    <h1>Lista de notas</h1>
    <a href="../home.php"><img src="../../public/res/back.svg" class="icon" alt=""></a>
    <a href="nota-form.php"><img src="../../public/res/create.svg" class="icon"></a>
    <br><br>
    <div class="tabla-container">
    <table border="1" cellpadding="5" class="programa-table">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Estudiante</th>
                <th>Actividad</th>
                <th>Nota</th>
                <th>Promedio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($notas)) {
                foreach ($notas as $n) {
                    $promedio = $controller->getPromedio($n->get('materia'), $n->get('estudiante'));

                    echo '<tr>';
                    echo '  <td>' . $n->get('materia') . '</td>';
                    echo '  <td>' . $n->get('estudiante') . '</td>';
                    echo '  <td>' . $n->get('actividad') . '</td>';
                    echo '  <td>' . $n->get('nota') . '</td>';
                    echo '  <td>' . number_format($promedio, 2) . '</td>';
                    echo '  <td>';
                    echo '      <button onclick="onClickBorrar(\'' . $n->get('materia') . '\', \'' . $n->get('estudiante') . '\', \'' . $n->get('actividad') . '\')">';
                    echo '          <img src="../../public/res/borrar.svg" alt="Borrar" width="30px">';
                    echo '      </button>';
                    echo '      <a href="nota-form.php?materia=' . $n->get('materia') . '&estudiante=' . $n->get('estudiante') . '&actividad=' . urlencode($n->get('actividad')) . '">';
                    echo '          <img src="../../public/res/modificar.svg" alt="Modificar" width="30px">';
                    echo '      </a>';
                    echo '  </td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">No hay notas registradas.</td></tr>';
            }
            ?>
        </tbody>
        </table>
    </div>

    <script src="../../public/js/nota.js"></script>
</body>
</html>
