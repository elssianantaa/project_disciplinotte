<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelanggaran;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class dasboardStaffController extends Controller
{
    //

    public function showprofil(){
        $user = Auth::user();
        return view('Staff.Profil', compact('user'));
    }

    public function showpe(){
        return view('Staff.Pengaturan');
    }
    public function show(Request $request){
        $tanggal = $request->tanggal;
        $kelas_id = $request->kelas_id;
        $nama = $request->nama;
        $totalPelanggaran = CatatanPelanggaran::count();


        $query = CatatanPelanggaran::with(['student', 'kelas', 'pelanggaran']);

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        if ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        }

        if ($nama) {
            $query->whereHas('student', function ($q) use ($nama) {
                $q->where('name', 'like', '%' . $nama . '%');
            });
        }

        $catatanpelanggaran = $query->get();
        $kelasList = Kelas::all();


        return view('Staff.daftarPelanggaran', compact('catatanpelanggaran', 'kelasList'));
    }


    public function createPelanggaran($id){
        $pelanggarans = Pelanggaran::select('id', 'nama_pelanggaran', 'kategori', 'point')->get();
        // $pelanggarans = $response->json();
        $student = Student::with('kelas', 'catatanpelanggarans')->findOrFail($id);
        return view('Staff.pelanggaran', compact('student', 'pelanggarans'));
    }


    public function addPelanggaran(Request $request){
        $validateData = $request->validate([
        'student_id'      => ['required', 'exists:students,id'],
        'kelas_id'        => ['required', 'exists:kelas,id'],
        'pelanggaran_id'  => ['required', 'exists:pelanggarans,id'],
        'deskripsi'       => ['required', 'string', 'max:255'],
        'foto'            => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        'tanggal'         => ['required', 'date'],
        ]);

        $fileName = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_pelanggaran', $fileName);
        }

        $tanggal = strtotime($request->tanggal);
        $tahun = date('Y', $tanggal);
        $bulan = date('m', $tanggal);

        if ($bulan >= 1 && $bulan <= 6) {
            $periode = "Semester 1 $tahun";
        } else {
            $periode = "Semester 2 $tahun";
        }

        // Ambil data siswa berdasarkan student_id
                $student = Student::with('kelas')->findOrFail($request->student_id);

        // Ambil data kelas berdasarkan kelas_id
         $kelas = Kelas::findOrFail($request->kelas_id);

         CatatanPelanggaran::create([
            'student_id'      => $request->student_id,
            'kelas_id'        => $request->kelas_id,
            'pelanggaran_id'  => $request->pelanggaran_id, // Ambil ID pelanggaran, bukan nama atau kategori
            // 'Kategori'        => $request->pelanggaran_id,
            // 'point'           => $request->pelanggaran_id,
            'deskripsi'       => $request->deskripsi,
            'foto'            => $fileName,
            'staff'           => auth()->user()->id, // Pastikan user adalah staff
            'tanggal'         => $request->tanggal,
            'periode'         => $periode, // Simpan periode sebagai "Semester X Tahun"
        ]);

        //status otomatis
        $totalPoint = $student->catatanpelanggarans->sum(function ($cp) {
            return $cp->pelanggaran->point ?? 0;
        });

        // Tentukan status baru berdasarkan total point
        $statusBaru = 'aktif';
        if ($totalPoint >= 40) {
            $statusBaru = 'dikeluarkan';
        } elseif ($totalPoint >= 30) {
            $statusBaru = 'skorsing';
        }

        // Update status siswa
        $student->update([
            'status' => $statusBaru
        ]);

        $student = Student::findOrFail($request->student_id);
        // $student->increment('point', $point);

        return redirect('/daftarSiswa');
    }

}
