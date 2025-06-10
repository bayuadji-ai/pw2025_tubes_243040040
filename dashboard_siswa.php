<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* Topbar (Mobile Only) */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #2196f3;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1001;
            justify-content: space-between;
        }

        .topbar h5 {
            margin: 0;
            font-size: 20px;
        }

        .hamburger-btn {
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            color: white;
        }

        /* Layout wrapper */
        .main-wrapper {
            display: flex;
            flex-direction: column;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: #f4f4f4;
            padding: 30px 20px;
            border-right: 1px solid #ccc;
            transition: left 0.3s ease;
            z-index: 1000;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .sidebar a.red {
            color: darkred;
        }

        .sidebar a.red:hover {
            background-color: #f8d7da;
        }

        .sidebar a.active {
            background-color: #ddd;
        }

        .logo img {
            width: 180px;
            margin-bottom: 20px;
        }

        /* Main content */
        .main {
            margin-top: 60px;
            padding: 20px;
        }

        .welcome-box {
            background: linear-gradient(90deg, #2196f3, #4fc3f7);
            border-radius: 20px;
            padding: 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .welcome-box img {
            width: 100px;
        }

        .menu-grid {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card-menu {
            background-color: white;
            border-left: 6px solid #2196f3;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .card-menu h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card-menu p {
            font-size: 14px;
            color: #555;
        }

        .card-menu.pink {
            border-left-color: #e91e63;
        }

        .card-menu.green {
            border-left-color: #4caf50;
        }

        .card-menu.orange {
            border-left-color: #ff9800;
        }

        .card-menu.purple {
            border-left-color: #9c27b0;
        }

        /* Desktop layout */
        @media (min-width: 768px) {
            .main-wrapper {
                flex-direction: row;
            }

            .sidebar {
                position: sticky;
                left: 0 !important;
                height: 100vh;
                z-index: 0;
            }

            .topbar {
                display: none;
            }

            .main {
                margin-top: 0;
                margin-left: 0;
                flex-grow: 1;
            }
        }
    </style>
</head>

<body>

    <!-- Topbar untuk Mobile -->
    <div class="topbar">
        <button class="hamburger-btn" onclick="toggleSidebar()">☰</button>
        <h5>Dashboard Siswa</h5>
    </div>

    <!-- Wrapper untuk Sidebar dan Konten -->
    <div class="main-wrapper">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="logo"><img src="img/logo_dashboard.png" alt="Logo"></div>
            <a href="dashboard_siswa.php" class="active"><i class="bi bi-house-door"></i> Home</a>
            <a href="ruangmateri.php"><i class="bi bi-book"></i> RuangMateri</a>
            <a href="ruanglatihan.php"><i class="bi bi-pencil"></i> RuangLatihan</a>
            <a href="modul_siswa.php"><i class="bi bi-file-earmark-fill"></i></i> Modul Belajar</a>
            <a href="logout.php" class="red"><i class="bi bi-box-arrow-left"></i> Logout</a>
            <a href="#"><i class="bi bi-chat-square-text"></i></i> Contact</a>
        </div>

        <!-- Konten Utama -->
        <div class="main">
            <div class="welcome-box">
                <div>
                    <h1>Halo, Selamat Datang!</h1>
                    <p>Semangat belajar hari ini ya! Yuk, mulai dari menu-menu menarik di bawah ini.</p>
                </div>
                <img src="https://cdn-icons-png.flaticon.com/512/201/201623.png" alt="Siswa" />
            </div>

            <div class="menu-grid">
                <div class="card-menu pink">
                    <h3>📘 Materi Populer</h3>
                    <p>Akses materi terfavorit pilihan siswa lainnya!</p>
                </div>
                <div class="card-menu green">
                    <h3>✏️ Latihan Harian</h3>
                    <p>Latihan setiap hari agar makin mantap!</p>
                </div>
                <div class="card-menu orange">
                    <h3>🧠 Quiz Mingguan</h3>
                    <p>Uji kemampuanmu melalui kuis tiap pekan.</p>
                </div>
                <div class="card-menu purple">
                    <h3>🎯 Target Belajar</h3>
                    <p>Atur target dan capai tujuan belajarmu!</p>
                </div>
            </div>

            <div class="mt-5 p-4 rounded" style="background-color: #e3f2fd;">
                <h4><i class="bi bi-chat-quote text-primary"></i> Kutipan Hari Ini</h4>
                <blockquote class="blockquote mt-3 mb-0">
                    <p>"Belajar bukan tentang menjadi yang terbaik, tapi menjadi lebih baik dari dirimu yang kemarin."</p>
                    <footer class="blockquote-footer">Anonim</footer>
                </blockquote>
            </div>

            <div class="mt-5">
                <h4><i class="bi bi-lightning-charge text-primary"></i> Tips Belajar Minggu Ini</h4>
                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Fokus 25 Menit</h5>
                                <p class="card-text">Gunakan teknik Pomodoro: 25 menit fokus belajar, 5 menit istirahat. Ulangi 4x, lalu istirahat panjang.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Belajar Sambil Ajar</h5>
                                <p class="card-text">Coba ajarkan kembali materi ke teman atau pura-pura jadi guru. Itu cara ampuh untuk memahami!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Cicil, Jangan Ngebut</h5>
                                <p class="card-text">Belajar sedikit demi sedikit setiap hari jauh lebih efektif daripada kebut semalam!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h4><i class="bi bi-calendar-week text-success"></i> Agenda Pekan Ini</h4>
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-start border-4 border-success">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-1 text-muted">Senin, 9 Juni</h6>
                                <h5 class="card-title">Ujian Matematika</h5>
                                <p class="card-text">Persiapkan dengan latihan soal di ruang latihan, fokus di bab Pecahan & Aljabar.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-start border-4 border-warning">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-1 text-muted">Kamis, 12 Juni</h6>
                                <h5 class="card-title">Presentasi Kelompok IPA</h5>
                                <p class="card-text">Tunjukkan hasil risetmu tentang Sistem Peredaran Darah. Siapkan slide dan latihan presentasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script Sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
    </script>

</body>

</html>