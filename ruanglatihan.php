<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
$kelas = $conn->query("SELECT * FROM tabel_kelas");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ruang Latihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


    <style>
        .mapel-card {
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            background-color: #fff;
        }

        .mapel-card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .mapel-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .mapel-name {
            font-weight: 600;
            font-size: 16px;
            color: #333;
        }

        @media (max-width: 576px) {
            .mapel-card {
                width: 100%;
            }
        }
    </style>
</head>

<body class="container py-4">

    <a href="dashboard_siswa.php" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
    </a>

    <h2 class="mb-4">📘 Ruang Latihan</h2>

    <label for="kelas">Pilih Kelas:</label>
    <select id="kelas" class="form-select w-100 w-md-50 mb-4">
        <option value="">-- Pilih Kelas --</option>
        <?php while ($k = $kelas->fetch_assoc()) : ?>
            <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
        <?php endwhile; ?>
    </select>

    <div id="mapelContainer" class="row g-3 mb-4"></div>
    <div id="latihanContainer" class="row g-3"></div>

    <script>
        function getIcon(nama) {
            nama = nama.toLowerCase();
            if (nama.includes("fisika")) return "⚛️";
            if (nama.includes("kimia")) return "🧪";
            if (nama.includes("matematika")) return "➗";
            if (nama.includes("biologi")) return "🧬";
            if (nama.includes("bahasa")) return "📝";
            if (nama.includes("geografi")) return "🌍";
            if (nama.includes("ekonomi")) return "💰";
            if (nama.includes("sosiologi")) return "👥";
            return "📚";
        }

        const kelasSelect = document.getElementById("kelas");
        const mapelContainer = document.getElementById("mapelContainer");
        const latihanContainer = document.getElementById("latihanContainer");

        kelasSelect.addEventListener("change", () => {
            const idKelas = kelasSelect.value;
            mapelContainer.innerHTML = "";
            latihanContainer.innerHTML = "";

            if (!idKelas) return;

            fetch("get_mapel.php?id_kelas=" + idKelas)
                .then(res => res.json())
                .then(mapelList => {
                    if (mapelList.length === 0) {
                        mapelContainer.innerHTML = "<p>Tidak ada mata pelajaran.</p>";
                        return;
                    }

                    mapelList.forEach(mapel => {
                        const col = document.createElement("div");
                        col.className = "col-6 col-md-3";
                        col.innerHTML = `
                            <div class="mapel-card" data-id-mapel="${mapel.id_mapel}">
                                <div class="mapel-icon">${getIcon(mapel.nama_mapel)}</div>
                                <div class="mapel-name">${mapel.nama_mapel}</div>
                            </div>
                        `;

                        col.querySelector('.mapel-card').addEventListener("click", () => {
                            latihanContainer.innerHTML = `<p class="text-muted">Loading latihan untuk ${mapel.nama_mapel}...</p>`;

                            fetch("get_latihan.php?id_mapel=" + mapel.id_mapel)
                                .then(res => res.json())
                                .then(latihanList => {
                                    if (latihanList.length === 0) {
                                        latihanContainer.innerHTML = `<p class="text-muted">Belum ada latihan untuk ${mapel.nama_mapel}.</p>`;
                                        return;
                                    }

                                    let html = "";
                                    latihanList.forEach(latihan => {
                                        html += `
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="card h-100 shadow-sm">
                                                    <div class="card-body d-flex flex-column">
                                                        <h5 class="card-title">${latihan.judul_latihan}</h5>
                                                        <p class="card-text flex-grow-1">${latihan.isi_text.substring(0, 100)}...</p>
                                                        <a href="#" class="btn btn-outline-primary mt-auto">Kerjakan</a>
                                                    </div>
                                                </div>
                                            </div>`;
                                    });

                                    latihanContainer.innerHTML = html;
                                })
                                .catch(err => {
                                    latihanContainer.innerHTML = "<p>Gagal memuat latihan.</p>";
                                    console.error(err);
                                });
                        });

                        mapelContainer.appendChild(col);
                    });
                })
                .catch(err => {
                    mapelContainer.innerHTML = "<p>Gagal memuat mapel.</p>";
                    console.error(err);
                });
        });
    </script>
</body>

</html>