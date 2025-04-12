<?php

namespace App\Http\Controllers;

use App\Models\CatatanPelanggaran;
use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\Skorsing;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class dasboardStaffController extends Controller
{
    //
    public function showprofil()
    {
        dd(Auth::user());
        return view('Staff.Profil', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Staff.Pengaturan', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'nohp' => 'required|string|max:20',
            'address' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Simpan foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama dulu kalau ada
            if ($user->foto && Storage::exists('public/foto_user/' . $user->foto)) {
                Storage::delete('public/foto_user/' . $user->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('public/foto_user', $fileName);

            $validated['foto'] = $fileName;
        }

        $user->update($validated);

        return redirect('dashboardStaff')->with('success', 'Profil berhasil diperbarui.');
    }




    //     public function updateProfil(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required',
    //         'nohp' => 'required',
    //         'address' => 'required',
    //         'role' => 'required|in:admin,staff,student',
    //         'foto' => 'nullable'
    //     ]);

    //     $admin = Auth::user(); // atau ambil dari ID, tergantung sistem login kamu

    //     $admin->name = $request->nama;

    //     if ($request->hasFile('foto')) {
    //         $fotoBaru = $request->file('foto')->store('foto-admin', 'public');
    //         $admin->foto = $fotoBaru;
    //     }

    //     $admin->update([
    //         'name' => $request->nama,
    //         'foto' => $fotoBaru ?? $admin->foto,
    //         // tambahkan yang lain juga kalau kolomnya required
    //         'email' => $admin->email,
    //         'password' => $admin->password,
    //         'role' => $admin->role,
    //         'nohp' => $admin->nohp,
    //         'address' => $admin->address,
    //     ]);

    //     return redirect('/pengaturan')->with('success', 'Profil berhasil diperbarui!');
    // }



    public function show(Request $request){

        $tanggal = $request->tanggal;
        $kelas_id = $request->kelas_id;
        $nama = $request->nama;
        $totalPelanggaran = CatatanPelanggaran::count();


        $query = CatatanPelanggaran::with(['student', 'kelas', 'pelanggaran']);

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        if ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        }

        if ($nama) {
            $query->whereHas('student', function ($q) use ($nama) {
                $q->where('name', 'like', '%' . $nama . '%');
            });
        }

        $catatanpelanggaran = $query->get();
        $kelasList = Kelas::all();


        return view('Staff.daftarPelanggaran', compact('catatanpelanggaran', 'kelasList'));
    }

    // Nampilin skorsing
    public function showSkorsing(Request $request){
        $tanggal = $request->tanggal;
        $kelas_id = $request->kelas_id;
        $nama = $request->nama;
        $totalSkorsing = Skorsing::count();


        $query = Skorsing::with(['student', 'kelas']);

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        if ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        }

        if ($nama) {
            $query->whereHas('student', function ($q) use ($nama) {
                $q->where('name', 'like', '%' . $nama . '%');
            });
        }

        $skorsing = $query->get();
        $kelasList = Kelas::all();

        $students = Student::with(['skorsings' => function ($q) {
            $q->latest('mulai')->limit(1);
        }, 'kelas'])->get();        
        

        return view('Staff.daftarSkorsing', compact('students', 'kelasList'));
    }


    public function createPelanggaran($id)
    {
        $pelanggarans = Pelanggaran::select('id', 'nama_pelanggaran', 'kategori', 'point')->get();
        // $pelanggarans = $response->json();
        $student = Student::with('kelas', 'catatanpelanggarans')->findOrFail($id);
        return view('Staff.pelanggaran', compact('student', 'pelanggarans'));
    }


    public function addPelanggaran(Request $request)
    {
        $validateData = $request->validate([
            'student_id'      => ['required', 'exists:students,id'],
            'kelas_id'        => ['required', 'exists:kelas,id'],
            'pelanggaran_id'  => ['required', 'exists:pelanggarans,id'],
            'deskripsi'       => ['required', 'string', 'max:255'],
            'foto'            => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'tanggal'         => ['required', 'date'],
        ]);

        $fileName = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_pelanggaran', $fileName);
        }

        $tanggal = strtotime($request->tanggal);
        $tahun = date('Y', $tanggal);
        $bulan = date('m', $tanggal);

        if ($bulan >= 1 && $bulan <= 6) {
            $periode = "Semester 1 $tahun";
        } else {
            $periode = "Semester 2 $tahun";
        }

        // Ambil data siswa berdasarkan student_id
        $student = Student::with('kelas')->findOrFail($request->student_id);

        // Ambil data kelas berdasarkan kelas_id
        $kelas = Kelas::findOrFail($request->kelas_id);

        CatatanPelanggaran::create([
            'student_id'      => $request->student_id,
            'kelas_id'        => $request->kelas_id,
            'pelanggaran_id'  => $request->pelanggaran_id, // Ambil ID pelanggaran, bukan nama atau kategori
            // 'Kategori'        => $request->pelanggaran_id,
            // 'point'           => $request->pelanggaran_id,
            'deskripsi'       => $request->deskripsi,
            'foto'            => $fileName,
            'staff'           => auth()->user()->id, // Pastikan user adalah staff
            'tanggal'         => $request->tanggal,
            'periode'         => $periode, // Simpan periode sebagai "Semester X Tahun"
        ]);

        //status otomatis
        // $totalPoint = $student->catatanpelanggarans->sum(function ($cp) {
        //     return $cp->pelanggaran->point ?? 0;
        // });

        // // Tentukan status baru berdasarkan total point
        // $statusBaru = 'aktif';
        // if ($totalPoint >= 40) {
        //     $statusBaru = 'dikeluarkan';
        // } elseif ($totalPoint >= 30) {
        //     $statusBaru = 'skorsing';
        // }

        // // Update status siswa
        // $student->update([
        //     'status' => $statusBaru
        // ]);

        // Cek skorsing terakhir
        $skorsingTerakhir = Skorsing::where('student_id', $student->id)
        ->latest('selesai')
        ->first();

        // Jika status skorsing tapi tanggal selesai sudah lewat → ubah ke aktif dulu
        if ($student->status === 'skorsing' && $skorsingTerakhir && $skorsingTerakhir->selesai < now()) {
                $student->update(['status' => 'aktif']);
        }

        // Hitung ulang total poin jadi gaakan noll meskipun masa nya udah abis
        $totalPoint = $student->catatanpelanggarans->sum(function ($cp) {
        return $cp->pelanggaran->point ?? 0;
        });

        // Tentukan status baru berdasarkan total poin
        $statusBaru = 'aktif';
        if ($totalPoint >= 40) {
            $statusBaru = 'dikeluarkan';
        } elseif ($totalPoint >= 30) {
            $statusBaru = 'skorsing';
        }

        $statusLama = $student->status;

        // Update status jika berubah
        if ($statusBaru !== $statusLama) {
            $student->update([
            'status' => $statusBaru
        ]);
        }

        // Buat entri skorsing jika baru kena
        if ($statusBaru === 'skorsing' && $statusLama !== 'skorsing') {
        $sudahDiskors = Skorsing::where('student_id', $student->id)
        ->whereDate('selesai', '>=', now())
        ->exists();

        if (!$sudahDiskors) {
        Skorsing::create([
            'student_id' => $student->id,
            'kelas_id'   => $student->kelas_id,
            'mulai'      => now(),
            'selesai'    => now()->addDays(1), // misal 3 hari
            'alasan'     => 'Poin mencapai ' . $totalPoint
        ]);
        }
        }

        return redirect('/daftarSiswa');

    }

}        



