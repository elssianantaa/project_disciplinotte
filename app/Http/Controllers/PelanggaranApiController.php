<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranApiController extends Controller
{
    //

    public function index()
    {
        $pelanggarans = Pelanggaran::select('id', 'nama_pelanggaran', 'kategori', 'point')->get();

        return response()->json($pelanggarans);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggaran' => 'required|string|max:255',
            'kategori' => 'required|in:Ringan,Sedang,Berat',
            'point' => 'required|integer|min:1',
        ]);

        $pelanggaran = Pelanggaran::create($validated);

        return response()->json([
            'message' => 'Pelanggaran berhasil ditambahkan',
            'data' => $pelanggaran
        ], 201);
    }

    public function destroy($id)
    {
        $pelanggaran = Pelanggaran::find($id);

        if (!$pelanggaran) {
            return response()->json([
                'message' => 'Data pelanggaran tidak ditemukan'
            ], 404);
    }

    $pelanggaran->delete();

    return response()->json([
            'message' => 'Pelanggaran berhasil dihapus'
        ], 200);
}

}
