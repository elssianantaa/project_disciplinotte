<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Dashboard Siswa')</title>

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

    @media (max-width: 768px) {
      .navbar-brand span {
        font-size: 1rem;
      }
    }
  </style>

  @stack('styles')
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('img/Logo smk-2.gif') }}" alt="Logo Sekolah" />
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
              <img src="{{ asset('img/hd nya bund.jpeg') }}" class="rounded-circle me-2" width="40" height="40" alt="User" />
              <span class="fw-semibold">{{ Auth::user()->name ?? 'Siswa' }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/student/profile"><i class="fas fa-user me-2"></i>Profil</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="text-center py-3 border-top mt-5">
    <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with ❤</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
