<?php
require __DIR__ . '/../../controllers/MateriasController.php';
use App\Controllers\MateriasController;

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $controller = new MateriasController();
    $materia = $controller->queryMateriaByCodigo($codigo);

    if ($materia) {
        echo '<tr>';
        echo '<td>' . $materia->get('codigo') . '</td>';
        echo '<td>' . $materia->get('nombre') . '</td>';
        echo '<td>' . $materia->get('programa') . '</td>';
        echo '<td>';
        echo '  <button onclick="onClickBorrar(' . $materia->get('codigo') . ')"><img src="../../public/res/borrar.svg" class="icon"></button>';
        echo '  <a href="materia-form.php?cod=' . $materia->get('codigo') . '"><img src="../../public/res/modificar.svg" class="icon" width="30px"></a>';
        echo '</td>';
        echo '</tr>';
    } else {
        echo '<tr><td colspan="4">No se encontró ninguna materia con el código ingresado.</td></tr>';
    }
}
?>
