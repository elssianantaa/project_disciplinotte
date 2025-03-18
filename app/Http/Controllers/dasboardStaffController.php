<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Student;
use Illuminate\Http\Request;

class dasboardStaffController extends Controller
{
    //

    public function show(){
        $data['pelanggaran'] = Pelanggaran::all();
        return view('Staff.daftarPelanggaran', $data);
    }
    public function createPelanggaran($id){
        $student = Student::with('kelas', 'pelanggarans')->findOrFail($id);
        return view('Staff.pelanggaran', compact('student'));
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


        $kategori = $request->Kategori; 

        // Tentukan poin berdasarkan kategori
        $point = match ($kategori) {
            'Ringan' => 10,
            'Sedang' => 15,
            'Berat' => 20,
            default => 0, // Jika kategori tidak valid
        };

        $fileName = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_pelanggaran', $fileName);
        }

        // Ambil data siswa berdasarkan student_id
                $student = Student::with('kelas')->findOrFail($request->student_id);

    // Ambil data kelas berdasarkan kelas_id
         $kelas = Kelas::findOrFail($request->kelas_id);

        $pelanggaran = Pelanggaran::create([
            'student_id' => $request->student_id,
            'kelas_id' => $request->kelas_id,
            'nama_pelanggaran' => $request->nama_pelanggaran,
            'Kategori' => $request->Kategori,
            'point' => $point,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
            'staff' => auth()->user()->id,
        ]);

        $student = Student::findOrFail($request->student_id);
        $student->increment('point', $point); 

        return redirect('/daftarSiswa');
    }

}
