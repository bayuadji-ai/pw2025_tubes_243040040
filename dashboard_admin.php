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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Admin</h2>
            <a href="logout.php" class="btn btn-danger float-end">Logout</a>
        </div>

        <h5 class="mb-4">Selamat Datang Admin</h5>

        <div class="row text-center">
            <!-- Kartu Materi -->
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-journal-bookmark me-2"></i>Manajemen Materi
                        </h5>
                        <a href="manajemen_materi.php" class="btn btn-primary mt-3">Lihat</a>
                    </div>
                </div>
            </div>
            <!-- Kartu Soal -->
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-question-circle me-2"></i>Manajemen Soal
                        </h5>
                        <a href="manajemen_soal.php" class="btn btn-primary mt-3">Lihat</a>
                    </div>
                </div>
            </div>
            <!-- Kartu Modul -->
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-archive me-2"></i>Manajemen Modul
                        </h5>
                        <a href="manajemen_modul.php" class="btn btn-primary mt-3">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>