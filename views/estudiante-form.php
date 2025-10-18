<?php
$cod = empty($_GET["cod"]) ? "" : $_GET["cod"];
$titulo = empty($cod) ? "Crear estudiante" : "Modificar estudiante";
$action = empty($cod) ? "registrar-estudiante.php" : "modificar-estudiante.php";
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
    <title>estudiante formulario</title>
</head>

<body>
    <h1><?php echo $titulo; ?></h1>
    <br>
    <a href="../index.php">Volver</a>
    <br>
    <form action="<?php echo $action; ?>" method="post">
        <?php
        if (!empty($cod)) {
            echo '<input type="hidden" name="id" value="' . $cod . '">';
        }
        ?>
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="nombre" id="name">
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" name="correo" id="email">
        </div>
        <div>
            <label for="programa">Programa:</label>
            <select name="programa" id="programa" required>
                <option value="">Seleccione un programa</option>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<option value="' . $fila["codigo"] . '">' . $fila["nombre"] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>

</html>