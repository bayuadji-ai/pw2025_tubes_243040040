<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
?>//

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 20%;
            background-color: #f4f4f4;
            padding: 30px 20px;
            border-right: 1px solid #ccc;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
        }

        .logo img {
            width: 250px;
            height: auto;
            text-align: center;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #ddd;
            color: #000;
        }

        .sidebar a.logout:hover {
            background-color: #f8d7da;
            color: darkred;
        }

        .content {
            flex-grow: 1;
            padding: 40px;
            text-align: center;
        }

        h1 {
            margin-top: 100px;
            font-size: 28px;
        }

        p {
            margin-top: 10px;
            font-size: 18px;
            color: #666;
        }

        .sidebar a.red {
            color: red;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="logo"><img src="img/logo_dashboard.png" alt=""></div>

        <a href="dashboard_siswa.php"><i class="bi bi-house-door"></i>Home</a>
        <a href="ruangmateri.php"><i class="bi bi-book"></i>RuangMateri</a>
        <a href="ruanglatihan.php"><i class="bi bi-pencil"></i>RuangLatihan</a>
        <a href="#"><i class="bi bi-person"></i>Profile</a>
        <a href="logout.php" class="red"><i class="bi bi-box-arrow-left"></i>Logout</a>
        <a href="#"><i class="bi bi-info-circle"></i>Tentang</a>
    </div>

    <div class="content">
        <h1>Halo, Selamat Datang</h1>
        <p>Belajar seru bareng kami</p>
    </div>

</body>

</html>