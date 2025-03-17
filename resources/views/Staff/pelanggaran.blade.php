<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Staf - Pelanggaran</title>
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
            padding: 10px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
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
                <a class="nav-link active" href="pelanggaran.html">
                    <i class="fas fa-exclamation-circle"></i> Pelanggaran
                </a>
            </li>
            <li class="nav-item"><a class="nav-link" href="laporan.html">
                <i class="fas fa-file-alt"></i> Laporan Pelanggaran</a></li>
           <li class="nav-item"><a class="nav-link" href="pengaturan.html">
               <i class="fas fa-cog"></i> Pengaturan</a></li>
        </ul>
    </nav>

    <div class="content">
        <h4 class="mb-4">Monitoring Pelanggaran</h4>
        <div class="row">
            <div class="col-md-4">
                <label for="foto" class="form-label">Foto</label>
                <div class="border p-4 text-center" style="height: 150px;" id="preview-container">
                    <img id="preview" src="" alt="Preview Foto" style="max-height: 100%; display: none;">
                    <span id="upload-text">Upload Foto</span>
                </div>
                <input type="file" class="form-control mt-2" id="foto" accept="image/*">
            </div>
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control" id="nisn" value="{{ $student->nisn }}">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama" value="{{ $student->name }}">
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" {{ $student->kelas->nama_kelas }}>
                </div>
                <div class="mb-3">
                    <label for="wali" class="form-label">Wali Kelas</label>
                    <input type="text" class="form-control" id="wali" value="{{ $student->kelas->wali_kelas }}">
                </div>
                <div class="mb-3">
                    <label for="pelanggaran" class="form-label">Nama Pelanggaran</label>
                    <input type="text" class="form-control" id="wali">
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori">
                        <option selected>Pilih Kategori</option>
                        <option value="1">Ringan</option>
                        <option value="2">Sedang</option>
                        <option value="3">Berat</option>
                    </select>
                </div>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("foto").addEventListener("change", function(event) {
            let preview = document.getElementById("preview");
            let uploadText = document.getElementById("upload-text");
            let file = event.target.files[0];
    
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                    uploadText.style.display = "none";
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>