<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Staf - Pengaturan</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .wrapper {
      display: flex;
      flex: 1;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      background: #f8f9fa;
      padding: 20px;
      position: fixed;
    }

    .sidebar img {
      max-width: 100px;
      display: block;
      margin: 0 auto;
    }

    .sidebar h5 {
      text-align: center;
      margin-top: 10px;
      color: #007bff;
      font-weight: bold;
    }

    .sidebar .nav-link {
      color: #333;
      font-weight: 500;
      border-radius: 5px;
    }

    .sidebar .nav-link:hover {
      background: #e9ecef;
    }

    .sidebar .nav-link.active {
      background: #007bff;
      color: white;
    }

    .content {
      flex-grow: 1;
      margin-left: 270px;
      padding: 20px;
    }

    .navbar {
      width: calc(100% - 250px);
      margin-left: 250px;
      background: white;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      top: 0;
      z-index: 1000;
    }

    footer {
      background: #f8f9fa;
      padding: 15px;
      text-align: center;
      font-size: 14px;
      border-top: 1px solid #ddd;
      margin-left: 250px;
      width: calc(100% - 250px);
      position: fixed;
      bottom: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .navbar {
        width: 100%;
        margin-left: 0;
      }

      .content {
        margin-left: 0;
        padding-bottom: 80px;
      }

      footer {
        display: none;
      }

      .mobile-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        border-top: 1px solid #ddd;
        display: flex;
        justify-content: space-around;
        padding: 8px 0;
        z-index: 1050;
      }

      .mobile-nav a {
        flex: 1;
        text-align: center;
        color: #555;
        text-decoration: none;
        font-size: 11px;
      }

      .mobile-nav a i {
        display: block;
        font-size: 16px;
      }

      .mobile-nav a.active {
        color: #007bff;
      }
    }
  </style>
</head>
<body>

  <!-- Modal Profil -->
  <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content" style="background-color: #f4f6f8;">
        <div class="modal-header">
          <h5 class="modal-title">Profil Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body text-center">
          <img src="{{ Auth::user()->foto ? asset('storage/foto_user/' . Auth::user()->foto) : asset('img/profile-admin.png') }}" class="rounded-circle mb-3" width="100" height="100">
          <h5>{{ Auth::user()->name }}</h5>
          <p class="text-muted">{{ ucfirst(Auth::user()->role) }}</p>
          <hr>
          <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
          <p><strong>No HP:</strong> {{ Auth::user()->nohp }}</p>
          <p><strong>Alamat:</strong> {{ Auth::user()->address }}</p>
        </div>
        <div class="modal-footer">
          <a href="/pengaturan" class="btn btn-primary">Edit Profil</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar">
    <h4 class="my-2">Pengaturan</h4>
    <div class="dropdown">
      <button class="btn btn-light d-flex align-items-center border-0" data-bs-toggle="dropdown">
        <img src="{{ Auth::user()->foto ? asset('storage/foto_user/' . Auth::user()->foto) : asset('img/profile-admin.png') }}" class="rounded-circle me-2" width="40" height="40">
        <span class="fw-bold">{{ Auth::user()->name }}</span>
        <i class="fas fa-caret-down ms-2"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profilModal">
            <i class="fas fa-user"></i> Profil
          </button>
        </li>
        <li>
          <a class="dropdown-item text-danger" href="/logout">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="wrapper">
    <!-- Sidebar -->
    <nav class="sidebar d-none d-md-block">
      <div class="text-center mb-3">
        <img src="/gambar/images.png" alt="Logo Sekolah">
        <h5>ADMIN STAF</h5>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="/dashboardStaff"><i class="fas fa-home"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="/daftarSiswa"><i class="fas fa-list"></i> Daftar Siswa</a></li>
        <li class="nav-item"><a class="nav-link" href="/daftarPelanggaran"><i class="fas fa-exclamation-circle"></i> Pelanggaran</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('staff.profile.edit', Auth::user()->id) }}"><i class="fas fa-cog"></i> Pengaturan</a></li>
      </ul>
    </nav>

    <!-- Content -->
    <div class="content container" style="margin-top: 80px; margin-bottom: 80px;">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
              <div class="card-body px-4 py-4">
                <h4 class="text-center mb-4 fw-semibold">Edit Profil</h4>
                <form action="{{ route('staff.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
      
                  <!-- Foto -->
                  <div class="text-center mb-4">
                    @if (Auth::user()->foto)
                      <img src="{{ asset('storage/foto_user/' . Auth::user()->foto) }}" class="rounded-circle shadow-sm" width="100" height="100" style="object-fit: cover;">
                    @else
                      <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 100px; height: 100px; font-size: 32px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                      </div>
                    @endif
                  </div>
      
                  <!-- Input -->
                  <div class="mb-3">
                    <label for="name" class="form-label small fw-semibold">Nama</label>
                    <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                  </div>
      
                  <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold">Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                  </div>
      
                  <div class="mb-3">
                    <label for="nohp" class="form-label small fw-semibold">Nomor HP</label>
                    <input type="text" class="form-control form-control-sm" name="nohp" value="{{ old('nohp', Auth::user()->nohp) }}" required>
                  </div>
      
                  <div class="mb-3">
                    <label for="address" class="form-label small fw-semibold">Alamat</label>
                    <textarea class="form-control form-control-sm" name="address" rows="2" required>{{ old('address', Auth::user()->address) }}</textarea>
                  </div>
      
                  <div class="mb-4">
                    <label for="foto" class="form-label small fw-semibold">Foto Profil</label>
                    <input type="file" class="form-control form-control-sm" name="foto">
                  </div>
      
                  <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      


  </div>

  <!-- Mobile Bottom Nav -->
  <div class="mobile-nav d-md-none">
    <a href="/dashboardStaff"><i class="fas fa-home"></i><span>Dashboard</span></a>
    <a href="/daftarSiswa"><i class="fas fa-list"></i><span>Siswa</span></a>
    <a href="/daftarPelanggaran"><i class="fas fa-exclamation-circle"></i><span>Pelanggaran</span></a>
    <a href="/pengaturan" class="active"><i class="fas fa-cog"></i><span>Setting</span></a>
  </div>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
