<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Staf - Pelanggaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5f5f5;
      overflow-x: hidden;
    }

    .navbar-top {
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      padding: 10px 20px;
      margin-left: 250px;
      z-index: 1000;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      background: #f8f9fa;
      padding: 20px;
      top: 0;
      left: 0;
    }

    .sidebar img {
      max-width: 80px;
      margin: 0 auto;
      display: block;
    }

    .sidebar h5 {
      text-align: center;
      margin-top: 10px;
      color: #007bff;
      font-size: 16px;
    }

    .sidebar .nav-link {
      color: #333;
      font-weight: 500;
      padding: 8px;
      font-size: 14px;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background: #007bff;
      color: white;
      border-radius: 5px;
    }

    .content {
      margin-left: 250px;
      padding: 30px;
      max-width: 900px;
    }

    .card-siswa {
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 20px;
      border-radius: 12px;
      background-color: #fff;
      border: 1px solid #ddd;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .card-siswa img {
      max-width: 100px;
      border-radius: 10px;
    }

    .card-siswa .info p {
      margin: 4px 0;
      font-size: 14px;
    }

    .form-control, .form-select {
      font-size: 14px;
    }

    label {
      font-size: 13px;
      font-weight: 500;
    }

    .mobile-nav {
      display: none;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .navbar-top,
      .content {
        margin-left: 0;
        padding: 20px;
      }

      form {
        margin-bottom: 90px; /* Biar ga ketutupan nav bawah */
      }

      .mobile-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        border-top: 1px solid #ddd;
        display: flex;
        justify-content: space-around;
        padding: 8px 0;
        z-index: 1050;
      }

      .mobile-nav a {
        text-align: center;
        color: #555;
        font-size: 11px;
        text-decoration: none;
        flex: 1;
      }

      .mobile-nav a i {
        font-size: 16px;
        display: block;
      }

      .mobile-nav a.active {
        color: #007bff;
      }

      .card-siswa {
        flex-direction: column;
        align-items: flex-start;
      }

      .card-siswa img {
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>

    <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="background-color: #f4f6f8;">
            <div class="modal-header">
              <h5 class="modal-title" id="profilModalLabel">Profil Pengguna</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                @if(Auth::user()->foto)
                {{-- <img src="{{ asset('storage/foto_user/' . Auth::user()->foto) }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;"> --}}
                <img src="{{ Auth::user()->foto ? asset('storage/foto_user/' . Auth::user()->foto) : asset('img/profile-admin.png') }}" alt="Foto Profil" class="rounded-circle mb-3" width="100" height="100">
                @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 100px; height: 100px; font-size: 40px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
              <h5>{{ Auth::user()->name }}</h5>
              <p class="text-muted">{{ ucfirst(Auth::user()->role) }}</p>
              <hr>
              <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
              <p><strong>No HP:</strong> {{ Auth::user()->nohp }}</p>
              <p><strong>Alamat:</strong> {{ Auth::user()->address }}</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('staff.profile.edit', Auth::user()->id) }}" class="btn btn-primary">Edit Profil</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>

<!-- Navbar Top -->
<nav class="navbar-top d-flex justify-content-between align-items-center">
  <h4 class="my-2">Monitoring Pelanggaran</h4>
  <div class="dropdown">
    <button class="btn btn-white d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
        {{-- <img src="{{ Auth::user()->foto ? asset('storage/foto_user/' . Auth::user()->foto) : asset('img/profile-admin.png') }}" alt="Admin" class="rounded-circle me-2" width="40" height="40"> --}}
        @if(Auth::user()->foto)
        {{-- <img src="{{ asset('storage/foto_user/' . Auth::user()->foto) }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;"> --}}
        <img src="{{ Auth::user()->foto ? asset('storage/foto_user/' . Auth::user()->foto) : asset('img/profile-admin.png') }}" alt="Admin" class="rounded-circle me-2" width="40" height="40">
    @else
        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 20px;">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    @endif

    </button>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profilModal">
              <i class="fas fa-user"></i> Profil
            </button>
          </li>
        <li><a class="dropdown-item text-danger" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>
</nav>

<!-- Sidebar -->
<nav class="sidebar d-none d-md-block">
  <div class="text-center mb-3">
    <img src="/gambar/images.png" alt="Logo Sekolah">
    <h5>ADMIN STAF</h5>
  </div>
  <ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link" href="/dashboardStaff"><i class="fas fa-home"></i> Dashboard</a></li>
    <li class="nav-item"><a class="nav-link" href="/daftarSiswa"><i class="fas fa-list"></i> Daftar Siswa</a></li>
    <li class="nav-item"><a class="nav-link active" href="/daftarPelanggaran"><i class="fas fa-exclamation-circle"></i> Pelanggaran</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('staff.profile.edit', Auth::user()->id) }}"><i class="fas fa-cog"></i> Pengaturan</a></li>
  </ul>
</nav>

<!-- Mobile Nav -->
<div class="mobile-nav d-md-none">
  <a href="/dashboardStaff"><i class="fas fa-home"></i>Dashboard</a>
  <a href="/daftarSiswa"><i class="fas fa-list"></i>Siswa</a>
  <a href="/daftarPelanggaran" class="active"><i class="fas fa-exclamation-circle"></i>Pelanggaran</a>
  <a href="/pengaturan"><i class="fas fa-cog"></i>Setting</a>
</div>

<!-- Content -->
<div class="content">
    <form action="{{ route('naik.kelas') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="periode" class="form-label">Periode / Tahun Ajaran</label>
            <input type="text" name="periode" class="form-control" placeholder="2024/2025" required>
        </div>
    
        <div class="mb-3">
            <label for="kelas_asal" class="form-label">Kelas lama</label>
            <select name="kelas_lama_id" class="form-control" required>
                @foreach($daftarKelas as $kelas)
                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
            @endforeach            
            </select>
        </div>
    
        <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas baru</label>
            <select name="kelas_id" class="form-control" required>
                @foreach($daftarKelas as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
    
        <button type="submit" class="btn btn-success">Naikkan Semua Siswa</button>
    </form>
    
    

</div>

<script>
  function previewFoto(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  document.querySelector('select[name="pelanggaran_id"]').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const point = selected.getAttribute('data-point');

    document.getElementById('point').value = point || '';
  });

</script>

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
