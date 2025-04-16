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
    // public function __construct()
    // {
    //     $this->middleware('login')->only(['showDb', 'showDbStaff']);  // hanya metode ini yang membutuhkan login
    //     $this->middleware('staff')->only(['showDb', 'showDbStaff']); // pengecekan login
    //     $this->middleware('admin')->only(['dashboard']); // hanya admin yang bisa akses
    // }

    public function authentication(Request $request)
{
    // Validasi input
    $validateData = $request->validate([
        'email' => ['required', 'email'],
        'password' => 'required'
    ]);

    // Coba login menggunakan Auth::attempt() dengan data yang sudah tervalidasi
    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        // Ambil user yang berhasil login
        $user = Auth::user();

        // Pengalihan berdasarkan role
        if ($user->role === 'admin') {
            return redirect('/dashboard'); // Arahkan ke dashboard admin
        } elseif ($user->role === 'staff') {
            return redirect('/dashboardStaff'); // Arahkan ke dashboard staff
        } elseif ($user->role === 'student') {
            return redirect('/dashboardSiswa'); // Arahkan ke halaman home
        }
    }

    // Jika login gagal, beri pesan kesalahan
    return back()->withErrors(['error' => 'Email atau password salah.']);
}

    // REKAP SISWA
    public function showRekap(Request $request)
    {
        // Ambil daftar kelas untuk dropdown
        $kelasList = Kelas::all();
    
        // Ambil daftar periode
        $periodeList = [];
        $startYear = 2018;
        $endYear = 2031;
        for ($year = $startYear; $year < $endYear; $year++) {
            $periodeList[] = $year . '/' . ($year + 1);
        }
    
        // Query siswa dengan relasi yang dibutuhkan
        $query = Student::with(['riwayatkelas', 'catatan_pelanggarans']);
    
        // Filter berdasarkan kelas jika ada
        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }
    
        // Filter berdasarkan nama jika ada
        if ($request->nama) {
            $query->where('name', 'like', '%' . $request->nama . '%');
        }
    
        // Filter berdasarkan periode jika ada (periode lama atau periode baru)
        if ($request->periode) {
            $query->whereHas('riwayatkelas', function ($q) use ($request) {
                // Cek apakah periode lama atau periode baru ada yang cocok
                $q->where('periode_lama', $request->periode)
                  ->orWhere('periode_baru', $request->periode);
            });
        }
    
        // Ambil data siswa setelah filter
        $students = $query->get();
    
        // Hitung total siswa
        $totalSiswa = $students->count();
    
        return view('admin.rekapSiswa', compact('students', 'totalSiswa', 'request', 'kelasList', 'periodeList'));
    }
    

    // public function showDb()
    // {
    //     return view('Admin.dashboard');
    // }

    public function showDbStaff()
    {
        return view('Staff.dashboardStaff');
    }
    // public function showDbStudent()
    // {
    //     return view('Student.dashboardSiswa');
    // }

    // public function index()
    // {
    //     $students = Student::all();
    //     return view('admin.siswa.index', compact('students'));
    // }

    // public function index(Request $request)
    // {

    //     $students = Student::with(['kelas', 'catatan_pelanggarans'])->get();
    //     $kelasList = Kelas::all(); // untuk dropdown
    //     $query = Student::with('kelas');

    //     if ($request->kelas_id) {
    //         $query->where('kelas_id', $request->kelas_id);
    //     }

    //     if ($request->nama) {
    //         $query->where('name', 'like', '%' . $request->nama . '%');
    //     }

    //     $students = $query->get();
    //     $totalSiswa = $students->count();

    //     return view('admin.siswa.index', compact('students', 'totalSiswa', 'request', 'kelasList'));
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

        // Mengurutkan berdasarkan inisial nama (huruf pertama)
        $students = $query->orderByRaw('UPPER(SUBSTRING(name, 1, 1))')->get();
        $totalSiswa = $students->count();

        return view('admin.siswa.index', compact('students', 'totalSiswa', 'request', 'kelasList'));
    }


    //Buat nampilin di dasboard staff
    public function show(Request $request)
    {
        $query = Student::with(['kelas', 'catatanpelanggarans.pelanggaran'])
        ->where('status', '!=', 'dikeluarkan') // ⬅️ Tambahan ini
        ->orderBy('name', 'asc'); // ⬅️ Urutkan berdasarkan nama A-Z

    if ($request->nama) {
        $query->where('name', 'like', '%' . $request->nama . '%');
    }

    if ($request->kelas_id) {
        $query->where('kelas_id', $request->kelas_id);
    }

    $students = $query->get();
    $totalSiswa = $students->count();
    $kelasList = Kelas::all();

    return view('Staff.daftarSiswa', compact('students', 'kelasList', 'totalSiswa'));

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
