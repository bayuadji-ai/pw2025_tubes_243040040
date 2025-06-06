<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
$kelas = $conn->query("SELECT * FROM tabel_kelas");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ruang Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .mapel-card {
            width: 140px;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            background-color: #f8f9fa;
        }

        .mapel-card:hover {
            transform: scale(1.05);
        }

        .mapel-icon {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .mapel-name {
            font-weight: 600;
            font-size: 15px;
        }

        .materi-scroll-container {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 1rem;
            padding: 1rem 0;
        }

        .materi-scroll-container .card {
            flex: 0 0 auto;
            width: 18rem;
        }
    </style>
</head>

<body class="container py-4">


    <a href="dashboard_siswa.php" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Dashboard
    </a>

    <h2 class="mb-3">Pilih Kelas - RuangMateri</h2>
    <select id="kelas" class="form-select w-50 mb-4">
        <option value="">-- Pilih Kelas --</option>
        <?php while ($k = $kelas->fetch_assoc()) : ?>
            <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
        <?php endwhile; ?>
    </select>

    <div id="mapelContainer" class="d-flex flex-wrap gap-3 mb-4"></div>

    <div id="materiContainer"></div>

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
        const materiContainer = document.getElementById("materiContainer");

        kelasSelect.addEventListener("change", () => {
            const idKelas = kelasSelect.value;
            materiContainer.innerHTML = "";
            mapelContainer.innerHTML = "";

            if (!idKelas) return;

            fetch("get_mapel.php?id_kelas=" + idKelas)
                .then(res => res.json())
                .then(mapelList => {
                    if (mapelList.length === 0) {
                        mapelContainer.innerHTML = "<p>Tidak ada mapel untuk kelas ini.</p>";
                        return;
                    }

                    mapelList.forEach(mapel => {
                        const card = document.createElement("div");
                        card.className = "mapel-card";
                        card.innerHTML = `
                            <div class="mapel-icon">${getIcon(mapel.nama_mapel)}</div>
                            <div class="mapel-name">${mapel.nama_mapel}</div>
                        `;

                        card.addEventListener("click", () => {
                            materiContainer.innerHTML = `<p>Loading materi untuk <b>${mapel.nama_mapel}</b>...</p>`;
                            fetch("get_materi.php?id_mapel=" + mapel.id_mapel)
                                .then(res => res.json())
                                .then(materiList => {
                                    if (materiList.length === 0) {
                                        materiContainer.innerHTML = `<p>Belum ada materi untuk mapel ini.</p>`;
                                        return;
                                    }

                                    let html = "";
                                    materiList.forEach(materi => {
                                        html += `
                                            <div class="card" style="width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title">${materi.judul_materi}</h5>
                                                    <p class="card-text">${materi.isi_text.substring(0, 100)}...</p>
                                                    <a href="#" class="btn btn-primary">Lihat Detail</a>
                                                </div>
                                            </div>
                                    `;
                                    });

                                    html += '</div>';
                                    materiContainer.innerHTML = html;
                                    materiContainer.innerHTML = `<div class="materi-scroll-container">${html}</div>`;
                                })
                                .catch(err => {
                                    materiContainer.innerHTML = "<p>Gagal memuat materi.</p>";
                                    console.error(err);
                                });
                        });

                        mapelContainer.appendChild(card);
                    });
                })
                .catch(err => {
                    console.error("Fetch mapel error:", err);
                    mapelContainer.innerHTML = `<p>Gagal memuat mapel.</p>`;
                });
        });
    </script>
</body>

</html>