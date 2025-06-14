<?php
require '../BD_Con/db.php';
session_start();

$errors = [];
$success = '';

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') 
    {
        header("Location: ../index.php");
        exit;
    }

$id = $_GET['id'] ?? null;

if ($id && is_numeric($id)) 
    {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $success = "Seguro deseas Eliminar este Usuario?";
        $stmt->execute([$id]);
    }
else
    {

    }

header("Location: ../Back/dashboard_admin.php");
exit;