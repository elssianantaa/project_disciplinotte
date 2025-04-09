<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Staf - Pelanggaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

<style>
   body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
  .card-siswa {
    max-width: 600px;
    width: 100%;
    border: 1px solid #ddd;
    padding: 16px;
    border-radius: 12px;
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  }
  .card-siswa img {
    border-radius: 10px;
    max-width: 120px;
  }
  .card-siswa .info p {
    margin: 4px 0;
    font-size: 14px;
    color: #444;
  }
  .card-siswa .info p strong {
    color: #222;
  }
</style>

  <style>
    body {
      overflow-x: hidden;
    }
    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      background: #f8f9fa;
      padding: 20px;
    }
    .sidebar img {
      max-width: 80px;
      display: block;
      margin: 0 auto;
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
    }
    .form-control, .form-select {
      font-size: 14px;
      padding: 6px 10px;
    }
    label {
      font-size: 13px;
    }
    button {
      font-size: 14px;
      border-radius: 8px;
      transition: 0.3s;
    }
    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

    <nav class="d-flex justify-content-between align-items-center px-4 py-2 shadow-sm bg-white" style="margin-left: 260px;">
        <h4 class="my-2">Monitoring Pelanggaran</h4>
        <div class="dropdown">
            <button class="btn btn-light d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
                <img src="/img/profile-admin.png" alt="Admin" class="rounded-circle me-2" width="40" height="40">
                <span class="fw-bold"> {{ Auth::user()->name }}</span>
                <i class="fas fa-caret-down ms-2"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="pengaturan.html"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li><a class="dropdown-item text-danger" href="logout.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </nav>

  <!-- Sidebar -->
  <nav class="sidebar">
    <div class="text-center mb-3">
        <img src="/gambar/images.png" alt="Logo Sekolah">
        <h5>ADMIN STAF</h5>
    </div>
    
    <ul class="nav flex-column" id="sidebar">
        <li class="nav-item">
            <a class="nav-link" href="/dashboardStaff">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="user.html">
                <i class="fas fa-user"></i> Users
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="daftarsiswa.html">
                <i class="fas fa-list"></i> Daftar Siswa
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/daftarPelanggaran">
                <i class="fas fa-exclamation-circle"></i> Pelanggaran
            </a>
        </li>
      
        <li class="nav-item">
            <a class="nav-link" href="pengaturan.html">
                <i class="fas fa-cog"></i> Pengaturan
            </a>
        </li>
    </ul>
</nav>

  <!-- Konten -->
  <div class="content">
    <form action="{{ route('pelanggaran.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Preview Foto -->
      <div class="mb-4">
        <label class="form-label fw-bold">Foto Siswa</label>
        <div class="d-flex align-items-center gap-4 card-siswa">
          <img src="{{ asset('storage/foto_siswa/' . $student->foto) }}" alt="Foto Siswa" class="img-thumbnail">
          <div class="info">
            <p><strong>NISN:</strong> {{ $student->nisn }}</p>
            <p><strong>Nama:</strong> {{ $student->name }}</p>
            <p><strong>Kelas:</strong> {{ $student->kelas->nama_kelas }}</p>
            <p><strong>Wali Kelas:</strong> {{ $student->kelas->wali_kelas }}</p>
          </div>
        </div>
      </div>
      
      

      <!-- Form Pelanggaran -->
<div class="row g-4">
    <!-- Kolom Kiri -->
    <div class="col-md-6">
      {{-- <div class="mb-3">
        <label for="pelanggaran" class="form-label">Nama Pelanggaran</label>
        <select class="form-select" id="pelanggaran" name="pelanggaran_id" required>
          <option value="" disabled selected>Pilih Pelanggaran</option>
          @foreach ($pelanggarans as $pelanggaran)
            <option value="{{ $pelanggaran->id }}">{{ $pelanggaran->nama_pelanggaran }}</option>
          @endforeach
        </select>
      </div> --}}

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

      <input type="hidden" class="form-control" id="point" readonly>
      <input type="hidden" class="form-control" id="kategori" readonly>
  
      <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}">
      </div>
    </div>
  
    <!-- Kolom Kanan -->
    <div class="col-md-6">
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <input type="text" class="form-control" name="deskripsi" required>
      </div>
  
      <div class="mb-3">
        <label for="foto" class="form-label">Foto Bukti</label>
        <div class="d-flex align-items-center gap-3">
          {{-- <img id="preview" src="#" alt="Preview Foto" class="rounded shadow-sm" style="height: 90px; width: 100px; display: none;"> --}}
          <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewFoto(event)" style="max-width: 300px;">
        </div>
      </div>
        </div>
    </div>
  
    <!-- Baris Khusus untuk Staff -->
    <div class="row mt-2">
        <div class="col-md-6">
        <div class="mb-2">
            <label for="staff" class="form-label">Petugas (Staff)</label>
            <input type="text" class="form-control" name="staff" value="{{ auth()->user()->name ?? 'Tidak diketahui' }}" readonly>
            <input type="hidden" name="staff_id" value="{{ auth()->user()->id }}">
        </div>
        </div>
    </div>
  

      <!-- Tombol Aksi -->
      <div class="d-flex gap-3 mt-3">
        <button class="btn btn-primary px-5" type="submit">Simpan</button>
        <button class="btn btn-secondary px-5" type="button">Cancel</button>
      </div>
      

    </form>
  </div>

  <!-- Script -->
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

//   function setPointByKategori() {
//     const selectKategori = document.querySelector('select[name="Kategori"]');
//     const pointField = document.querySelector('input[name="point"]');
//     const kategori = selectKategori.value;
//     const point = kategori === "Ringan" ? 10 : kategori === "Sedang" ? 15 : kategori === "Berat" ? 20 : 0;
//     pointField.value = point;
//   }

//   // Set point saat kategori berubah
//   document.querySelector('select[name="Kategori"]').addEventListener('change', setPointByKategori);

//   // Set point saat halaman pertama kali dimuat
//   window.addEventListener('DOMContentLoaded', setPointByKategori);
document.getElementById('pelanggaran_id').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        document.getElementById('Kategori').value = selected.getAttribute('data-kategori');
        document.getElementById('point').value = selected.getAttribute('data-point');
    });
</script>



</body>
</html>
