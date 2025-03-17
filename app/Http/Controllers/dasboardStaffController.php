<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Student;
use Illuminate\Http\Request;

class dasboardStaffController extends Controller
{
    //
    public function createPelanggaran($id){
        $student = Student::findOrFail($id); 
        return view('Staff.pelanggaran', $student);
    }

    public function addPelanggaran(Request $request){
        $validateData = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nama_pelanggaran' => ['required', 'string', 'max:255'],
            'Kategori' => ['required', 'in:Ringan,Sedang,Berat'],
            'point' => ['required', 'numeric'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'staff_id' => ['required', 'exists:staff,id'],
        ]);
    
        $fileName = null;
    
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_pelanggaran', $fileName);
        }
    
        $pelanggaran = Pelanggaran::create([
            'student_id' => $request->student_id,
            'kelas_id' => $request->kelas_id,
            'nama_pelanggaran' => $request->nama_pelanggaran,
            'Kategori' => $request->Kategori,
            'point' => $request->point,
            'deskripsi' => $request->deskripsi,
            'foto' => $fileName,
            'staff_id' => $request->staff_id,
        ]);
    
        return redirect()->route('Staff.daftarSiswa')->with('success', 'Pelanggaran berhasil ditambahkan!');
    }

}
