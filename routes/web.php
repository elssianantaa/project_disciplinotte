<?php

use App\Http\Controllers\dasboardController;
use App\Http\Controllers\dasboardStaffController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\userController;
use App\Models\Staff;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/hello', function () {
//     return 'Hello Olaf';
// });

// Route::get('test', function () {
//     return 'testt yak';
// });

//LOGIN
// Route::get('/dasboard', [dasboardController::class, 'showDasboard']);
Route::get('/', [dasboardController::class, 'login']);
Route::post('/auth', [dasboardController::class, 'authentication']);
Route::get('/dashboard', [dasboardController::class, 'showDb']);
Route::get('/dashboardStaff', [dasboardController::class, 'showDbStaff']);
Route::get('/register', [userController::class, 'createRe']);
Route::post('/register/create', [userController::class, 'addRe']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Route::get('/pengaturan', [dasboardStaffController::class, 'pengaturan'])->name('pengaturan');
// Route::post('/pengaturan', [dasboardStaffController::class, 'updatePengaturan'])->name('staff.pengaturan');
// Rute untuk form edit profil
Route::get('/staff/profile/{id}/edit', [dasboardStaffController::class, 'edit'])->name('staff.profile.edit');

// Rute untuk proses update profil
Route::put('/staff/profile/{id}', [dasboardStaffController::class, 'update'])->name('staff.profile.update');
Route::get('/profil', [dasboardStaffController::class, 'showprofil']);



Route::middleware('auth', 'staff')->group(function () {
    //NAMPILIN SISWA DI DASBOARD STAFF
    Route::get('/daftarSiswa', [dasboardController::class, 'show']);

    //CRUD PELANGGARAN
    Route::get('/daftarPelanggaran', [dasboardStaffController::class, 'show'])->name('staff.laporan');
    Route::get('/pelanggaran/{id}', [dasboardStaffController::class, 'createPelanggaran']);
    Route::post('/pelanggaran/create/', [dasboardStaffController::class, 'addPelanggaran'])->name('pelanggaran.store');

});


//CRUDE TAMBAH SISWA
// Route::get('/admin/dashboard', [DasboardController::class, 'index'])->name('admin.siswa.index');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/pengaturan', [dasboardController::class, 'showpe']);
    Route::get('/admin/siswa', [dasboardController::class, 'index'])->name('admin.siswa.index');
    Route::get('/admin/siswa/create', [dasboardController::class, 'create'])->name('admin.siswa.create');
    Route::post('/admin/siswa/store', [dasboardController::class, 'store'])->name('admin.siswa.store');
    Route::get('/admin/dashboard/{siswa}/edit', [dasboardController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/admin/dashboard/{siswa}', [dasboardController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/admin/dashboard/{siswa}', [dasboardController::class, 'destroy'])->name('admin.siswa.destroy');

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

// Rute untuk form edit profil
Route::get('/admin/profile/{id}/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');

// Rute untuk proses update profil
Route::put('/admin/profile/{id}', [ProfileController::class, 'update'])->name('admin.profile.update');
});




















































