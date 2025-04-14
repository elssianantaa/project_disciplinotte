<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelanggaran;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class dasboardSiswaController extends Controller
{

    public function showDbStudent()
{
    // Ambil semua catatan pelanggaran beserta data siswa dan jenis pelanggaran
    $pelanggarans = CatatanPelanggaran::with([
        'student',       // relasi ke data siswa (misalnya nama, nisn, kelas)
        'pelanggaran'
    ])
    ->orderBy('created_at', 'desc') // bisa juga pakai point kalau mau urut berdasarkan pelanggaran terberat
    ->get();

    return view('Student.dashboardSiswa', compact('pelanggarans'));
}


}
