<?php
require 'functions.php';

$query = "SELECT tabel_latihan.*, tabel_mapel.nama_mapel, tabel_kelas.nama_kelas 
          FROM tabel_latihan
          JOIN tabel_mapel ON tabel_latihan.id_mapel = tabel_mapel.id_mapel
          JOIN tabel_kelas ON tabel_mapel.id_kelas = tabel_kelas.id_kelas
          ORDER BY id_latihan DESC";
$latihan = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="container mt-4">
    <div class="my-4">
        <h4>Daftar Latihan</h4>
        <a href="dashboard_admin.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
        </a>
        <br>
        <a href="tambah_latihan.php" class="btn btn-success btn-sm mb-2">+ Tambah Latihan</a>
        <a href="cetak_latihan.php" class="btn btn-success btn-sm mb-2">Cetak PDF</a>

        <form class="row g-2 mb-3" id="search-form" onsubmit="return false;">
            <div class="col-9 col-md-6">
                <input type="text" class="form-control" id="keyword" placeholder="🔍 Cari latihan...">
            </div>
            <div class="col-3 col-md-2">
                <button class="btn btn-primary w-100" id="btn-cari">Cari</button>
            </div>
        </form>
        <br>

        <div id="container">
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Latihan</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_assoc($latihan)) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['judul_latihan'] ?></td>
                                <td><?= $row['nama_kelas'] ?></td>
                                <td><?= $row['nama_mapel'] ?></td>
                                <td>
                                    <a href="edit_latihan.php?id=<?= $row['id_latihan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapus_latihan.php?id=<?= $row['id_latihan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            const keyword = document.getElementById('keyword');
            const container = document.getElementById('container');
            const btnCari = document.getElementById('btn-cari');

            function searchMateri() {
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        container.innerHTML = xhr.responseText;
                    }
                };
                xhr.open('GET', 'ajax/soal_search.php?keyword=' + keyword.value, true);
                xhr.send();
            }

            // Trigger live search saat mengetik
            keyword.addEventListener('keyup', searchMateri);

            // Trigger saat tombol Cari ditekan
            btnCari.addEventListener('click', searchMateri);
        </script>
</body>

</html>