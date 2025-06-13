<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$conn = new mysqli("localhost", "root", "", "edge_academy");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$guru = $conn->query("SELECT * FROM guru_kursus");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $guru_id = $_POST['guru_id'];
    $catatan = $_POST['catatan'];

    $stmt = $conn->prepare("INSERT INTO pendaftaran_kursus (user_id, guru_id, catatan) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $guru_id, $catatan);
    $stmt->execute();

    $id_pendaftaran = $stmt->insert_id;
    echo "<script>
        alert('Pendaftaran berhasil!');
        window.location.href='bukti_pendaftaran.php?id=$id_pendaftaran';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Kursus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Daftar Kursus Privat</h4>
                    </div>
                    <div class="card-body">
                        <a href="dashboard_siswa.php" class="btn btn-outline-secondary mb-3">
                            &larr; Kembali ke Dashboard
                        </a>

                        <form method="post">
                            <div class="mb-3">
                                <label for="guru_id" class="form-label">Pilih Guru</label>
                                <select class="form-select" name="guru_id" id="guru_id" required>
                                    <option value="">-- Pilih Guru --</option>
                                    <?php while ($row = $guru->fetch_assoc()): ?>
                                        <option value="<?= $row['id']; ?>">
                                            <?= $row['nama']; ?> - <?= $row['mapel']; ?> (<?= $row['jadwal']; ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted">
                        Pilih guru yang sesuai kebutuhan kamu.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>