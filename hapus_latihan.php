<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM tabel_latihan WHERE id_latihan = $id");
}

header("Location: manajemen_soal.php");
exit;
