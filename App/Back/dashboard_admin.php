<?php
session_start();
require '../BD_Con/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') 
    {        
        header("Location: ../index.php");
        exit;
    }

// Búsqueda
$busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

// Paginación
$por_pagina = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $por_pagina;

// Conteo total con búsqueda
$condicion = '';
$params = [];

if ($busqueda) 
    {
        $condicion = "WHERE nombre LIKE ? OR documento LIKE ? OR correo LIKE ?";
        $params = ["%$busqueda%", "%$busqueda%", "%$busqueda%"];
    }

$total_stmt = $pdo->prepare("SELECT COUNT(*) FROM users $condicion");
$total_stmt->execute($params);
$total = $total_stmt->fetchColumn();
$total_paginas = ceil($total / $por_pagina);

// Consulta paginada
/*$sql = "SELECT * FROM users $condicion ORDER BY nombre ASC LIMIT ? OFFSET ?";
$params[] = $por_pagina;
$params[] = $offset;
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$usuarios = $stmt->fetchAll();*/

$stmt = $pdo->prepare("SELECT * FROM users ORDER BY nombre ASC LIMIT ? OFFSET ?");
$stmt->bindValue(1, $por_pagina, PDO::PARAM_INT);
$stmt->bindValue(2, $offset, PDO::PARAM_INT);
$stmt->execute();
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="../assets/style/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?></h3>
        <div>
            <a href="../Users/cambiar_password.php" class="btn btn-outline-secondary">Cambiar Contraseña</a>
            <a href="../Users/create.php" class="btn btn-success">Crear Usuario</a>
            <a href="../Users/logout.php" class="btn btn-outline-danger">Cerrar Sesión</a>
        </div>
    </div>

    <!-- Buscador -->
    <form method="get" class="input-group mb-4">
        <input type="text" name="buscar" value="<?= htmlspecialchars($busqueda) ?>" class="form-control" placeholder="Buscar por nombre, documento o correo">
        <button class="btn btn-primary">Buscar</button>
    </form>

    <!-- Exportar -->
    <div class="mb-3">
        <a href="export_excel.php" class="btn btn-outline-success">Exportar a Excel</a>
        <a href="export_pdf.php" class="btn btn-outline-danger">Exportar a PDF</a>
    </div>

    <!-- Tabla de usuarios -->
    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-striped table-hover table-responsive mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Correo</th>
                        <th>Edad</th>
                        <th>Fecha Nacimiento</th>
                        <th>Rol</th>
                        <th>F. Creación</th>
                        <th>F. Actualización</th>
                        <th>Estado</th>
                        <th>Acciones</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td>
                                <?php if ($u['foto']): ?>
                                    <img src="uploads/<?= htmlspecialchars($u['foto']) ?>" width="40" height="40" style="object-fit:cover; border-radius:50%;">
                                <?php else: ?>
                                    <span class="text-muted">Sin Foto</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($u['nombre']) ?></td>
                            <td><?= htmlspecialchars($u['apellido']) ?></td>
                            <td><?= htmlspecialchars($u['documento']) ?></td>
                            <td><?= htmlspecialchars($u['correo']) ?></td>
                            <td><?= htmlspecialchars($u['edad']) ?></td>
                            <td><?= htmlspecialchars($u['fecha_nacimiento']) ?></td>
                            <td><?= htmlspecialchars($u['rol']) ?></td>
                            <td><?= htmlspecialchars($u['created_at']) ?></td>
                            <td><?= htmlspecialchars($u['updated_at']) ?></td>
                            <td><?= htmlspecialchars($u['state']) ?></td>
                            <td>
                                <a href="../Users/edit.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="../Users/delete.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="userDeleteOK(1)">Eliminar</a>
                            </td>
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
                    <a class="page-link" href="?pagina=<?= $i ?>&buscar=<?= urlencode($busqueda) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<script src="../assets/js/sweetalert.min.js"></script>
<script src="../assets/js/users.js"></script>
</body>
</html>