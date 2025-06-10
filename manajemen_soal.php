<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="container mt-4">
    <!-- Latihan Section -->
    <div class="my-4">
        <h4>Daftar Latihan</h4>
        <a href="dashboard_admin.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
        </a>
        <br>
        <a href="tambah_latihan.php" class="btn btn-success btn-sm mb-2">+ Tambah Latihan</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $latihan = $conn->query("
          SELECT l.id_latihan, l.judul_latihan, mp.nama_mapel, k.nama_kelas
          FROM tabel_latihan l
          JOIN tabel_mapel mp ON l.id_mapel = mp.id_mapel
          JOIN tabel_kelas k ON mp.id_kelas = k.id_kelas
        ");
                while ($row = $latihan->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['judul_latihan']) ?></td>
                        <td><?= htmlspecialchars($row['nama_mapel']) ?></td>
                        <td><?= htmlspecialchars($row['nama_kelas']) ?></td>
                        <td>
                            <a href="edit_latihan.php?id=<?= $row['id_latihan'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_latihan.php?id=<?= $row['id_latihan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>