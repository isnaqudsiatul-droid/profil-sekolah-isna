<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SiswaController extends Controller
{
    public function index()
    {
        $title = 'Siswa';
        $siswa = Siswa::latest()->get();

        return view('admin.siswa.index', compact('title', 'siswa'));    
    }

    public function addEdit($id_siswa = null)
    {
        $siswa = null;

        if ($id_siswa) {
            try {
                $decryptedId = Crypt::decrypt($id_siswa);
                $siswa = Siswa::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }
        }

        return view('admin.siswa.form', compact('siswa'));
    }

    public function save(Request $request, $id_siswa = null)
    {
        $decryptedId = null;

        if ($id_siswa) {
            try {
                $decryptedId = Crypt::decrypt($id_siswa);
                $siswa = Siswa::findOrFail($decryptedId);
            } catch (\Exception $e) {
                return redirect()
                    ->route('admin.siswa.index')
                    ->with('error', 'Data siswa tidak ditemukan.');
            }
        } else {
            $siswa = new Siswa();
        }

        $request->validate([
                'nisn' => 'nullable|numeric|digits_between:1,16|unique:siswa,nisn,' . ($decryptedId ?? 'NULL') . ',id_siswa',
                'nama_siswa' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'tahun_masuk' => 'required|digits:4|integer'
            ],
            [
                'nisn.numeric' => 'NISN harus berupa angka.',
                'nisn.digits_between' => 'NISN maksimal 16 digit.',
                'nisn.unique' => 'NISN sudah terdaftar pada siswa lain.',
                'nama_siswa.required' => 'Nama siswa wajib diisi.',
                'jenis_kelamin.required' => 'Pilih jenis kelamin.',
                'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
                'tahun_masuk.digits' => 'Tahun masuk harus 4 digit angka.',
            ]
        );

        $siswa->nisn = $request->nisn;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tahun_masuk = $request->tahun_masuk;

        $siswa->save();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', $decryptedId ? 'Data siswa berhasil diperbarui.' : 'Data siswa berhasil disimpan.');
    }

    public function show($id_siswa)
    {
        $title = 'Detail Data Siswa';

        try {
            $decryptedId = Crypt::decrypt($id_siswa);
            $siswa = Siswa::findOrFail($decryptedId);
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('admin.siswa.show', compact('siswa', 'title'));
    }

    public function destroy($id_siswa)
    {
        try {
            $decryptedId = Crypt::decrypt($id_siswa);
            $siswa = Siswa::findOrFail($decryptedId);
            $siswa->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}