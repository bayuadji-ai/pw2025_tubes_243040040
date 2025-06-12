<?php
require '../functions.php';

$keyword = $_GET["keyword"] ?? "";

$query = "SELECT tabel_latihan.*, tabel_mapel.nama_mapel, tabel_kelas.nama_kelas 
          FROM tabel_latihan
          JOIN tabel_mapel ON tabel_latihan.id_mapel = tabel_mapel.id_mapel
          JOIN tabel_kelas ON tabel_mapel.id_kelas = tabel_kelas.id_kelas
          WHERE 
              judul_latihan LIKE ? OR 
              nama_mapel LIKE ? OR 
              nama_kelas LIKE ?
          ORDER BY id_latihan DESC";

$stmt = $conn->prepare($query);
$keyword_param = "%$keyword%";
$stmt->bind_param("sss", $keyword_param, $keyword_param, $keyword_param);
$stmt->execute();
$result = $stmt->get_result();
?>

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
            while ($row = $result->fetch_assoc()) : ?>
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