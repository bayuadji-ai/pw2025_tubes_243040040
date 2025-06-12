<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

// Konfigurasi pagination
$limit = 6;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data
$totalQuery = $conn->query("SELECT COUNT(*) as total FROM modul_buku");
$totalData = $totalQuery->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Ambil data sesuai halaman
$result = $conn->query("SELECT * FROM modul_buku LIMIT $start, $limit");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Modul Belajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">

        <!-- Tombol Kembali -->
        <a href="dashboard_siswa.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
        </a>

        <!-- Judul -->
        <h2 class="mb-4 text-center">Modul Belajar</h2>

        <!-- Input Live Search -->
        <div class="input-group mb-4">
            <input type="text" id="search" class="form-control" placeholder="Cari modul...">
            <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>

        <!-- Kartu Modul -->
        <div class="row g-4" id="modul-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($modul = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="upload/<?= $modul['gambar']; ?>" class="card-img-top" style="height: 200px; object-fit: contain;" alt="Sampul Modul">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($modul['judul']); ?></h5>
                                <p class="card-text"><?= substr(htmlspecialchars($modul['deskripsi']), 0, 100); ?>...</p>
                                <a href="#" class="btn btn-primary">Baca</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada modul tersedia.</p>
                </div>
            <?php endif; ?>
        </div>



    </div>

    <!-- AJAX Script -->
    <script>
        document.getElementById('search').addEventListener('input', function() {
            const keyword = this.value;

            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'ajax/modul_search_siswa.php?keyword=' + encodeURIComponent(keyword), true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('modul-container').innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        });
    </script>
</body>

</html>