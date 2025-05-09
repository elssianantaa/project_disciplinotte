<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />

    <style>
    html, body {
        height: 100%;
    }
    body {
        display: flex;
        flex-direction: column;
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        padding-top: 80px;
        background-color: #f8f9fa;
    }
    main {
        flex: 1;
    }
    footer {
        text-align: center;
        padding: 10px;
        background: none;
        margin-top: auto;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background-color: white;
        border-bottom: 1px solid #dee2e6;
    }

    .navbar-brand img {
        height: 36px;
        margin-right: 10px;
    }

    .navbar-brand span {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }

    .card-header {
        font-weight: 600;
        font-size: 1rem;
    }

    table th {
        background-color: #0d6efd;
        color: white;
        font-weight: 500;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    .alert {
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .navbar-brand span {
            font-size: 1rem;
        }

        .table {
            font-size: 0.9rem;
        }

        .alert {
            text-align: center;
        }
    }

    @keyframes fadeInRow {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .table-row {
        opacity: 0;
        animation: fadeInRow 2s ease-out forwards;
    }

    .table-row:nth-child(n) {
        animation-delay: calc(0.4s * (var(--row-number, 1) - 1));
    }

    .table-danger {
        background-color: #f8d7da !important;
    }

    .table-danger .ms-1 {
        color: #dc3545;
        font-weight: bold;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeeba;
        color: #856404;
    }

    .alert-warning strong {
        color: #dc3545;
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="gambar/Logosmk.gif" alt="Logo Sekolah" style="height: 40px; margin-right: 10px;" />
            <span class="fw-bold text-black">DiscipliNotes</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link fw-bold active" href="/dashboardSiswa">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-bold" href="/daftarPelanggaranSiswa">Pelanggaran</a></li>
                <li class="nav-item"><a class="nav-link fw-bold" href="/tentangkami">Tentang Kami</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="studentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @php
                            $student = session('student');
                            $fotoPath = $student && $student->foto ? 'storage/foto_profilesiswa/' . $student->foto : null;
                        @endphp

                        @if($fotoPath && file_exists(public_path($fotoPath)))
                            <img src="{{ asset($fotoPath) }}" alt="Foto Profil" class="rounded-circle me-2" width="40" height="40" />
                        @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                 style="width: 40px; height: 40px; font-size: 20px;">
                                {{ strtoupper(substr(optional($student)->name, 0, 1)) }}
                            </div>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="studentDropdown">

                        <li><a class="dropdown-item" href="{{ route('Student.profile.show') }}"><i class="fas fa-user me-2"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('updatePassword') }}"><i class="bi bi-key me-2"></i> Ubah Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mb-4 py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Riwayat Pelanggaran
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Total Poin Pelanggaran</th>
                        <th>Tanggal Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pelanggarans as $pelanggaranGroup)
                    @php
                        $firstPelanggaran = $pelanggaranGroup->pelanggaranGroup->first();
                        $nisn_anonim = substr($firstPelanggaran->student->nisn, 0, 4) . '****' . substr($firstPelanggaran->student->nisn, -2);
                    @endphp
                    <tr class="table-row @if($loop->first) table-danger @endif">
                        <td>
                            @if ($loop->first)
                                <span class="ms-1 text-warning" title="Perlu Pendampingan">⚠️</span>
                            @endif
                            {{ $loop->iteration }}
                        </td>
                        <td>{{ $nisn_anonim }}</td>
                        <td>{{ Str::limit($firstPelanggaran->student->name, 2, '**') }}</td>
                        <td>{{ $pelanggaranGroup->total_poin }}</td>
                        <td>{{ \Carbon\Carbon::parse($pelanggaranGroup->latest_pelanggaran->created_at)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="text-center py-5 border-top">
    <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with ❤</small>
</footer>       

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('.table-row');
        rows.forEach((row, index) => {
            row.style.animationDelay = `${index * 0.2}s`;
            row.classList.add('fade-in');
        });
    });
</script>
</body>
</html>
