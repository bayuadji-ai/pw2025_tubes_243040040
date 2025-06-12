<?php
require_once("tcpdf/tcpdf.php");

// Ambil isi HTML dari cetak_materi.php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/pw2025_tubes_243040040/cetak_materi.php"); // ganti nama_project sesuai folder kamu
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);
curl_close($ch);

// Buat PDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('times', '', 11);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Data Materi.pdf', 'I');
