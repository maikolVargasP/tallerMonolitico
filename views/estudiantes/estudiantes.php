<?php
require __DIR__ . '/../../controllers/EstudiantesController.php';
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
    <a href="../home.php">Volver</a>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Programa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($estudiantes as $e) {
                echo '<tr>';
                echo '  <td>' . $e->get('codigo') . '</td>';
                echo '  <td>' . $e->get('nombre') . '</td>';
                echo '  <td>' . $e->get('email') . '</td>';
                echo '  <td>' . $e->get('programa') . '</td>';
                echo '  <td>';
                echo '      <button onclick="onClickBorrar(' . $e->get('codigo') . ')">';
                echo '          <img src="../../public/res/borrar.svg" alt="Borrar" width="30px">';
                echo '      </button>';
                echo '  </td>';
                echo '  <td>';
                echo '      <button>';   
                echo '      <a href="estudiante-form.php?cod=' . $e->get('codigo') . '">';
                echo '          <img src="../../public/res/modificar.svg" alt="modificar" width="30px">';
                echo '      </a>';
                echo '      </button>';
                echo '  </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    
    <script src="../../public/js/estudiante.php"></script>
</body>
</html>
