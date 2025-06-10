<?php
$conn = new mysqli("localhost", "root", "", "nama_database");
$data = $conn->query("SELECT * FROM modul_buku");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Modul Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h3>Daftar Modul Buku</h3>
        <a href="tambah.php" class="btn btn-success mb-3">Tambah Modul</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = $data->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['judul']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td><img src="upload/<?= $row['gambar'] ?>" width="100"></td>
                        <td><a href="upload/<?= $row['file_pdf'] ?>" target="_blank">Lihat PDF</a></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>