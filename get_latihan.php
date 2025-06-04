<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
header('Content-Type: application/json');

$id_mapel = isset($_GET['id_mapel']) ? intval($_GET['id_mapel']) : 0;
if ($id_mapel === 0) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT id_latihan, judul_latihan, isi_text FROM tabel_latihan WHERE id_mapel = ?");
$stmt->bind_param("i", $id_mapel);
$stmt->execute();
$result = $stmt->get_result();

$latihan = [];
while ($row = $result->fetch_assoc()) {
    $latihan[] = $row;
}

echo json_encode($latihan);
