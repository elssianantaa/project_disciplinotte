<!DOCTYPE html>

<html lang="id">

<head>

  <meta charset="UTF-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Admin Staf</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

  <style>

    body {

      font-family: 'Segoe UI', sans-serif;

    }



    .sidebar {

      width: 250px;

      height: 100vh;

      position: fixed;

      background: #f8f9fa;

      padding: 20px;

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

      margin-bottom: 5px;

    }



    .sidebar .nav-link:hover {

      background: #e9ecef;

    }



    .sidebar .nav-link.active {

      background: #007bff;

      color: white;

    }



    .content {

      margin-left: 270px;

      padding: 20px;

    }



    .topbar {

      margin-left: 260px;

      background: #fff;

      border-bottom: 1px solid #dee2e6;

      padding: 10px 20px;

      position: sticky;

      top: 0;

      z-index: 1000;

    }



    .bottom-nav {

      display: none;

      position: fixed;

      bottom: 0;

      left: 0;

      width: 100%;

      background: #f8f9fa;

      border-top: 1px solid #dee2e6;

      z-index: 1030;

    }



    .bottom-nav .nav-link {

      color: #333;

      font-size: 14px;

      text-align: center;

      padding: 10px 0;

      flex: 1;

    }



    .bottom-nav .nav-link.active {

      color: #007bff;

    }



    @media (max-width: 768px) {

      .sidebar {

        display: none;

      }



      .topbar, .content {

        margin-left: 0 !important;

      }



      .bottom-nav {

        display: flex;

      }



      .table td, .table th {

        font-size: 13px;

        padding: 0.5rem;

      }

    }

  </style>

</head>

<body>



  <!-- Navbar Atas -->

  <nav class="topbar d-flex justify-content-between align-items-center shadow-sm">

    <h4 class="mb-0 fw-semibold">Dashboard</h4>

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
                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

      </ul>

    </div>

  </nav>



  <!-- Sidebar -->

  <nav class="sidebar">

    <div class="text-center mb-3">

      <img src="/img/Logo smk-2.gif" alt="Logo Sekolah" />

      <h5>ADMIN STAF</h5>

    </div>

    <ul class="nav flex-column" id="sidebar">

      <li class="nav-item">

        <a class="nav-link" href="index.html"><I class="fas fa-home me-2"></I>Dashboard</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="daftarsiswa.html"><I class="fas fa-list me-2"></I>Daftar Siswa</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="pelanggaran.html"><I class="fas fa-exclamation-circle me-2"></I>Pelanggaran</a>

      </li>

      <li class="nav-item">

        <a class="nav-link" href="Pengaturan.html"><I class="fas fa-cog me-2"></I>Pengaturan</a>

      </li>

    </ul>

  </nav>



  <!-- Konten Utama -->

  <main class="content pb-5">
  <form action="/daftarSiswa" method="GET" class="mb-4">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label for="kelas_id" class="form-label">Pilih Kelas:</label>
                    <select name="kelas_id" id="kelas_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Kelas --</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if(request('kelas_id'))
                <div class="col-md-4">
                    <label for="nama" class="form-label">Cari Nama Siswa:</label>
                    <input type="text" name="nama" id="nama" value="{{ request('nama') }}" class="form-control" placeholder="Masukkan nama">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                @endif

                <div class="col-md-2">
                    <div class="form-label d-block">
                        Jumlah Siswa: <span class="fw-bold">{{ $totalSiswa }}</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-label d-block">
                        Jumlah Skorsing: <span class="fw-bold">{{ $totalSkorsing }}</span>
                    </div>
                </div>
            </div>
        </form>
    <h2 class="mb-4">Daftar Pelanggaran Siswa</h2>

    <div class="table-responsive">

      <table class="table table-bordered table-hover table-sm w-100 align-middle">

        <thead class="table-light">

          <tr>

            <th>No</th>

            <th>Foto</th>

            <th>NIS</th>

            <th>Nama Siswa</th>

            <th>Kelas</th>

            <th>Status</th>

            <th>Point Pelanggaran</th>

            <th>Aksi</th>

          </tr>

        </thead>

        <tbody>
        @foreach ($students as $key => $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <img src="{{ asset('storage/foto_siswa/'.$item->foto) }}" width="40" height="40">
                    </td>
                    <td>{{$item->nisn}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->kelas->nama_kelas}}</td>
                    <td>{{$item->status}}</td>
                    <td>
                        {{ $item->catatanpelanggarans->sum(fn($cp) => $cp->pelanggaran->point ?? 0) }}
                    </td>
                    <td>
                        <a href="/pelanggaran/{{$item->id}}" class="btn btn-danger btn-sm">
                            Catat Pelanggaran
                        </a>
                    </td>
                </tr>
                @endforeach

        </tbody>

      </table>

    </div>

  </main>



  <!-- Bottom Navigation -->

  <nav class="bottom-nav d-md-none d-flex">

    <a class="nav-link" href="index.html"><I class="fas fa-home"></I><br>Dashboard</a>

    <a class="nav-link" href="daftarsiswa.html"><I class="fas fa-list"></I><br>Siswa</a>

    <a class="nav-link" href="pelanggaran.html"><I class="fas fa-exclamation-circle"></I><br>Pelanggaran</a>

    <a class="nav-link" href="Pengaturan.html"><I class="fas fa-cog"></I><br>Pengaturan</a>

  </nav>



  <!-- Script -->

  <script>

    document.addEventListener("DOMContentLoaded", function () {

      let currentPage = window.location.pathname.split("/").pop();



      // Sidebar

      document.querySelectorAll("#sidebar .nav-link").forEach(link => {

        let linkPage = link.getAttribute("href");

        if (currentPage === linkPage) {

          link.classList.add("active");

        }

      });



      // Bottom Nav

      document.querySelectorAll(".bottom-nav .nav-link").forEach(link => {

        let linkPage = link.getAttribute("href");

        if (currentPage === linkPage) {

          link.classList.add("active");

        }

      });

    });

  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>


