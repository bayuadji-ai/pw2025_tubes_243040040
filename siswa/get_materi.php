<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
$id_mapel = isset($_GET['id_mapel']) ? intval($_GET['id_mapel']) : 0;

if ($id_mapel === 0) {
    echo json_encode([]);
    exit;
}

$stmt = $conn->prepare("SELECT judul_materi FROM tabel_materi WHERE id_mapel = ?");
$stmt->bind_param("i", $id_mapel);
$stmt->execute();
$result = $stmt->get_result();

$materi = [];
while ($row = $result->fetch_assoc()) {
    $materi[] = $row;
}

header('Content-Type: application/json');
echo json_encode($materi);

$stmt->close();
$conn->close();
?>
