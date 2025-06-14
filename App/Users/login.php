<?php
session_start();
require '../BD_Con/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE correo = ?");
    $stmt->execute([$correo]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) 
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['rol'] = $user['rol'];
            $_SESSION['status'] = $user['status'];
            $_SESSION['nombre'] = $user['nombre'];        

            if ($user['rol'] === 'admin' && $user['state'] === 'activo') 
                {
                    header('Location: ../Back/dashboard_admin.php');
                    /*header('Location: create.php');*/
                } 
            elseif($user['rol'] === 'usuario' && $user['state'] === 'activo') 
                {
                    header('Location: ../Back/dashboard_usuario.php');
                }
            $error = "Su Usuario no se encuentra Activo. Contacte su Administrador";
                /*header('Location: index.php');*/
        } 
        
    else 
        {
            $error = "Correo o contraseña incorrectos.";
        }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="../assets/style/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="card p-4 shadow" style="width: 350px;">
        <h4 class="text-center">Iniciar Sesión</h4>
        <form method="post">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</body>
</html>