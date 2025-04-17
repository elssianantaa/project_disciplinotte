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
        $pelanggarans = CatatanPelanggaran::with(['student', 'pelanggaran'])
            ->get()
            ->groupBy('student_id')  // Kelompokkan berdasarkan student_id
            ->map(function ($pelanggaranGroup) {
                // Hitung total poin untuk setiap siswa
                $totalPoin = $pelanggaranGroup->sum(function ($pelanggaran) {
                    return $pelanggaran->pelanggaran->point;
                });

                // Ambil data pelanggaran terakhir (tanggal terbaru)
                $latestPelanggaran = $pelanggaranGroup->sortByDesc('created_at')->first();

                // Tambahkan total poin dan tanggal pelanggaran terakhir ke grup
                $pelanggaranGroup->total_poin = $totalPoin;
                $pelanggaranGroup->latest_pelanggaran = $latestPelanggaran;

                return $pelanggaranGroup;
            })
            ->sortByDesc(function ($pelanggaranGroup) {
                // Urutkan berdasarkan total poin
                return $pelanggaranGroup->first()->total_poin;
            });

        return view('Student.daftarPelanggaran', compact('pelanggarans'));
    }






}
