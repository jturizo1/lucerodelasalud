<?php require_once __DIR__ . '/../auth/check_auth.php'; if(!is_admin()) redirect('../user/users.php'); ?>
<?php
$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
  $mysqli->query("DELETE FROM users WHERE id={$id}");
}
redirect('/admin/users.php');
