<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // wajib login

        // hanya admin yang bisa akses semua method kecuali logout
        $this->middleware('admin')->except(['logout']);
    }

    //w
    public function createRe()
    {
        return view('admin.register');
    }

    public function addRe(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : DB::raw('password'),
            'role' => 'staff',
        ]);

        return redirect('/');
    }

    public function index()
    {
        $users = User::all();
        $totalSiswa = $users->count();
        return view('admin.users.index', compact('users', 'totalSiswa'));
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nohp' => 'required',
            'address' => 'required',
            'role' => 'required|in:admin,staff,student',
        ]);

        $fileName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_user', $fileName);
        }


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nohp' => $request->nohp,
            'address' => $request->address,
            'role' => $request->role,
            'foto' => $fileName
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'nohp' => 'required',
            'address' => 'required',
            'role' => 'required|in:admin,staff,student',
            'foto' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($user->foto && Storage::disk('public')->exists('foto_user/' . $user->foto)) {
                Storage::disk('public')->delete('foto_user/' . $user->foto);
            }

            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_user', $fileName);
        } else {
            $fileName = $user->foto; // Tetap pakai yang lama
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'nohp' => $request->nohp,
            'address' => $request->address,
            'role' => $request->role,
            'foto' => $fileName
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
