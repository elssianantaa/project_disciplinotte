<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DiscipliNotes</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background-color: #ffffff;
    }

    header {
      background-color: #ffffff;
      padding: 1rem 3rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .navbar-container {
      max-width: 1200px;
      width: 100%;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo-brand {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo-brand img {
      height: 50px;
      width: 50px;
      object-fit: cover;
    }

    .logo-brand span {
      font-weight: 700;
      color: #2c3e50;
      font-size: 1.5rem;
    }

    .nav-links {
      display: flex;
      gap: 2rem;
      align-items: center;
    }

    .nav-links a {
      text-decoration: none;
      color: #34495e;
      font-weight: 600;
      padding: 0.5rem 1rem;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #0061f2;
    }

    .dropdown {
      position: relative;
    }

    .dropdown-btn {
      background-color: #0061f2;
      color: white;
      padding: 0.6rem 1.2rem;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .dropdown-btn:hover {
      background-color: #0051c0;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
      border-radius: 6px;
      overflow: hidden;
      z-index: 1000;
      min-width: 180px;
    }

    .dropdown-content a {
      display: block;
      padding: 0.8rem 1.2rem;
      text-decoration: none;
      color: #34495e;
      font-weight: 500;
      white-space: nowrap;
      transition: background-color 0.3s ease;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .hero {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      padding: 5rem 5% 3rem;
      background-color: #e9efff;
      text-align: center;
    }

    .hero-text {
      flex: 1 1 400px;
      max-width: 700px;
      margin: 0 auto;
    }

    .hero-text h1 {
      font-size: 2.8rem;
      margin-bottom: 1rem;
      color: #1f2937;
    }

    .hero-text p {
      font-size: 1.1rem;
      color: #6b7280;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .hero-text a {
      padding: 0.8rem 1.5rem;
      margin-right: 1rem;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary {
      background-color: #0061f2;
      color: white;
    }

    .btn-secondary {
      background-color: #d1e0ff;
      color: #0061f2;
    }

    .hero-image {
      width: 450px;
      max-width: 100%;
      margin-top: 2rem;
    }

    .wave {
      margin-top: -60px;
    }

    footer {
      background: #ffffff;
      padding: 15px;
      text-align: center;
      font-size: 14px;
      border-top: 1px solid #ddd;
      margin-top: 40px;
    }

    /* Bottom Navigation Mobile */
    .bottom-nav {
      display: none;
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }

      .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #ffffff;
        border-top: 1px solid #ddd;
        display: flex;
        justify-content: space-around;
        padding: 0.4rem 0;
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        z-index: 999;
      }

      .bottom-nav .nav-item {
        text-align: center;
        color: #34495e;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.75rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        flex: 1;
      }

      .bottom-nav .nav-item .icon {
        font-size: 1.2rem;
      }

      .bottom-nav .nav-item.active,
      .bottom-nav .nav-item:hover {
        color: #0061f2;
      }
      .fade-in {
    opacity: 0;
    animation: fadeIn 1s ease-in-out forwards;
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}
    }
  </style>
</head>
<audio id="bg-music" loop>
    <source src="{{ asset('audio/backsound.mp3') }}" type="audio/mpeg">
  </audio>
  
  <script>
    const audio = document.getElementById('bg-music');
    audio.volume = 0.3;
  
    // Trick: Play saat user scroll sedikit
    window.addEventListener('scroll', () => {
      audio.play();
    });
  </script>
  

<body>

  <header>
    <div class="navbar-container">
      <div class="logo-brand">
        <img src="gambar/Logosmk.gif" alt="Logo">
        <span>DiscipliNotes</span>
      </div>
      <nav class="nav-links">
        <a href="/landingpage" class="active">Home</a>
        <!-- <a href="about.html" class="">About</a> -->
        <a href="/contactlanding" class="">Contact</a>
        <div class="dropdown">
          <div class="dropdown-btn">Login</div>
          <div class="dropdown-content">
            <a href="/loginSiswa">Login Siswa</a>
            <a href="{{route ('Admin.login')}}">Login Staf</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="hero-text">
      <h1>Catatan Pelanggaran Siswa</h1>
      <p>DiscipliNotes adalah aplikasi berbasis web yang dirancang untuk membantu sekolah dalam mencatat dan memantau pelanggaran siswa secara digital. Dengan antarmuka yang mudah digunakan, admin dan staff dapat mencatat, melacak, dan menganalisis data pelanggaran untuk menciptakan lingkungan belajar yang lebih disiplin.</p>
      {{-- <a href="#" class="btn-primary">Mulai Sekarang →</a> --}}
      {{-- <a href="#" class="btn-secondary">Pelajari Lebih Lanjut</a> --}}
    </div>
    <img class="hero-image" src="gambar/landing.png" alt="Hero Image"/>
  </section>

  <div class="wave">
    <svg viewBox="0 0 1440 320" style="display: block;" xmlns="http://www.w3.org/2000/svg">
      <path fill="#e9efff" fill-opacity="1" d="M0,224L60,202.7C120,181,240,139,360,117.3C480,96,600,96,720,117.3C840,139,960,181,1080,186.7C1200,192,1320,160,1380,144L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
    </svg>
  </div>

  <section style="padding: 4rem 5%; background-color: #ffffff;">
    <h2 style="text-align: center; font-size: 2rem; color: #1f2937; margin-bottom: 2rem;">Fitur Utama DiscipliNotes</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
      <div style="background-color: #f3f4f6; padding: 1.5rem; border-radius: 10px;">
        <h3 style="color: #0061f2;">Catat Pelanggaran</h3>
        <p>Staff dapat mencatat pelanggaran siswa dengan cepat dan efisien melalui antarmuka sederhana.</p>
      </div>
      <div style="background-color: #f3f4f6; padding: 1.5rem; border-radius: 10px;">
        <h3 style="color: #0061f2;">Rekap Otomatis</h3>
        <p>Setiap pelanggaran akan otomatis terekam dan masuk dalam rekapitulasi bulanan siswa.</p>
      </div>
      <div style="background-color: #f3f4f6; padding: 1.5rem; border-radius: 10px;">
        <h3 style="color: #0061f2;">Login Admin,Staff dan Siswa</h3>
        <p>Tersedia akses login terpisah antara admin, staff dan siswa untuk memantau data masing-masing.</p>
      </div>
      <div style="background-color: #f3f4f6; padding: 1.5rem; border-radius: 10px;">
        <h3 style="color: #0061f2;">Dashboard Interaktif</h3>
        <p>Pantau statistik dan grafik pelanggaran siswa secara real-time dan mudah dipahami.</p>
      </div>
    </div>
  </section>
  <section style="padding: 4rem 5%; background-color: #e3f2fd;">
    <h2 style="text-align: center; font-size: 2.5rem; color: #0d47a1; margin-bottom: 1rem;">
      Kenapa <span style="color: #0061f2;">DiscipliNotes</span>?
    </h2>
    <p style="max-width: 800px; margin: auto; text-align: center; font-size: 1.1rem; color: #1f2937; line-height: 1.7;">
      Kami percaya bahwa <strong>kedisiplinan adalah kunci sukses siswa.</strong> Dengan sistem pelaporan yang 
      <em>transparan</em> dan <em>real-time</em>, sekolah dapat membimbing siswa lebih baik tanpa 
      mengandalkan metode konvensional yang lambat dan kurang efisien. 
    </p>
  
    <div style="display: flex; justify-content: center; gap: 2rem; margin-top: 2rem; flex-wrap: wrap;">
      <div style="background-color: #bbdefb; padding: 1.5rem; border-radius: 10px; width: 250px; text-align: center;">
        <h3 style="color: #0051c0;">📌 Fokus</h3>
        <p>Mempermudah guru dalam mencatat dan memantau pelanggaran siswa.</p>
      </div>
      <div style="background-color: #bbdefb; padding: 1.5rem; border-radius: 10px; width: 250px; text-align: center;">
        <h3 style="color: #0051c0;">🔒 Transparansi</h3>
        <p>Data tercatat rapi dan bisa diakses oleh pihak terkait secara jelas.</p>
      </div>
      <div style="background-color: #bbdefb; padding: 1.5rem; border-radius: 10px; width: 250px; text-align: center;">
        <h3 style="color: #0051c0;">⚡ Efisien</h3>
        <p>Tidak perlu lagi laporan manual, semua bisa tercatat otomatis.</p>
      </div>
    </div>
  </section>
  <section style="padding: 4rem 5%; background-color: #ffffff;">
    <h2 style="text-align: center; font-size: 2rem; color: #0d47a1; margin-bottom: 1rem;">
      🎮 Mini Quiz: Seberapa Tahu Kamu?
    </h2>
    <p style="text-align: center; font-size: 1.1rem; color: #374151;">
      Klik kartu di bawah ini untuk melihat jawabannya! 🎉
    </p>
  
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 2rem; margin-top: 2rem;">
      <!-- Quiz 1 -->
      <div onclick="toggleAnswer('a1')" 
           style="cursor: pointer; width: 300px; background-color: #e3f2fd; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; position: relative; overflow: hidden; transition: transform 0.3s; animation: bounce 1s infinite;">
        <h3 style="color: #0061f2; font-size: 1.2rem;">🤔 Pelanggaran paling sering di sekolah?</h3>
        <p id="a1" style="display: none; margin-top: 1rem; color: #1e3a8a;">👉 Datang terlambat ke sekolah!</p>
        <div id="fireworks1" class="fireworks" style="display: none; position: absolute; top: 0; left: 50%; transform: translateX(-50%);">
          <img src="https://img.icons8.com/ios/452/fireworks.png" style="width: 100px; animation: fireworksAnimation 1s infinite;">
        </div>
      </div>
  
      <!-- Quiz 2 -->
      <div onclick="toggleAnswer('a2')" 
           style="cursor: pointer; width: 300px; background-color: #e3f2fd; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; position: relative; overflow: hidden; transition: transform 0.3s; animation: bounce 1s infinite;">
        <h3 style="color: #0061f2; font-size: 1.2rem;">🧐 Apa pelanggaran yang dianggap ringan di sekolah?</h3>
        <p id="a2" style="display: none; margin-top: 1rem; color: #1e3a8a;">👉 Tidak memakai seragam lengkap atau makan di dalam kelas.</p>
        <div id="fireworks2" class="fireworks" style="display: none; position: absolute; top: 0; left: 50%; transform: translateX(-50%);">
          <img src="https://img.icons8.com/ios/452/fireworks.png" style="width: 100px; animation: fireworksAnimation 1s infinite;">
        </div>
      </div>
  
      <!-- Quiz 3 -->
      <div onclick="toggleAnswer('a3')" 
           style="cursor: pointer; width: 300px; background-color: #e3f2fd; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; position: relative; overflow: hidden; transition: transform 0.3s; animation: bounce 1s infinite;">
        <h3 style="color: #0061f2; font-size: 1.2rem;">😅 Siapa yang bisa lihat laporan pelanggaran?</h3>
        <p id="a3" style="display: none; margin-top: 1rem; color: #1e3a8a;">👉 Admin, Staff, dan Siswa!</p>
        <div id="fireworks3" class="fireworks" style="display: none; position: absolute; top: 0; left: 50%; transform: translateX(-50%);">
            <img src="" alt="Fireworks" style="width: 100px; height: 100px;" />


        </div>
      </div>
    </div>
  
    <style>
      /* Bounce animation on click */
      @keyframes bounce {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
      }
  
      /* Fireworks animation */
      @keyframes fireworksAnimation {
        0% { opacity: 0; transform: scale(0.5); }
        50% { opacity: 1; transform: scale(1); }
        100% { opacity: 0; transform: scale(0.5); }
      }
    </style>
  
    <script>
      function toggleAnswer(id) {
        const ans = document.getElementById(id);
        ans.style.display = ans.style.display === 'none' ? 'block' : 'none';
  
        // Show fireworks animation on click
        const fireworks = document.getElementById('fireworks' + id.slice(1));
        fireworks.style.display = 'block';
        setTimeout(() => {
          fireworks.style.display = 'none';
        }, 1500); // Hide fireworks after 1.5s
      }
    </script>
  </section>
  

  
 

  <footer class="text-center py-3 border-top">
    <small>&copy; 2025. Admin Staf SMK - All Rights Reserved. Hand-crafted with ❤</small>
  </footer>

  <div class="bottom-nav">
    <a href="/landingpage" class="nav-item">
      <span class="icon">🏠</span>
      <span class="text">Home</span>
    </a>
    <a href="/contactlanding" class="nav-item">
      <span class="icon">📋</span>
      <span class="text">Contact</span>
    </a>
  </div>

</body>
</html>