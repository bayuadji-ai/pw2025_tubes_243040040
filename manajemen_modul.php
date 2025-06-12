<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="shortcut icon" href="img/icon.jpeg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="container mt-4">
    <div class="my-4">
        <h4>Daftar Modul</h4>
        <a href="dashboard_admin.php" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
        </a>
        <br>

        <a href="tambah_modul.php" class="btn btn-success btn-sm mb-2">+ Tambah Modul</a>
        <br>

        <form class="row g-2 mb-3" onsubmit="return false;">
            <div class="col-md-6">
                <input type="text" class="form-control" id="keyword" placeholder="🔍 Cari modul...">
            </div>
        </form>


        <div id="tabel-container">
            <?php include 'ajax/modul_search.php'; ?>
        </div>
    </div>

    <script>
        document.getElementById('keyword').addEventListener('keyup', function() {
            let keyword = this.value;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/modul_search.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("tabel-container").innerHTML = xhr.responseText;
                }
            };

            xhr.send("keyword=" + encodeURIComponent(keyword));
        });
    </script>
</body>

</html>