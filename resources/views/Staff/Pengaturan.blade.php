<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Staf - Pengaturan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            display: flex;
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
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }
        footer {
    position: fixed;
    bottom: 0;
    left: 250px;
    width: calc(100% - 250px);
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
            <li class="nav-item">
                <a class="nav-link" href="index.html">
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
            <li class="nav-item"><a class="nav-link" href="laporan.html">
                <i class="fas fa-file-alt"></i> Laporan Pelanggaran</a></li>
           <li class="nav-item"><a class="nav-link active" href="pengaturan.html">
               <i class="fas fa-cog"></i> Pengaturan</a></li>
        </ul>
    </nav>
    <div class="content container">
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
            <!-- <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Tampilan</div>
                    <div class="card-body">
                        <label for="themeSelect" class="form-label">Pilih Tema</label>
                        <select class="form-select" id="themeSelect">
                            <option value="light">Terang</option>
                            <option value="dark">Gelap</option>
                        </select>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="text-center mt-3">
            <button class="btn btn-danger" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </div>
    </div>

    <script>
        document.getElementById("themeSelect").addEventListener("change", function() {
            if (this.value === "dark") {
                document.body.style.backgroundColor = "#343a40";
                document.body.style.color = "white";
            } else {
                document.body.style.backgroundColor = "white";
                document.body.style.color = "black";
            }
        });

        document.getElementById("logoutBtn").addEventListener("click", function() {
            alert("Anda telah logout.");
            window.location.href = "login.html";
        });
    </script>


    <footer>
        <p>&copy; 2025. Admin Staf SMK - All Rights Reserved.</p>
        <p>Hand-crafted & made with ❤</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
