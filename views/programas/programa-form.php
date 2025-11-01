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
    <link rel="stylesheet" href="../../public/css/modals.css">
</head>

<body>
    <a href="programas.php"><img src="../../public/res/back.svg" class="icon"></a>
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
                    <input type="text" name="codigo" id="codigo" required placeholder="Maximo 4 caracteres">
                </div>';
        }
        ?>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
            <br>
        <div >
            <button type="submit" class="btn-guardar">Guardar</button>
        </div>
    </form>
    </div>
</body>

</html>