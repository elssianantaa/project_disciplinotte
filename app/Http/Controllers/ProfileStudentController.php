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

        return view('Student.profile.show', compact('student'));
    }

    public function edit()
    {
        $student = session('student');

        if (!$student) {
            return redirect()->route('loginSiswa')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('Student.profile.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        if (!$student) {
            return redirect()->route('loginSiswa')->with('error', 'Data tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'alamat' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $student->name = $request->name;
        $student->kelas = $request->kelas;
        $student->alamat = $request->alamat;

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
