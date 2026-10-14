<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ektrakurikuler;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EktrakurikulerController extends Controller
{
    public function index()
    {
        $title = 'Ekstrakurikuler';
        $ekstrakurikuler = Ektrakurikuler::with('guru')->latest()->get();

        return view('admin.ekskul.index', compact('title', 'ekstrakurikuler'));
    }

    public function addEdit($id_ekskul = null)
    {
        $ekstrakurikuler = null;

        if ($id_ekskul) {
            try {
                $decryptedId = Crypt::decrypt($id_ekskul);
                $ekstrakurikuler = Ektrakurikuler::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()->route('admin.ekskul.index')->with('error', 'Data tidak ditemukan.');
            }
        }

        $guru = Guru::orderBy('nama_guru', 'asc')->get();

        return view('admin.ekskul.form', compact('guru', 'ekstrakurikuler'));
    }

    public function save(Request $request, $id_ekskul = null)
    {
        $slug = Str::slug($request->nama_ekskul);
        $request->merge(['slug' => $slug]);

        $decryptedId = null;
        $ekstrakurikuler = new Ektrakurikuler();

        if ($id_ekskul) {
            try {
                $decryptedId = Crypt::decrypt($id_ekskul);
                $ekstrakurikuler = Ektrakurikuler::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.ekskul.index')
                    ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
            }
        } else {
            $ekstrakurikuler = new Ektrakurikuler();
        }

        $request->validate([
                'nama_ekskul' => 'required|string|max:40',
                'id_guru' => 'required|exists:guru,id_guru',
                'jadwal_latihan' => 'required|string|max:40',
                'deskripsi' => 'nullable|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'slug'      => 'required|unique:guru,slug,' . ($decryptedId ?? 'NULL') . ',id_guru'
            ],
            [
                'nama_ekskul.required' => 'Nama ekstrakurikuler wajib diisi.',
                'nama_ekskul.max' => 'Nama ekstrakurikuler maksimal 40 karakter.',
                'id_guru.required' => 'Guru pembina wajib dipilih.',
                'id_guru.exists' => 'Guru pembina yang dipilih tidak valid.',
                'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
                'jadwal_latihan.max' => 'Jadwal latihan maksimal 40 karakter.',
                'gambar.image' => 'File harus berupa gambar (JPG, PNG).',
                'gambar.max' => 'Ukuran gambar maksimal 2MB.',
                'slug.unique' => 'Slug ekskul sudah digunakan. Silahkan gunakan judul yang berbeda.'
            ]
        );

        $ekstrakurikuler->nama_ekskul = $request->nama_ekskul;
        $ekstrakurikuler->slug = $slug;
        $ekstrakurikuler->id_guru = $request->id_guru;
        $ekstrakurikuler->jadwal_latihan = $request->jadwal_latihan;
        $ekstrakurikuler->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
                Storage::disk('public')->exists($ekstrakurikuler->gambar);
            }
            $ekstrakurikuler->gambar = $request->file('gambar')->store('ekstrakurikuler', 'public');
        }

        $ekstrakurikuler->save();

        return redirect()
            ->route('admin.ekskul.index')
            ->with(
                'success',
                $id_ekskul
                    ? 'Data ekstrakurikuler berhasil diperbarui.'
                    : 'Data ekstrakurikuler berhasil disimpan.'
            );
    }

    public function show($id_ekskul)
    {
        try {
            $ekstrakurikuler = Ektrakurikuler::with('guru')->findOrFail(Crypt::decrypt($id_ekskul));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.ekskul.index')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }

        return view('admin.ekskul.show', compact('ekstrakurikuler'));
    }

    public function destroy($id_ekskul)
    {
        try {
            $ekstrakurikuler = Ektrakurikuler::findOrFail(Crypt::decrypt($id_ekskul));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.ekskul.index')
                ->with('error', 'Data ekstrakurikuler tidak ditemukan.');
        }

        if ($ekstrakurikuler->gambar && Storage::disk('public')->exists($ekstrakurikuler->gambar)) {
            Storage::disk('public')->exists($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()
            ->route('admin.ekskul.index')
            ->with('error', 'Data ekstrakurikuler berhasil dihapus.');
    }

    public function ekskulPublic()
    {
        $title = 'Data Ekstrakurikuler';

        $ekskul = Ektrakurikuler::all();

        return view('public.ekskul.index', compact('ekskul', 'title'));
    }

    public function showPublic($slug)
    {
        $title = 'Detail Data Ekstrakurikuler';

        try {
            $ekstrakurikuler = Ektrakurikuler::where('slug', $slug)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()
                ->route('public.ekskul.index')
                ->with('error', 'Data guru tidak ditemukan.');
        }

        return view('public.ekskul.show', compact('title', 'ekstrakurikuler'));
    }
}
