<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
header('Content-Type: application/json');

$id_mapel = isset($_GET['id_mapel']) ? intval($_GET['id_mapel']) : 0;
if ($id_mapel === 0) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT id_materi, judul_materi, isi_text FROM tabel_materi WHERE id_mapel = ?");
$stmt->bind_param("i", $id_mapel);
$stmt->execute();
$result = $stmt->get_result();

$materi = [];
while ($row = $result->fetch_assoc()) {
    $materi[] = $row;
}

echo json_encode($materi);
