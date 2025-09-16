<?php
session_start();

// === Ajusta Variables Según sea el Caso===
define('DB_HOST', 'localhost');
define('DB_NAME', 'ldlsapp_db');
define('DB_USER', 'root');
define('DB_PASS', 'Adm1n1str4d0r');

// Definir Zona Horaria
date_default_timezone_set('America/Bogota');

// SMTP (PHPMailer) Ajustar según tu proveedor
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'camiloasic@gmail.com'); // Usar Contraseña de Aplicación
define('SMTP_PASS', 'app-password');
define('SMTP_SECURE', 'tls');
define('MAIL_FROM', 'camiloasic@gmail.com');
define('MAIL_FROM_NAME', 'Alertas Próximos a Vencer');

// Rutas
define('BASE_URL', '/'); // Ajusta si se despliega en Subcarpeta
define('UPLOAD_DIR', __DIR__ . '/Uploads');
define('IMG_DIR', UPLOAD_DIR . '/images');
define('CERT_DIR', UPLOAD_DIR . '/Certificados');
define('VAC_DIR',  UPLOAD_DIR . '/Vacunas');

// Límite de 2 MB
define('MAX_FILE_SIZE', 2 * 1024 * 1024);

// Conexión a BD
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) 
    {
        die('Error DB: ' . $mysqli->connect_error);
    }
else
    {
        $mysqli->set_charset('utf8mb4');
    }

function is_logged_in() 
    { 
        return isset($_SESSION['user']); 
    }
function is_admin() 
    { 
        return is_logged_in() && $_SESSION['user']['perfil'] === 'admin'; 
    }

function redirect($path) 
    {
        header('Location: ' . BASE_URL . ltrim($path, '/'));
        exit;
    }

function h($s) 
    { 
        return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); 
    }

function days_left($start, $end) 
    {
        if (!$end) return null;
        $now = new DateTime('today');
        $e = new DateTime($end);
        return (int)$now->diff($e)->format('%r%a'); // Muestra Negativo si está Vencido
    }

function send_mail($to, $subject, $html) 
    {
        require_once __DIR__ . '/vendor/PHPMailer/PHPMailer.php';
        require_once __DIR__ . '/vendor/PHPMailer/SMTP.php';
        require_once __DIR__ . '/vendor/PHPMailer/Exception.php';
        // Instancia PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try 
            {
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = SMTP_USER;
                $mail->Password = SMTP_PASS;
                $mail->SMTPSecure = SMTP_SECURE;
                $mail->Port = SMTP_PORT;

                $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
                $mail->addAddress($to);

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $html;

                $mail->send();
                return true;
            } 
        catch (Exception $e) 
            {
                error_log('Mail error: ' . $e->getMessage());
                return false;
            }
    }

// Garantizar que las Carpetas Existan
foreach ([UPLOAD_DIR, IMG_DIR, CERT_DIR, VAC_DIR, __DIR__ . '/logs'] as $d) 
    {
        if (!is_dir($d)) @mkdir($d, 0775, true);
    }
?>