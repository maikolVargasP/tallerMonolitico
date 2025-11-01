<?php
require __DIR__ . '/../../controllers/ProgramaController.php';
use App\Controllers\ProgramaController;

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $controller = new ProgramaController();
    $programa = $controller->queryProgramaByCodigo($codigo);

    if ($programa) {
        echo '<tr>';
        echo '<td>' . $programa->get('codigo') . '</td>';
        echo '<td>' . $programa->get('nombre') . '</td>';
        echo '<td>';
        echo '<button onclick="onClickBorrar(' . $programa->get('codigo') . ')"><img src="../../public/res/borrar.svg" class="icon"></button>';
        echo '<a href="programa-form.php?cod=' . $programa->get('codigo') . '"><img src="../../public/res/modificar.svg" class="icon" width="30px"></a>';
        echo '</td>';
        echo '</tr>';
    } else {
        echo '<tr><td colspan="3">No se encontró ningún programa con el código ingresado.</td></tr>';
    }
}
?>
