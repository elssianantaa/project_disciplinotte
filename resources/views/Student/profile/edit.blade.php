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

    .profile-info-table {
      width: 100%;
      margin-top: 20px;
      text-align: center;
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
      text-align: center;
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

    .form-label {
      text-align: left;
      font-weight: bold;
    }

    .form-group {
      text-align: left;
    }

    .form-control {
      display: block;
      width: 100%;
      margin-top: 5px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="gambar.Logosmk.gif" alt="Logo Sekolah" style="height: 40px; margin-right: 10px;" />
        <span class="fw-bold text-black">DisipliNote</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link fw-bold active" href="/dashboardSiswa.html">Home</a></li>
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
                  {{ strtoupper(substr($student->name ?? 'S', 0, 1)) }}
                </div>
              @endif
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
    </div>
  </nav>

  <div class="container profile-wrapper">
    <div class="profile-title">Profil Siswa</div>
    <div class="container profile-container">
      <div class="edit-profile-container">
        <h5 class="text-center fw-semibold">Edit Profil</h5>

        <form action="{{ route('Student.profile.update', $student->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="text-center mb-3">
            @if ($student->foto)
              <img src="{{ asset('storage/foto_profilesiswa/' . $student->foto) }}"
                   class="profile-img rounded-circle shadow"
                   id="profilePreview"
                   style="width: 130px; height: 130px; object-fit: cover;">
            @else
              <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow"
                   style="width: 130px; height: 130px; font-size: 40px; margin: 0 auto;" id="profileInitial">
                {{ strtoupper(substr(session('student')->name, 0, 1)) }}
              </div>
            @endif

            <input type="file" name="foto" class="form-control mt-2" id="profilePicture" accept="image/*">
          </div>

          <div class="mb-2">
            <label class="form-label" for="name">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" id="name">
          </div>

          <div class="mb-2">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $student->nisn ) }}" id="nisn" required>
          </div>

          <div class="form-group mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelasList as $kelas)
                    <option value="{{ $kelas->id }}" {{ $student->kelas_id == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-success w-100 mb-2">
            <i class="fas fa-save me-1"></i> Simpan
          </button>
          <a href="{{ route('Student.profile.show') }}" class="btn btn-secondary w-100">Batal</a>
        </form>
      </div>
    </div>
  </div>

  <footer class="text-center mt-4 py-3 border-top bg-light">
    <p class="mb-0">&copy; 2025. Admin Staf SMK - All Rights Reserved.</p>
  </footer>

  <script>
    document.getElementById('profilePicture').addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          document.getElementById('profilePreview').src = e.target.result;
          document.getElementById('profileInitial').style.display = 'none';
        }
        reader.readAsDataURL(file);
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
