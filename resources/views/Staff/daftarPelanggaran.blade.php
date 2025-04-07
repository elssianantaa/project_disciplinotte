<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Staf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        .table-container {
    max-width: 100%;         /* Biar nggak melebar banget */
    overflow-x: auto;        /* Scroll ke samping kalau perlu */
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 10px;
    background-color: #fff;
}

.table th,
.table td {
    white-space: nowrap;     /* Biar isi nggak pindah ke baris bawah */
    font-size: 14px;         /* Perkecil font biar hemat tempat */
    vertical-align: middle;
}
.table-container {
    max-width: 100%;         /* Biar nggak melebar banget */
    overflow-x: auto;        /* Scroll ke samping kalau perlu */
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 10px;
    background-color: #fff;
}

.table th,
.table td {
    white-space: nowrap;     /* Biar isi nggak pindah ke baris bawah */
    font-size: 14px;         /* Perkecil font biar hemat tempat */
    vertical-align: middle;
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
        .content {
            margin-left: 270px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="text-center mb-3">
            <img src="/img/Logo smk-2.gif" alt="Logo Sekolah">
            <h5>ADMIN STAF</h5>
        </div>
        <ul class="nav flex-column" id="sidebar">
            <li class="nav-item">
                <a class="nav-link" href="/dashboardStaff">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.html">
                    <i class="fas fa-user"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="daftarsiswa.html">
                    <i class="fas fa-list"></i> Daftar Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pelanggaran.html">
                    <i class="fas fa-exclamation-circle"></i> Pelanggaran
                </a>
            </li>
            <li class="nav-item"><a class="nav-link" href="/daftarPelanggaran">
                <i class="fas fa-file-alt"></i> Laporan Pelanggaran</a></li>
           <li class="nav-item"><a class="nav-link" href="pengaturan.html">
               <i class="fas fa-cog"></i> Pengaturan</a></li>
        </ul>
    </nav>
    <main class="flex-grow-1 p-4" style="margin-left: 260px;">
        <h2>Detail Daftar Pelanggaran Siswa</h2>

        <form method="GET" action="{{ route('staff.laporan') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </div>
        </form>

        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Pelanggaran</th>
                        <th>Kategori</th>
                        <th>Point Pelanggaran</th>
                        <th>Deskripsi</th>
                        <th>Foto Bukti</th>
                        <th>Petugas</th>
                        <th>Tanggal</th>
                        <th>Periode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($catatanpelanggaran as $key => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->student->nisn }}</td>
                        <td>{{ $item->student->name }}</td>
                        <td>{{ $item->kelas->nama_kelas }}</td>
                        <td>{{ $item->kelas->wali_kelas }}</td>
                        <td>{{ $item->pelanggaran->nama_pelanggaran }}</td>
                        <td>{{ $item->Kategori }}</td>
                        <td>{{ $item->point }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <img src="{{ asset('storage/foto_pelanggaran/'.$item->foto) }}" alt="bukti" width="40" height="40">
                        </td>
                        <td>{{ auth()->user()->name }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->periode }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        
        
    </main>
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
