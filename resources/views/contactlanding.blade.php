<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DiscipliNotes</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      padding-bottom: 60px;
      min-height: 100vh; 
      position: relative;
    }

    header {
      background-color: #ffffff;
      padding: 1rem 3rem;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .navbar-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .logo-brand {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo-brand img {
      height: 50px;
      width: 50px;
      object-fit: contain;
    }

    .logo-brand span {
      font-weight: 700;
      color: #2c3e50;
      font-size: 1.5rem;
    }

    .nav-toggle {
      display: none;
      font-size: 1.5rem;
      cursor: pointer;
      background: none;
      border: none;
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

    .nav-links a.active {
      color: #0061f2;
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

    .contact-section {
      padding: 4rem 5%;
      background-color: #f9fafb;
    }

    .contact-info {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      margin: 0 auto;
      max-width: 800px;
    }

    .contact-info h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
      color: #1f2937;
      text-align: center;
    }

    .contact-info p {
      font-size: 1.1rem;
      color: #4b5563;
      line-height: 1.8;
      text-align: center;
    }

    .contact-info a {
      color: #0061f2;
      font-weight: 600;
      text-decoration: none;
    }

    footer {
      background: #ffffff;
      padding: 15px;
      text-align: center;
      font-size: 14px;
      border-top: 1px solid #ddd;
      margin-top: 40px;
      position: absolute;
      bottom: 0;
      width: 100%;
    }

    /* Bottom Nav (mobile only) */
    .bottom-nav {
      display: none;
    }

    @media (max-width: 768px) {
      .nav-toggle {
        display: block;
      }

      .nav-links {
        width: 100%;
        flex-direction: column;
        gap: 0;
        display: none;
        margin-top: 1rem;
      }

      .nav-links.show {
        display: flex;
      }

      .nav-links a, .dropdown-btn {
        width: 100%;
        padding: 1rem;
        text-align: left;
      }

      header {
        padding: 1rem;
      }

      .contact-section {
        padding: 3rem 2%;
      }

      .contact-info {
        padding: 1.5rem;
      }

      footer {
        margin-bottom: 60px;
      }

      .bottom-nav {
        display: flex;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #ffffff;
        border-top: 1px solid #ccc;
        justify-content: space-around;
        align-items: center;
        padding: 0.5rem 0;
        z-index: 1000;
      }

      .bottom-nav a {
        text-decoration: none;
        color: #666;
        font-size: 1.2rem;
        text-align: center;
      }

      .bottom-nav a.active,
      .bottom-nav a:hover {
        color: #0061f2;
      }

      .bottom-nav i {
        font-size: 1.4rem;
      }

      .bottom-nav span {
        display: block;
        font-size: 0.7rem;
      }
    }
  </style>
</head>
<body>

  <header>
    <div class="navbar-container">
      <div class="logo-brand">
        <img src="img/Logo smk-2.gif" alt="Logo">
        <span>DiscipliNotes</span>
      </div>
      <nav class="nav-links" id="navLinks">
        <a href="/">Home</a>
        <a href="/contactlanding" class="active">Contact</a>
        <div class="dropdown">
          <div class="dropdown-btn">Login</div>
          <div class="dropdown-content">
            <a href="login-siswa.html">Login Siswa</a>
            <a href="login-guru.html">Login Staf</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="contact-section">
    <div class="contact-info">
      <h2>Hubungi Kami</h2>
      <p>Jika Anda memiliki pertanyaan atau ingin memberikan masukan, Anda dapat menghubungi kami melalui informasi kontak berikut:</p>
      <p>Email: <a href="mailto:support@disciplinotes.com">support@disciplinotes.com</a></p>
      <p>Telepon: <a href="tel:+6282127849569">0821 2784 9569</a></p>
      <p>Atau Hubungi Instagram Kami:</p>
      <p><a href="https://instagram.com/alyadvkamhrnii" target="_blank">@alyadvkamhrnii</a></p>
      <p><a href="https://instagram.com/olvndraa" target="_blank">@olvndraa</a></p>

    </div>
  </section>

  <footer>
    <small>&copy; 2025. Admin Staf SMK - Semua Hak Dilindungi.</small>
  </footer>

  <nav class="bottom-nav">
    <a href="/">
      <i class="fas fa-home"></i>
      <span>Home</span>
    </a>
    <a href="/contactlanding" class="active">
      <i class="fas fa-envelope"></i>
      <span>Contact</span>
    </a>
    <a href="#">
      <i class="fas fa-sign-in-alt"></i>
      <span>Login</span>
    </a>
  </nav>

  <script>
    function toggleNav() {
      const nav = document.getElementById('navLinks');
      nav.classList.toggle('show');
    }
  </script>

</body>
</html>