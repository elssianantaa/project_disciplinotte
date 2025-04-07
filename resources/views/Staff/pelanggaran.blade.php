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

        /* Tambahan styling buat form agar rapi */
        .form-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .preview-container {
            width: 200px;
            height: 200px;
            border: 2px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            position: relative;
        }

        #preview {
            max-width: 100%;
            max-height: 100%;
            display: none;
        }

        #upload-text {
            position: absolute;
            color: #888;
        }

        @media (min-width: 768px) {
            .form-wrapper {
                flex-direction: column;
                align-items: center;
            }
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

    <form action="/pelanggaran/create/" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <h4 class="mb-4">Monitoring Pelanggaran</h4>
            <div class="form-wrapper">
                <!-- Foto dan preview -->
                <div class="form-wrapper row">
                    <!-- Kolom Foto -->
                    <div class="col-md-4 d-flex flex-column align-items-center">
                        <div class="preview-container" id="preview-container">
                            <img id="preview" src="" alt="Preview Foto">
                            <span id="upload-text">Upload Foto</span>
                        </div>
                        <input type="file" class="form-control mt-2" id="foto" name="foto" accept="image/*" style="max-width: 200px;">
                    </div>
                
                    <!-- Kolom Form -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control" id="nisn" name="nisn" value="{{ $student->nisn }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama" name="name" value="{{ $student->name }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="kelas" name="nama_kelas" value="{{ $student->kelas->nama_kelas ?? 'Tidak ada kelas' }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="wali" class="form-label">Wali Kelas</label>
                                <input type="text" class="form-control" id="wali" name="wali_kelas" value="{{ $student->kelas->wali_kelas ?? 'Tidak ada wali kelas' }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pelanggaran" class="form-label">Nama Pelanggaran</label>
                                <select class="form-control" id="pelanggaran" name="pelanggaran_id" required>
                                    <option value="" disabled selected>Pilih Pelanggaran</option>
                                    @foreach ($pelanggarans as $pelanggaran)
                                        <option value="{{ $pelanggaran->id }}">{{ $pelanggaran->nama_pelanggaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" name="Kategori" required>
                                    <option value="Ringan">Ringan</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Berat">Berat</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="point" class="form-label">Point Pelanggaran</label>
                                <input type="number" class="form-control" id="point" name="point" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="foto" class="form-label">Foto Bukti</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="staff" class="form-label">Petugas (Staff)</label>
                                <input type="text" class="form-control" name="staff" value="{{ auth()->user()->name ?? 'Tidak diketahui' }}" readonly>
                                <input type="hidden" name="staff_id" value="{{ auth()->user()->id }}">
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary w-100" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                
    </form>

    <script>
        document.querySelector('select[name="Kategori"]').addEventListener('change', function() {
            let pointField = document.querySelector('input[name="point"]');
            let kategori = this.value;
            let point = kategori === "Ringan" ? 10 : kategori === "Sedang" ? 15 : kategori === "Berat" ? 20 : 0;
            pointField.value = point;
        });

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