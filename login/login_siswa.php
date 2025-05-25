<?php
require 'functions.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1>Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color: red; font-style:italic">USERNAME ATAU PASSWORD SALAH!</p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>

            <li>
                <label for="email">Email :</label>
                <input type="email" name="email" id="email">
            </li>

            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>

            <li>
                <button type="submit" name="login">Login</button>
            </li>

        </ul>
    </form>
</body>

</html>