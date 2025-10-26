<?php
// Captura de datos del formulario
$codigo = $_POST["codigo"];
$nombre = $_POST["nombre"];
$email = $_POST["correo"];
$programa = $_POST["programa"];

// Conexión a la base de datos
$hostDb = "localhost";
$userDb = "root";
$pwdDb = "";
$nameDb = "notas_app";

$conexDb = new mysqli(
    $hostDb,
    $userDb,
    $pwdDb,
    $nameDb
);

if ($conexDb->connect_error) {
    die("DB error: " . $conexDb->connect_error);
}

// Sentencia SQL corregida
$sql = "INSERT INTO estudiantes (codigo, nombre, email, programa)
        VALUES (?, ?, ?, ?)";

// Usar prepared statement para mayor seguridad
$prepare = $conexDb->prepare($sql);
$prepare->bind_param("ssss", $codigo, $nombre, $email, $programa);
$result = $prepare->execute();

$conexDb->close();

if ($result) {
    header("Location: estudiantes.php");
    exit;
} else {
    echo "Error al guardar el estudiante.";
}
?>
