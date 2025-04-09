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
      margin: 0;
      padding: 0;
      min-height: 100vh;
      overflow-x: hidden;
      background-color: #f5f5f5;
    }

    .navbar-top {
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      padding: 10px 20px;
      z-index: 1000;
      margin-left: 250px;
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
      font-weight: bold;
      font-size: 16px;
    }

    .sidebar .nav-link {
      color: #333;
      font-weight: 500;
      border-radius: 5px;
      padding: 8px;
      font-size: 14px;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background: #007bff;
      color: white;
    }

    .content {
      margin-left: 250px;
      padding: 30px;
      max-width: 900px;
      padding-bottom: 130px;
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
      padding: 6px 10px;
    }

    label {
      font-size: 13px;
      font-weight: 500;
    }

    button {
      font-size: 14px;
      border-radius: 8px;
    }

    button:hover {
      background-color: #0056b3;
    }

    .mobile-nav {
      display: none;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .navbar-top, .content {
        margin-left: 0;
        padding: 20px;
      }

      .content {
        padding-bottom: 150px;
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
        text-align: left;
      }

      .card-siswa img {
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>

<!-- Navbar Top -->
<nav class="navbar-top d-flex justify-content-between align-items-center">
  <h4 class="my-2">Monitoring Pelanggaran</h4>
  <div class="dropdown">
    <button class="btn btn-light d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
      <img src="/img/profile-admin.png" alt="Admin" class="rounded-circle me-2" width="40" height="40">
      <i class="fas fa-caret-down ms-2"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item" href="pengaturan.html"><i class="fas fa-cog"></i> Pengaturan</a></li>
      <li><a class="dropdown-item text-danger" href="logout.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
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
    <li class="nav-item"><a class="nav-link" href="daftarsiswa.html"><i class="fas fa-list"></i> Daftar Siswa</a></li>
    <li class="nav-item"><a class="nav-link active" href="/daftarPelanggaran"><i class="fas fa-exclamation-circle"></i> Pelanggaran</a></li>
    <li class="nav-item"><a class="nav-link" href="pengaturan.html"><i class="fas fa-cog"></i> Pengaturan</a></li>
  </ul>
</nav>

<!-- Mobile Nav -->
<div class="mobile-nav d-md-none">
  <a href="/dashboardStaff"><i class="fas fa-home"></i>Dashboard</a>
  <a href="daftarsiswa.html"><i class="fas fa-list"></i>Siswa</a>
  <a href="/daftarPelanggaran" class="active"><i class="fas fa-exclamation-circle"></i>Pelanggaran</a>
  <a href="pengaturan.html"><i class="fas fa-cog"></i>Setting</a>
</div>

<!-- Content -->
<div class="content">
  <form action="{{ route('pelanggaran.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Card Siswa -->
    <div class="mb-4 card-siswa">
      <img src="{{ asset('storage/foto_siswa/' . $student->foto) }}" alt="Foto Siswa">
      <div class="info">
        <p><strong>NISN:</strong> {{ $student->nisn }}</p>
        <p><strong>Nama:</strong> {{ $student->name }}</p>
        <p><strong>Kelas:</strong> {{ $student->kelas->nama_kelas }}</p>
        <p><strong>Wali Kelas:</strong> {{ $student->kelas->wali_kelas }}</p>
      </div>
    </div>

    <!-- Form -->
    <div class="row g-4">
      <div class="col-md-6">
        {{-- <label class="form-label">Nama Pelanggaran</label>
        <select class="form-select" name="pelanggaran_id" required>
          <option value="" disabled selected>Pilih Pelanggaran</option>
          @foreach ($pelanggarans as $pelanggaran)
            <option value="{{ $pelanggaran->id }}">{{ $pelanggaran->nama_pelanggaran }}</option>
          @endforeach
        </select> --}}
        <input type="hidden" class="form-control" id="point" readonly>
        <input type="hidden" class="form-control" id="kategori" readonly>

      {{-- <div class="mb-3">
        <label for="pelanggaran_id" class="form-label">Nama Pelanggaran</label>
        <select class="form-select" name="pelanggaran_id" id="pelanggaran_id" required>
            <option disabled selected>Pilih Pelanggaran</option>
            @foreach($pelanggarans as $p)
                <option value="{{ $p->id }}"
                        data-kategori="{{ $p->kategori }}"
                        data-point="{{ $p->point }}">
                    {{ $p->nama_pelanggaran }}
                </option>
            @endforeach
        </select>
    </div> --}}

    <select class="form-select" name="pelanggaran_id" id="pelanggaran_id" required>
        <option disabled selected>Pilih Pelanggaran</option>
        @foreach($pelanggarans as $p)
            <option value="{{ $p['id'] }}"
                    data-kategori="{{ $p['kategori'] }}"
                    data-point="{{ $p['point'] }}">
                {{ $p['nama_pelanggaran'] }}
            </option>
        @endforeach
    </select>
    
      <input type="hidden" name="student_id" value="{{ $student->id }}">
      <input type="hidden" name="kelas_id" value="{{ $student->kelas->id }}">

        <label class="form-label mt-3">Tanggal</label>
        <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">Deskripsi</label>
        <input type="text" class="form-control" name="deskripsi" required>

        <label class="form-label mt-3">Foto Bukti</label>
        <input type="file" class="form-control" name="foto" accept="image/*" onchange="previewFoto(event)">
        <img id="preview" src="#" alt="Preview Foto" style="display:none; max-width:150px; margin-top:10px; border-radius:8px;">
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-6">
        <label class="form-label">Petugas (Staff)</label>
        <input type="text" class="form-control" value="{{ auth()->user()->name ?? 'Tidak diketahui' }}" readonly>
        <input type="hidden" name="staff_id" value="{{ auth()->user()->id }}">
      </div>
    </div>

    <div class="mt-4 d-flex gap-3">
      <button type="submit" class="btn btn-primary px-4">Simpan</button>
      <button type="button" class="btn btn-secondary px-4">Cancel</button>
    </div>
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
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>