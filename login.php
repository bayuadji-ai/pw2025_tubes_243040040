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
            $_SESSION["user_id"] = $row["id"];
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">
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
            padding: 20px;
        }

        .container {
            display: flex;
            width: 850px;
            max-width: 100%;
            height: 550px;
            background: #fff;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
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
            position: relative;
            z-index: 2;
        }

        form {
            width: 100%;
        }

        .form-box h1 {
            font-size: 32px;
            margin-bottom: 20px;
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
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
                position: relative;
            }

            .img-box {
                display: none;
                /* hide image box */
            }

            .container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('img/login.jpeg');
                background-size: cover;
                background-position: center;
                opacity: 0.15;
                z-index: 1;
            }

            .form-box {
                width: 100%;
                padding: 30px 20px;
                background-color: rgba(0, 12, 34, 0.95);
            }
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
                        <input type="text" placeholder="Username" name="username" id="username" required>
                        <i class="bi bi-person"></i>
                    </li>
                    <li>
                        <input type="password" placeholder="Password" name="password" id="password" required>
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