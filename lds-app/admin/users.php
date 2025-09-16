<?php $title='Usuarios'; require_once __DIR__ . '/../auth/check_auth.php'; if(!is_admin()) redirect('../user/users.php'); ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <form class="d-flex" method="get">
    <input class="form-control me-2" type="search" name="q" placeholder="Buscar por nombre, documento o correo" value="<?php echo h($_GET['q'] ?? ''); ?>">
    <button class="btn btn-outline-primary">Buscar</button>
  </form>
  <div class="btn-group">
    <a class="btn btn-success" href="/admin/user_form.php">+ Crear Usuario</a>
    <a class="btn btn-outline-secondary" href="/export/export_excel.php">Exportar Excel</a>
    <a class="btn btn-outline-secondary" href="/export/export_pdf.php">Exportar PDF</a>
  </div>
</div>
<?php
$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM users";
$params = [];
if ($q !== '') {
  $sql .= " WHERE nombre LIKE CONCAT('%',?,'%') OR apellido LIKE CONCAT('%',?,'%') OR documento LIKE CONCAT('%',?,'%') OR correo LIKE CONCAT('%',?,'%')";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('ssss', $q,$q,$q,$q);
  $stmt->execute();
  $res = $stmt->get_result();
} else {
  $res = $mysqli->query($sql . " ORDER BY created_at DESC");
}
?>
<div class="table-responsive">
<table class="table table-striped table-hover align-middle">
  <thead><tr>
    <th>Foto</th><th>Documento</th><th>Nombre</th><th>Correo</th><th>Perfil</th><th>Estado</th><th>Creado</th><th>Actualizado</th><th>Acciones</th>
  </tr></thead>
  <tbody>
  <?php while($u = $res->fetch_assoc()): ?>
    <tr>
      <td><?php if($u['foto']): ?><img src="<?php echo '/Uploads/images/' . h($u['foto']); ?>" style="width:40px;height:40px;object-fit:cover;border-radius:50%"><?php endif; ?></td>
      <td><?php echo h($u['documento']); ?></td>
      <td><?php echo h($u['nombre'] . ' ' . $u['apellido']); ?></td>
      <td><?php echo h($u['correo']); ?></td>
      <td><span class="badge bg-info"><?php echo h($u['perfil']); ?></span></td>
      <td><span class="badge <?php echo $u['estado']=='Activo'?'bg-success':'bg-secondary'; ?>"><?php echo h($u['estado']); ?></span></td>
      <td><?php echo h($u['created_at']); ?></td>
      <td><?php echo h($u['updated_at']); ?></td>
      <td>
        <a class="btn btn-sm btn-primary" href="/admin/user_form.php?id=<?php echo $u['id']; ?>">Editar</a>
        <a class="btn btn-sm btn-danger" href="/admin/user_delete.php?id=<?php echo $u['id']; ?>" onclick="return confirm('¿Eliminar usuario?')">Eliminar</a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
</div>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>