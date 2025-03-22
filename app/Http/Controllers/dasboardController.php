<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class dasboardController extends Controller
{
    public function login()
    {
        return view('Admin.login');
    }

    public function authentication(Request $request)
    {
        $validateData = $request->validate([
            'email' => ['required', 'email'],                    
            'password' => 'required'
        ]);

        if (Auth::attempt($validateData)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/dashboard');
            } elseif ($user->role === 'guru') {
                return redirect('/dashboardStaff');
            } elseif ($user->role === 'student') {
                return redirect()->route('home');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showDb()
    {
        return view('Admin.dashboard');
    }

    public function showDbStaff()
    {
        return view('Staff.dashboardStaff');
    }

    // public function index()
    // {
    //     $students = Student::all();
    //     return view('admin.siswa.index', compact('students'));
    // }

    public function index()
{
    $students = Student::with(['kelas', 'catatan_pelanggarans'])->get(); // ✅ Tambah with()
    return view('admin.siswa.index', compact('students'));
}


    //Buat nampilin di dasboard staff
    public function show(){
        $students = Student::with(['kelas', 'catatan_pelanggarans'])->get(); // ✅ Pastikan pakai with()
        return view('Staff.daftarSiswa', compact('students'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
{


    $request->validate([
        'nisn' => 'required|unique:students,nisn',
        'name' => 'required',
        'kelas_id' => 'required',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'status' => 'required',
        'password' => 'required',
    ]);

    Student::create([
        'nisn' => $request->nisn,
        'name' => $request->name,
        'kelas_id' => $request->kelas_id,
        'jenis_kelamin' => $request->jenis_kelamin,
        'status' => $request->status,
        'password' => bcrypt($request->password),
        'point' => 0
    ]);

    return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
}


    public function edit(Student $siswa)
    {
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Student $siswa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status' => 'nullable|in:aktif,skorsing,dikeluarkan',
        ]);

        $siswa->update([
            'name' => $request->name,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status ?? $siswa->status,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy(Student $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
