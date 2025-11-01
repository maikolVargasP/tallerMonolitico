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
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>

<body>
    <h1><?php echo $titulo; ?></h1>
    <br>
    <a href="estudiantes.php"><img src="../../public/res/back.svg" class="icon"></a>
    <br>
    <div class="form-container">
    <form action="<?php echo $action; ?>" method="post" class="form-group">
            <?php
        if (!empty($cod)) {
            echo '<input type="hidden" name="codigo" value="' . $cod . '">';
        } else {
            echo '<div class="form-group">
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" id="codigo" required placeholder="Maximo 5 caracteres">
                </div>';
        }
        ?>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="form-group">
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
            <button type="submit" class="btn-guardar">Guardar</button>
          </div>
         </form>
    </div>
</body>

</html>