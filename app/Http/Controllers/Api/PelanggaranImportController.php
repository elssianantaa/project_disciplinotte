<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\PelanggaranImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class PelanggaranImportController extends Controller
{
    //
    public function importPelanggaran(Request $request)
    {
        // Validasi file yang di-upload
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Mengimpor file Excel
        try {
            Excel::import(new PelanggaranImport, $request->file('file'));
            return response()->json(['message' => 'Data siswa berhasil diimpor'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage()], 500);
        }
    }
}
