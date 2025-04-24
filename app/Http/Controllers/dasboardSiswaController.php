<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelanggaran;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;



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



}


