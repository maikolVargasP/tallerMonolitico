<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require __DIR__ . '/../../controllers/EstudiantesController.php';
use App\Controllers\EstudiantesController;

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $controller = new EstudiantesController();
    $estudiante = $controller->queryEstudianteByCodigo($codigo);

    if ($estudiante) {
        echo '<tr>';
        echo '<td>' . $estudiante->get('codigo') . '</td>';
        echo '<td>' . $estudiante->get('nombre') . '</td>';
        echo '<td>' . $estudiante->get('email') . '</td>';
        echo '<td>' . $estudiante->get('programa') . '</td>';
        echo '<td>';
        echo '<button onclick="onClickBorrar(' . $estudiante->get('codigo') . ')"><img src="../../public/res/borrar.svg" class="icon"></button>';
        echo '<a href="estudiante-form.php?cod=' . $estudiante->get('codigo') . '"><img src="../../public/res/modificar.svg" class="icon"></a>';
        echo '</td>';
        echo '</tr>';
    } else {
        echo '<tr><td colspan="5">No se encontró ningún estudiante con el código ingresado.</td></tr>';
    }
}
?>
