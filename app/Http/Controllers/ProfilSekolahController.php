<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $profilSekolah = ProfilSekolah::first();
        $data = ['title' => 'Profil Sekolah'];

        return view('admin.profil.index', $data, compact('profilSekolah'));
    }

    public function edit()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('admin.profil.index')->with('error', 'Maaf, operator tidak memiliki hak akses untuk mengedit profil sekolah.');
        }

        $profilSekolah = ProfilSekolah::first();
        $data = ['title' => 'Edit Profil'];

        return view('admin.profil.edit', $data, compact('profilSekolah'));
    }

    public function update(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('admin.profil.index')->with('error', 'Maaf, operator tidak memiliki hak akses untuk memperbarui profil sekolah.');
        }

        $request->validate([
            'nama_sekolah'          => 'required|max:255',
            'nama_kepala_sekolah'   => 'nullable|max:100',
            'foto_kepala_sekolah'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'npsn'                  => 'required|max:50',
            'alamat'                => 'required',
            'kontak'                => 'nullable|max:15',
            'tiktok'                => 'nullable|string|max:255',
            'instagram'             => 'nullable|string|max:255',
            'facebook'              => 'nullable|string|max:255',
            'youtube'               => 'nullable|string|max:255',
            'visi'                  => 'nullable',
            'misi'                  => 'nullable',
            'tahun_berdiri'         => 'nullable|numeric|digits:4',
            'deskripsi'             => 'nullable',
            'logo'                  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto'                  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profilSekolah = ProfilSekolah::first();

        if (!$profilSekolah) {
            $profilSekolah = new ProfilSekolah();
        }

        $profilSekolah->nama_sekolah   = $request->nama_sekolah;
        $profilSekolah->nama_kepala_sekolah = $request->nama_kepala_sekolah;
        $profilSekolah->npsn            = $request->npsn;
        $profilSekolah->alamat          = $request->alamat;
        $profilSekolah->kontak          = $request->kontak;
        $profilSekolah->tiktok          = $request->tiktok;
        $profilSekolah->instagram       = $request->instagram;
        $profilSekolah->facebook        = $request->facebook;
        $profilSekolah->youtube         = $request->youtube;
        $profilSekolah->visi            = $request->visi;
        $profilSekolah->misi            = $request->misi;
        $profilSekolah->tahun_berdiri   = $request->tahun_berdiri;
        $profilSekolah->deskripsi       = $request->deskripsi;

        if ($request->hasFile('logo')) {
            if ($profilSekolah->logo && Storage::disk('public')->exists($profilSekolah->logo)) {
                Storage::disk('public')->delete($profilSekolah->logo);
            }
            $profilSekolah->logo = $request->file('logo')->store('profil', 'public');
        }

        if ($request->hasFile('foto_kepala_sekolah')) {
            if ($profilSekolah->foto_kepala_sekolah && Storage::disk('public')->exists($profilSekolah->foto_kepala_sekolah)) {
                Storage::disk('public')->delete($profilSekolah->foto_kepala_sekolah);
            }
            $profilSekolah->foto_kepala_sekolah = $request->file('foto_kepala_sekolah')->store('profil', 'public');
        }

        if ($request->hasFile('foto')) {
            if ($profilSekolah->foto && Storage::disk('public')->exists($profilSekolah->foto)) {
                Storage::disk('public')->delete($profilSekolah->foto);
            }
            $profilSekolah->foto = $request->file('foto')->store('profil', 'public');
        }

        $profilSekolah->save();

        return redirect()->route('admin.profil.index')->with('success', 'Profil sekolah berhasil diperbarui!');
    }

    public function profilPublic()
    {
        $profil = ProfilSekolah::first();

        return view('public.profil', compact('profil'));
    }
}