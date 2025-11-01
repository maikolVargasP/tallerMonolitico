<?php
require __DIR__ . '/../../controllers/MateriasController.php';
use App\Controllers\MateriasController;

// Crear instancia del controlador
$controller = new MateriasController();
$materias = $controller->queryAllMaterias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de materias</title>
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>
<body>
        <header>
        <nav class="navbar">
            <ul>
                <li class="title"><h1>Sistema Materias</h1></li>
                <li class="search-item">
                    <div class="search-box" >
                        <label for="buscarCodigo"></label>
                        <input type="text" id="buscarCodigo" placeholder="Buscar código de materia">
                        <button type="button" id="botonBuscarMateria">
                            <img src="../../public/res/busqueda.svg" class="icon">
                        </button>
                    </div>
                </li>
                <li><a href="../estudiantes/estudiantes.php">Estudiantes</a></li>
                <li><a href="../programas/programas.php">Programas</a></li>
                <li><a href="../notas/notas.php">Notas</a></li>
            </ul>
            </nav>
        </header>

    <a href="../home.php"><img src="../../public/res/home.svg" class="icon"></a>
    <a href="materia-form.php"><img src="../../public/res/create.svg" class="icon"></a>
    
    <div class="search-box" style="margin-top: 20px;">
        
    </div>
    <div class="tabla-container">
    <table id="tablaMaterias" border="1" cellpadding="5" class="programa-table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Programa</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($materias as $m) {
                echo '<tr>';
                echo '  <td>' . $m->get('codigo') . '</td>';
                echo '  <td>' . $m->get('nombre') . '</td>';
                echo '  <td>' . $m->get('programa') . '</td>';
                echo '  <td>';
                echo '      <button onclick="onClickBorrar(' . $m->get('codigo') . ')">';
                echo '          <img src="../../public/res/borrar.svg" alt="Borrar" width="30px">';
                echo '      </button>';
                echo '      <button>';   
                echo '      <a href="materia-form.php?cod=' . $m->get('codigo') . '">';
                echo '          <img src="../../public/res/modificar.svg" alt="modificar" width="30px">';
                echo '      </a>';
                echo '      </button>';
                echo '  </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    </div>

    <script src='../../public/js/materia.js'></script>
</body>
</html>
