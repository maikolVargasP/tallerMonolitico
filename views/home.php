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
            <img src="../public/res/logoperfil-removebg-preview.png" alt="Logo" class="logo" id="openModal">
        </header>

        <!-- ====== MINI VENTANA (MODAL) ====== -->
        <div id="infoModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Información del Usuario</h2>
                <p><strong>Nombre:</strong> Juan Pérez</p>
                <p><strong>Rol:</strong> Administrador</p>
                <p><strong>Último acceso:</strong> 30/10/2025</p>
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
