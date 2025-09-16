<?php require_once __DIR__ . '/../auth/check_auth.php'; if(!is_admin()) redirect('../user/users.php'); ?>
<?php
// PDF muy básico (sin dependencias)
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename=usuarios.pdf');
echo "%PDF-1.4\n";
echo "1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n";
echo "2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj\n";
$width=595;$height=842;
echo "3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 $width $height]/Contents 4 0 R/Resources<</Font<</F1 5 0 R>>>>>>endobj\n";
$content = "BT /F1 10 Tf 50 800 Td (Usuarios) Tj T* ";
$res = $mysqli->query("SELECT documento,nombre,apellido,correo,perfil,estado FROM users ORDER BY created_at DESC");
$y = 780;
while ($r = $res->fetch_assoc()) 
  {
    $line = "{$r['documento']} - {$r['nombre']} {$r['apellido']} - {$r['correo']} - {$r['perfil']} - {$r['estado']}";
    $line = preg_replace('/[()]/', '', $line);
    $content .= "1 0 0 1 50 $y Tm ($line) Tj ";
    $y -= 14;
  }
$content .= "ET";
$len = strlen(iconv('UTF-8', 'ISO-8859-1//IGNORE', $content));
echo "4 0 obj<</Length $len>>stream\n$content\nendstream endobj\n";
print("5 0 obj<</Type/Font/Subtype/Type1/Name/F1/BaseFont/Helvetica>>endobj\n");
print("xref\n0 6\n0000000000 65535 f \n");
print("trailer<</Size 6/Root 1 0 R>>\nstartxref\n0\n%%EOF");
exit;