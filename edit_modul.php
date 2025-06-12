<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM modul_buku WHERE id='$id'");
    $modul = mysqli_fetch_assoc($query);
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = $_POST['id'];
    $judul      = $_POST['judul'];
    $deskripsi  = $_POST['deskripsi'];
    $gambar_lama = $_POST['gambar_lama'];

    // Proses upload gambar
    if ($_FILES['gambar']['name'] != "") {
        $gambar_baru = uniqid() . '_' . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'upload/' . $gambar_baru);

        if (file_exists("upload/$gambar_lama")) {
            unlink("upload/$gambar_lama");
        }
    } else {
        $gambar_baru = $gambar_lama;
    }

    // Update database
    $update = mysqli_query($conn, "UPDATE modul_buku SET 
                judul='$judul', 
                deskripsi='$deskripsi', 
                gambar='$gambar_baru' 
              WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Modul berhasil diperbarui!'); window.location.href='manajemen_modul.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Gagal memperbarui modul: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Modul</title>
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .img-preview {
            max-width: 200px;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="form-container">
            <h3 class="text-center mb-4">Edit Modul Belajar</h3>

            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $modul['id'] ?>">
                <input type="hidden" name="gambar_lama" value="<?= $modul['gambar'] ?>">

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Modul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($modul['judul']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?= htmlspecialchars($modul['deskripsi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="upload/<?= $modul['gambar'] ?>" class="img-preview mb-2"><br>
                    <label for="gambar" class="form-label">Ganti Gambar (Opsional)</label>
                    <input class="form-control" type="file" name="gambar" accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                    <a href="manajemen_modul.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>