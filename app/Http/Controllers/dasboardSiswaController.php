<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelanggaran;
use Illuminate\Support\Facades\DB;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;



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



    public function riwayat()
    {
        $siswa = auth()->user();

        $riwayat = DB::table('catatan_pelanggarans')
                ->join('pelanggarans', 'catatan_pelanggarans.pelanggaran_id', '=', 'pelanggarans.id')
                ->where('catatan_pelanggarans.student_id', $siswa->id)
                ->select(
                    'catatan_pelanggarans.*',
                    'pelanggarans.nama_pelanggaran',
                    'pelanggarans.point'
                )
                ->get();

        return view('Student.riwayatPelanggaran', compact('riwayat'));
    }

    





}


