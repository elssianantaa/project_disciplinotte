<?php

use App\Http\Controllers\dasboardController;
use App\Http\Controllers\dasboardStaffController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\userController;
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

//CRUD STUDENTS
Route::get('/daftarSiswa', [studentController::class, 'show']);

//CRUD PELANGGARAN
Route::get('/pelanggaran/{id}', [dasboardStaffController::class, 'createPelanggaran']);
Route::post('/pelanggaran/create/{id}', [dasboardController::class, 'addPelanggaran']);

//CRUDE TAMBAH SISWA
// Route::get('/admin/dashboard', [DasboardController::class, 'index'])->name('admin.siswa.index');
Route::get('/admin/siswa', [dasboardController::class, 'index'])->name('admin.siswa.index');
Route::get('/admin/siswa/create', [dasboardController::class, 'create'])->name('admin.siswa.create');
Route::post('/admin/siswa/store', [dasboardController::class, 'store'])->name('admin.siswa.store');
Route::get('/admin/dashboard/{siswa}/edit', [dasboardController::class, 'edit'])->name('admin.siswa.edit');
Route::put('/admin/dashboard/{siswa}', [dasboardController::class, 'update'])->name('admin.siswa.update');
Route::delete('/admin/dashboard/{siswa}', [dasboardController::class, 'destroy'])->name('admin.siswa.destroy');






















































