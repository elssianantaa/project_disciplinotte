<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Staf - Pengaturan</title>
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

    /* Responsive Styles */
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

  <!-- Navbar -->
  <nav class="navbar">
    <h4 class="my-2">Dashboard</h4>
    <div class="dropdown">
      <button class="btn btn-light d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
        <img src="/img/profile-admin.png" alt="Admin" class="rounded-circle me-2" width="40" height="40">
        <span class="fw-bold">Alya Cantik</span>
        <i class="fas fa-caret-down ms-2"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="pengaturan.html"><i class="fas fa-cog"></i> Pengaturan</a></li>
        <li><a class="dropdown-item text-danger" href="logout.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>
  </nav>
  <div class="wrapper">
    <nav class="sidebar d-none d-md-block">
      <div class="text-center mb-3">
        <img src="/img/Logo smk-2.gif" alt="Logo Sekolah">
        <h5>ADMIN STAF</h5>
      </div>
      <ul class="nav flex-column" id="sidebar">
        <li class="nav-item"><a class="nav-link" href="index.html"><i class="fas fa-home"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="daftarsiswa.html"><i class="fas fa-list"></i> Daftar Siswa</a></li>
        <li class="nav-item"><a class="nav-link" href="pelanggaran1.html"><i class="fas fa-exclamation-circle"></i> Pelanggaran</a></li>
        <li class="nav-item"><a class="nav-link active" href="pengaturan.html"><i class="fas fa-cog"></i> Pengaturan</a></li>
      </ul>
    </nav>
    <div class="content container mt-5">
      <br><br>
      <h4 class="mb-4">Pengaturan</h4>
      <div class="row">
        <div class="col-md-6">
          <div class="card mb-3">
            <div class="card-header">Profil Admin</div>
            <div class="card-body">
              <div class="mb-3">
                <label for="namaAdmin" class="form-label">Nama Admin</label>
                <input type="text" class="form-control" id="namaAdmin" value="Alya Cantik">
              </div>
              <div class="mb-3">
                <label for="fotoAdmin" class="form-label">Foto Profil</label>
                <input type="file" class="form-control" id="fotoAdmin">
              </div>
              <button class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mobile-nav d-md-none">
    <a href="index.html"><i class="fas fa-home"></i><span>Dashboard</span></a>
    <a href="daftarsiswa.html"><i class="fas fa-list"></i><span>Siswa</span></a>
    <a href="pelanggaran1.html"><i class="fas fa-exclamation-circle"></i><span>Pelanggaran</span></a>
    <a href="pengaturan.html" class="active"><i class="fas fa-cog"></i><span>Setting</span></a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
