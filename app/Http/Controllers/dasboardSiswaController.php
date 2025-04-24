<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelanggaran;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;



class dasboardSiswaController extends Controller
{

    public function showDbStudent()
    {
        // Ambil pelanggaran yang terjadi hari ini
        $pelanggarans = CatatanPelanggaran::with(['student', 'pelanggaran'])
            ->whereDate('created_at', Carbon::today())  // Mengambil data yang hanya terjadi hari ini
            ->get()
            ->groupBy('student_id')  // Kelompokkan berdasarkan student_id
            ->map(function ($group) {
                // Hitung total poin untuk setiap siswa
                $totalPoin = $group->sum(function ($catatan) {
                    return $catatan->pelanggaran->point;
                });

                // Ambil data pelanggaran terakhir (tanggal terbaru)
                $latestPelanggaran = $group->sortByDesc('created_at')->first();

                // Kembalikan data yang sudah diolah
                return (object)[
                    'student_id' => $group->first()->student_id,
                    'student' => $group->first()->student,
                    'total_poin' => $totalPoin,
                    'latest_pelanggaran' => $latestPelanggaran,
                    'pelanggaranGroup' => $group,
                ];
            })
            ->sortByDesc(function ($group) {
                return $group->total_poin;  // Urutkan berdasarkan total poin
            });

        return view('Student.daftarPelanggaran', compact('pelanggarans'));
    }
}