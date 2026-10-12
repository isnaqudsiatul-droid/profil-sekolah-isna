<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $title = 'Berita';

        if (Auth::user()->role === 'admin') {
            $berita = Berita::with('user')
                ->latest('tanggal')
                ->get();
        } else {
            $berita = Berita::with('user')
                ->where('id_user', Auth::id())
                ->latest('tanggal')
                ->get();
        }

        return view('admin.berita.index', compact('title', 'berita'));
    }

    public function addEdit($id_berita = null)
    {
        try {
            $berita = null;
            if ($id_berita) {
                $berita = Berita::findOrFail(Crypt::decrypt($id_berita));

                if (Auth::user()->role !== 'admin' && $berita->id_user !== Auth::id()) {
                    return redirect()
                        ->route('admin.berita.index')
                        ->with('error', 'Anda tidak memiliki hak akses untuk mengedit berita milik operator lain.');
                }
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return view('admin.berita.form', compact('berita'));
    }

    public function save(Request $request, $id_berita = null)
    {
        $slug = Str::slug($request->judul);
        $request->merge(['slug' => $slug]);

        $decryptedId = null;
        if ($id_berita) {
            try {
                $decryptedId = Crypt::decrypt($id_berita);
                $berita = Berita::findOrFail($decryptedId);

                if (Auth::user()->role !== 'admin' && $berita->id_user !== Auth::id()) {
                    return redirect()
                        ->route('admin.berita.index')
                        ->with('error', 'Anda tidak memiliki hak akses untuk mengubah berita ini.');
                }
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Data berita tidak ditemukan.');
            }
        } else {
            $berita = new Berita();
            $berita->id_user = Auth::id() ?? User::value('id_user');
        }

        $request->validate(
            [
                'judul' => 'required|string|max:255',
                'isi' => 'required|string',
                'tanggal' => 'required|date',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|in:draft,public',
                'slug' => 'required|unique:berita,slug,' . $decryptedId . ',id_berita'
            ],
            [
                'judul.required' => 'Judul berita wajib diisi.',
                'judul.max' => 'Judul terlalu panjang.',
                'isi.required' => 'Isi berita wajib diisi.',
                'tanggal.required' => 'Tanggal publikasi wajib diisi.',
                'tanggal.date' => 'Format tanggal tidak valid.',
                'gambar.image' => 'Gambar harus berupa file gambar.',
                'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, atau PNG.',
                'gambar.max' => 'Ukuran gambar maksimal 2MB.',
                'status.required' => 'Status berita wajib dipilih.',
                'status.in' => 'Status berita hanya boleh Draft atau Public.',
                'slug.unique' => 'Slug berita sudah digunakan. Silahkan gunakan judul yang berbeda.'
            ]
        );

        $berita->judul = $request->judul;
        $berita->slug = $slug;
        $berita->isi = $request->isi;
        $berita->tanggal = $request->tanggal;
        $berita->status = $request->status;

        if ($request->hasFile('gambar')) {
            if (
                $berita->gambar &&
                Storage::disk('public')->exists($berita->gambar)
            ) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $berita->gambar = $request
                ->file('gambar')
                ->store('berita', 'public');
        }

        $berita->save();

        return redirect()
            ->route('admin.berita.index')
            ->with(
                'success',
                $id_berita
                    ? 'Data berita berhasil diperbarui.'
                    : 'Data berita berhasil disimpan.'
            );
    }

    public function show($id_berita)
    {
        $title = 'Detail Data Berita';

        try {
            $berita = Berita::with('user')
                ->findOrFail(Crypt::decrypt($id_berita));
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        return view(
            'admin.berita.show',
            compact('berita', 'title')
        );
    }

    public function destroy($id_berita)
    {
        try {
            $berita = Berita::findOrFail(
                Crypt::decrypt($id_berita)
            );

            if (Auth::user()->role !== 'admin' && $berita->id_user !== Auth::id()) {
                return redirect()
                    ->route('admin.berita.index')
                    ->with('error', 'Anda tidak memiliki hak akses untuk menghapus berita milik operator lain.');
            }
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.berita.index')
                ->with('error', 'Data berita tidak ditemukan.');
        }

        if (
            $berita->gambar &&
            Storage::disk('public')->exists($berita->gambar)
        ) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Data berita berhasil dihapus.');
    }

    public function beritaPublic()
    {
        $berita = Berita::with('user')
            ->where('status', 'public')
            ->latest('tanggal')
            ->get();

        return view('public.berita.index', compact('berita'));
    }

    public function showPublic($slug)
    {
        $title = 'Detail Data Berita';

        $berita = Berita::with('user')
            ->where('slug', $slug)
            ->where('status', 'public')
            ->firstOrFail();

        return view('public.berita.show', compact('berita', 'title'));
    }
}