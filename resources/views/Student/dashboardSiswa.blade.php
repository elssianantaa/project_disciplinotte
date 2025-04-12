<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />

    <style>
      body {
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        padding-top: 80px;
      }

      .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background-color: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      }

      .navbar-brand img {
        height: 40px;
        margin-right: 10px;
      }

      .hero-section {
        position: relative;
        height: 60vh;
        border-radius: 2rem;
        box-shadow: inset 0 -80px 60px -40px rgba(0, 0, 0, 0.4);
      }

      .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 2rem;
      }

      .carousel-indicators [data-bs-target] {
        background-color: #000;
      }

      .motivasi {
        margin-top: 20px;
        text-align: center;
        font-size: 0.9rem;
        color: #333;
        /* font-weight: 500; */
      }

      @media (max-width: 768px) {
        .hero-section {
          height: 40vh;
        }

        .motivasi {
          font-size: 0.95rem;
          margin: 15px 20px;
        }

        .navbar-brand span {
          font-size: 1rem;
        }
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="img/Logo smk-2.gif" alt="Logo Sekolah" />
          <span class="fw-bold text-black">DisipliNote</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item"><a class="nav-link fw-bold active" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="#tentang">Tentang Kami</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="#pelanggaran">Pelanggaran</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                <img src="img/hd nya bund.jpeg" class="rounded-circle me-2" width="40" height="40" alt="User" />
                <span class="fw-semibold">Vii</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profilesiswa.html"><i class="fas fa-user me-2"></i>Profil</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Carousel -->
    <div class="container my-4">
      <div id="heroCarousel" class="carousel slide rounded-4 overflow-hidden shadow" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="hero-section" style="background: url('img/bk.jpg') no-repeat center center / cover;">
              <div class="hero-overlay"></div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="hero-section" style="background: url('img/s.jpg') no-repeat center center / cover;">
              <div class="hero-overlay"></div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        </div>
      </div>

      <!-- Tulisan Motivasi (di bawah slider) -->
      <div class="motivasi">
        <i class="fas  me-2"></i>
        -Mulailah hari dengan kebiasaan baik dengan datang tepat waktu-
        <!-- , lengkap seragam, siap belajar! 📚 -->
      </div>
    </div>
    <section class="py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-7">
            <h4 class="fw-bold mb-3">Peringatan Untuk Siswa</h4>
            <p class="text-dark fs-5">
              Kamu sudah melanggar beberapa peraturan sekolah. Mohon untuk lebih disiplin agar tidak mendapatkan sanksi lanjutan.
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam ut eveniet ab amet similique tempore cupiditate necessitatibus dignissimos? Fugit, dicta?
            </p>
          </div>
          <div class="col-md-5 text-center mt-4 mt-md-0">
            <img src="img/images (1).jpeg" alt="Pelanggaran" class="img-fluid shadow rounded-4" style="max-height: 300px;" />
          </div>
        </div>
      </div>
    </section>
    

    <!-- Riwayat Pelanggaran -->
    <div class="card mb-5 shadow-sm" style="margin-left: 96px; margin-right: 96px;">
      <div class="card-header bg-primary text-white">
        Riwayat Pelanggaran
      </div>
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
                <th>Jenis Pelanggaran</th>
                <th>Skor</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>Tidak Menggunakan Seragam</td>
                <td>20</td>
                <td>Tanpa jas almamater</td>
                <td>03-04-2025</td>
            </tr>
            <tr>
                <td>Merokok</td>
                <td>45</td>
                <td>Kantin belakang sekolah</td>
                <td>01-04-2025</td>
            </tr>
            <tr>
                <td>Terlambat Masuk</td>
                <td>10</td>
                <td>Datang pukul 07:45</td>
                <td>05-04-2025</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
            <div class="alert alert-warning" role="alert" style="margin-left: 96px; margin-right: 96px;">
              <!-- <h5 class="fw-bold">Peringatan:</h5> -->
              Kamu telah mencapai skor pelanggaran <strong>30</strong> poin. Jika melanggar lagi, kamu akan mendapatkan sanksi lebih berat! Mohon untuk lebih disiplin.
            </div>
          </div>

    <!-- Footer -->
    <footer class="text-center py-3 border-top">
      <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with ❤</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>