    <?php
    require __DIR__ . '/../../controllers/ProgramaController.php';

    use App\Controllers\ProgramaController;

    $controller = new ProgramaController(); 
    $programa = $controller->queryAllProgramas();
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Lista de programas</title>
        <link rel="stylesheet" href="../../public/css/modals.css">
    </head>
    <body> 
        <h1>Lista de programas</h1>
        <a href="../home.php"><img src="../../public/res/menu.svg" alt="" class="icon"></a>
        <a href="programa-form.php">Crear programa</a>
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($programa as $p) {
                    echo '<tr>';
                    echo '  <td>' . $p->get('codigo') . '</td>';
                    echo '  <td>' . $p->get('nombre') . '</td>';
                    echo '  <td>';
                    echo '      <button onclick="onClickBorrar(' . $p->get('codigo') . ')">';
                    echo '          <img src="../../public/res/borrar.svg" alt="Borrar" width="30px">';
                    echo '      </button>';
                    echo '  </td>';
                    echo '  <td>';
                    echo '      <button>';   
                    echo '      <a href="programa-form.php?cod=' . $p->get('codigo') . '">';
                    echo '          <img src="../../public/res/modificar.svg" alt="modificar" width="30px">';
                    echo '      </a>';
                    echo '      </button>';
                    echo '  </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        
        <script src="../../public/js/programa.js"></script>
    </body>
    </html>
