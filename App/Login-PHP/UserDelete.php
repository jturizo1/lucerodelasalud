<?php
include 'ConDB.php';
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM users WHERE id=$id");
header("Location: Dashboard.php");