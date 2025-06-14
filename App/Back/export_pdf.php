<?php
require '../BD_Con/db.php';
require '../vendor/autoload.php';

use Dompdf\Dompdf;

$stmt = $pdo->query("SELECT nombre, apellido, documento, correo, edad, fecha_nacimiento, rol, state FROM users");
$data = $stmt->fetchAll();

// HTML
$html = '<h3>Lista de Usuarios</h3><table border="1" cellpadding="5" cellspacing="0" width="100%">';
$html .= '<tr><th>Nombre</th><th>Apellido</th><th>Documento</th><th>Correo</th><th>Edad</th><th>Fecha Nacimiento</th><th>Rol</th><th>Estado</th></tr>';

foreach ($data as $row) {
    $html .= "<tr>
        <td>{$row['nombre']}</td>
        <td>{$row['apellido']}</td>
        <td>{$row['documento']}</td>
        <td>{$row['correo']}</td>
        <td>{$row['edad']}</td>
        <td>{$row['fecha_nacimiento']}</td>
        <td>{$row['rol']}</td>
        <td>{$row['state']}</td>
    </tr>";
}
$html .= '</table>';

// Generar PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("usuarios.pdf", ["Attachment" => 1]);
exit;