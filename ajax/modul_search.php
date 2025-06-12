<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

$keyword = $_POST['keyword'] ?? '';
$sql = "SELECT * FROM modul_buku WHERE judul LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%' ORDER BY id DESC";
$data = $conn->query($sql);
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($data->num_rows > 0): ?>
            <?php $no = 1;
            while ($row = $data->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                    <td><img src="upload/<?= $row['gambar'] ?>" width="100"></td>
                    <td>
                        <a href="edit_modul.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <a href="hapus_modul.php?id=<?= $row['id'] ?>"
                            class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')"><i class="bi bi-trash3"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Tidak ada data ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>