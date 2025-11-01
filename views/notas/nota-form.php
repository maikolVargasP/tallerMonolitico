<?php
$materia = empty($_GET["materia"]) ? "" : $_GET["materia"];
$estudiante = empty($_GET["estudiante"]) ? "" : $_GET["estudiante"];
$actividad = empty($_GET["actividad"]) ? "" : $_GET["actividad"];

$titulo = empty($materia) ? "Registrar nota" : "Modificar nota";
$action = empty($materia) ? "registrar-nota.php" : "modificar-nota.php";

// Conexión para obtener listas
$conexion = new mysqli("localhost", "root", "", "notas_app");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$materias = $conexion->query("SELECT codigo, nombre FROM materias");
$estudiantes = $conexion->query("SELECT codigo, nombre FROM estudiantes");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>
<body>
    <h1><?php echo $titulo; ?></h1>
    <a href="notas.php"><img src="../../public/res/back.svg" class="icon"></a>
    <br><br>

    <form action="<?php echo $action; ?>" method="post">
        <div>
            <label for="materia">Materia:</label>
            <select name="materia" id="materia" required <?php echo !empty($materia) ? 'disabled' : ''; ?>>
                <option value="">Seleccione una materia</option>
                <?php
                if ($materias->num_rows > 0) {
                    while ($fila = $materias->fetch_assoc()) {
                        $sel = ($fila["codigo"] === $materia) ? "selected" : "";
                        echo "<option value='{$fila["codigo"]}' $sel>{$fila["nombre"]}</option>";
                    }
                }
                ?>
            </select>
            <?php if (!empty($materia)) echo "<input type='hidden' name='materia' value='$materia'>"; ?>
        </div>

        <div>
            <label for="estudiante">Estudiante:</label>
            <select name="estudiante" id="estudiante" required <?php echo !empty($estudiante) ? 'disabled' : ''; ?>>
                <option value="">Seleccione un estudiante</option>
                <?php
                if ($estudiantes->num_rows > 0) {
                    while ($fila = $estudiantes->fetch_assoc()) {
                        $sel = ($fila["codigo"] === $estudiante) ? "selected" : "";
                        echo "<option value='{$fila["codigo"]}' $sel>{$fila["nombre"]}</option>";
                    }
                }
                ?>
            </select>
            <?php if (!empty($estudiante)) echo "<input type='hidden' name='estudiante' value='$estudiante'>"; ?>
        </div>

        <div>
            <label for="actividad">Actividad:</label>
            <input type="text" name="actividad" id="actividad" required maxlength="50"
                value="<?php echo $actividad; ?>"
                <?php echo !empty($actividad) ? 'readonly' : ''; ?>>
        </div>

        <div>
            <label for="nota">Nota:</label>
            <input type="number" name="nota" id="nota" step="0.01" min="0" max="5" required>
        </div>

        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>
</html>
