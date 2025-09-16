<?php require_once __DIR__ . '/../auth/check_auth.php'; if(is_admin()) redirect('../admin/users.php'); ?>
<?php
function ensure_dir($dir)
    { 
        if(!is_dir($dir)) @mkdir($dir, 0775, true); 
    }
ensure_dir(IMG_DIR); ensure_dir(CERT_DIR); ensure_dir(VAC_DIR);

$id = (int)($_POST['id'] ?? 0);
$editing = $id > 0;

$documento = $_POST['documento'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$correo = $_POST['correo'] ?? '';
$perfil = $_POST['perfil'] ?? 'usuario';
$estado = $_POST['estado'] ?? 'Activo';
$fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
$edad = $_POST['edad'] ?? null;
$password = $_POST['password'] ?? '';

// Procesar Imagen
$foto_name = null;
if (!empty($_FILES['foto']['name'])) 
    {
        if ($_FILES['foto']['size'] > MAX_FILE_SIZE) die('Foto supera 2MB');
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['png','jpg','jpeg'])) die('Foto debe ser PNG/JPG');
        $foto_name = 'I-' . $documento . '-' . time() . '.' . ($ext==='jpeg'?'jpg':$ext);
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], IMG_DIR . '/' . $foto_name)) 
            {
                die('Error al subir la Foto');
            }
    }

if ($editing) 
    {
        // No cambiar documento
        $stmt = $mysqli->prepare("UPDATE users SET nombre=?, apellido=?, correo=?, perfil=?, estado=?, fecha_nacimiento=?, edad=?, updated_at=NOW() " . ($foto_name?', foto=?':'') . ($password!==''?', password=?':'') . " WHERE id=?");
        if ($foto_name && $password!=='') 
            {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param('sssssssssI', $nombre,$apellido,$correo,$perfil,$estado,$fecha_nacimiento,$edad,$foto_name,$hash,$id);
            } 
        elseif ($foto_name) 
            {
                $stmt->bind_param('ssssssssI', $nombre,$apellido,$correo,$perfil,$estado,$fecha_nacimiento,$edad,$foto_name,$id);
            } 
        elseif ($password!=='') 
            {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param('ssssssssi', $nombre,$apellido,$correo,$perfil,$estado,$fecha_nacimiento,$edad,$hash,$id);
            } 
        else 
            {
                $stmt->bind_param('sssssssi', $nombre,$apellido,$correo,$perfil,$estado,$fecha_nacimiento,$edad,$id);
            }
        // Corrige tipos de bind por rama
        $stmt->execute();
        $user_id = $id;
    } 
else 
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("INSERT INTO users (documento,nombre,apellido,correo,password,perfil,estado,fecha_nacimiento,edad,foto) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('ssssssssss', $documento,$nombre,$apellido,$correo,$hash,$perfil,$estado,$fecha_nacimiento,$edad,$foto_name);
        $stmt->execute();
        $user_id = $mysqli->insert_id;
    }

// Manejo de certificados/vacunas (múltiples filas)
function handleDocs($prefix, $dir, $table, $user_id) 
    {
        foreach (($_POST[$prefix] ?? []) as $key => $row) 
            {
                $desc = $row['descripcion'] ?? '';
                $fr = $row['fecha_registro'] ?? '';
                $fi = $row['fecha_inicio'] ?? '';
                $ff = $row['fecha_fin'] ?? '';
                $field = $prefix . '[' . $key . '][archivo]';
                $file = $_FILES[$prefix]['name'][$key]['archivo'] ?? null;

                $stored = $row['archivo'] ?? null; // cuando edición

                if ($file) 
                    {
                        $size = $_FILES[$prefix]['size'][$key]['archivo'];
                        if ($size > MAX_FILE_SIZE) die('PDF supera 2MB');
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if ($ext !== 'pdf') die('Solo PDF');
                        $fname = ($prefix==='certificados'?'C':'V') . '-' . $_POST['documento'] . '-' . time() . '-' . $key . '.pdf';
                        $tmp = $_FILES[$prefix]['tmp_name'][$key]['archivo'];
                        move_uploaded_file($tmp, $dir . '/' . $fname);
                        $stored = $fname;
                    }

                if ($stored) 
                    {
                        $stmt = $GLOBALS['mysqli']->prepare("INSERT INTO {$table} (user_id, descripcion, fecha_registro, fecha_inicio, fecha_fin, archivo) VALUES (?,?,?,?,?,?)");
                        $stmt->bind_param('isssss', $user_id, $desc, $fr, $fi, $ff, $stored);
                        $stmt->execute();
                    }
            }
    }

handleDocs('certificados', CERT_DIR, 'certificados', $user_id);
handleDocs('vacunas', VAC_DIR, 'vacunas', $user_id);

redirect('/user/users.php');