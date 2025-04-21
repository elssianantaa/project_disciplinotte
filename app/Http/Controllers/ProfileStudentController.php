<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileStudentController extends Controller
{
    public function show()
    {
        $student = session('student');
    
        if (!$student) {
            return redirect('loginSiswa')->with('error', 'Anda harus login terlebih dahulu.');
        }
    
        // Ambil ulang data student lengkap dari DB (untuk akses relasi)
        $student = Student::with(['kelas', 'catatanPelanggaran.pelanggaran'])->find($student->id);
    
        // Hitung total poin
        $pelanggarans = $student->catatanPelanggaran;
    
        $totalPoin = $pelanggarans->sum(function ($catatan) {
            return $catatan->pelanggaran->point ?? 0;
        });
    
        $maxPoin = 40;
        $sisaPoin = $maxPoin - $totalPoin;
    
        return view('Student.profile.show', compact('student', 'totalPoin', 'sisaPoin'));
    }
    

    public function edit()
    {
        $student = session('student');
    
        if (!$student) {
            return redirect()->route('loginSiswa')->with('error', 'Anda harus login terlebih dahulu.');
        }
    
        $kelasList = \App\Models\Kelas::all(); // ✅ Tambahkan ini
    
        return view('Student.profile.edit', compact('student', 'kelasList')); // ✅ Kirim ke view
    }
    

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        

        if (!$student) {
            return redirect()->route('loginSiswa')->with('error', 'Data tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'required|string|max:20', // ✅ TAMBAHKAN
            'kelas_id' => 'required|string|max:100',
            // 'alamat' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        $student->name = $request->name;
        $student->nisn = $request->nisn;
        $student->kelas_id = $request->kelas_id;
        // $student->alamat = $request->alamat;

        // Proses upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($student->foto && Storage::exists('public/foto_profilesiswa/' . $student->foto)) {
                Storage::delete('public/foto_profilesiswa/' . $student->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_profilesiswa', $filename);
            $student->foto = $filename;
        }

        $student->save();

        // Update session
        session(['student' => $student]);

        return redirect()->route('Student.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
