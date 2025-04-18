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
        transform: translateY(10px); /* Biar ada sedikit gerakan */
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-row {
    opacity: 0;
    animation: fadeInRow 0.6s ease-in forwards;
}

.table-row:nth-child(n) {
    animation-delay: calc(0.1s * (var(--row-number) - 1)); /* Jeda antar baris */
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

/* Hilangkan border garis pada table */
.table,
.table th,
.table td {
    border: none !important;
}


</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="img/Logo smk-2.gif" alt="Logo Sekolah" />
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                <img src="img/hd nya bund.jpeg" class="rounded-circle me-2" width="40" height="40" alt="User" />
                <span class="fw-semibold">Vii</span>
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
                        <tr class="table-row @if($loop->first) table-danger @endif">
                            <td>
                                @if ($loop->first)
                                    <span class="ms-1 text-warning" title="Perlu Pendampingan">⚠️</span>
                                @endif
                                {{ $loop->iteration }}
                            </td>
                
                            {{-- Pengaburan NISN --}}
                            @php
                                $firstPelanggaran = $pelanggaranGroup->pelanggaranGroup->first(); // Ambil data pertama
                                $nisn_anonim = substr($firstPelanggaran->student->nisn, 0, 4) . '****' . substr($firstPelanggaran->student->nisn, -2);
                            @endphp
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
        {{-- @foreach($pelanggarans as $pelanggaranGroup)
        @php
            // Ambil siswa pertama di grup pelanggaran
        @endphp
    
        <!-- Tampilkan pesan hanya jika ID siswa yang login sesuai dan ada total poin pelanggaran -->
        @if($students->id == $siswaId && $pelanggaranGroup['total_poin'] > 0)
            @if($pelanggaranGroup['total_poin'] >= 30)
                <div class="alert alert-warning mt-3 mb-5" role="alert">
                    Kamu telah mencapai skor pelanggaran <strong>{{ $pelanggaranGroup['total_poin'] }}</strong> poin. Jika melanggar lagi, kamu akan mendapatkan sanksi lebih berat! Mohon untuk lebih disiplin.
                </div>
            @else
                <div class="alert alert-info mt-3 mb-5" role="alert">
                    Total poin pelanggaran kamu saat ini: <strong>{{ $pelanggaranGroup['total_poin'] }}</strong> poin. Tetap jaga perilaku, ya!
                </div>
            @endif
        @endif
    @endforeach --}}
    
    


    </div>
    {{-- @foreach($pelanggarans as $pelanggaranGroup)
    @if($pelanggaranGroup->total_poin >= 30)
        <div class="alert alert-warning mt-3 mb-5" role="alert">
            Kamu telah mencapai skor pelanggaran <strong>{{ $pelanggaranGroup->total_poin }}</strong> poin. Jika melanggar lagi, kamu akan mendapatkan sanksi lebih berat! Mohon untuk lebih disiplin.
        </div>
    @endif
@endforeach --}}

    <footer class="text-center py-5 border-top">
            <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with ❤</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.table-row');
    rows.forEach((row, index) => {
        // Set delay secara dinamis berdasarkan index
        row.style.animationDelay = `${index * 0.2}s`;
        row.classList.add('fade-in'); // Tambahkan kelas fade-in jika diperlukan
    });
});

    </script>
</body>
</html>
