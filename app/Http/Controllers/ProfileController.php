<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profile.edit', compact('user'));
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

        return redirect()->route('admin.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
