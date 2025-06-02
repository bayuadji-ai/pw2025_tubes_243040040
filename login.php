<?php
require 'functions.php';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            header("Location: dashboard_siswa.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


    <!-- Style CSS-->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(90deg, #e2e2e2, #c9d6ff);
        }

        label {
            display: block;
        }

        .container {
            position: relative;
            width: 850px;
            height: 550px;
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .2);
        }

        .form-box {
            position: absolute;
            right: 0;
            width: 50%;
            height: 100%;
            background: seagreen;
            display: flex;
            align-items: center;
            color: #333;
            text-align: center;
            padding: 40px;
        }

        form {
            width: 100%;
        }

        .container h1 {
            font-size: 36px;
            margin: -10px 0;
        }

        ul li {
            position: relative;
            margin: 30px 0;
        }

        ul li input {
            width: 100%;
            padding: 13px 50px 13px 20px;
            background: #eee;
            border-radius: 8px;
            border: none;
            outline: none;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        ul li input::placeholder {
            color: #888;
            font-weight: 400;
        }

        ul li i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #888;
        }

        .btn {
            width: 100%;
            height: 48px;
            background: #7494ec;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
        }

        ul a {
            margin-top: 20px;
        }
    </style>
</head>
<!-- akhir style -->

<body>
    <div class="container">
        <div class="form-box login">
            <form action="" method="post">
                <h1>Login</h1>

                <?php if (isset($error)) : ?>
                    <p style="color: red; font-style:italic" ;>USERNAME ATAU PASSWORD SALAH!</p>
                <?php endif; ?>

                <ul>
                    <li>
                        <label for="username"></label>
                        <input type="text" placeholder="username" name="username" id="username">
                        <i class="bi bi-person"></i>
                    </li>

                    <li>
                        <label for="password"></label>
                        <input type="password" placeholder="password" name="password" id="password">
                        <i class="bi bi-lock"></i>
                    </li>

                    <button type="submit" class="btn" name="login">Login</button>

                    <a href="index.php" class="btn">Kembali Ke Beranda</a>

                </ul>
            </form>
        </div>

    </div>

</body>

</html>