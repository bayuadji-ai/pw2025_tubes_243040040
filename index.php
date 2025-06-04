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
                        Platform pembelajaran interaktif yang dirancang untuk siswa, guru, dan siapa pun yang ingin terus belajar. Temukan berbagai kursus, materi, dan fitur yang mendukung pembelajaran digital.
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
                            <h5 class="card-title">Kursus & Sertifikasi</h5>
                            <p class="card-text">Pelajari berbagai topik dan raih sertifikat resmi untuk menambah nilai kompetensimu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Materi Lengkap</h5>
                            <p class="card-text">Materi pembelajaran dari tingkat SD hingga SMA yang terus diperbarui sesuai kurikulum.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Forum Diskusi</h5>
                            <p class="card-text">Berdiskusi langsung dengan pelajar lain, bertanya dan berbagi ilmu dalam komunitas positif.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Kelas Virtual</h5>
                            <p class="card-text">Ruang interaktif bagi guru dan siswa untuk belajar secara daring dengan mudah dan nyaman.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Statistik Belajar</h5>
                            <p class="card-text">Pantau perkembanganmu lewat grafik belajar, skor ujian, dan aktivitas harian secara real-time.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Statistik Belajar</h5>
                            <p class="card-text">Pantau perkembanganmu lewat grafik belajar, skor ujian, dan aktivitas harian secara real-time.</p>
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
                EdgeAcademy adalah platform pembelajaran daring berbasis teknologi yang menyediakan sarana belajar interaktif, fleksibel, dan terjangkau untuk seluruh pelajar di Indonesia. Kami percaya bahwa pendidikan berkualitas harus bisa diakses siapa saja, di mana saja.
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