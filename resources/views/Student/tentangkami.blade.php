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

      @media (max-width: 576px) {
        .card-body table {
          font-size: 0.85rem;
        }

        .card-header {
          font-size: 1rem;
          text-align: center;
        }

        .alert {
          font-size: 0.9rem;
          text-align: center;
        }

        footer small {
          font-size: 0.75rem;
        }

        .hero-section {
          height: 35vh !important;
        }

        .navbar-brand span {
          font-size: 0.9rem;
        }

        .motivasi {
          font-size: 0.85rem;
          margin: 10px 15px;
        }

        .table th, .table td {
          white-space: nowrap;
        }
      }
    </style>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="gambar/Logosmk.gif" alt="Logo Sekolah" />
          <span class="fw-bold text-black">DisipliNote</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item"><a class="nav-link fw-bold" href="/tampilans.html">Home</a></li>
            <li class="nav-item"><a class="nav-link fw-bold active" href="/tentangk.html">Tentang Kami</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="/riwayat.html">Pelanggaran</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                {{-- <img src="img/hd nya bund.jpeg" class="rounded-circle me-2" width="40" height="40" alt="User" /> --}}
                {{-- <span class="fw-semibold">Vii</span> --}}
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="profilesiswa.html"><i class="fas fa-user me-2"></i>Profil</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container py-5">
        <div class="text-center mb-4">
          <h2 class="fw-bold">Tentang DisipliNote</h2>
          <p class="text-muted">Menciptakan budaya disiplin di lingkungan sekolah melalui teknologi.</p>
        </div>
      
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="card border-0 shadow rounded-4 p-4">
              <p>
                <strong>DisipliNote</strong> adalah sistem informasi yang dikembangkan untuk membantu pihak sekolah dalam mencatat, memantau, dan memberikan laporan terkait pelanggaran siswa secara digital. 
                Sistem ini bertujuan untuk meningkatkan transparansi, efisiensi, dan kedisiplinan di lingkungan sekolah.
              </p>
              <p>
                Dengan fitur yang mudah digunakan oleh siswa, guru, dan staf sekolah, kami berharap DisipliNote menjadi solusi cerdas untuk mendukung pembinaan karakter dan budaya positif di sekolah.
              </p>
              <!-- <p class="mb-0"><strong>Salam disiplin,</strong><br>Tim Admin Staf SMK 💼</p> -->
            </div>
          </div>
        </div>
      </div>
      
      <!-- <div class="container mb-5">
        <h3 class="text-center mb-4">Team</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-">
          <div class="col">
            <div class="">
              <img src="img/ken.jpg" class="" alt="Foto 1" style="width: 200px;border-radius: 20px;">
            </div>
          </div>
          <div class="col">
            <div class="">
              <img src="img/ken.jpg" class="card-img-top" alt="Foto 2" style="width: 200px;border-radius: 20px;">
            </div>
          </div>
          <div class="col">
            <div class="">
              <img src="img/ken.jpg" class="card-img-top" alt="Foto 3" style="width: 200px;border-radius: 20px;">
            </div>
          </div>
          <div class="col">
            <div class="">
              <img src="img/ken.jpg" class="card-img-top" alt="Foto 4" style="width: 200px;border-radius: 20px;">
            </div>
          </div>
        </div>
      </div> -->
      

    <footer class="text-center py-3 border-top">
      <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with ❤</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>