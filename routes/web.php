<?php

use App\Http\Controllers\dasboardController;
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

<<<<<<< HEAD
// Route::get('/', function () {
//     return view('welcome');
// });
=======
Route::get('/', function () {
    return view('admin.index');
});
>>>>>>> 2fbbc38d63307a4e7e6294058f9b8a657744e337

// Route::get('/hello', function () {
//     return 'Hello Olaf';
// });
<<<<<<< HEAD

// Route::get('test', function () {
//     return 'testt yak';
// });

Route::get('/dasboard', [dasboardController::class, 'showDasboard']);
Route::get('/', [dasboardController::class, 'login']);
Route::post('/auth', [dasboardController::class, 'authentication']);
Route::get('/dashboard', [dasboardController::class, 'showDb']);
=======

// Route::get('test', function () {
//     return 'testt yak';
// });


>>>>>>> 2fbbc38d63307a4e7e6294058f9b8a657744e337
