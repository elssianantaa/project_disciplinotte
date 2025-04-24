<?php

use App\Http\Controllers\dasboardController;
use App\Http\Controllers\dasboardSiswaController;
use App\Http\Controllers\dasboardStaffController;
use App\Http\Controllers\PelanggaranApiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileStudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\userController;
use App\Models\Staff;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//LOGIN
// Route::get('/dasboard', [dasboardController::class, 'showDasboard']);
Route::get('/', [dasboardController::class, 'login']);
Route::post('/auth', [dasboardController::class, 'authentication']);
// Route::get('/login', [dasboardController::class, 'login'])->name('login');

Route::get('/register', [userController::class, 'createRe']);
Route::post('/register/create', [userController::class, 'addRe']);
Route::get('/login', [dasboardController::class, 'login'])->middleware('guest'); // ✅ BENAR
Route::get('/loginSiswa', [studentController::class, 'showLoginForm'])->name('Student.login');
Route::post('/loginSiswa', [studentController::class, 'login']);
Route::get('/dashboardSiswa', [studentController::class, 'dashboard'])->name('Student.dashboardSiswa');

Route::post('/logoutSiswa', [studentController::class, 'logoutSiswa'])->name('Student.logoutSiswa');
// web.php
Route::post('/logoutSiswa', [dasboardSiswaController::class, 'logout'])->name('logoutSiswa');
Route::post('/logoutSiswa', [studentController::class, 'logoutSiswa'])->name('logoutSiswa');
Route::get('/tentangkami', [studentController::class, 'tentangkami'])->name('Student.tentangkami');

Route::get('/updatepassword', [studentController::class, 'showUpdatePasswordForm'])->name('updatePassword');
Route::post('/updatepassword', [studentController::class, 'updatePassword'])->name('updatePassword.post');
Route::get('/profile-siswa', [ProfileStudentController::class, 'show'])->name('Student.profile.show');
Route::get('/profile-siswa/edit', [ProfileStudentController::class, 'edit'])->name('Student.profile.edit');
Route::put('/profile-siswa/{id}', [ProfileStudentController::class, 'update'])->name('Student.profile.update');
// Route::get('/profile', [ProfileStudentController::class, 'show'])->name('Student.profile.show');
// Route::get('/profile/edit', [ProfileStudentController::class, 'edit'])->name('Student.profile.edit');
// Route::post('/profile/update/{id}', [ProfileStudentController::class, 'update'])->name('Student.profile.update');



Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::post('/kelas/import', [KelasController::class, 'import'])->name('kelas.import');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::middleware('auth:web','staff')->group(function () {
    Route::get('/dashboardStaff', [dasboardController::class, 'showDbStaff']);

    //NAMPILIN DAFTAR SKORSING
    Route::get('/daftarSkorsing', [dasboardStaffController::class, 'showSkorsing']);

    //NAMPILIN DAFTAR SISWA DIKELUARKAN
    Route::get('/daftarOut', [dasboardStaffController::class, 'showOut']);

    //NAMPILIN SISWA DI DASBOARD STAFF
    Route::get('/daftarSiswa', [dasboardController::class, 'show']);

    //CRUD PELANGGARAN
    Route::get('/daftarPelanggaran', [dasboardStaffController::class, 'show'])->name('staff.laporan');
    Route::get('/pelanggaran/{id}', [dasboardStaffController::class, 'createPelanggaran']);
    Route::post('/pelanggaran/create/', [dasboardStaffController::class, 'addPelanggaran'])->name('pelanggaran.store');
    Route::get('/staff/profile/{id}/edit', [dasboardStaffController::class, 'edit'])->name('staff.profile.edit');



// Rute untuk proses update profil
    Route::put('/staff/profile/{id}', [dasboardStaffController::class, 'update'])->name('staff.profile.update');
    Route::get('/profil', [dasboardStaffController::class, 'showprofil']);

});


