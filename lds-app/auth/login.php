<?php
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $correo = $_POST['correo'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $mysqli->prepare("SELECT * FROM users WHERE correo = ? LIMIT 1");
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) 
            {
                $_SESSION['user'] = 
                    [
                        'id' => $user['id'],
                        'documento' => $user['documento'],
                        'nombre' => $user['nombre'],
                        'apellido' => $user['apellido'],
                        'correo' => $user['correo'],
                        'perfil' => $user['perfil'],
                        'estado' => $user['estado']
                    ];
                if ($user['perfil'] === 'admin') redirect('admin/dashboard.php');
                redirect('user/dashboard.php');
            } 
        else 
            {
                $_SESSION['error'] = 'Credenciales Inválidas';
                redirect('index.php');
            }
    }
redirect('index.php');