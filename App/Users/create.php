<?php
require '../BD_Con/db.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura de datos
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $documento = trim($_POST['documento']);
    $correo = trim($_POST['correo']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $edad = $_POST['edad'];
    $rol = $_POST['rol'];
    $state = $_POST['state'];

    // Manejo de imagen
    $foto = null;
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
            $errors[] = "Formato de imagen no permitido. Solo JPG y PNG.";
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO users (nombre, apellido, documento, correo, password, edad, fecha_nacimiento, rol, foto, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$nombre, $apellido, $documento, $correo, $password, $edad, $fecha_nacimiento, $rol, $foto, $state]);
            $success = "Usuario creado correctamente.";
        } catch (PDOException $e) {
            $errors[] = "Error al insertar usuario: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link href="../assets/style/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Crear Nuevo Usuario</div>
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $e): ?>
                                    <li><?= htmlspecialchars($e) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <form method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Apellido</label>
                                <input type="text" name="apellido" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label>Documento</label>
                                <input type="text" name="documento" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Correo</label>
                                <input type="email" name="correo" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label>Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" required>
                            </div>
                            <div class="col">
                                <label>Edad</label>
                                <input type="number" name="edad" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label>Rol</label>
                                <select name="rol" class="form-control">
                                    <option value="usuario">Usuario</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Estado</label>
                                <select name="state" class="form-control">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Foto (JPG o PNG)</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100" onclick="userCreateOK(1)">Crear Usuario</button>
                    </form>
                </div>
            </div>
            <a href="../Back/dashboard_admin.php" class="btn btn-link mt-3">← Volver al Dashboard</a>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../assets/js/users.js"></script>
</body>
</html>