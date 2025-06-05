<?php
session_start();
include 'ConDB.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['user'] = $username;
        header("Location: Dashboard.php");
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<form method="post">
    Usuario: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>

<?php if (!empty($error)) echo $error; ?>