<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            } elseif ($user->role === 'staff') {
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

    public function index(Request $request)
    {
           
        $students = Student::with(['kelas', 'catatan_pelanggarans'])->get(); 
        $kelasList = Kelas::all(); // untuk dropdown
        $query = Student::with('kelas');
    
        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }
    
        if ($request->nama) {
            $query->where('name', 'like', '%' . $request->nama . '%');
        }
    
        $students = $query->get();
        $totalSiswa = $students->count();
    
        return view('admin.siswa.index', compact('students', 'totalSiswa', 'request', 'kelasList'));
    }


    //Buat nampilin di dasboard staff
    public function show(Request $request)
    {

        $query = Student::with(['kelas', 'catatanpelanggarans']);

        if ($request->nama) {
            $query->where('name', 'like', '%' . $request->nama . '%');
        }

        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $students = $query->get();
        $kelasList = Kelas::all(); // buat dropdown kelas

        return view('Staff.daftarSiswa', compact('students', 'kelasList'));
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // $fotoPath = null;
        // if ($request->hasFile('foto')) {
        //     $fotoPath = $request->file('foto')->store('foto', 'public');
        // }
        $fileName = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_siswa', $fileName);
        }

        Student::create([
            'nisn' => $request->nisn,
            'name' => $request->name,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'point' => 0,
            'foto' => $fileName,
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($siswa->foto && Storage::disk('public')->exists('foto_siswa/' . $siswa->foto)) {
                Storage::disk('public')->delete('foto_siswa/' . $siswa->foto);
            }
        
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_siswa', $fileName);
        } else {
            $fileName = $siswa->foto; // Tetap pakai yang lama
        }


        $siswa->update([
            'name' => $request->name,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status ?? $siswa->status,
            'foto' => $fileName,
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
