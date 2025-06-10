<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

$query = "SELECT * FROM modul_buku";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modul Belajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

    <div class="container py-4">
        <!-- Tombol Kembali -->
        <a href="dashboard_siswa.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
        </a>

        <!-- Judul Halaman -->
        <h2 class="mb-4 text-center">Modul Belajar</h2>

        <!-- Search dan Pagination -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Cari modul..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>
            <nav>
                <ul class="pagination mb-0">
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
            </nav>
        </div>

        <div class="row g-4">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($modul = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="upload/<?php echo $modul['gambar']; ?>" class="card-img-top" alt="Sampul Modul">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $modul['judul']; ?></h5>
                                <p class="card-text">
                                    <?php echo substr($modul['deskripsi'], 0, 100); ?>...
                                </p>
                                <a class="btn btn-primary" target="_blank">Baca</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col-12 text-center"><p class="text-muted">Belum ada modul tersedia.</p></div>';
            }
            ?>
        </div>
    </div>

</body>

</html>