<?php
require '../BD_Con/db.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$stmt = $pdo->query("SELECT nombre, apellido, documento, correo, edad, fecha_nacimiento, rol, state FROM users");
$data = $stmt->fetchAll();

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("Usuarios");

// Encabezados
$headers = ['Nombre', 'Apellido', 'Documento', 'Correo', 'Edad', 'Fecha Nacimiento', 'Rol', 'Estado'];
$sheet->fromArray($headers, null, 'A1');

// Datos
$sheet->fromArray($data, null, 'A2');

// Descargar
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="usuarios.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;