<?php
require '../BD_Con/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_SESSION['user_id'];
$mensaje = '';
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $actual = $_POST['password_actual'];
    $nueva = $_POST['nueva_password'];
    $confirmar = $_POST['confirmar_password'];

    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (!password_verify($actual, $user['password'])) {
        $errores[] = "La contraseña actual no es correcta.";
    } elseif ($nueva !== $confirmar) {
        $errores[] = "Las nuevas contraseñas no coinciden.";
    } else {
        $nuevo_hash = password_hash($nueva, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->execute([$nuevo_hash, $id]);
        $mensaje = "Contraseña actualizada correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <link href="../assets/style/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h3>Cambiar Contraseña</h3>
    <a href="<?= $_SESSION['rol'] === 'admin' ? '../Back/dashboard_admin.php' : '../Back/dashboard_usuario.php' ?>" class="btn btn-link mb-3">← Volver</a>

    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?= $mensaje ?></div>
    <?php endif; ?>
    <?php if ($errores): ?>
        <div class="alert alert-danger"><ul><?php foreach ($errores as $e) echo "<li>$e</li>"; ?></ul></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label>Contraseña Actual</label>
            <input type="password" name="password_actual" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nueva Contraseña</label>
            <input type="password" name="nueva_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Confirmar Nueva Contraseña</label>
            <input type="password" name="confirmar_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cambiar</button>
    </form>
</div>
</body>
</html>