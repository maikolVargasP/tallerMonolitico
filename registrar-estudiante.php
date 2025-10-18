<?php
$nombre = $_POST["nombre"];
$codigo = $_POST["codigo"];
$email = $_POST["correo"];
$programa = $_POST["programa"];

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

$sql = "insert into estudiantes (nombre,telefono,email,codigo)values";
$sql .= "('$nombre', '$programa', '$email', '$codigo')";

$result = $conexDb->query($sql);

$conexDb->close();

if ($result) {
    header("Location: index.php");
} else {
    echo "Error al guardar";
}


?>