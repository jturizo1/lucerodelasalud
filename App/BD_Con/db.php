<?php
$host = 'localhost';
$db = 'appbd_lds';
$user = 'root';
$pass = 'Adm1n1str4d0r';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Error de Conexión a la Base de Datos: " . $e->getMessage());
}
?>