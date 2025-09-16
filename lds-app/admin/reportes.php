<?php $title='Reportes'; require_once __DIR__ . '/../auth/check_auth.php'; if(!is_admin()) redirect('../user/dashboard.php'); ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php
$total = $mysqli->query("SELECT COUNT(*) c FROM users")->fetch_assoc()['c'];
$activos = $mysqli->query("SELECT COUNT(*) c FROM users WHERE estado='Activo'")->fetch_assoc()['c'];
$inactivos = $mysqli->query("SELECT COUNT(*) c FROM users WHERE estado='Inactivo'")->fetch_assoc()['c'];
$admins = $mysqli->query("SELECT COUNT(*) c FROM users WHERE perfil='admin'")->fetch_assoc()['c'];

$expQuery = "
  SELECT u.id, u.documento, u.nombre, u.apellido, u.correo, 'Certificado' AS tipo, c.descripcion, c.fecha_fin AS vence
  FROM certificados c JOIN users u ON u.id=c.user_id
  UNION ALL
  SELECT u.id, u.documento, u.nombre, u.apellido, u.correo, 'Vacuna' AS tipo, v.descripcion, v.fecha_fin AS vence
  FROM vacunas v JOIN users u ON u.id=v.user_id
  ORDER BY vence ASC
";
$exp = $mysqli->query($expQuery);
?>
<div class="row">
  <div class="col-md-5">
    <canvas id="pie"></canvas>
  </div>
  <div class="col-md-7">
    <h5>Documentos por vencer</h5>
    <div class="table-responsive" style="max-height:400px;overflow:auto">
      <table class="table table-sm table-striped">
        <thead><tr><th>Usuario</th><th>Documento</th><th>Tipo</th><th>Descripción</th><th>Vence</th><th>Días</th></tr></thead>
        <tbody>
        <?php $today = new DateTime('today'); while($r=$exp->fetch_assoc()): $dias=days_left($today->format('Y-m-d'), $r['vence']); ?>
          <tr class="<?php echo $dias<=10?($dias<0?'table-danger':'table-warning'):''; ?>">
            <td><?php echo h($r['nombre'].' '.$r['apellido']); ?></td>
            <td><?php echo h($r['documento']); ?></td>
            <td><?php echo h($r['tipo']); ?></td>
            <td><?php echo h($r['descripcion']); ?></td>
            <td><?php echo h($r['vence']); ?></td>
            <td><?php echo h($dias); ?></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
new Chart(document.getElementById('pie'), {
  type: 'pie',
  data: {
    labels: ['Total','Activos','Inactivos','Admins'],
    datasets: [{ data: [<?php echo $total; ?>, <?php echo $activos; ?>, <?php echo $inactivos; ?>, <?php echo $admins; ?>] }]
  }
});
</script>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
