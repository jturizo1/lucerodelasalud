<?php require_once __DIR__ . '/../auth/check_auth.php'; if(!is_admin()) redirect('../user/users.php'); ?>
<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=usuarios.csv');
$out = fopen('php://output', 'w');
fputcsv($out, ['Documento','Nombre','Apellido','Correo','Perfil','Estado','Creado','Actualizado']);
$res = $mysqli->query("SELECT documento,nombre,apellido,correo,perfil,estado,created_at,updated_at FROM users ORDER BY created_at DESC");
while ($r = $res->fetch_assoc()) fputcsv($out, $r);
fclose($out);
exit;