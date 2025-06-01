<?php
// Koneksi DB dan ambil kelas
$conn = new mysqli("localhost", "root", "", "edge_academy");
$kelas = $conn->query("SELECT * FROM tabel_kelas");
?>

<label for="kelas">Pilih Kelas:</label>
<select id="kelas">
    <option value="">-- Pilih Kelas --</option>
    <?php while ($k = $kelas->fetch_assoc()) : ?>
        <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
    <?php endwhile; ?>
</select>

<div id="mapelContainer" class="mapel-container"></div>
<div id="materiContainer" style="margin-top:20px;"></div>

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
        box-shadow: 0 2px 5px rgb(0 0 0 / 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .mapel-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgb(0 0 0 / 0.15);
    }

    .mapel-icon {
        font-size: 40px;
        margin-bottom: 10px;
        color: #3498db;
    }

    .mapel-name {
        font-weight: 600;
        font-size: 16px;
        color: #333;
    }
</style>

<script>
    // Fungsi untuk dapat icon (bisa kamu ganti pakai gambar juga)
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
        return "📚"; // default icon
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
            .then((res) => res.json())
            .then((mapelList) => {
                if (mapelList.length === 0) {
                    mapelContainer.innerHTML = "<p>Tidak ada mata pelajaran untuk kelas ini.</p>";
                    return;
                }

                mapelList.forEach((mapel) => {
                    const card = document.createElement("div");
                    card.className = "mapel-card";

                    card.innerHTML = `
            <div class="mapel-icon">${getIcon(mapel.nama_mapel)}</div>
            <div class="mapel-name">${mapel.nama_mapel}</div>
          `;

                    card.addEventListener("click", () => {
                        materiContainer.innerHTML = "<p>Loading materi...</p>";

                        fetch("get_materi.php?id_mapel=" + mapel.id_mapel)
                            .then((res) => res.json())
                            .then((materiList) => {
                                if (materiList.length === 0) {
                                    materiContainer.innerHTML = "<p>Belum ada materi untuk mapel ini.</p>";
                                    return;
                                }
                                let html = "<h4>Materi:</h4><ul>";
                                materiList.forEach((materi) => {
                                    html += `<li>${materi.judul_materi}</li>`;
                                });
                                html += "</ul>";
                                materiContainer.innerHTML = html;
                            });
                    });

                    mapelContainer.appendChild(card);
                });
            });
    });
</script>