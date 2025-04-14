<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KelasImport;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    // public function index()
    // {
    //     // Ambil semua data kelas dari database
    //     $kelas = Kelas::all();
        
    //     return view('admin.kelas.index', compact('kelas'));
    // }

    // // Jika kamu ingin menangani upload Excel dan menyimpan data kelas
    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls'
    //     ]);

    //     $path = $request->file('file')->storeAs('uploads', $request->file('file')->getClientOriginalName());

    //     // Import file Excel
    //     Excel::import(new KelasImport, storage_path('app/' . $path));

    //     return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diimport.');
    // }

    // public function create()
    // {
    //     // Ambil semua data kelas dari database (kelas yang sudah di-import)
    //     $kelas = Kelas::all();
        
    //     return view('admin.siswa.create', compact('kelas'));
    // }

    public function importkelas(Request $request)
    {
        // Validasi file yang di-upload
        $validator = Validator::make($request->all(), [
            'file' => '|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Mengimpor file Excel
        try {
            Excel::import(new KelasImport, $request->file('file'));
            return response()->json(['message' => 'Data siswa berhasil diimpor'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage()], 500);
        }
    }
}

