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
    <style>
        .mapel-container {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .mapel-card {
            width: 120px;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .mapel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
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
    </style>
</head>
<body class="container py-4">
    <h2>Pilih Kelas - Ruang Latihan</h2>

    <label for="kelas">Kelas:</label>
    <select id="kelas" class="form-select w-50 mb-3">
        <option value="">-- Pilih Kelas --</option>
        <?php while ($k = $kelas->fetch_assoc()) : ?>
            <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
        <?php endwhile; ?>
    </select>

    <div id="mapelContainer" class="mapel-container"></div>
    <div id="latihanContainer" class="mt-4"></div>

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
                        const card = document.createElement("div");
                        card.className = "mapel-card";
                        card.innerHTML = `
                            <div class="mapel-icon">${getIcon(mapel.nama_mapel)}</div>
                            <div class="mapel-name">${mapel.nama_mapel}</div>
                        `;

                        card.addEventListener("click", () => {
                            latihanContainer.innerHTML = <p>Loading latihan untuk ${mapel.nama_mapel}...</p>;

                            fetch("get_latihan.php?id_mapel=" + mapel.id_mapel)
                                .then(res => res.json())
                                .then(latihanList => {
                                    if (latihanList.length === 0) {
                                        latihanContainer.innerHTML = <p>Belum ada latihan untuk ${mapel.nama_mapel}.</p>;
                                        return;
                                    }

                                    let html = "";
                                    latihanList.forEach(latihan => {
                                        html += `
                                            <div class="col-md-4">
                                                <div class="card mb-3 shadow-sm">
                                                    <div class="card-body">
                                                        <h5 class="card-title">${latihan.judul_latihan}</h5>
                                                        <p class="card-text">${latihan.isi_text.substring(0, 100)}...</p>
                                                        <a href="#" class="btn btn-primary btn-sm">Kerjakan</a>
                                                    </div>
                                                </div>
                                            </div>`;
                                    });

                                    latihanContainer.innerHTML = <div class="row">${html}</div>;
                                })
                                .catch(err => {
                                    latihanContainer.innerHTML = "<p>Gagal memuat latihan.</p>";
                                    console.error(err);
                                });
                        });

                        mapelContainer.appendChild(card);
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