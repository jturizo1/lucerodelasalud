<?php $title='Usuario'; require_once __DIR__ . '/../auth/check_auth.php'; if(!is_admin()) redirect('../user/users.php'); ?>
<?php require_once __DIR__ . '/../partials/header.php'; ?>
<?php
$editing = isset($_GET['id']);
$user = null;
$certs = []; $vaxs = [];
if ($editing) {
  $id = (int)$_GET['id'];
  $user = $mysqli->query("SELECT * FROM users WHERE id={$id}")->fetch_assoc();
  if (!$user) { echo "<div class='alert alert-danger'>Usuario no encontrado</div>"; require_once __DIR__ . '/../partials/footer.php'; exit; }
  $certs = $mysqli->query("SELECT * FROM certificados WHERE user_id={$id}")->fetch_all(MYSQLI_ASSOC);
  $vaxs  = $mysqli->query("SELECT * FROM vacunas WHERE user_id={$id}")->fetch_all(MYSQLI_ASSOC);
}
?>
<form id="userForm" class="needs-validation" novalidate method="post" action="/admin/user_save.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo h($user['id'] ?? ''); ?>">
<ul class="nav nav-tabs" id="tabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">Datos Personales</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">Certificados</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab">Vacunas</button>
  </li>
</ul>
<div class="tab-content border p-3 border-top-0">
  <div class="tab-pane fade show active" id="tab1" role="tabpanel">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Foto (PNG/JPG ≤ 2MB)</label>
        <input class="form-control" type="file" name="foto" accept=".png,.jpg,.jpeg">
        <?php if(!empty($user['foto'])): ?>
          <img class="mt-2" src="<?php echo '/Uploads/images/' . h($user['foto']); ?>" style="width:100px;height:100px;object-fit:cover;border-radius:12px">
        <?php endif; ?>
      </div>
      <div class="col-md-4">
        <label class="form-label">Documento</label>
        <input class="form-control" type="text" name="documento" value="<?php echo h($user['documento'] ?? ''); ?>" <?php echo $editing?'readonly':''; ?> required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Correo</label>
        <input class="form-control" type="email" name="correo" value="<?php echo h($user['correo'] ?? ''); ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Nombre</label>
        <input class="form-control" type="text" name="nombre" value="<?php echo h($user['nombre'] ?? ''); ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Apellido</label>
        <input class="form-control" type="text" name="apellido" value="<?php echo h($user['apellido'] ?? ''); ?>" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Password <?php echo $editing?'(dejar vacío para no cambiar)':''; ?></label>
        <input class="form-control" type="password" name="password" <?php echo $editing?'':'required'; ?>>
      </div>
      <div class="col-md-4">
        <label class="form-label">Perfil</label>
        <select class="form-select" name="perfil" required>
          <option value="admin" <?php echo ($user['perfil']??'')==='admin'?'selected':''; ?>>Admin</option>
          <option value="usuario" <?php echo ($user['perfil']??'')==='usuario'?'selected':''; ?>>Usuario</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Estado</label>
        <select class="form-select" name="estado" required>
          <option <?php echo ($user['estado']??'')==='Activo'?'selected':''; ?>>Activo</option>
          <option <?php echo ($user['estado']??'')==='Inactivo'?'selected':''; ?>>Inactivo</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Fecha Nacimiento</label>
        <input class="form-control" type="date" name="fecha_nacimiento" value="<?php echo h($user['fecha_nacimiento'] ?? ''); ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">Edad</label>
        <input class="form-control" type="number" name="edad" value="<?php echo h($user['edad'] ?? ''); ?>" readonly>
      </div>
      <div class="col-md-4">
        <label class="form-label">Fechas</label>
        <input class="form-control mb-2" type="text" value="Creado: <?php echo h($user['created_at'] ?? ''); ?>" readonly>
        <input class="form-control" type="text" value="Actualizado: <?php echo h($user['updated_at'] ?? ''); ?>" readonly>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="tab2" role="tabpanel">
    <div id="certRows"></div>
    <button type="button" class="btn btn-outline-primary mt-2" onclick="addRow('cert')">+ Agregar Certificado</button>
  </div>
  <div class="tab-pane fade" id="tab3" role="tabpanel">
    <div id="vaxRows"></div>
    <button type="button" class="btn btn-outline-primary mt-2" onclick="addRow('vax')">+ Agregar Vacuna</button>
  </div>
