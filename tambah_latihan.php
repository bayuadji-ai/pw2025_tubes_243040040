<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

// ambil data mapel dari database
$mapel = $conn->query("SELECT m.id_mapel, m.nama_mapel, k.nama_kelas 
                       FROM tabel_mapel m 
                       JOIN tabel_kelas k ON m.id_kelas = k.id_kelas");

// Proses form hanya jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $judul = $_POST['judul'] ?? '';
    $isi = $_POST['isi'] ?? '';
    $id_mapel = $_POST['id_mapel'] ?? '';

    // Validasi sederhana
    if (!empty($judul) && !empty($isi) && !empty($id_mapel)) {
        $stmt = $conn->prepare("INSERT INTO tabel_latihan (judul_latihan, isi_text, id_mapel) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $judul, $isi, $id_mapel);
        $stmt->execute();
        header("Location: dashboard_admin.php");
        exit;
    } else {
        $error = "Semua field wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            max-width: 600px;
            margin: auto;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 1rem;
            }

            .form-control,
            .form-select {
                font-size: 0.9rem;
            }

            h4 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Tambah Latihan</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Latihan</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Deskripsi</label>
                        <textarea name="isi" id="isi" class="form-control" rows="6" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                        <select name="id_mapel" id="id_mapel" class="form-select" required>
                            <option value="">-- Pilih Mapel --</option>
                            <?php while ($m = $mapel->fetch_assoc()): ?>
                                <option value="<?= $m['id_mapel'] ?>">
                                    <?= $m['nama_mapel'] ?> (<?= $m['nama_kelas'] ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    <a href="manajemen_soal.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>