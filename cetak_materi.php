<?php
require 'functions.php';

$query = "SELECT tabel_materi.*, tabel_mapel.nama_mapel, tabel_kelas.nama_kelas 
          FROM tabel_materi
          JOIN tabel_mapel ON tabel_materi.id_mapel = tabel_mapel.id_mapel
          JOIN tabel_kelas ON tabel_mapel.id_kelas = tabel_kelas.id_kelas
          ORDER BY id_materi DESC";
$materi = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Materi</title>
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
            font-weight: bold;
        }

        .btn-print {
            background-color: #198754;
            color: white;
        }

        .btn-back {
            background-color: #0d6efd;
            color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 10px 14px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #0d6efd;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        @media print {
            .btn-container {
                display: none;
            }

            body {
                margin: 0;
                background-color: white;
            }

            table {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    <h2>Daftar Materi</h2>

    <div class="btn-container">
        <a href="manajemen_materi.php" class="btn btn-back">← Kembali ke Manajemen Materi</a>
        <a href="pdf_materi.php" class="btn btn-print" target="_blank">🖨️ Cetak PDF</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Materi</th>
                <th>Kelas</th>
                <th>Mapel</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            while ($row = mysqli_fetch_assoc($materi)) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($row['judul_materi']) ?></td>
                    <td><?= htmlspecialchars($row['nama_kelas']) ?></td>
                    <td><?= htmlspecialchars($row['nama_mapel']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>