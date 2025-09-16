<?php
require_once __DIR__ . '/../config.php';

$today = new DateTime('today');
$in10  = (new DateTime('today'))->modify('+10 day')->format('Y-m-d');

$sql = "
 SELECT u.id, u.correo, u.nombre, u.apellido, u.documento, 'Certificado' AS tipo, c.descripcion, c.fecha_fin AS vence
 FROM certificados c JOIN users u ON u.id=c.user_id WHERE c.fecha_fin <= ?
 UNION ALL
 SELECT u.id, u.correo, u.nombre, u.apellido, u.documento, 'Vacuna' AS tipo, v.descripcion, v.fecha_fin AS vence
 FROM vacunas v JOIN users u ON u.id=v.user_id WHERE v.fecha_fin <= ?
 ORDER BY vence ASC
";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ss', $in10, $in10);
$stmt->execute();
$res = $stmt->get_result();

$byUser = [];
while ($r = $res->fetch_assoc()) {
  $dias = days_left($today->format('Y-m-d'), $r['vence']);
  $byUser[$r['correo']][] = $r + ['dias' => $dias];
}

foreach ($byUser as $to => $items) {
  $rows = '';
  foreach ($items as $it) {
    $rows .= "<tr><td>{$it['tipo']}</td><td>".h($it['descripcion'])."</td><td>{$it['vence']}</td><td>{$it['dias']}</td></tr>";
  }
  $html = "<p>Hola, tienes documentos por vencer o vencidos en 10 días o menos.</p>
           <table border='1' cellpadding='6' cellspacing='0'>
           <tr><th>Tipo</th><th>Descripción</th><th>Vence</th><th>Días</th></tr>{$rows}</table>";
  send_mail($to, 'Alertas de vencimiento', $html);
}
echo "OK " . date('Y-m-d H:i:s');
