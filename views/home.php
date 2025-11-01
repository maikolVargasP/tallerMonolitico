<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../public/css/modals.css">
</head>

<body class="home2">
    <section class="container">
        <header>
            <h1>MENU PRINCIPAL</h1>
            <img src="../public/res/logoperfil-removebg-preview.png" alt="Logo" class="logo" id="openModal" title="Información de la aplicación" >
        </header>

        <!-- ====== MINI VENTANA (MODAL) ====== -->
        <div id="infoModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2><strong>Información de la aplicación</strong></h2>
                <p>Esta aplicación monolítica permite gestionar la información académica de una institución educativa. A través de sus módulos, se pueden registrar, consultar, modificar y eliminar programas, materias, estudiantes y notas. Además, controla las relaciones entre estos datos para asegurar la coherencia del sistema, como evitar eliminar registros con dependencias o calcular automáticamente el promedio de notas de cada estudiante.</p>
                
            </div>
        </div>

        <nav class="home">
            <a href="estudiantes/estudiantes.php" class="btn">Estudiantes</a>
            <a href="notas/notas.php" class="btn">Notas</a>
            <a href="materias/materias.php" class="btn">Materias</a>
            <a href="programas/programas.php" class="btn">Programas</a>
        </nav>
    </section>
    <script src="../public/js/home.js"></script>

</body>
</html>
