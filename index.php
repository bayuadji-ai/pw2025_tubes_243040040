<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EdgeAcademy - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .hero {
            background: #000c22;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero h1,
        .hero p.lead {
            color: white;
        }

        .hero-img {
            width: 400px;
            max-width: 100%;
            height: auto;
            border-radius: 1rem;
        }

        .feature-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .tentang {
            background-image: url('img/bg-tentang.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .tentang h2 {
            color: white;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .tentang p {
            color: white;
            background-color: rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">EdgeAcademy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-3" href="login.php">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-4">Selamat Datang di <span class="text-primary">EdgeAcademy</span></h1>
                    <p class="lead mb-4">
                        EdgeAcademy adalah platform belajar online untuk siswa SMA IPA dan IPS, menyediakan materi pelajaran dan latihan soal sesuai kurikulum. Kami hadir untuk membantu siswa belajar lebih mudah, mandiri, dan siap menghadapi ujian kapan saja, di mana saja.


                    </p>
                    <a href="registrasi.php" class="btn btn-outline-primary btn-lg">Daftar Sekarang</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="img/gambar_index.jpeg" alt="Ilustrasi Edukasi" class="hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Apa Yang Kami Berikan</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Materi Pembelajaran Terstruktur</h5>
                            <p class="card-text">Akses materi pelajaran IPA & IPS yang lengkap dan sesuai kurikulum nasional.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Latihan Soal interaktif</h5>
                            <p class="card-text">Ribuan soal latihan dengan pembahasan untuk menguji dan memperkuat pemahaman siswa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Kelas Berdasarkan Jurusan & Tingkat</h5>
                            <p class="card-text">Konten disesuaikan berdasarkan kelas(X,XI,XII) dan jurusan (IPA/IPS) agar lebih relevan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Rangkuman & Infografis</h5>
                            <p class="card-text">Ringkasan materi penting dan infografis visual untuk membantu siswa belajar lebih cepat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Navigasi Belajar Sederhana</h5>
                            <p class="card-text">Antarmuka yang dirancang simpel dan intuitif agar siswa dapat fokus belajar tanpa kebingungan teknis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Akses Fleksibel Kapan Saja</h5>
                            <p class="card-text">Belajar bisa dilakukan di mana saja dan kapan saja lewat perangkat dekstop atau mobile.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-5 tentang" style="background-image: url('img/sectionbg.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Tentang EdgeAcademy</h2>
            <p class="text-center mx-auto" style="max-width: 700px;">
                EdgeAcademy adalah platform edukasi untuk siswa SMA IPA dan IPS yang menyediakan materi pembelajaran dan latihan soal berdasarkan kelas dan jurusan. Siswa dapat memilih kelas, melihat mata pelajaran yang sesuai, lalu mengakses materi atau mengerjakan soal secara mandiri. Sistem akan menyesuaikan konten secara otomatis agar proses belajar lebih fokus dan terarah.

            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 shadow-sm mt-auto">
        <div class="container">
            <p class="mb-0 text-muted">&copy; 2025 EdgeAcademy | All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>