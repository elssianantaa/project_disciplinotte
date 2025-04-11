<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
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
        .table-responsive {
        max-height: 460px; /* Gedein tinggi scroll area */
        overflow-y: auto;
        position: relative;
    }

    thead th {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 10;
    }

    table th, table td {
        font-size: 16px; /* Lebihin ukuran font */
        vertical-align: middle;
    }

    img.foto-siswa {
        width: 90px;
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
    }

    /* .table-responsive {
        max-height: 400px;
        overflow-y: auto;
        position: relative;
    }

    thead th {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 10;
    } */

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
                <img src="{{ Auth::user()->foto ? asset('storage/foto_user/' . Auth::user()->foto) : asset('img/profile-admin.png') }}"
                     alt="Foto Profil" class="rounded-circle mb-3" width="100" height="100">
            @else
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                     style="width: 100px; height: 100px; font-size: 40px;">
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
                <a href="{{ route('admin.profile.edit', Auth::user()->id) }}" class="btn btn-primary">Edit Profile</a>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>


    <nav class="d-flex justify-content-between align-items-center px-4 py-2 shadow-sm bg-white" style="margin-left: 260px;">
        <h4 class="my-2">@yield('title', 'Dashboard')</h4>
        <div class="dropdown">
            <button class="btn btn-light d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
                <img src="{{ Auth::user()->foto ? asset('storage/foto_user/' . Auth::user()->foto) : asset('img/profile-admin.png') }}" alt="Admin" class="rounded-circle me-2" width="40" height="40">
                <span class="fw-bold">{{ Auth::user()->name }}</span>
                <i class="fas fa-caret-down ms-2"></i>
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
            <h5>ADMIN</h5>
        </div>
        <ul class="nav flex-column" id="sidebar">
            <li class="nav-item"><a class="nav-link" href="/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
            {{-- <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}"><i class="fas fa-user"></i> Users</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/kelolastaff') }}"><i class="fas fa-user"></i>Kelola Staff</a></li> --}}
            <li class="nav-item"><a class="nav-link" href="/admin/siswa"><i class="fas fa-list"></i> Daftar Siswa</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin/users"><i class="fas fa-list"></i> Daftar Pengguna</a></li>
            {{-- <li class="nav-item"><a class="nav-link" href="{{ url('admin/pelanggaran') }}"><i class="fas fa-exclamation-circle"></i> Pelanggaran</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/laporan') }}"><i class="fas fa-file-alt"></i> Laporan Pelanggaran</a></li> --}}
            <li class="nav-item"><a class="nav-link" href="/pengaturan"><i class="fas fa-cog"></i> Pengaturan</a></li>
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025. Admin Staf SMK - All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
