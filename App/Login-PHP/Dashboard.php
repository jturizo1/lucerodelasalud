<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: Login.php");
    exit();
}
include 'ConDB.php';

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<h2>Bienvenido(a) al Sistema, <?= $_SESSION['user'] ?> | <a href="Logout.php">Cerrar Sesión</a></h2>
<a href="UserCreate.php">Agregar Nuevo Usuario</a>

<table border="1">
    <tr><th>ID</th><th>Usuario</th><th>Acción</th></tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td>
                <a href="UserEdit.php?id=<?= $row['id'] ?>">Editar</a>
                <a href="UserDelete.php?id=<?= $row['id'] ?>" onclick="return confirm('Está seguro que desea eliminar este Usuario?');">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>