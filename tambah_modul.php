<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    // Pastikan folder upload tersedia
    if (!is_dir("upload")) {
        mkdir("upload", 0755, true);
    }

    // Buat nama unik agar tidak overwrite
    $nama_gambar_baru = uniqid() . "_" . $gambar;

    // Upload gambar
    if (move_uploaded_file($tmp, "upload/" . $nama_gambar_baru)) {
        // Insert ke database
        $conn->query("INSERT INTO modul_buku (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$nama_gambar_baru')");
        header("Location: manajemen_modul.php");
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Gagal upload gambar!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Materi</title>
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">
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
                <h4 class="mb-0">Tambah Modul</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Modul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="6" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" id="judul" class="form-control" accept="image/*" class="form-control mb-2" required required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    <a href="manajemen_modul.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>