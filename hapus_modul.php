<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
$id = $_GET['id'];

// hapus file dari folder upload (opsional)
$get = $conn->query("SELECT * FROM modul_buku WHERE id=$id")->fetch_assoc();
unlink("upload/" . $get['gambar']);

$conn->query("DELETE FROM modul_buku WHERE id=$id");
header("Location: manajemen_modul.php");
