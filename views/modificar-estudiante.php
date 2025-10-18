<?php
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$programa = $_POST["programa"];
$codigo = $_POST["codigo"]; 

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

$sql = "update estudiantes set programa=?, nombre=?, email=? where codigo=?";

$prepare = $conexDb->prepare($sql);
$prepare->bind_param("ssss", $programa, $nombre, $email, $codigo);
$result = $prepare->execute();

$conexDb->close();


if ($result) {
    header("Location: ../index.php");
} else {
    echo "Error al guardar";
}


?>