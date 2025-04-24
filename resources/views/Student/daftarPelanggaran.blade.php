    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Dashboard Siswa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />

    <!-- Ganti bagian STYLE di atas head -->
    <style>

    html, body {
    height: 100%;
    }

    body {
    display: flex;
    flex-direction: column;
    }

    main {
    flex: 1;
    }

    footer {
    text-align: center;
    padding: 10px;
    background: none;
    margin-top: auto;
    }

        body {
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        padding-top: 80px;
        background-color: #f8f9fa;
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

        footer {
        font-size: 0.8rem;
        color: #6c757d;
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

        /* Animasi fade-in untuk setiap baris dengan durasi lebih lama */
    @keyframes fadeInRow {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Kelas untuk setiap baris tabel */
    .table-row {
        opacity: 0;
        animation: fadeInRow 2s ease-out forwards; /* Durasi animasi 1 detik */
        animation-delay: 0.8s;
    }

    /* Untuk banyak baris, gunakan cara di bawah: */
    .table-row:nth-child(n) {
        animation-delay: calc(0.4s * (var(--row-number) - 1));
    }

    /* Highlight baris dengan poin tertinggi */
    .table-danger {
        background-color: #f8d7da !important;
    }

    /* Animasi peringatan untuk siswa dengan pelanggaran tinggi */
    .table-danger .ms-1 {
        color: #dc3545; /* Warna merah untuk menambah kesan peringatan */
        font-weight: bold;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-color: #ffeeba;
        color: #856404;
    }

    .alert-warning strong {
        color: #dc3545; /* Menonjolkan pesan peringatan */
    }

    </style>
    </head>
    {{-- <audio id="bg-music" loop hidden>
        <source src="{{ asset('audio/backsound.mp3') }}" type="audio/mpeg">
    </audio>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const audio = document.getElementById("bg-music");
    audio.volume = 0.15;

    // Coba mainkan langsung saat halaman siap
    audio.play().catch(function (e) {
        console.warn("Autoplay diblokir oleh browser: ", e);
    });

    // Mulai animasi setelah musik diputar
    audio.onplay = function() {
        const rows = document.querySelectorAll('.table-row');
        rows.forEach((row) => {
            row.classList.add('fade-in');
        });
D
        
=======
    };
});


    </script> --}}

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
            <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="gambar/Logosmk.gif" alt="Logo Sekolah" style="height: 40px; margin-right: 10px;" />
                <span class="fw-bold text-black">DiscipliNotes</span>
            </a>

            <!-- Tombol Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link fw-bold active" href="/dashboardSiswa">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-bold" href="/daftarPelanggaranSiswa">Pelanggaran</a></li>
                <li class="nav-item"><a class="nav-link fw-bold" href="/tentangkami">Tentang Kami</a></li>

                <!-- Dropdown Akun -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="studentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- DEBUG: Tampilkan isi session student --}}
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
                        <a class="dropdown-itemz text-danger" href="{{ route('logout') }}"
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
                <!-- Tabel Pelanggar -->
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

                            {{-- Pengaburan NISN --}}
                            <td>{{ $nisn_anonim }}</td>

                            {{-- Nama Siswa --}}
                            <td>{{ Str::limit($firstPelanggaran->student->name, 2, '**') }}</td>

                            {{-- Total Poin Pelanggaran --}}
                            <td>{{ $pelanggaranGroup->total_poin }}</td>

                            {{-- Tanggal Terakhir --}}
                            <td>{{ \Carbon\Carbon::parse($pelanggaranGroup->latest_pelanggaran->created_at)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div>
            </div>
        <!-- Tampilkan pesan peringatan hanya jika siswa memiliki pelanggaran -->
        {{-- @foreach($pelanggarans as $pelanggaranGroup)
        @if($pelanggaranGroup->total_poin >= 30)
            <div class="alert alert-warning mt-3 mb-5" role="alert">
                Kamu telah mencapai skor pelanggaran <strong>{{ $pelanggaranGroup->total_poin }}</strong> poin. Jika melanggar lagi, kamu akan mendapatkan sanksi lebih berat! Mohon untuk lebih disiplin.
            </div>
        @endif
    @endforeach --}}
            </div>
            <!-- <div class="card mt-4 shadow-sm">
            <div class="card-header bg-info text-white">Kotak Aspirasi</div>
            <div class="card-body">
                <p class="mb-2">Punya saran atau unek-unek soal peraturan sekolah?</p>
                <textarea class="form-control mb-2" rows="3" placeholder="Tulis di sini..."></textarea>
                <button class="btn btn-outline-primary btn-sm">Kirim</button>
            </div>
            </div> -->
            <footer class="text-center py-5 border-top">
                <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with ❤</small>
            </footer>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('.table-row');
        rows.forEach((row, index) => {
            // Set delay secara dinamis berdasarkan index
            row.style.animationDelay = ${index * 0.2}s;
            row.classList.add('fade-in'); // Tambahkan kelas fade-in jika diperlukan
        });
    });

        </script>
    </body>
