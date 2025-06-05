<?php
$host = "localhost";
$user = "root";
$pass = "Adm1n1str4d0r";
$db = "loggindb";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>