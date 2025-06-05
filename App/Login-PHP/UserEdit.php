<?php
include 'ConDB.php';
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? ", password='" . md5($_POST['password']) . "'" : "";

    mysqli_query($conn, "UPDATE users SET username='$username' $password WHERE id=$id");
    header("Location: Dashboard.php");
}
?>

<form method="post">
    Usuario: <input type="text" name="username" value="<?= $row['username'] ?>" required><br>
    Password (Dejar en blanco para no cambiar): <input type="password" name="password"><br>
    <input type="submit" value="Update">
</form>