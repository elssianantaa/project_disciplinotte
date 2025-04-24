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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> <!-- Gunakan hanya yang ini -->
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

    .navbar .dropdown-menu {
        z-index: 1050; /* pastikan lebih tinggi dari navbar */
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

<audio id="bg-music" loop hidden>
  <source src="{{ asset('audio/backsound.mp3') }}" type="audio/mpeg">
</audio>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      const audio = document.getElementById("bg-music");
      audio.volume = 0.15;

      // Coba mainkan langsung
      audio.play().catch(function (e) {
          console.warn("Autoplay diblokir oleh browser: ", e);
      });
  });
  

<audio id="bg-music" loop hidden>
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
};
});
</script>
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
                <a class="dropdown-item text-danger" href="{{ route('logoutSiswa') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logoutSiswa') }}" method="POST" style="display: none;">
                @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>


<!-- Hero Section (Carousel) -->
<div class="container my-4">
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
    </div>

    <div class="motivasi">
        <i class="fas me-2"></i>
        -Mulailah hari dengan kebiasaan baik dengan datang tepat waktu-
    </div>
</div>

<!-- Peringatan Pelanggaran -->
@if ($totalPoin > 0)
<section class="py-4">
    <div class="container">
        <div class="alert alert-info shadow rounded-4 animate_animated animate_fadeInUp">
            <h5 class="fw-bold">Peringatan untuk Siswa</h5>
            <p><strong>Perhatian!</strong><br><br>
                Kamu tercatat telah melakukan pelanggaran terhadap peraturan sekolah. Hal ini sangat kami sayangkan, karena setiap siswa diharapkan menunjukkan sikap disiplin, tanggung jawab, serta menjadi teladan yang baik bagi teman-teman lainnya.<br><br>
                Jadikan peringatan ini sebagai titik balik untuk memperbaiki sikap dan menjauhi pelanggaran di masa mendatang.
            </p>

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
</section>
@else
<section class="py-4 mb-5">
  <div class="container">
    <div class="alert alert-success shadow rounded-4">
      <h5 class="fw-bold">Tidak Ada Pelanggaran 🎉</h5>
      <p>Selamat! Kamu belum tercatat melakukan pelanggaran apapun. Terus pertahankan sikap disiplin dan menjadi contoh yang baik untuk teman-temanmu ya 🙌</p>
    </div>
    <div class="row justify-content-center align-items-center mt-4">
      <div class="col-md-4 mb-3 d-flex justify-content-center">
        <img src="gambar/animasi1.jpg" alt="Disiplin"
             class="img-fluid animate_animated animatefadeIn animatedelay-1s animate_slower"
             style="height: 250px; object-fit: contain;" />
      </div>
      <div class="col-md-6 mb-3 text-center">
        <h5 class="fw-bold">Terus Jaga Disiplinmu!</h5>
        <p>Dengan tidak adanya pelanggaran, kamu sudah menunjukkan sikap yang patut dicontoh. Pertahankan terus semangat positif ini ya 💪</p>
      </div>
    </div>
    <div class="row justify-content-center align-items-center mt-4">
      <div class="col-md-6 mb-3 text-center">
        <h5 class="fw-bold">Kamu Inspirasi Teman-Temanmu ✨</h5>
        <p>Sikap disiplin yang kamu tunjukkan bisa jadi contoh yang positif untuk lingkungan sekitarmu. Terus semangat dan tetap rendah hati ya 👏</p>
      </div>

      <div class="col-md-4 mb-3 d-flex justify-content-center">
        <img src="gambar/animasi2.jpg" alt="Disiplin"
             class="img-fluid animate_animated animatefadeIn animatedelay-1s animate_slower"
             style="height: 250px; object-fit: contain;" />
      </div>
    </div>
  </div>
</section>
@endif
<section style="padding: 4rem 5%; background-color: #fef9ff;">
    <h2 style="text-align: center; font-size: 2rem; color: #8e24aa; margin-bottom: 1rem;">
      🤓 Tebak-Tebakan Seru!
    </h2>
    <p style="text-align: center; font-size: 1.1rem; color: #6b21a8;">
      Ayo jawab dan buktikan kamu jago pantau siswa!
    </p>
  
    <div style="max-width: 600px; margin: 2rem auto; background-color: #f3e8ff; padding: 2rem; border-radius: 16px; box-shadow: 0 4px 14px rgba(0,0,0,0.1);">
      <h3 style="text-align: center; color: #6a1b9a;">📚 Apa pelanggaran yang paling sering ditemukan di sekolah?</h3>
      
      <div style="margin-top: 1.5rem;">
        <button onclick="checkAnswer('A')" style="margin: 0.5rem 0; width: 100%; padding: 0.8rem; border: none; border-radius: 8px; background-color: #ede7f6; font-size: 1rem; cursor: pointer;">
          A. Makan di kelas
        </button>
        <button onclick="checkAnswer('B')" style="margin: 0.5rem 0; width: 100%; padding: 0.8rem; border: none; border-radius: 8px; background-color: #ede7f6; font-size: 1rem; cursor: pointer;">
          B. Datang terlambat
        </button>
        <button onclick="checkAnswer('C')" style="margin: 0.5rem 0; width: 100%; padding: 0.8rem; border: none; border-radius: 8px; background-color: #ede7f6; font-size: 1rem; cursor: pointer;">
          C. Lupa bawa buku
        </button>
      </div>
  
      <p id="feedback" style="margin-top: 1rem; text-align: center; font-weight: bold; font-size: 1.1rem;"></p>
    </div>
  
    <script>
      function checkAnswer(option) {
        const feedback = document.getElementById('feedback');
        if (option === 'B') {
          feedback.innerHTML = '🎉 Yay! Benar banget, datang terlambat tuh paling sering!';
          feedback.style.color = '#2e7d32'; // hijau
        } else {
          feedback.innerHTML = '😅 Oops, belum tepat. Coba lagi yuk!';
          feedback.style.color = '#c62828'; // merah
        }
      }
    </script>
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
  <!-- Tambahkan ini di paling bawah sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
