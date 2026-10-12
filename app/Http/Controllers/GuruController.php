<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function index()
    {
        $title = 'Guru';
        $guru = Guru::latest()->paginate(10);

        return view('admin.guru.index', compact('title', 'guru'));
    }

    public function addEdit($id_guru = null)
    {
        $guru = null;

        if ($id_guru) {
            try {
                $decryptedId = Crypt::decrypt($id_guru);
                $guru = Guru::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
            }
        }

        return view('admin.guru.form', compact('guru'));
    }

    public function save(Request $request, $id_guru = null)
    {
        $slug = Str::slug($request->nama_guru);
        $request->merge(['slug' => $slug]);

        $decryptedId = null;
        $guru = new Guru();

        if ($id_guru) {
            try {
                $decryptedId = Crypt::decrypt($id_guru);
                $guru = Guru::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()->route('admin.guru.index')->with('error', 'Data tidak ditemukan.');
            }
        }

        $request->validate([
            'nama_guru' => 'required',
            'mapel'     => 'required',
            'nip'       => 'nullable|unique:guru,nip,' . ($decryptedId ?? 'NULL') . ',id_guru',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'slug'      => 'required|unique:guru,slug,' . ($decryptedId ?? 'NULL') . ',id_guru'
        ], [
            'nama_guru.required' => 'Nama guru wajib diisi.',
            'mapel.required'     => 'Mata pelajaran wajib diisi.',
            'nip.unique'         => 'NIP sudah terdaftar.',
            'foto.image'         => 'Foto harus berupa file gambar (JPG, PNG).',
            'foto.max'           => 'Ukuran foto maksimal 2MB.',
            'slug.unique'        => 'Slug guru sudah digunakan. Silahkan gunakan nama yang berbeda.'
        ]);

        $guru->nama_guru = $request->nama_guru;
        $guru->slug = $slug;
        $guru->nip  = $request->nip;
        $guru->mapel = $request->mapel;

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $guru->foto = $request->file('foto')->store('guru', 'public');
        }

        $guru->save();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', $id_guru ? 'Data guru berhasil diperbarui.' : 'Data guru berhasil disimpan.');
    }

    public function destroy($id_guru)
    {
        $guru = Guru::findOrFail($id_guru);

        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    public function show($id_guru)
    {
        $title = 'Detail Data Guru';

        try {
            $decryptedId = Crypt::decrypt($id_guru);

            $guru = Guru::findOrFail($decryptedId);

            return view('admin.guru.show', compact('guru', 'title'));
        } catch (DecryptException $e) {
            return redirect()->route('admin.guru.index')->with('error', 'URL tidak valid atau data gagal didekripsi.');
        } catch (\Exception $e) {
            return redirect()->route('admin.guru.index')->with('error', 'Data guru tidak ditemukan.');
        }
    }

    public function guruPublic()
    {
        $guru = Guru::all();

        return view('public.guru.index', compact('guru'));
    }

    public function showPublic($slug)
    {
        $title = 'Detail Data Guru';
        
        try {
            $guru = Guru::where('slug', $slug)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()
                ->route('public.guru.index')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        return view('public.guru.show', compact('guru', 'title', 'profil'));
    }
}
