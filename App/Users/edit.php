<?php
require '../BD_Con/db.php';
session_start();

// Solo admins
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../Back/dashboard_admin.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Usuario no encontrado";
    exit;
}

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $documento = trim($_POST['documento']);
    $correo = trim($_POST['correo']);
    $edad = $_POST['edad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $rol = $_POST['rol'];
    $state = $_POST['estado'];

    // Imagen
    $foto = $user['foto'];
    if (!empty($_FILES['foto']['name'])) {
        $permitidos = ['image/jpeg', 'image/png'];
        if (in_array($_FILES['foto']['type'], $permitidos)) {
            $nombre_foto = uniqid() . '_' . basename($_FILES['foto']['name']);
            $ruta_foto = '../uploads/' . $nombre_foto;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_foto)) {
                $foto = $nombre_foto;
            } else {
                $errors[] = "Error al subir la imagen.";
            }
        } else {
            $errors[] = "Formato no permitido (solo JPG/PNG).";
        }
    }

    if (empty($errors)) {
        $sql = "UPDATE users SET nombre=?, apellido=?, documento=?, correo=?, edad=?, fecha_nacimiento=?, rol=?, state=?, foto=?, updated_at=NOW() WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $apellido, $documento, $correo, $edad, $fecha_nacimiento, $rol, $state, $foto, $id]);
        $success = "Usuario actualizado correctamente.";
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="../assets/style/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h3>Editar Usuario</h3>
    <a href="../Back/dashboard_admin.php" class="btn btn-link mb-3">← Volver</a>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <?php if ($errors): ?>
        <div class="alert alert-danger"><ul><?php foreach ($errors as $e) echo "<li>$e</li>"; ?></ul></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col">
                <label>Nombre</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" class="form-control" required>
            </div>
            <div class="col">
                <label>Apellido</label>
                <input type="text" name="apellido" value="<?= htmlspecialchars($user['apellido']) ?>" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Documento</label>
                <input type="text" name="documento" value="<?= htmlspecialchars($user['documento']) ?>" class="form-control" required>
            </div>
            <div class="col">
                <label>Correo</label>
                <input type="email" name="correo" value="<?= htmlspecialchars($user['correo']) ?>" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Edad</label>
                <input type="number" name="edad" value="<?= htmlspecialchars($user['edad']) ?>" class="form-control" required>
            </div>
            <div class="col">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($user['fecha_nacimiento']) ?>" class="form-control" required>
            </div>
            <div class="col">
                <label>Rol</label>
                <select name="rol" class="form-control">
                    <option value="usuario" <?= $user['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                    <option value="admin" <?= $user['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="col">
                <label>Estado</label>
                <select name="estado" class="form-control">
                    <option value="activo" <?= $user['rol'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                    <option value="inactivo" <?= $user['rol'] === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Foto Actual</label><br>
            <?php if ($user['foto']): ?>
                <img src="../uploads/<?= $user['foto'] ?>" width="100" class="rounded">
            <?php else: ?>
                <span>No tiene</span>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label>Cambiar Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../assets/js/users.js"></script>
</body>
</html>