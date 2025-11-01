<?php
require __DIR__ . '/../../controllers/NotasController.php';
use App\Controllers\NotasController;

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $controller = new NotasController();
    $notas = $controller->queryNotasByEstudiante($codigo);

    if (!empty($notas)) {
        $total = 0;
        $count = 0;

        foreach ($notas as $n) {
            $total += $n->get('nota');
            $count++;
        }

        $promedioGeneral = $count > 0 ? round($total / $count, 2) : 0;

        
        foreach ($notas as $n) {
            echo "<tr>";
            echo "<td>" . $n->get('id') . "</td>";
            echo "<td>" . $n->get('materia') . "</td>";
            echo "<td>" . $n->get('estudiante') . "</td>";
            echo "<td>" . $n->get('actividad') . "</td>";
            echo "<td>" . $n->get('nota') . "</td>";
            echo "<td>";
            echo "<button onclick=\"onClickBorrar(" . $n->get('id') . ")\">";
            echo "<img src='../../public/res/borrar.svg' alt='Borrar' width='30px'>";
            echo "</button>";
            echo "<a href='nota-form.php?id=" . $n->get('id') . "'>";
            echo "<img src='../../public/res/modificar.svg' alt='Editar' width='30px'>";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo '<tr><td colspan="6" style="text-align:center;font-weight:bold;">Promedio del Estudiante: ' . $promedioGeneral . '</td></tr>';
    } else {
        echo "<tr><td colspan='6'>No se encontraron notas para el estudiante con código " . $codigo . "</td></tr>";
    }
}
?>
