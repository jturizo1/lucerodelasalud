<?php
include 'ConDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
    header("Location: Dashboard.php");
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Crear Usuario">
</form>