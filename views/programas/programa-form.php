<?php
$cod = empty($_GET["cod"]) ? "" : $_GET["cod"];
$titulo = empty($cod) ? "Crear programa" : "Modificar programa";
$action = empty($cod) ? "registrar-programa.php" : "modificar-programa.php";

$conexion = new mysqli("localhost", "root", "", "notas_app");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


$sql = "SELECT codigo, nombre FROM programas";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Programas</title>
</head>

<body>
    <h1><?php echo $titulo; ?></h1>
    <br>
    <a href="../../index.php">Volver</a>
    <br>
    <form action="<?php echo $action; ?>" method="post">
            <?php
        if (!empty($cod)) {
            echo '<input type="hidden" name="codigo" value="' . $cod . '">';
        } else {
            echo '<div>
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" id="codigo" required>
                </div>';
        }
        ?>
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="nombre" id="name">
        </div>
        
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