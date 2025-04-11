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
                        <h1 class="text-center text-primary" style="font-family: 'Trebuchet MS', sans-serif;">DiscipliNotes</h1>
                        <h2 class="text-center text-secondary" style="font-family: 'Trebuchet MS', sans-serif;">Sign Into Your Account</h2>

                        <p class="pt-3" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            Silakan masuk untuk memantau, memperbarui, dan mengelola data pelanggaran siswa
                        </p>

                        <form action="/auth" method="post" class="pt-2">
                            @csrf
                            <div class="form-group py-3">
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" style="height: 50px; background-color: #F5F7FF;">
                            </div>

                            <div class="form-group position-relative">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" style="height: 50px; background-color: #F5F7FF;">
                                <span onclick="togglePassword()" class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                                    <i id="toggleIcon" class="fas fa-eye"></i>
                                </span>
                            </div>

                            <div class="form-group pt-4">
                                <button type="submit" class="btn w-100" style="height: 50px; font-size: 20px; border-radius: 15px; background-color: #7DA0FA; color: white; border: none;">
                                    Login
                                </button>
                            </div>

                            <div class="pt-4 text-center">
                                <a href="#">Forgot your password?</a>
                                <p>Don't have an account? <a href="/register">Register here</a></p>
                            </div>
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