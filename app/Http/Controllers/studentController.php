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
        // Cek jika siswa sudah login berdasarkan session
        $student = session('student');
    
        if (!$student) {
            // Jika tidak ada sesi, arahkan ke halaman login
            return redirect('/loginSiswa')->with('error', 'Silakan login terlebih dahulu!');
        }
    
        return view('Student.dashboardSiswa', compact('student'));
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

        // Ambil data siswa berdasarkan id yang ada di session
        $student = Student::find(session('student')->id);

        // Periksa apakah password lama yang dimasukkan sudah benar
        if (!Hash::check($request->current_password, $student->password)) {
            return back()->with('error', 'Password lama salah!');
        }

        // Update password dengan yang baru
        $student->password = Hash::make($request->new_password);
        $student->save();

        return back()->with('success', 'Password berhasil diubah!');
    }

    // Tidak perlu menggunakan guard jika kamu menggunakan session manual
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Jika session student kosong, redirect ke halaman login
            if (!session('student')) {
                return redirect('/loginSiswa')->with('error', 'Silakan login terlebih dahulu!');
            }
            return $next($request);
        });
    }
}
