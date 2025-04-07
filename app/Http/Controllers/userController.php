<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    //
    public function createRe(){
        return view('admin.register');
    }

    // public function addRe(Request $request)

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

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nohp' => $request->nohp,
            'address' => $request->address,
            'role' => $request->role,
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
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'nohp' => $request->nohp,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }

    

}






