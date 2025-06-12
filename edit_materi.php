<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

$id = $_GET['id'] ?? 0;

// Ambil data materi yang akan diedit
$stmt = $conn->prepare("SELECT * FROM tabel_materi WHERE id_materi = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$materi = $result->fetch_assoc();

// Ambil data mapel + kelas
$mapel = $conn->query("SELECT m.id_mapel, m.nama_mapel, k.nama_kelas 
                       FROM tabel_mapel m 
                       JOIN tabel_kelas k ON m.id_kelas = k.id_kelas");

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $judul = $_POST['judul'] ?? '';
    $isi = $_POST['isi'] ?? '';
    $id_mapel = $_POST['id_mapel'] ?? '';

    if (!empty($judul) && !empty($isi) && !empty($id_mapel)) {
        $stmt = $conn->prepare("UPDATE tabel_materi SET judul_materi = ?, isi_text = ?, id_mapel = ? WHERE id_materi = ?");
        $stmt->bind_param("ssii", $judul, $isi, $id_mapel, $id);
        $stmt->execute();
        header("Location: manajemen_materi.php");
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
    <title>Edit Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">
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
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Materi</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Materi</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="<?= htmlspecialchars($materi['judul_materi']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Deskripsi</label>
                        <textarea name="isi" id="isi" class="form-control" rows="6" required><?= htmlspecialchars($materi['isi_text']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                        <select name="id_mapel" id="id_mapel" class="form-select" required>
                            <option value="">-- Pilih Mapel --</option>
                            <?php while ($m = $mapel->fetch_assoc()): ?>
                                <option value="<?= $m['id_mapel'] ?>" <?= $materi['id_mapel'] == $m['id_mapel'] ? 'selected' : '' ?>>
                                    <?= $m['nama_mapel'] ?> (<?= $m['nama_kelas'] ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-warning">Update</button>
                    <a href="manajemen_materi.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>