<?php
session_start();

// Validasi login
if (!isset($_SESSION['login']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "edge_academy");
$user_id = $_SESSION['user_id'];

// Cek apakah data profil sudah ada
$stmt = $conn->prepare("SELECT * FROM profil_siswa WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$profil = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_lengkap'];
    $ttl = $_POST['ttl'];
    $asal = $_POST['asal_sekolah'];
    $domisili = $_POST['domisili'];
    $jk = $_POST['jenis_kelamin'];

    if ($profil) {
        $stmt = $conn->prepare("UPDATE profil_siswa SET nama_lengkap=?, ttl=?, asal_sekolah=?, domisili=?, jenis_kelamin=? WHERE user_id=?");
        $stmt->bind_param("sssssi", $nama, $ttl, $asal, $domisili, $jk, $user_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO profil_siswa (user_id, nama_lengkap, ttl, asal_sekolah, domisili, jenis_kelamin) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $nama, $ttl, $asal, $domisili, $jk);
    }

    $stmt->execute();
    header("Location: profile_siswa.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Profil Siswa</h5>
                    </div>
                    <div class="card-body p-4">

                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Data berhasil disimpan.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?= $profil['nama_lengkap'] ?? '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tempat, Tanggal Lahir</label>
                                <input type="text" name="ttl" class="form-control" placeholder="Contoh: Bandung, 20 April 2007" value="<?= $profil['ttl'] ?? '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" class="form-control" value="<?= $profil['asal_sekolah'] ?? '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Domisili</label>
                                <input type="text" name="domisili" class="form-control" value="<?= $profil['domisili'] ?? '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" <?= ($profil['jenis_kelamin'] ?? '') === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= ($profil['jenis_kelamin'] ?? '') === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-2">Simpan Perubahan</button>
                            <a href="dashboard_siswa.php" class="btn btn-secondary w-100">Kembali ke Dashboard</a>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted small">
                        Data disimpan otomatis di akun Anda.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>