<?php
$cod = empty($_GET["cod"]) ? "" : $_GET["cod"];
$titulo = empty($cod) ? "Crear materia" : "Modificar materia";
$action = empty($cod) ? "registrar-materia.php" : "modificar-materia.php";

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "notas_app");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener los programas
$sql = "SELECT codigo, nombre FROM programas";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de materia</title>
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>

<body>
    <a href="materias.php"><img src="../../public/res/back.svg" class="icon"></a>
    <br>
    <div class="form-container">
    <h1><?php echo $titulo; ?></h1>
    <br>
    <form action="<?php echo $action; ?>" method="post">
    <?php
    if (!empty($cod)) {
        echo '<input type="hidden" name="codigo" value="' . $cod . '">';
    } else {
        echo '<div class="form-group">
                <label for="codigo">Código:</label>
                <input type="text" name="codigo" id="codigo" required>
            </div>';
    }
    ?>
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
    </div>
    <div class="form-group">
        <label for="programa">Programa:</label>
        <select name="programa" id="programa" required>
            <option value="">Seleccione un programa</option>
            <?php
            $conexion = new mysqli("localhost", "root", "", "notas_app");
            $result = $conexion->query("SELECT codigo, nombre FROM programas");
            while ($fila = $result->fetch_assoc()) {
                echo '<option value="' . $fila["codigo"] . '">' . $fila["nombre"] . '</option>';
            }
            ?>
        </select>
    </div>
    <div>
        <button type="submit" class="btn-guardar">Guardar</button>
    </div>
    </form>
    </div>
</body>
</html>
