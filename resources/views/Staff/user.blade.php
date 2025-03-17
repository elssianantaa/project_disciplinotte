<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Staf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
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
        footer {
    position: fixed;
    bottom: 0;
    left: 260px;
    width: calc(100% - 260px);
    background: #f8f9fa;
    padding: 15px;
    text-align: center;
    font-size: 14px;
    border-top: 1px solid #ddd;
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
            <li class="nav-item"><a class="nav-link" href="index.html">
                <i class="fas fa-home"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link active" href="user.html">
                <i class="fas fa-user"></i> Users</a></li>
            <li class="nav-item"><a class="nav-link" href="daftarsiswa.html">
                <i class="fas fa-list"></i> Daftar Siswa</a></li>
            <li class="nav-item"><a class="nav-link" href="pelanggaran.html">
                <i class="fas fa-exclamation-circle"></i> Pelanggaran</a></li>
            <li class="nav-item"><a class="nav-link" href="laporan.html">
                 <i class="fas fa-file-alt"></i> Laporan Pelanggaran</a></li>
            <li class="nav-item"><a class="nav-link" href="pengaturan.html">
                <i class="fas fa-cog"></i> Pengaturan</a></li>
        </ul>
    </nav>
    <main class="content">
        <h2>Daftar Siswa</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="siswaTable">
                <tr>
                    <td>1</td>
                    <td>Herman Beck</td>
                    <td>Jl. Merdeka No. 10</td>
                    <td>081234567890</td>
                    <td>Siswa</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <footer>
            <p>&copy; 2025. Admin Staf SMK - All Rights Reserved.</p>
            <p>Hand-crafted & made with ❤</p>
        </footer>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
