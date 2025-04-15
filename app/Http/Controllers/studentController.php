<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // tampilkan form login
    public function showLoginForm()
    {
        return view('Student.login');
    }

    // proses login
    // public function login(Request $request)
    // {
    //     // Validasi input
    //     $credentials = $request->only('nisn', 'password');

    //     // Coba login dengan nisn dan password
    //     if (Auth::attempt($credentials)) {
    //         // Cek jika login berhasil
    //         $user = Auth::user();

    //         // Redirect ke dashboard siswa
    //         return redirect()->route('Student.dashboardSiswa');
    //     }

    //     // Jika login gagal
    //     return back()->with('error', 'NISN atau Password salah!');
    // }

    public function login(Request $request)
{
    // Validasi input
    $credentials = $request->only('nisn', 'password');

    // Coba login dengan nisn dan password
    if (Auth::guard('student')->attempt($credentials)) {
        $user = Auth::guard('student')->user();
        return redirect()->route('Student.dashboardSiswa');
    }

    // Login gagal
    return back()->with('error', 'NISN atau Password salah!');
}
public function dashboard()
{
    return view('Student.dashboardSiswa'); // Pastikan ada file resources/views/Student/dashboard.blade.php
}


    // proses logout
    public function logout()
    {
        Auth::logout();  // Logout tanpa guard
        return redirect()->route('/loginSiswaw');
    }

    // ubah password
    public function updatePassword(Request $request)
    {
        // Validasi password
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:3|confirmed',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah password lama sesuai
        DB::table('students')
        ->where('id', $user->id)  // Menggunakan id user yang sedang login
        ->update(['password' => Hash::make($request->new_password)]);

    return back()->with('success', 'Password berhasil diganti!');
    }
}
