<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href=" {{ asset ('assets/bootstrap-5.3.2-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

</head>
<body>
    <div style="background-color: white;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-100"><path fill="#E8F0FE" fill-opacity="0.5" d="M0,192L20,192C40,192,80,192,120,170.7C160,149,200,107,240,96C280,85,320,107,360,117.3C400,128,440,128,480,122.7C520,117,560,107,600,96C640,85,680,75,720,80C760,85,800,107,840,101.3C880,96,920,64,960,58.7C1000,53,1040,75,1080,80C1120,85,1160,75,1200,64C1240,53,1280,43,1320,37.3C1360,32,1400,32,1420,32L1440,32L1440,0L1420,0C1400,0,1360,0,1320,0C1280,0,1240,0,1200,0C1160,0,1120,0,1080,0C1040,0,1000,0,960,0C920,0,880,0,840,0C800,0,760,0,720,0C680,0,640,0,600,0C560,0,520,0,480,0C440,0,400,0,360,0C320,0,280,0,240,0C200,0,160,0,120,0C80,0,40,0,20,0L0,0Z"></path></svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-100" style="margin-top: -500px;"><path fill="#E8F0FE" fill-opacity="1" d="M0,192L20,192C40,192,80,192,120,170.7C160,149,200,107,240,96C280,85,320,107,360,117.3C400,128,440,128,480,122.7C520,117,560,107,600,96C640,85,680,75,720,80C760,85,800,107,840,101.3C880,96,920,64,960,58.7C1000,53,1040,75,1080,80C1120,85,1160,75,1200,64C1240,53,1280,43,1320,37.3C1360,32,1400,32,1420,32L1440,32L1440,0L1420,0C1400,0,1360,0,1320,0C1280,0,1240,0,1200,0C1160,0,1120,0,1080,0C1040,0,1000,0,960,0C920,0,880,0,840,0C800,0,760,0,720,0C680,0,640,0,600,0C560,0,520,0,480,0C440,0,400,0,360,0C320,0,280,0,240,0C200,0,160,0,120,0C80,0,40,0,20,0L0,0Z"></path></svg>
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center " style="margin-top: -310px;">

                <div class="col-md-6">
                    <div class="card p-5 shadow" style="border-radius: 10px; background-color: white;">
                        <h1 style="text-align: center; font-size: 32px; font-weight: bold; color: #7DA0FA; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">  Disiplin Notes
                            <h1 class="" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;color: #D5E7FF; text-align: center;">Sign Into Your Account</h1>
                        </h1>

                        <p class="pt-3" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">
                            Silakan masuk untuk memantau, memperbarui, dan mengelola laporan kegiatan Anda.
                        </p>

                        <form  class="pt-2" action="/auth" method="post">
                            @csrf


                            <div class="form-group py-3">
                                <input type="email" name="email" class="form-control" placeholder="Enter your NISN" style="height:50px;background-color: #F5F7FF;">
                            </div>
                            <div class="form-group position-relative">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your Password" style="height:50px;background-color: #F5F7FF;">
                                <span onclick="togglePassword()" class="position-absolute" style="top:50%; right:10px; transform:translateY(-50%); cursor:pointer;">
                                    <i id="toggleIcon" class="fas fa-eye"></i>
                                </span>
                            </div>
                            <div class="form-group pt-4">
                                <button type="submit" class="w-100" style="height:50px; font-size: 20px; border-radius: 15px;background-color:#7DA0FA;color: white;border: none;">
                                    Login
                                </button>
                            </div>
                            <div class="pt-4 text-left">
                                <a href="#" style="font-size: 17px;color: #7DA0FA">Forgot your password?</a>
                                <p class="pt-2" style="color: #000000;">Don't have an account? <a href="/register"
                                    style="color: #7DA0FA;text-decoration: none;">Register here</a></p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Kolom Gambar -->
                <div class="col-md-6 d-none d-md-block">
                    <img src="gambar/imglogin.avif" alt="">
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin-top: -210px;"><path fill="#D5E7FF" fill-opacity="1" d="M0,224L40,224C80,224,160,224,240,224C320,224,400,224,480,218.7C560,213,640,203,720,176C800,149,880,107,960,128C1040,149,1120,235,1200,229.3C1280,224,1360,128,1400,80L1440,32L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin-top: -300px;"><path fill="#FAFAFA" fill-opacity="1" d="M0,224L40,224C80,224,160,224,240,224C320,224,400,224,480,218.7C560,213,640,203,720,176C800,149,880,107,960,128C1040,149,1120,235,1200,229.3C1280,224,1360,128,1400,80L1440,32L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>

    </div>
</body>
</html>

<script src="{{ asset ('assets/bootstrap-5.3.2-dist/js/bootstrap.min.js')}}"></script>
