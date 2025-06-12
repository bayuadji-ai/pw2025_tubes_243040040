<?php
require 'functions.php';

if (isset($_POST["register"])) {

    if ("registrasi"($_POST) > 0) {
        echo "<script>
                    alert('user baru berhasil di tambahkan!');
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registrasi Siswa</title>
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
            box-shadow: 0 0 30px rgba(0, 0, 0, .2);
            position: relative;
        }

        .form-box {
            width: 50%;
            background: #000c22;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            z-index: 2;
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

        form {
            width: 100%;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 15px;
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

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }

            .img-box {
                display: none;
            }

            .container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('img/daftar.jpeg');
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
        <div class="form-box regis">
            <form action="" method="post">
                <h1>Daftar</h1>
                <ul>
                    <li>
                        <input type="text" placeholder="Username" name="username" id="username" required>
                        <i class="bi bi-person"></i>
                    </li>
                    <li>
                        <input type="email" placeholder="Email" name="email" id="email" required>
                        <i class="bi bi-envelope"></i>
                    </li>
                    <li>
                        <input type="password" placeholder="Password" name="password" id="password" required>
                        <i class="bi bi-lock"></i>
                    </li>
                    <li>
                        <input type="password" placeholder="Konfirmasi Password" name="password2" id="password2" required>
                        <i class="bi bi-lock"></i>
                    </li>
                </ul>
                <button type="submit" class="btn" name="register">Daftar Sekarang!</button>
                <a href="index.php">Kembali Ke Beranda</a>
            </form>
        </div>
        <div class="img-box">
            <img src="img/daftar.jpeg" alt="Gambar Ilustrasi">
        </div>
    </div>
</body>

</html>