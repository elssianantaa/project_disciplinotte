<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileStudentController extends Controller
{
    public function show()
    {
        $student = Auth::user(); // ambil data user yang sedang login

        // Pastikan user yang sedang login ada
        if (!$student) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('Student.profile.show', compact('student')); // Kirimkan data student ke view
    }

    public function edit()
    {
        $student = Auth::user();

        // Pastikan user yang sedang login ada
        if (!$student) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        return view('Student.profile.edit', compact('student')); // arahkan ke halaman edit
    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        // Pastikan user yang sedang login ada
        if (!$student) {
            return redirect()->route('login')->with('error', 'Data tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nohp' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika ada foto baru, simpan foto tersebut
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($student->foto && file_exists(storage_path('app/public/foto_user/' . $student->foto))) {
                unlink(storage_path('app/public/foto_user/' . $student->foto)); // hapus foto lama
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('foto_user', 'public');
            $student->foto = basename($fotoPath);
        }

        // Update data lainnya
        $student->name = $request->name;
        $student->nohp = $request->nohp;
        $student->address = $request->address;

        // Pastikan data disimpan
        $student->save(); 

        // Redirect dengan pesan sukses
        return redirect()->route('Student.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
