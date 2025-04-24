<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />


  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 150vh;
      background-color: #f1f3f5;
    }

    .profile-wrapper {
      margin-top: 120px;
      text-align: center;
    }

    .profile-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .profile-container {
      max-width: 550px;
      margin: 0 auto 40px auto;
      padding: 25px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      text-align: center; /* Tambahkan text-align center ke container */
    }

    .profile-img {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      border: 4px solid #dee2e6;
    }

    .profile-info-table {
      width: 100%;
      margin-top: 20px;
      text-align: center; /* Memastikan tabel rata tengah */
    }

    .profile-info-table th, .profile-info-table td {
      padding: 8px;
      vertical-align: middle;
    }

    .profile-info-table th {
      width: 120px;
      font-weight: 600;
      text-align: left;
    }

    .profile-info-table td {
      text-align: center; /* Meratakan teks nilai ke tengah */
    }

    .btn-edit {
      margin-top: 20px;
    }

    footer {
      background: #f8f9fa;
      padding: 15px;
      text-align: center;
      font-size: 14px;
      border-top: 1px solid #ddd;
      margin-top: auto;
    }

    @media (max-width: 600px) {
      .profile-title {
        font-size: 1.5rem;
      }

      .profile-container {
        margin: 0 15px 40px 15px;
        padding: 20px;
      }

      .profile-img {
        width: 100px;
        height: 100px;
      }
      .card {
  border-radius: 15px;
}
.card-title {
  font-size: 1.2rem;
}
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="gambar/Logosmk.gif" alt="Logo Sekolah" style="height: 40px; margin-right: 10px;" />
        <span class="fw-bold text-black">DisipliNote</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link fw-bold active" href="/dashboardSiswa">Home</a></li>
          <li class="nav-item"><a class="nav-link fw-bold" href="/daftarPelanggaranSiswa">Pelanggaran</a></li>
          <li class="nav-item"><a class="nav-link fw-bold" href="/tentangkami">Tentang Kami</a></li>
          <li class="nav-item d-flex align-items-center">
            @php
            $student = session('student');
            $fotoPath = $student && $student->foto ? 'storage/foto_profilesiswa/' . $student->foto : null;
          @endphp

          <li class="nav-item d-flex align-items-center me-2">
            @if($fotoPath && file_exists(public_path($fotoPath)))
              <img src="{{ asset($fotoPath) }}" alt="Foto Profil" class="rounded-circle me-2" width="40" height="40" />
            @else
              <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow"
                style="width: 40px; height: 40px; font-size: 18px;">
                {{ strtoupper(substr(optional($student)->name, 0, 1)) }}
            </div>
            @endif
          </li>

            <!-- Foto Profil atau Inisial -->

          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href=""><i class="fas fa-user me-2"></i>Profil</a></li>
              <li>
                <a class="dropdown-item" href="{{ route('updatePassword') }}">
                    <i class="bi bi-key"></i> Ubah Password
                </a>
            </li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container profile-wrapper">
    <div class="profile-title">Profil Siswa</div>
    <div class="profile-container">
      @php
        $student = session('student');
        $fotoPath = $student && $student->foto ? 'storage/foto_profilesiswa/' . $student->foto : null;
      @endphp

      @if($fotoPath && file_exists(public_path($fotoPath)))
        <img src="{{ asset($fotoPath) }}" alt="Foto Profil" class="profile-img">
      @else
        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow"
             style="width: 130px; height: 130px; font-size: 40px; margin: 0 auto 15px auto;">
             {{ strtoupper(substr(optional($student)->name, 0, 1)) }}
            </div>
      @endif

      <table class="table table-borderless profile-info-table">
        <tr>
            <td class="text-center"><strong>Nama:</strong> {{ optional(session('student'))->name }}</td>
        </tr>
        <tr>
          <td class="text-center"><strong>NISN:</strong> {{ session('student')->nisn }}</td>
        </tr>
        <tr>
          <td class="text-center"><strong>Kelas:</strong> {{ session('student')->kelas->nama_kelas }}</td>
        </tr>
      </table>
     
      <div class="row justify-content-center mt-3 mb-4">
        <div class="col-12 col-md-5 mb-2">
            <a href="{{ route('siswa.riwayat') }}" class="text-decoration-none h-100 d-block">
                <div class="card border-danger shadow-sm h-100" style="cursor: pointer;">
                    <div class="card-body text-center d-flex flex-column justify-content-center p-1">
                        <h6 class="card-title text-danger mb-1" style="font-size: 0.8rem;">
                            <i class="fas fa-exclamation-triangle"></i> Total Pelanggaran
                        </h6>
                        <h5 class="fw-bold mb-0" style="font-size: 1.1rem;">{{ $totalPoin }}</h5>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-12 col-md-5 mb-2">
            <div class="card border-success shadow-sm h-100">
                <div class="card-body text-center d-flex flex-column justify-content-center p-1">
                    <h6 class="card-title text-success mb-1" style="font-size: 0.8rem;">
                        <i class="fas fa-check-circle"></i> Sisa Point
                    </h6>
                    <h5 class="fw-bold mb-0" style="font-size: 1.1rem;">{{ $sisaPoin }}</h5>
                </div>
            </div>
        </div>
    </div>
    






      <a href="{{ route('Student.profile.edit', optional($student)->id) }}" class="btn btn-primary btn-edit">
        <i class="fas fa-edit"></i> Edit Profil
      </a>
    </div>
  </div>

  <footer>
    <p>&copy; 2025. Dashboard Siswa SMK - All Rights Reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
