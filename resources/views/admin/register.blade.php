<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</head>
<body>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div style="background-color: rgb(255, 255, 255);">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-100">
            <path fill="#E8F0FE" fill-opacity="0.5" d="M0,192L20,192C40,192,80,192,120,170.7C160,149,200,107,240,96C280,85,320,107,360,117.3C400,128,440,128,480,122.7C520,117,560,107,600,96C640,85,680,75,720,80C760,85,800,107,840,101.3C880,96,920,64,960,58.7C1000,53,1040,75,1080,80C1120,85,1160,75,1200,64C1240,53,1280,43,1320,37.3C1360,32,1400,32,1420,32L1440,32L1440,0L0,0Z"></path>
        </svg>

        <div class="container mt-5">
            <div class="row justify-content-center align-items-center" style="margin-top: -310px;">
                <div class="col-md-6">
                    <div class="card p-5 shadow" style="border-radius: 10px; background-color: white;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="/" class="text-decoration-none text-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                            </a>
                            <h1 class="text-center flex-grow-1 text-primary m-0" style="font-family: 'Trebuchet MS', sans-serif;">DiscipliNotes</h1>
                            <span style="width: 24px;"></span> <!-- Placeholder biar teks tetap di tengah -->
                        </div>

                        <h2 class="text-center text-secondary" style="font-family: 'Trebuchet MS', sans-serif;">Create Your Account</h2>

                        <p class="pt-3" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            Buat akun untuk mulai memantau dan mencatat pelanggaran siswa.
                        </p>


                        <form action="/register/create" method="post">
                            @csrf

                            {{-- Full Name --}}
                            <input type="text" name="name" placeholder="Full Name"
                                class="form-control mb-3 @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- Email --}}
                            <input type="email" name="email" placeholder="Email"
                                class="form-control mb-3 @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- Password --}}
                            <input type="password" name="password" placeholder="Password"
                                class="form-control mb-3 @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- Konfirmasi Password --}}
                            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                class="form-control mb-3">

                            {{-- Role Tersembunyi (Kalau role-nya fix staff misalnya) --}}
                            <input type="hidden" name="role" value="staff">

                            <button type="submit" class="btn w-100" style="background-color: #7DA0FA;color: white;">Register</button>
                        </form>


                    </div>
                </div>

                <div class="col-md-6 d-none d-md-block">
                    <img src="/gambar/imglogin.avif" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.getElementById("toggleIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
