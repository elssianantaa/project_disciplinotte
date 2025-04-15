<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\Validator;

class StudentImportController extends Controller
{
    /**
     * Import data siswa dari file Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {

        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'File tidak ditemukan dalam request'], 400);
        }
    
        // Validasi file yang di-upload
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Mengimpor file Excel
        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return response()->json(['message' => 'Data siswa berhasil diimpor'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage()], 500);
        }
    }
}
