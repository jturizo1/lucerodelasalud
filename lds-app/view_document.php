<?php require_once __DIR__ . '/auth/check_auth.php'; ?>
<?php
$path = basename($_GET['path'] ?? '');
$dirs = [IMG_DIR, CERT_DIR, VAC_DIR];
foreach ($dirs as $d) 
  {
    $f = $d . '/' . $path;
    if (is_file($f)) 
      {
        $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
        $mime = $ext==='pdf'?'application/pdf':($ext==='png'?'image/png':'image/jpeg');
        header('Content-Type: ' . $mime);
        header('Content-Disposition: inline; filename="' . $path . '"');
        readfile($f);
        exit;
      }
  }
http_response_code(404); echo "Archivo no Encontrado";