//CRUDE TAMBAH SISWA
// Route::get('/admin/dashboard', [DasboardController::class, 'index'])->name('admin.siswa.index');
Route::middleware(['auth:web','admin'])->group(function () {
    Route::get('/pengaturan', [dasboardController::class, 'showpe']);
    Route::get('/dashboard', [dasboardController::class, 'dashboard']);
    Route::get('/admin/siswa', [dasboardController::class, 'index'])->name('admin.siswa.index');
    Route::get('/admin/siswa/create', [dasboardController::class, 'create'])->name('admin.siswa.create');
    Route::post('/admin/siswa/store', [dasboardController::class, 'store'])->name('admin.siswa.store');
    Route::get('/admin/dashboard/{siswa}/edit', [dasboardController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/admin/dashboard/{siswa}', [dasboardController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/admin/dashboard/{siswa}', [dasboardController::class, 'destroy'])->name('admin.siswa.destroy');

    Route::get('/rekapSiswa', [dasboardController::class, 'showRekap'])->name('rekap.siswa');

    Route::get('/admin/kelolastaff', [StaffController::class, 'index'])->name('admin.kelolastaff.index');
    Route::get('/admin/kelolastaff/create', [StaffController::class, 'create'])->name('admin.kelolastaff.create');
    Route::post('/admin/kelolastaff/store', [StaffController::class, 'store'])->name('admin.kelolastaff.store');
    Route::get('/admin/kelolastaff/{kelolastaff}/edit', [StaffController::class, 'edit'])->name('admin.kelolastaff.edit');
    Route::put('/admin/kelolastaff/{kelolastaff}', [StaffController::class, 'update'])->name('admin.kelolastaff.update');
    Route::delete('/admin/kelolastaff/{kelolastaff}', [StaffController::class, 'destroy'])->name('admin.kelolastaff.destroy');


    Route::get('/admin/users', [userController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [userController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [userController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [userController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [userController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [userController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/profile', [ProfileController::class, 'show'])->name('admin.profile.show');
    Route::get('/admin/profile/{id}/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile/{id}', [ProfileController::class, 'update'])->name('admin.profile.update');

});
// Route::middleware(['auth:student', 'student'])->group(function () {
    // Route::get('/dashboardSiswa', [studentController::class, 'dashboard'])->name('Student.dashboardSiswa');
    // Route::post('/updatePassword', [studentController::class, 'updatePassword'])->name('updatePassword');
    // Route::get('/updatePassword', [studentController::class, 'showUpdatePasswordForm'])->name('updatePasswordForm');
    // Route::get('/student/profile', [ProfileStudentController::class, 'show'])->name('Student.profile.show');
    // Route::get('/student/profile/edit/{id}', [ProfileStudentController::class, 'edit'])->name('Student.profile.edit');
    // Route::post('/student/profile/update/{id}', [ProfileStudentController::class, 'update'])->name('Student.profile.update');
    // Route::get('/logoutSiswa', [studentController::class, 'logout'])->name('logout');


// });

// Route::get('/dashboardSiswa', [StudentController::class, 'dashboard'])->name('Student.dashboardSiswa');
// Route::get('/student/profile', [ProfileStudentController::class, 'show'])->name('Student.profile.show');
// Route::get('/student/profile/edit/{id}', [ProfileStudentController::class, 'edit'])->name('Student.profile.edit');
// Route::post('/student/profile/update/{id}', [ProfileStudentController::class, 'update'])->name('Student.profile.update');

// DAFTAR PELANGGARAN DI DASHBOARD SISWA
Route::get('/daftarPelanggaranSiswa', [dasboardSiswaController::class, 'showDbStudent'])->name('dashboardSiswa');
Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::post('/kelas/import', [KelasController::class, 'import'])->name('kelas.import');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


// naik kelas
Route::get('/riwayatKelas', [dasboardStaffController::class, 'showKelas'])->name('show');
Route::get('/kenaikanKelas', [dasboardStaffController::class, 'showRiwayatKelas'])->name('form.naik.kelas');
Route::post('/naikKelas', [dasboardStaffController::class, 'naikKelas'])->name('naik.kelas');
Route::post('/logoutSiswa', [dasboardSiswaController::class, 'logout'])->name('logout');
// Login Admin


// RIWAYAT PELANGGARAN
Route::get('/siswa/riwayat-pelanggaran', [dasboardSiswaController::class, 'riwayat'])->name('siswa.riwayat');
















































