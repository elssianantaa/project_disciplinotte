<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    // Menampilkan daftar staff
    public function index()
    {
        $staffs = Staff::all();
        return view('admin.kelolastaff.index', compact('staffs'));
    }

    // Menampilkan form tambah staff
    public function create()
    {
        return view('admin.kelolastaff.create');
    }

    // Menyimpan data staff baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'role' => 'required|in:satpam,guru,bk',
        ]);

        Staff::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.kelolastaff.index')->with('success', 'Staff berhasil ditambahkan');
    }

    // Menampilkan form edit staff
    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.kelolastaff.edit', compact('staff'));
    }

    // Update data staff
    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $id,
            'alamat' => 'required|string',
            'nohp' => 'required|string|max:15',
            'role' => 'required|in:satpam,guru,bk',
        ]);



        $staff->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.kelolastaff.index')->with('success', 'Staff berhasil diperbarui');
    }

    // Menghapus staff
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->route('admin.kelolastaff.index')->with('success', 'Staff berhasil dihapus');
    }
}
