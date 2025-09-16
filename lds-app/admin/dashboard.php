<?php $title='Dashboard Admin'; require_once __DIR__ . '/../auth/check_auth.php'; if(!is_admin()) redirect('user/dashboard.php'); ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php
$counts = 
  [
    'total' => $mysqli->query("SELECT COUNT(*) c FROM users")->fetch_assoc()['c'],
    'activos' => $mysqli->query("SELECT COUNT(*) c FROM users WHERE estado='Activo'")->fetch_assoc()['c'],
    'inactivos' => $mysqli->query("SELECT COUNT(*) c FROM users WHERE estado='Inactivo'")->fetch_assoc()['c'],
    'admins' => $mysqli->query("SELECT COUNT(*) c FROM users WHERE perfil='admin'")->fetch_assoc()['c'],
  ];
$expQuery = "
  SELECT u.nombre, u.apellido, u.correo, u.documento, 'Certificado' AS tipo, c.descripcion, c.fecha_fin AS vence
  FROM certificados c JOIN users u ON u.id=c.user_id
  UNION ALL
  SELECT u.nombre, u.apellido, u.correo, u.documento, 'Vacuna' AS tipo, v.descripcion, v.fecha_fin AS vence
  FROM vacunas v JOIN users u ON u.id=v.user_id
";
$exp = $mysqli->query($expQuery);
$alerts = [];
$today = new DateTime('today');
while ($row = $exp->fetch_assoc()) 
  {
    $days = days_left($today->format('Y-m-d'), $row['vence']);
    if ($days <= 10) $alerts[] = $row + ['dias'=>$days];
  }
?>
<div class="row g-3">
  <div class="col-md-3"><div class="card card-body"><h6>Total</h6><h3><?php echo $counts['total']; ?></h3></div></div>
  <div class="col-md-3"><div class="card card-body"><h6>Activos</h6><h3><?php echo $counts['activos']; ?></h3></div></div>
  <div class="col-md-3"><div class="card card-body"><h6>Inactivos</h6><h3><?php echo $counts['inactivos']; ?></h3></div></div>
  <div class="col-md-3"><div class="card card-body"><h6>Admins</h6><h3><?php echo $counts['admins']; ?></h3></div></div>
</div>

<div class="card mt-4">
  <div class="card-body">
    <h5 class="card-title">Alertas (≤ 10 días)</h5>
    <div class="table-responsive">
      <table class="table table-sm table-striped">
        <thead><tr><th>Usuario</th><th>Documento</th><th>Tipo</th><th>Descripción</th><th>Vence</th><th>Días</th></tr></thead>
        <tbody>
        <?php foreach ($alerts as $a): ?>
          <tr class="<?php echo $a['dias'] < 0 ? 'table-danger' : 'table-warning'; ?>">
            <td><?php echo h($a['nombre'] . ' ' . $a['apellido']); ?></td>
            <td><span class="badge bg-secondary"><?php echo h($a['documento']); ?></span></td>
            <td><?php echo h($a['tipo']); ?></td>
            <td><?php echo h($a['descripcion']); ?></td>
            <td><?php echo h($a['vence']); ?></td>
            <td><?php echo h($a['dias']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
<?php if (!empty($alerts)): ?>
Swal.fire('Alertas', 'Hay documentos próximos a vencer o vencidos.', 'warning');
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>