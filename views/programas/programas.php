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
        <header>
        <nav class="navbar">
            <ul>
                <li class="title"><h1>Sistema Programa</h1></li>
                <li class="search-item">
                    <div class="search-box" >
                        <label for="buscarCodigo"></label>
                        <input type="text" id="buscarCodigo" placeholder="Ingresar código del programa">
                        <button type="button" id="botonBuscarPrograma">
                            <img src="../../public/res/busqueda.svg" class="icon">
                        </button>
                    </div>
                </li>
                <li><a href="../estudiantes/estudiantes.php">Estudiantes</a></li>
                <li><a href="../materias/materias.php">Materias</a></li>
                <li><a href="../notas/notas.php">Notas</a></li>
            </ul>
            </nav>
        </header>
        <a href="../home.php"><img src="../../public/res/home.svg" alt="" class="icon"></a>
        <a href="programa-form.php"><img src="../../public/res/create.svg" class="icon"></a>
        

        <div class="tabla-container">
        <table id="tablaProgramas" border="1" cellpadding="5" class="programa-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Accion</th>
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
        </div>
        
        <script src="../../public/js/programa.js"></script>
    </body>
    </html>
