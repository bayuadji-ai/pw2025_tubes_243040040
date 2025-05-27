<?php
$conn = new mysqli("localhost", "root", "", "edge_academy");
$kelas = $conn->query("SELECT * FROM tabel_kelas");
?>

<label>Pilih Kelas:</label>
<select id="kelas" name="kelas">
    <option value="">-- Pilih Kelas --</option>
    <?php while ($k = $kelas->fetch_assoc()): ?>
        <option value="<?= $k['id_kelas'] ?>"><?= $k['nama_kelas'] ?></option>
    <?php endwhile; ?>
</select>

<div id="daftar_mapel" style="margin-top:20px;">
    <!-- Tombol mapel akan muncul di sini -->
</div>

<div id="daftar_materi" style="margin-top:20px;">
    <!-- Materi akan tampil di sini -->
</div>

<script>
    document.getElementById("kelas").addEventListener("change", function() {
        let id_kelas = this.value;
        let container = document.getElementById("daftar_mapel");
        let materiContainer = document.getElementById("daftar_materi");
        materiContainer.innerHTML = ""; // Clear materi jika kelas ganti

        if (!id_kelas) {
            container.innerHTML = "";
            return;
        }

        fetch("get_mapel.php?id_kelas=" + id_kelas)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    container.innerHTML = "<p>Tidak ada mata pelajaran untuk kelas ini.</p>";
                    return;
                }

                let html = "";
                data.forEach(mapel => {
                    html += `<button class="btn-mapel" data-id="${mapel.id_mapel}" style="margin:5px;">${mapel.nama_mapel}</button>`;
                });
                container.innerHTML = html;

                // Pasang event click ke semua tombol mapel
                document.querySelectorAll(".btn-mapel").forEach(btn => {
                    btn.addEventListener("click", function() {
                        let id_mapel = this.getAttribute("data-id");
                        fetch("get_materi.php?id_mapel=" + id_mapel)
                            .then(res => res.json())
                            .then(materi => {
                                if (materi.length === 0) {
                                    materiContainer.innerHTML = "<p>Belum ada materi untuk mata pelajaran ini.</p>";
                                    return;
                                }

                                let output = "<h3>Daftar Materi:</h3><ul>";
                                materi.forEach(item => {
                                    output += `<li><strong>${item.judul_materi}</strong></li>`;
                                });
                                output += "</ul>";
                                materiContainer.innerHTML = output;
                            });
                    });
                });
            });
    });
</script>