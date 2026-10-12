<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Pengguna';

        $user = User::paginate(10);

        return view('admin.user.index', compact('user', 'title'));
    }

    public function addEdit($id_user = null)
    {
        try {
            $user = $id_user
                ? User::findOrFail(Crypt::decrypt($id_user))
                : null;
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view('admin.user.form', compact('user'));
    }

    public function save(Request $request, $id_user = null)
    {
        $decryptedId = null;

        if ($id_user) {
            try {
                $decryptedId = Crypt::decrypt($id_user);

                $user = User::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.user.index')
                    ->with('error', 'Data pengguna tidak ditemukan.');
            }
        } else {
            $user = new User();
        }

        $request->validate(
            [
                'name' => 'required|string|max:50',
                'username' => 'nullable|string|max:30|unique:user,username,' . ($decryptedId ?? 'NULL') . ',id_user',
                'email' => 'required|email|unique:user,email,' . ($decryptedId ?? 'NULL') . ',id_user',
                'role' => 'required|in:admin,operator,Admin,Operator',
                'status' => 'required|in:aktif,tidak_aktif',
                'password' => $decryptedId
                    ? 'nullable|min:6'
                    : 'required|min:6',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'name.required' => 'Nama lengkap wajib diisi.',
                'username.unique' => 'Username sudah digunakan oleh akun lain.',
                'email.required' => 'Alamat email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah terdaftar pada akun lain.',
                'role.required' => 'Pilih role pengguna (Admin atau Operator).',
                'role.in' => 'Pilihan role tidak valid.',
                'status.required' => 'Status akun wajib dipilih.',
                'status.in' => 'Status akun tidak valid.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal terdiri dari 6 karakter.',
                'foto.image' => 'File yang diunggah harus berupa gambar.',
                'foto.mimes' => 'Format foto harus jpeg, png, jpg, atau gif.',
                'foto.max' => 'Ukuran foto maksimal 2MB.',
            ]
        );

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = strtolower($request->role);
        $user->status = $request->status;

        if ($request->filled('username')) {
            $user->username = $request->username;
        } elseif (!$decryptedId) {
            $baseUsername = strtolower(explode('@', $request->email)[0]);
            $username = $baseUsername;
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }
            $user->username = $username;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $fotoPath = $request
                ->file('foto')
                ->store('profile', 'public');

            $user->foto = $fotoPath;
        }

        $user->save();

        return redirect()
            ->route('admin.user.index')
            ->with(
                'success',
                $decryptedId
                    ? 'Data pengguna berhasil diperbarui.'
                    : 'Data pengguna berhasil disimpan.'
            );
    }

    public function show($id_user)
    {
        $title = 'Detail Pengelola';

        try {
            $user = User::findOrFail(
                Crypt::decrypt($id_user)
            );
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        return view(
            'admin.user.show',
            compact('user', 'title')
        );
    }

    public function toggleStatus($id_user)
    {
        try {
            $decryptedId = Crypt::decrypt($id_user);

            $user = User::findOrFail($decryptedId);
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        if ($user->id_user == Auth::id()) {
            return redirect()
                ->route('admin.user.index')
                ->with(
                    'error',
                    'Anda tidak dapat menonaktifkan akun Anda sendiri.'
                );
        }

        if ($user->status === 'aktif') {
            $user->status = 'tidak_aktif';
            $message = 'Pengguna berhasil dinonaktifkan.';
        } else {
            $user->status = 'aktif';
            $message = 'Pengguna berhasil diaktifkan.';
        }

        $user->save();

        return redirect()
            ->route('admin.user.index')
            ->with('success', $message);
    }

    public function destroy($id_user)
    {
        try {
            $user = User::findOrFail(Crypt::decrypt($id_user));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.user.index')
                ->with('error', 'Data pengguna tidak ditemukan.');
        }

        if ($user->id_user == Auth::id()) {
            return redirect()
                ->route('admin.user.index')
                ->with(
                    'error',
                    'Anda tidak dapat menghapus akun Anda sendiri.'
                );
        }

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with(
                'success',
                'Data pengguna berhasil dihapus.'
            );
    }
}