<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Admin Staf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
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

        /* Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            nav[style*="margin-left"] {
                margin-left: 0 !important;
            }
            main, footer {
                margin-left: 0;
            }
            .bottom-nav {
                display: flex;
                justify-content: space-around;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: #ffffff;
                border-top: 1px solid #ddd;
                padding: 10px 0;
                z-index: 1000;
            }
            .bottom-nav a {
                text-align: center;
                color: #333;
                font-size: 14px;
            }
            .bottom-nav a.active {
                color: #007bff;
            }
            .bottom-nav i {
                font-size: 20px;
                display: block;
            }
            .row > div {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
<nav class="d-flex justify-content-between align-items-center px-4 py-2 shadow-sm bg-white" style="margin-left: 260px;">
    <h4 class="my-2">Dashboard</h4>
    <div class="dropdown">
        <button class="btn btn-light d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
            <img src="/img/profile-admin.png" alt="Admin" class="rounded-circle me-2" width="40" height="40">
            <span class="fw-bold"> {{ Auth::user()->name }}</span>
            <i class="fas fa-caret-down ms-2"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="pengaturan.html"><i class="fas fa-cog"></i> Pengaturan</a></li>
            <li><a class="dropdown-item text-danger" href="logout.html"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
</nav>

<nav class="sidebar d-none d-md-block">
    <div class="text-center mb-3">
        <img src="/gambar/images.png" alt="Logo Sekolah">
        <h5>ADMIN STAF</h5>
    </div>
    <ul class="nav flex-column" id="sidebar">
        <li class="nav-item">
            <a class="nav-link" href="index.html"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="daftarsiswa.html"><i class="fas fa-list"></i> Daftar Siswa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pelanggaran1.html"><i class="fas fa-exclamation-circle"></i> Pelanggaran</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pengaturan.html"><i class="fas fa-cog"></i> Pengaturan</a>
        </li>
    </ul>
</nav>


<div class="bottom-nav d-md-none">
    <a href="index.html" class="nav-link"><i class="fas fa-home"></i>Dashboard</a>
    <a href="/daftarSiswa.html" class="nav-link"><i class="fas fa-list"></i> Daftar Siswa</a>
    <a href="/pelanggaran1.html" class="nav-link"><i class="fas fa-exclamation-circle"></i>Pelanggaran</a>
    <a href="pengaturan.html" class="nav-link"><i class="fas fa-cog"></i>Pengaturan</a>
</div>

<main>
    <div class="alert alert-info">
        <h2 class="fw-bold animate_animated animate_fadeInDown">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-muted animate_animated animatefadeInUp animate_delay-1s">
            Ini adalah pusat kendali semua data pelanggaran siswa. Semangat terus ya, Admin terbaik! 🚀
        </p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Daftar Siswa</h5>
                    <p class="card-text">Lihat dan kelola pelanggaran siswa</p>
                    <a href="/daftarSiswa" class="btn btn-primary">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Pelanggaran</h5>
                    <p class="card-text">Catatan pelanggaran siswa.</p>
                    <a href="/pelanggaran1.html" class="btn btn-warning">Lihat Pelanggaran</a>
                </div>
            </div>
        </div>
</main>

<footer>
    <p>&copy; 2025. Admin Staf SMK - All Rights Reserved.</p>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let sidebarLinks = document.querySelectorAll("#sidebar .nav-link, .bottom-nav .nav-link");
        let currentPage = window.location.pathname.split("/").pop();

        sidebarLinks.forEach(link => {
            let linkPage = link.getAttribute("href");
            if (currentPage === linkPage) {
                link.classList.add("active");
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
