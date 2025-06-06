<?php
session_start();
require 'functions.php';

if (isset($_SESSION["login"])) {
    if ($_SESSION["role"] === "admin") {
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard_siswa.php");
    }
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            if ($row["role"] === "admin") {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_siswa.php");
            }
            exit;
        }
    }

    $error = true;
}
?>


<!DOCTYPE html>
<html lang="id">

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
            display: flex;
            width: 850px;
            height: 550px;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0, 0, 0, .2);
        }

        .container {
            display: flex;
            width: 850px;
            height: 550px;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0, 0, 0, .2);
        }

        .img-box {
            width: 50%;
            background-color: #081729;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .img-box img {
            max-width: 100%;
            height: auto;
            border-radius: 20px;
        }

        .form-box {
            width: 50%;
            background: #000c22;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        form {
            width: 100%;
        }

        .form-box h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            position: relative;
            margin-bottom: 20px;
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

        ul li i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #888;
        }

        ul li a {
            display: inline-block;
            margin-top: 5px;
            color: #a0c4ff;
            text-decoration: none;
        }

        .btn {
            width: 100%;
            height: 48px;
            background: #7494ec;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
            margin-top: 10px;
        }

        .form-box a {
            display: block;
            margin-top: 15px;
            color: #aad;
            text-decoration: underline;
            text-align: center;
        }

        .error-msg {
            color: #f88;
            font-style: italic;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="img-box">
            <img src="img/login.jpeg" alt="Ilustrasi Login">
        </div>


        <div class="form-box login">
            <form action="" method="post">
                <h1>Login</h1>

                <?php if (isset($error)) : ?>
                    <p class="error-msg">USERNAME ATAU PASSWORD SALAH!</p>
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
                </ul>

                <a href="registrasi.php">Belum Punya Akun? Daftar Sekarang</a>

                <button type="submit" class="btn" name="login">Login</button>

                <a href="index.php">Kembali Ke Beranda</a>
            </form>
        </div>
    </div>
</body>

</html>