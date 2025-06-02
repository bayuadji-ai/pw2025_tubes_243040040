<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
header('Content-Type: application/json');

$id_kelas = isset($_GET['id_kelas']) ? intval($_GET['id_kelas']) : 0;
if ($id_kelas === 0) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT id_mapel, nama_mapel FROM tabel_mapel WHERE id_kelas = ?");
$stmt->bind_param("i", $id_kelas);
$stmt->execute();
$result = $stmt->get_result();

$mapel = [];
while ($row = $result->fetch_assoc()) {
    $mapel[] = $row;
}

echo json_encode($mapel);
