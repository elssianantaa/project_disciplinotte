<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Profil Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6f9;
      padding-top: 80px;
    }
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1030;
      background-color: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    .edit-profile-container {
      max-width: 450px;
      margin: 30px auto;
      padding: 20px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }
    .profile-img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 8px;
      border: 2px solid #dee2e6;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('gambar/Logosmk.gif') }}" alt="Logo Sekolah" style="height: 36px;" />
        <span class="fw-bold text-black ms-2">DisipliNote</span>
      </a>
    </div>
  </nav>

  <div class="container">
    <div class="edit-profile-container">
      <h5 class="text-center fw-semibold">Edit Profil</h5>

      <form action="{{ route('Student.profile.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="text-center mb-3">
          <img src="{{ $student->foto ? asset('storage/foto_profilesiswa/' . $student->foto) : asset('img/profile-siswa.png') }}" class="profile-img" id="profilePreview">
          <input type="file" name="foto" class="form-control mt-2" id="profilePicture" accept="image/*">
        </div>
        
        <div class="mb-2">
          <label class="form-label">Nama</label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}">
        </div>

        <div class="mb-2">
          <label for="form-label">NISN</label>
          <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $student->nisn ) }}" required>
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
    
    

        {{-- <div class="mb-2">
          <label class="form-label">Alamat</label>
          <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $student->alamat) }}">
        </div> --}}

        <button type="submit" class="btn btn-success w-100 mb-2">
          <i class="fas fa-save me-1"></i> Simpan
        </button>
        <a href="{{ route('Student.profile.show') }}" class="btn btn-secondary w-100">Batal</a>
      </form>
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
        }
        reader.readAsDataURL(file);
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
