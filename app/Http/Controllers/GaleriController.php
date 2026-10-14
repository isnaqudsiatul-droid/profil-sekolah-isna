<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    public function index()
    {
        $title = 'Galeri';
        $galeri = Galeri::latest('tanggal')->get();

        return view('admin.galeri.index', compact('title', 'galeri'));
    }

    public function addEdit($id_galeri = null)
    {
        $title = $id_galeri ? 'Edit Galeri' : 'Tambah Galeri';
        $galeri = null;

        if ($id_galeri) {
            try {
                $decryptedId = Crypt::decrypt($id_galeri);
                $galeri = Galeri::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()->route('admin.galeri.index')->with('error', 'Data tidak ditemukan.');
            }
        }

        return view('admin.galeri.form', compact('galeri', 'title'));
    }

    public function save(Request $request, $id_galeri = null)
    {
        $slug = Str::slug($request->judul);
        $request->merge(['slug' => $slug]);

        $decryptedId = null;
        $galeri = new Galeri();

        if ($id_galeri) {
            try {
                $decryptedId = Crypt::decrypt($id_galeri);
                $galeri = Galeri::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.galeri.index')
                    ->with('error', 'Data galeri tidak ditemukan.');
            }
        }

        $fileRule = $id_galeri ? 'nullable' : 'required';
        if ($request->kategori == 'Video' && $request->filled('link_video')) {
            $fileRule = 'nullable';
        }

        $request->validate(
            [
                'judul' => 'required|string|max:50',
                'kategori' => 'required|in:Foto,Video',
                'tanggal' => 'required|date',
                'keterangan' => 'nullable|string',
                'file' => $fileRule . '|file|mimes:jpeg,png,jpg,mp4,mov|max:51200',
                'link_video' => 'nullable|url',
                'slug'      => 'required|unique:galeri,slug,' . ($decryptedId ?? 'NULL') . ',id_galeri'
            ],
            [
                'judul.required' => 'Judul dokumentasi wajib diisi.',
                'judul.max' => 'Judul maksimal 50 karakter.',
                'kategori.required' => 'Pilih kategori media (Foto atau Video).',
                'tanggal.required' => 'Tanggal wajib diisi.',
                'file.required' => 'File foto atau video wajib diunggah.',
                'file.mimes' => 'Format file yang didukung: JPG, PNG, MP4, atau MOV.',
                'file.max' => 'Ukuran file maksimal 50MB.',
                'link_video.url' => 'Format URL link YouTube tidak valid.',
                'slug.unique' => 'Slug galeri sudah digunakan. Silahkan gunakan judul yang berbeda.'
            ]
        );

        $galeri->judul = $request->judul;
        $galeri->slug = $slug;
        $galeri->kategori = $request->kategori;
        $galeri->tanggal = $request->tanggal;
        $galeri->keterangan = $request->keterangan;

        if ($request->hasFile('file')) {
            if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
                Storage::disk('public')->delete($galeri->file);
            }
            $galeri->file = $request->file('file')->store('galeri', 'public');
            $galeri->link_video = null;
        }

        if ($request->filled('link_video')) {
            $url = $request->link_video;
            if (str_contains($url, 'watch?v=')) {
                $url = str_replace('watch?v=', 'embed/', explode('&', $url)[0]);
            } elseif (str_contains($url, 'youtu.be/')) {
                $url = str_replace('youtu.be/', 'www.youtube.com/embed/', explode('?', $url)[0]);
            }
            
            $galeri->link_video = $url;
            
            if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
                Storage::disk('public')->delete($galeri->file);
                $galeri->file = null;
            }
        } elseif ($request->kategori == 'Foto') {
            $galeri->link_video = null;
        }

        $galeri->save();

        return redirect()
            ->route('admin.galeri.index')
            ->with(
                'success',
                $id_galeri
                    ? 'Data galeri berhasil diperbarui.'
                    : 'Data galeri berhasil disimpan.'
            );
    }

    public function show($id_galeri)
    {
        $title = 'Detail Data Galeri';

        try {
            $galeri = Galeri::findOrFail(Crypt::decrypt($id_galeri));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }

        return view('admin.galeri.show', compact('galeri', 'title'));
    }

    public function destroy($id_galeri)
    {
        try {
            $galeri = Galeri::findOrFail(Crypt::decrypt($id_galeri));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }

        if ($galeri->file && Storage::disk('public')->exists($galeri->file)) {
            Storage::disk('public')->delete($galeri->file);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Data galeri berhasil dihapus.');
    }

    public function galeriPublic()
    {
        $title = 'Data Galeri';

        $galeri = Galeri::latest('tanggal')->get();

        return view('public.galeri.index', compact('galeri', 'title'));
    }

    public function showPublic($slug)
    {
        $title = 'Detail Data Galeri';

        try {
            $galeri = Galeri::where('slug', $slug)->firstOrFail();
        } catch (\Exception $e) {
            return redirect()
                ->route('public.galeri.index')
                ->with('error', 'Data galeri tidak ditemukan.');
        }

        return view('public.galeri.show', compact('title', 'galeri'));
    }
}