<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
$keyword = $_GET['keyword'] ?? '';

$query = "SELECT * FROM modul_buku WHERE judul LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($modul = $result->fetch_assoc()) {
        echo '<div class="col-md-4">';
        echo '<div class="card h-100">';
        echo '<img src="upload/' . $modul['gambar'] . '" class="card-img-top" style="height: 200px; object-fit: contain;" alt="Sampul Modul">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($modul['judul']) . '</h5>';
        echo '<p class="card-text">' . substr(htmlspecialchars($modul['deskripsi']), 0, 100) . '...</p>';
        echo '<a href="#" class="btn btn-primary">Baca</a>';
        echo '</div></div></div>';
    }
} else {
    echo '<div class="col-12 text-center"><p class="text-muted">Modul tidak ditemukan.</p></div>';
}
