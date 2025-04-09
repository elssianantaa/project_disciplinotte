<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelanggaran;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class dasboardStaffController extends Controller
{
    //

    public function show(Request $request){
        $tanggal = $request->tanggal;

    $catatanpelanggaran = [];

    if ($tanggal) {
        $catatanpelanggaran = CatatanPelanggaran::with(['student', 'kelas', 'pelanggaran'])
            ->whereDate('tanggal', $tanggal)
            ->get();
    }

    return view('Staff.daftarPelanggaran', compact('catatanpelanggaran'));
    }

    public function createPelanggaran($id){
        $pelanggarans = Pelanggaran::select('id', 'nama_pelanggaran', 'kategori', 'point')->get();
        // $pelanggarans = $response->json();
        $student = Student::with('kelas', 'catatanpelanggarans')->findOrFail($id);
        return view('Staff.pelanggaran', compact('student', 'pelanggarans'));
    }


    public function addPelanggaran(Request $request){
        // $validateData = $request->validate([
        //     'student_id' => ['required', 'exists:students,id'],
        //     'kelas_id' => ['required', 'exists:kelas,id'],
        //     'nama_pelanggaran' => ['required', 'string', 'max:255'],
        //     'Kategori' => ['required', 'in:Ringan,Sedang,Berat'],
        //     'point' => ['required', 'numeric'],
        //     'deskripsi' => ['required', 'string', 'max:255'],
        //     'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        //     'staff_id' => ['required', 'exists:staff,id'],
        // ]);


        // $kategori = $request->Kategori;

        // // Tentukan poin berdasarkan kategori
        // $point = match ($kategori) {
        //     'Ringan' => 10,
        //     'Sedang' => 15,
        //     'Berat' => 20,
        //     default => 0, // Jika kategori tidak valid
        // };

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

         $pelanggaran = CatatanPelanggaran::create([
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

        $student = Student::findOrFail($request->student_id);
        // $student->increment('point', $point);

        return redirect('/daftarSiswa');
    }

}
