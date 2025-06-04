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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Registrasi Siswa</title>
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

        .form-box {
            width: 50%;
            background: #000c22;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
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

        .container h1 {
            font-size: 36px;
            margin: -10px 0;
            color: white;
            text-align: center;
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

        .form-box a {
            display: block;
            margin-top: 15px;
            color: #aad;
            text-decoration: underline;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Form di kiri -->
        <div class="form-box regis">
            <form action="" method="post">
                <h1>Daftar</h1>
                <ul>
                    <li>
                        <label for="username"></label>
                        <input type="text" placeholder="Username" name="username" id="username">
                        <i class="bi bi-person"></i>
                    </li>

                    <li>
                        <label for="email"></label>
                        <input type="email" placeholder="Email" name="email" id="email">
                        <i class="bi bi-envelope"></i>
                    </li>

                    <li>
                        <label for="password"></label>
                        <input type="password" placeholder="Password" name="password" id="password">
                        <i class="bi bi-lock"></i>
                    </li>

                    <li>
                        <label for="password2"></label>
                        <input type="password" placeholder="Konfirmasi Password" name="password2" id="password2">
                        <i class="bi bi-lock"></i>
                    </li>

                    <button type="submit" class="btn" name="register">Daftar Sekarang!</button>

                    <a href="index.php">Kembali Ke Beranda</a>
                </ul>
            </form>
        </div>

        <!-- Gambar di kanan -->
        <div class="img-box">
            <img src="img/daftar.jpeg" alt="Gambar Ilustrasi">
        </div>
    </div>


</body>

</html>