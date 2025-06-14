<?php
session_start();
$conn = new mysqli("localhost", "root", "", "edge_academy");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Akses tidak sah! ID pendaftaran tidak ditemukan.");
}

$id_pendaftaran = $_GET['id']; 
$user_id = $_SESSION['user_id']; 

$query = "
SELECT 
    p.catatan,
    g.nama AS nama_guru,
    g.mapel,
    g.jadwal,
    u.username AS nama_siswa
FROM pendaftaran_kursus p
JOIN users u ON p.user_id = u.id
JOIN guru_kursus g ON p.guru_id = g.id
WHERE p.id = $id_pendaftaran AND p.user_id = $user_id
";

$result = $conn->query($query);
if ($result->num_rows === 0) {
    echo "Data tidak ditemukan atau bukan milik Anda.";
    exit;
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center">
                <h4 class="mb-0">Bukti Pendaftaran Kursus Privat</h4>
            </div>
            <div class="card-body">
                <p><strong>Nama Siswa:</strong> <?= htmlspecialchars($data['nama_siswa']); ?></p>
                <p><strong>Guru:</strong> <?= htmlspecialchars($data['nama_guru']); ?></p>
                <p><strong>Mata Pelajaran:</strong> <?= htmlspecialchars($data['mapel']); ?></p>
                <p><strong>Jadwal:</strong> <?= htmlspecialchars($data['jadwal']); ?></p>
                <p><strong>Catatan:</strong> <?= htmlspecialchars($data['catatan'] ?: '-'); ?></p>
            </div>
            <div class="card-footer text-center">
                <a href="dashboard_siswa.php" class="btn btn-primary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>

</html>