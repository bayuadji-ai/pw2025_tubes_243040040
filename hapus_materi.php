<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM tabel_materi WHERE id_materi = $id");
}

header("Location: dashboard_admin.php");
exit;
