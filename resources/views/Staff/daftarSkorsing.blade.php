<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Staf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        }
        .sidebar .nav-link:hover {
            background: #e9ecef;
        }
        .sidebar .nav-link.active {
            background: #007bff;
            color: white;
        }
        main {
            flex-grow: 1;
            margin-left: 260px;
            padding: 20px;
        }
        footer {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            border-top: 1px solid #ddd;
            margin-left: 260px;
        }
    </style>
</head>
<body>

     <!-- Modal Profil -->
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

    <nav class="d-flex justify-content-between align-items-center px-4 py-2 shadow-sm bg-white" style="margin-left: 260px;">
        <h4 class="my-2">Tambah Pelanggaran Siswa</h4>
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
                <a class="nav-link" href="/daftarSiswa">
                    <i class="fas fa-list"></i> Daftar Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/daftarPelanggaran">
                    <i class="fas fa-exclamation-circle"></i> Pelanggaran
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('staff.profile.edit', Auth::user()->id) }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </li>
        </ul>
    </nav>
    <main class="flex-grow-1 p-4" style="margin-left: 260px;">
        {{-- <h2>Daftar Pelanggaran Siswa</h2> --}}

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

                {{-- <div class="col-md-2">
                    <div class="form-label d-block">
                        Jumlah Siswa Skorsing: <span class="fw-bold">{{ $totalSkorsing }}</span>
                    </div> --}}
                </div>
            </div>
        </form>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th>Skorsing</th>
                    {{-- <th>Aksi</th> --}}
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
                    <td>
                        <span class="badge 
                          {{ $item->status == 'skorsing' ? 'bg-warning' : 
                             ($item->status == 'dikeluarkan' ? 'bg-danger' : 'bg-success') }}">
                          {{ ucfirst($item->status) }}
                        </span>
                      </td>
                    {{-- <td>
                        {{ $item->catatanpelanggarans->sum(fn($cp) => $cp->pelanggaran->point ?? 0) }}
                    </td> --}}
                    <td>
                        @php
                        $skorsingTerbaru = $item->skorsings->first();
                      @endphp
                      
                      @if ($item->status == 'skorsing' && $skorsingTerbaru)
                        {{ \Carbon\Carbon::parse($skorsingTerbaru->mulai)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($skorsingTerbaru->selesai)->format('d M Y') }}
                      @else
                        -
                      @endif
                    </td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2025. Admin Staf SMK - All Rights Reserved.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let sidebarLinks = document.querySelectorAll("#sidebar .nav-link");
            let currentPage = window.location.pathname.split("/").pop();

            sidebarLinks.forEach(link => {
                let linkPage = link.getAttribute("href");

                if (currentPage === linkPage) {
                    link.classList.add("active");
                }

                link.addEventListener("click", function () {
                    sidebarLinks.forEach(item => item.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
