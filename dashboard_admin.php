<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit;
}
?>


<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">
</head>

<body class="container mt-4">
    <h2>Dashboard Admin</h2>

    <h4>Selamat Datang ADMIN!</h4>

    <a href="logout.php" class="btn btn-danger float-end">Logout</a>


    <!-- Materi Section -->
    <div class="my-4">
        <h4>Daftar Materi</h4>
        <a href="tambah_materi.php" class="btn btn-success btn-sm mb-2">+ Tambah Materi</a>
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
                $materi = $conn->query("
          SELECT m.id_materi, m.judul_materi, mp.nama_mapel, k.nama_kelas
          FROM tabel_materi m
          JOIN tabel_mapel mp ON m.id_mapel = mp.id_mapel
          JOIN tabel_kelas k ON mp.id_kelas = k.id_kelas
        ");
                while ($row = $materi->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['judul_materi']) ?></td>
                        <td><?= htmlspecialchars($row['nama_mapel']) ?></td>
                        <td><?= htmlspecialchars($row['nama_kelas']) ?></td>
                        <td>
                            <a href="edit_materi.php?id=<?= $row['id_materi'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_materi.php?id=<?= $row['id_materi'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Latihan Section -->
    <div class="my-4">
        <h4>Daftar Latihan</h4>
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