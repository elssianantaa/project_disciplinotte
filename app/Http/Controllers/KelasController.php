<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KelasImport;

class KelasController extends Controller
{
    public function index()
    {
        // Ambil semua data kelas dari database
        $kelas = Kelas::all();
        
        return view('admin.kelas.index', compact('kelas'));
    }

    // Jika kamu ingin menangani upload Excel dan menyimpan data kelas
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $path = $request->file('file')->storeAs('uploads', $request->file('file')->getClientOriginalName());

        // Import file Excel
        Excel::import(new KelasImport, storage_path('app/' . $path));

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diimport.');
    }

    public function create()
    {
        // Ambil semua data kelas dari database (kelas yang sudah di-import)
        $kelas = Kelas::all();
        
        return view('admin.siswa.create', compact('kelas'));
    }
}

