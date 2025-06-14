<?php
session_start();
require 'db.php';

// Verifica si el usuario está autenticado y es "usuario"
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'usuario') 
    {
        header("Location: login.php");
        exit;
    }

// Paginación
$por_pagina = 5;
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$offset = ($pagina - 1) * $por_pagina;

// Total de usuarios para calcular páginas
$total = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_paginas = ceil($total / $por_pagina);

// Consulta ordenada por nombre, documento, edad
$stmt = $pdo->prepare("SELECT nombre, apellido, documento, edad, fecha_nacimiento FROM users ORDER BY nombre ASC, documento ASC, edad ASC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $por_pagina, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Usuario</title>
    <link href="assets/style/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?></h3>
        <a href="cambiar_password.php" class="btn btn-outline-secondary">Cambiar Contraseña</a>
        <a href="logout.php" class="btn btn-outline-danger">Cerrar Sesión</a>
    </div>

    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            Lista de Usuarios
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0 table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Edad</th>
                        <th>Fecha de Nacimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['nombre']) ?></td>
                            <td><?= htmlspecialchars($user['apellido']) ?></td>
                            <td><?= htmlspecialchars($user['documento']) ?></td>
                            <td><?= htmlspecialchars($user['edad']) ?></td>
                            <td><?= htmlspecialchars($user['fecha_nacimiento']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación -->
    <nav class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                    <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/assets/js/users.js"></script>
</body>
</html>