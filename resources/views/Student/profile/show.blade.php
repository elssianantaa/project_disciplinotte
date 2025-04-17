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
    }

    .profile-img {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      border: 4px solid #dee2e6;
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
      /* .avatar-placeholder {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #6c757d;
  color: white;
  font-weight: bold;
  font-size: 40px;
  width: 130px;
  height: 130px;
  border-radius: 50%;
  margin: 0 auto 15px auto;
  border: 4px solid #dee2e6;
} */

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
          <li class="nav-item"><a class="nav-link fw-bold active" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link fw-bold" href="#tentang">Tentang Kami</a></li>
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

  <div class="container profile-wrapper">
    <div class="profile-title">Profil Siswa</div>
    <div class="profile-container">
        @if(session('student') && session('student')->foto)
        <img src="{{ asset('storage/' . session('student')->foto) }}"
             alt="Foto Profil"
             class="rounded-circle shadow"
             width="100"
             height="100"
             style="object-fit: cover;">
    @else
    @php
    $student = auth('student')->user();
@endphp

@if($student && $student->name)
    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow"
         style="width: 100px; height: 100px; font-size: 40px;">
        {{ strtoupper(substr($student->name, 0, 1)) }}
    </div>
@else
    <p>Tidak ada siswa yang login</p>
@endif
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow"
                 style="width: 100px; height: 100px; font-size: 40px;">
                
            </div>

    @endif



      {{-- <h3 class="fw-semibold">{{ $student->name }}</h3> --}}
      <table class="table table-borderless text-start mt-3 mx-auto" style="max-width: 400px;">
        <tr>
            <th scope="row">Nama</th>
            <td>{{ $student->name }}</td>
          </tr>
        <tr>
          <th scope="row">NISN</th>
          <td>{{ $student->nisn }}</td>
        </tr>
        <tr>
          <th scope="row">Kelas</th>
          <td>{{ $student->kelas->nama_kelas }}</td>
        </tr>
        <tr>
          <th scope="row">Alamat</th>
          <td>{{ $student->alamat ?? 'Belum diisi' }}</td>
        </tr>
        <tr>
          <th scope="row">No HP</th>
          <td>{{ $student->no_hp ?? 'Belum diisi' }}</td>
        </tr>
      </table>
      <a href="{{ route('Student.profile.edit', $student->id) }}" class="btn btn-primary mt-3">
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
