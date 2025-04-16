{{-- <!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />

    <style>
      body {
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        padding-top: 80px;
      }

      .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background-color: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      }

      .navbar-brand img {
        height: 40px;
        margin-right: 10px;
      }

      .hero-section {
        position: relative;
        height: 60vh;
        border-radius: 2rem;
        box-shadow: inset 0 -80px 60px -40px rgba(0, 0, 0, 0.4);
      }

      .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 2rem;
      }

      .carousel-indicators [data-bs-target] {
        background-color: #000;
      }

      .motivasi {
        margin-top: 20px;
        text-align: center;
        font-size: 0.9rem;
        color: #333;
        /* font-weight: 500; */
      }

      @media (max-width: 768px) {
        .hero-section {
          height: 40vh;
        }

        .motivasi {
          font-size: 0.95rem;
          margin: 15px 20px;
        }

        .navbar-brand span {
          font-size: 1rem;
        }
      }
    </style>
  </head>
  
  <body>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="gambar/Logosmk.gif" alt="Logo Sekolah" />
          <span class="fw-bold text-black">DisipliNote</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item"><a class="nav-link fw-bold active" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="#tentang">Tentang Kami</a></li>
            <li class="nav-item"><a class="nav-link fw-bold" href="#pelanggaran">Pelanggaran</a></li>
              @if(session('student') && session('student')->foto)
              <img src="{{ asset('storage/' . session('student')->foto) }}"
                   alt="Foto Profil"
                   class="rounded-circle shadow"
                   width="50"
                   height="50"
                   style="object-fit: cover;">
          @else
              @if(session('student') && session('student')->name)
                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow"
                       style="width: 50px; height: 50px; font-size: 40px;">
                      {{ strtoupper(substr(session('student')->name, 0, 1)) }}
                  </div>
              @else
              <li class="nav-item dropdown">
                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow"
                       style="width: 100px; height: 100px; font-size: 40px;">
                  </div>
              @endif
          @endif
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item {{ request()->routeIs('Student.profile.show') ? 'active' : '' }}" 
                    href="{{ route('Student.profile.show') }}">
                    <i class="fas fa-user me-2"></i>Profil
                 </a>
              </li>              
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Carousel -->
    <div class="container my-4">
      <div id="heroCarousel" class="carousel slide rounded-4 overflow-hidden shadow" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="hero-section" style="background: url('gambar/bk.jpg') no-repeat center center / cover;">
              <div class="hero-overlay"></div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="hero-section" style="background: url('gambar/bk2.jpg') no-repeat center center / cover;">
              <div class="hero-overlay"></div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        </div>
      </div>

      <!-- Tulisan Motivasi (di bawah slider) -->
      <div class="motivasi">
        <i class="fas  me-2"></i>
        -Mulailah hari dengan kebiasaan baik dengan datang tepat waktu-
        <!-- , lengkap seragam, siap belajar! 📚 -->
      </div>
    </div>
    <section class="py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-7">
            <h4 class="fw-bold mb-3">Peringatan Untuk Siswa</h4>
            <p class="text-dark fs-5">
              Kamu sudah melanggar beberapa peraturan sekolah. Mohon untuk lebih disiplin agar tidak mendapatkan sanksi lanjutan.
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam ut eveniet ab amet similique tempore cupiditate necessitatibus dignissimos? Fugit, dicta?
            </p>
          </div>
          <div class="col-md-5 text-center mt-4 mt-md-0">
            <img src="img/images (1).jpeg" alt="Pelanggaran" class="img-fluid shadow rounded-4" style="max-height: 300px;" />
          </div>
        </div>
      </div>
    </section>


    <!-- Riwayat Pelanggaran -->
    <div class="card mb-5 shadow-sm" style="margin-left: 96px; margin-right: 96px;">
      <div class="card-header bg-primary text-white">
        Riwayat Pelanggaran
      </div>
      <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Pelanggaran</th>
                    <th>Skor</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach($pelanggarans as $pelanggaran)
                <tr @if($loop->first) class="table-danger" @endif>
                    <td>
                        {{ $loop->iteration }}
                        @if ($loop->first)
                        <span class="badge bg-warning text-dark">Perlu Pendampingan</span>
                        @endif
                    </td>
                    <td>{{ $p->student->nisn }}</td>
                    <td>{{ Str::limit($p->student->name, 1, '**') }}</td>
                    <td>{{ $p->pelanggaran->nama_pelanggaran }}</td>
                    <td>{{ $p->pelanggaran->point }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y') }}</td>
                </tr>
                @endforeach
            </tbody> --}}
        {{-- </table>

      </div>
    </div>
            <div class="alert alert-warning" role="alert" style="margin-left: 96px; margin-right: 96px;"> --}}
              <!-- <h5 class="fw-bold">Peringatan:</h5> -->
              {{-- Kamu telah mencapai skor pelanggaran <strong>30</strong> poin. Jika melanggar lagi, kamu akan mendapatkan sanksi lebih berat! Mohon untuk lebih disiplin. --}}
            {{-- </div>
          </div> --}}

    <!-- Footer -->
    {{-- <footer class="text-center py-3 border-top">
      <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with ❤</small>
    </footer> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
  {{-- </body> --}}
{{-- </html> --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", sans-serif;
      padding-top: 80px;
    }

    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      background-color: rgba(255, 255, 255, 0.75);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
      height: 40px;
      margin-right: 10px;
    }

    .hero-section {
      position: relative;
      height: 60vh;
      border-radius: 2rem;
      box-shadow: inset 0 -80px 60px -40px rgba(0, 0, 0, 0.4);
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 2rem;
    }

    .carousel-indicators [data-bs-target] {
      background-color: #000;
    }

    .motivasi {
      margin-top: 20px;
      text-align: center;
      font-size: 0.9rem;
      color: #333;
    }

    @media (max-width: 768px) {
      .hero-section {
        height: 40vh;
      }

      .motivasi {
        font-size: 0.95rem;
        margin: 15px 20px;
      }

      .navbar-brand span {
        font-size: 1rem;
      }
    }

    @media (max-width: 576px) {
      .card-body table {
        font-size: 0.85rem;
      }

      .card-header {
        font-size: 1rem;
        text-align: center;
      }

      .alert {
        font-size: 0.9rem;
        text-align: center;
      }

      footer small {
        font-size: 0.75rem;
      }

      .hero-section {
        height: 35vh !important;
      }

      .navbar-brand span {
        font-size: 0.9rem;
      }

      .motivasi {
        font-size: 0.85rem;
        margin: 10px 15px;
      }

      .table th, .table td {
        white-space: nowrap;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="gambar/Logosmk.gif" alt="Logo Sekolah" />
        <span class="fw-bold text-black">DisipliNote</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link fw-bold active" href="/dashboardSiswa.html">Home</a></li>
          <li class="nav-item"><a class="nav-link fw-bold" href="/tentangkami">Tentang Kami</a></li>
          <li class="nav-item"><a class="nav-link fw-bold" href="">Pelanggaran</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
              {{-- <img src="img/hd nya bund.jpeg" class="rounded-circle me-2" width="40" height="40" alt="User" /> --}}
              {{-- <span class="fw-semibold">Vii</span> --}}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{route('Student.profile.show')}}"><i class="fas fa-user me-2"></i>Profil</a></li>
              <li>
                <a class="dropdown-item" href="{{ route('updatePassword') }}">
                    <i class="bi bi-key"></i> Ubah Password
                </a>
            </li>
              <li><hr class="dropdown-divider" /></li>
              <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container my-4">
    <div id="heroCarousel" class="carousel slide rounded-4 overflow-hidden shadow" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="hero-section" style="background: url('gambar/bk.jpg') no-repeat center center / cover;">
            <div class="hero-overlay"></div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="hero-section" style="background: url('gambar/bk2.jpg') no-repeat center center / cover;">
            <div class="hero-overlay"></div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
      </div>
    </div>
    <div class="motivasi">
      <i class="fas me-2"></i>
      -Mulailah hari dengan kebiasaan baik dengan datang tepat waktu-
    </div>
  </div>

  <section class="py-4">
    <div class="container">
      <div class="alert alert-info shadow rounded-4 animate_animated animate_fadeInUp">
        <div class="alert alert-info shadow rounded-4">
          <h5 class="fw-bold">Peringatan Untuk Siswa</h5>
          <p><strong>Perhatian!</strong><br><br>
            <br><br>Kamu tercatat telah melaukkan pelanggaran terhadap peraturan sekolah. Hal ini sangat kami sayangkan, karena setiap siswa diharapkan mampu menunjukkan sikap disiplin, tanggung jawab, dan menjadi contoh yang baik bagi lingkungan sekitarnya.
            Sekolah tidak hanya menjadi tempat untuk meraih prestasi akademik, tetapi juga tempat untuk membentuk karakter yang kuat dan positif. Pelanggaran yang terjadi menunjukkan bahwa masih ada sikap yang perlu dibenahi demi kebaikan bersama.
            <br><br>
            Kami berharap kamu dapat menjadikan peringatan ini sebagai titik balik. Jadilah pribadi yang lebih sadar akan aturan, menghargai proses, dan memiliki komitmen untuk berubah ke arah yang lebih baik. Karena masa depanmu ditentukan oleh sikap yang kamu tanam hari ini.
            </p>
           </div> 
        <div class="row justify-content-center mt-4">
          <div class="col-md-5 mb-3">
            <img src="gambar/bk3.jpg" alt="Pelanggaran" class="img-fluid shadow rounded-4 w-100" style="height: 250px; object-fit: cover;" />
          </div>
          <div class="col-md-5 mb-3">
            <img src="gambar/bk4.jpg" alt="Pelanggaran" class="img-fluid shadow rounded-4 w-100" style="height: 250px; object-fit: cover;" />
          </div>
        </div>
      </div>
    </div>
  </section>
  
<script>
  const quotes = [
    "Disiplin adalah jembatan antara tujuan dan pencapaian.",
    "Kedisiplinan hari ini, kesuksesan esok hari.",
    "Tidak ada yang berhasil tanpa disiplin diri.",
    "Orang sukses melakukan apa yang tidak ingin dilakukan orang lain."
  ];
  document.addEventListener("DOMContentLoaded", () => {
    const motivasi = document.querySelector(".motivasi");
    motivasi.innerHTML = ` <i class="fas fa-quote-left me-2"></i> ${quotes[Math.floor(Math.random() * quotes.length)]}`;
  });
</script>
<footer class="text-center py-3 border-top">
    <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with </small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
