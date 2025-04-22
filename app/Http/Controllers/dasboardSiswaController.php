<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelanggaran;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dasboardSiswaController extends Controller
{
    public function showDbStudent()
    {
        // Ambil ID siswa yang sedang login
        $siswaId = Auth::id();
    
        // Ambil semua catatan pelanggaran beserta data siswa dan jenis pelanggaran
        $pelanggarans = CatatanPelanggaran::with(['student', 'pelanggaran'])
            ->get()
            ->groupBy('student_id')  // Kelompokkan berdasarkan student_id
            ->map(function ($pelanggaranGroup) {
                // Hitung total poin untuk setiap siswa, pastikan mengakses poin dengan benar
                $totalPoin = $pelanggaranGroup->sum(function ($pelanggaran) {
                    return $pelanggaran->pelanggaran->point;  // Poin dihitung berdasarkan relasi pelanggaran
                });
    
                // Ambil data pelanggaran terakhir (tanggal terbaru)
                $latestPelanggaran = $pelanggaranGroup->sortByDesc('created_at')->first();
    
                // Tambahkan total poin dan tanggal pelanggaran terakhir ke grup
                return (object) [
                    'student_id' => $pelanggaranGroup->first()->student_id,
                    'total_poin' => $totalPoin,
                    'latest_pelanggaran' => $latestPelanggaran,
                    'pelanggaranGroup' => $pelanggaranGroup,
                ];
            })
            ->sortByDesc(function ($pelanggaranGroup) {
                // Urutkan berdasarkan total poin untuk setiap grup
                return $pelanggaranGroup->total_poin;
            });
    
        return view('Student.daftarPelanggaran', compact('pelanggarans', 'siswaId'));
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/loginSiswa');
}

    
    

// 

    // public function showDbStudent()
    // {
    //     // Ambil ID siswa yang sedang login
    //     $siswaId = Auth::id();
    
    //     $pelanggarans = CatatanPelanggaran::with(['student', 'pelanggaran'])
    //         ->get()
    //         ->groupBy('student_id')
    //         ->map(function ($group) {
    //             $totalPoin = $group->sum(fn ($item) => $item->pelanggaran->point);
    //             $latest = $group->sortByDesc('created_at')->first();
    
    //             // Menggunakan head() untuk mendapatkan elemen pertama dari grup
    //             return (object) [
    //                 'student' => $group->first()->student,  // Ambil student pertama
    //                 'total_poin' => $totalPoin,
    //                 'latest_pelanggaran' => $latest,
    //                 'riwayat' => $group,
    //             ];
    //         })
    //         ->sortByDesc('total_poin');
    
    //     return view('Student.daftarPelanggaran', compact('pelanggarans', 'siswaId'));
    // }
    





}
