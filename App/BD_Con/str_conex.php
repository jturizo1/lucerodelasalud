<?php
$host = "localhost";
$user = "root";
$pass = "Adm1n1str4d0r";
$db = "loggindb";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error al Conectar la Base de Datos: " . mysqli_connect_error());
}
?>