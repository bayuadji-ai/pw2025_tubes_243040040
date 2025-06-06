<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
</head>

<body>
    <h1>Selamat datang, Admin!</h1>
    <a href="logout.php" class="btn-logout">Logout</a>
</body>

</html>