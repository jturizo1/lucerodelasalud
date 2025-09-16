<?php $title='Dashboard Usuario'; require_once __DIR__ . '/../auth/check_auth.php'; if(is_admin()) redirect('../admin/dashboard.php'); ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php
$expQuery = "
  SELECT u.nombre, u.apellido, u.documento, 'Certificado' AS tipo, c.descripcion, c.fecha_fin AS vence
  FROM certificados c JOIN users u ON u.id=c.user_id
  UNION ALL
  SELECT u.nombre, u.apellido, u.documento, 'Vacuna' AS tipo, v.descripcion, v.fecha_fin AS vence
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
<h4>Alertas (≤ 10 días)</h4>
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
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