</div>

<div class="d-flex justify-content-between align-items-center mt-3">
  <div>
    <button type="button" class="btn btn-secondary" onclick="prevTab()">◀ Anterior</button>
    <button type="button" class="btn btn-secondary" onclick="nextTab()">Siguiente ▶</button>
  </div>
  <button id="saveBtn" class="btn btn-success" disabled>Guardar</button>
</div>
</form>

<script>

// Edad Calculada Automáticamente
document.querySelector('input[name="fecha_nacimiento"]').addEventListener('change', e => 
  {
    const d = new Date(e.target.value); if (isNaN(d)) return;
    const diff = new Date(Date.now() - d.getTime());
    document.querySelector('input[name="edad"]').value = Math.abs(diff.getUTCFullYear() - 1970);
  });

function addRow(kind, data={}) 
  {
    const container = kind==='cert' ? document.getElementById('certRows') : document.getElementById('vaxRows');
    const prefix = kind==='cert' ? 'certificados' : 'vacunas';
    const id = Math.random().toString(36).slice(2);
    const row = document.createElement('div');
    row.className = 'row g-2 align-items-end border rounded p-2 mb-2';
    row.innerHTML = `
      <div class="col-md-3"><label class="form-label">Descripción</label>
        <input class="form-control" name="${prefix}[${id}][descripcion]" value="${data.descripcion||''}" required>
      </div>
      <div class="col-md-2"><label class="form-label">Fecha Registro</label>
        <input type="date" class="form-control" name="${prefix}[${id}][fecha_registro]" value="${data.fecha_registro||''}" required>
      </div>
      <div class="col-md-2"><label class="form-label">Inicio</label>
        <input type="date" class="form-control" name="${prefix}[${id}][fecha_inicio]" value="${data.fecha_inicio||''}" required>
      </div>
      <div class="col-md-2"><label class="form-label">Fin</label>
        <input type="date" class="form-control" name="${prefix}[${id}][fecha_fin]" value="${data.fecha_fin||''}" required>
      </div>
      <div class="col-md-2"><label class="form-label">Archivo (PDF ≤2MB)</label>
        <input type="file" class="form-control" name="${prefix}[${id}][archivo]" accept=".pdf" ${data.archivo?'':'required'}>
        ${data.archivo?`<a class="small" target="_blank" href="/view_document.php?path=${encodeURIComponent(data.archivo)}">Ver</a>`:''}
      </div>
      <div class="col-md-1"><button type="button" class="btn btn-outline-danger" onclick="this.closest('.row').remove()">X</button></div>
    `;
    container.appendChild(row);
  }

// Cargar filas si edición
<?php if ($editing): ?>
  <?php foreach ($certs as $c): ?>
    addRow('cert', <?php echo json_encode($c); ?>);
  <?php endforeach; ?>
  <?php foreach ($vaxs as $v): ?>
    addRow('vax', <?php echo json_encode($v); ?>);
  <?php endforeach; ?>
<?php else: ?>
  addRow('cert'); addRow('vax');
<?php endif; ?>

function nextTab()
  {
    const t=document.querySelector('#tabs .nav-link.active'); t?.parentElement.nextElementSibling?.querySelector('button')?.click();
  }
function prevTab()
  {
    const t=document.querySelector('#tabs .nav-link.active'); t?.parentElement.previousElementSibling?.querySelector('button')?.click();
  }

// Habilitar Guardar solo si todos los datos están diligenciados
function validateAll()
  {
    const form = document.getElementById('userForm');
    const valid = form.checkValidity();
    document.getElementById('saveBtn').disabled = !valid;
  }
document.getElementById('userForm').addEventListener('input', validateAll);
document.getElementById('userForm').addEventListener('change', validateAll);
setInterval(validateAll, 800);
</script>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>