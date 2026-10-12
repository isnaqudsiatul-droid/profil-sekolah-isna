<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfilController extends Controller
{
    public function index()
    {
        $title = 'Detail Akun';
        $user = Auth::user();
        return view('admin.akun.index', compact('user', 'title'));
    }

    public function edit()
    {
        $title = 'Edit Akun';
        $user = Auth::user();
        return view('admin.akun.edit', compact('user', 'title'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user,username,' . $user->id_user . ',id_user',
            'password' => 'nullable|min:6|confirmed',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi foto max 2MB
        ]);

        $user->name = $request->name;
        $user->username = $request->username;

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('profil', 'public');
            $user->foto = $path;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.akun.index')->with('success', 'Profil berhasil diperbarui!');
    }
}