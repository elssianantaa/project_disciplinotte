<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function showLoginForm()
    {
        return view('Student.login');
    }
    public function tentangkami()
    {
        return view('Student.tentangkami');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        // Cari siswa berdasarkan NISN
        $student = Student::where('nisn', $request->nisn)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            // Simpan data siswa ke session
            session(['student' => $student]);

            return redirect()->route('Student.dashboardSiswa');
        }

        return back()->with('error', 'NISN atau Password salah!');
    }


    public function dashboard()
    {
        $student = session('student');
    
        if (!$student) {
            return redirect('/loginSiswa')->with('error', 'Silakan login terlebih dahulu!');
        }
    
        $siswa = $student; 
        $pelanggarans = $siswa->catatanPelanggarans()->with('pelanggaran')->get();
    
        $totalPoin = $pelanggarans->sum(function ($catatan) {
            return $catatan->pelanggaran->point ?? 0;
        });
    
        $maxPoin = 40;
        $sisaPoin = $maxPoin - $totalPoin;
    
        return view('Student.dashboardSiswa', compact('student', 'pelanggarans', 'totalPoin', 'sisaPoin'));
    }
    

    public function logout(Request $request)
    {
        // Hapus session siswa
        $request->session()->forget('student');

        return redirect('/loginSiswa')->with('success', 'Berhasil logout.');
    }

    public function showUpdatePasswordForm()
    {
        $student = session('student');
        if (!$student) {
            // Arahkan ke halaman login jika belum login
            return redirect('/loginSiswa');
        }

        return view('Student.updatePassword', compact('student'));
    }

    public function updatePassword(Request $request)
    {
        // Validasi form update password
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:3|confirmed', // Minimal 3 karakter dan konfirmasi password
        ]);

        $sessionStudent = session('student');
        $student = Student::find(is_array($sessionStudent) ? $sessionStudent['id'] : optional($sessionStudent)->id);


        // Periksa apakah password lama yang dimasukkan sudah benar
        if (!Hash::check($request->current_password, $student->password)) {
            return back()->with('error', 'Password lama salah!');
        }

        // Update password dengan yang baru
        $student->password = Hash::make($request->new_password);
        $student->save();

        return back()->with('success', 'Password berhasil diubah!');
    }
}

