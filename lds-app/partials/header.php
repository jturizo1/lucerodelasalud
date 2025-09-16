<?php require_once __DIR__ . '/../config.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo h($title ?? 'Sistema'); ?></title>
  <link rel="icon" type="image/png" href="../assets/images/favicon.ico"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">LUCEROS DE LA SALUD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
        <?php if (is_admin()): ?>
          <li class="nav-item"><a class="nav-link" href="../admin/dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="../admin/users.php">Usuarios</a></li>
          <li class="nav-item"><a class="nav-link" href="../admin/reportes.php">Reportes</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="../user/dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="../user/users.php">Usuarios</a></li>
        <?php endif; ?>
      </ul>
      <div class="d-flex align-items-center">
        <span class="me-3"><?php echo h($_SESSION['user']['nombre'] ?? ''); ?></span>
        <a class="btn btn-outline-danger btn-sm" href="../auth/logout.php">Salir</a>
      </div>
    </div>
  </div>
</nav>
<div class="container my-4">