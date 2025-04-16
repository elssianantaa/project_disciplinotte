<?php

use App\Http\Controllers\Api\PelanggaranImportController;
use App\Http\Controllers\Api\StudentImportController;
use App\Http\Controllers\KelasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelanggaranApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('pelanggaran/import', [PelanggaranImportController::class, 'importPelanggaran']);
Route::post('kelas/import', [KelasController::class, 'importkelas']);
Route::post('students/import', [StudentImportController::class, 'import']);
Route::get('/pelanggaran', [PelanggaranApiController::class, 'index']);
Route::post('/pelanggaran', [PelanggaranApiController::class, 'store']);
Route::delete('/pelanggaran/{id}', [PelanggaranApiController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
