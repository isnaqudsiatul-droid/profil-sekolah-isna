<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Ektrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Admin';

        $totalGuru           = Guru::count();
        $totalSiswa          = Siswa::count();
        $totalBerita         = Berita::count();
        $totalEkstrakurikuler= Ektrakurikuler::count();
        $totalGaleri         = Galeri::count();
        $totalPengelola      = User::count();
        $beritaTerbaru       = Berita::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'title',
            'totalGuru',
            'totalSiswa',
            'totalBerita',
            'totalEkstrakurikuler',
            'totalGaleri',
            'totalPengelola',
            'beritaTerbaru',
        ));
    }

    public function landing()
    {
        $title = 'Beranda';

        $berita = Berita::with('user')
            ->where('status', 'public')
            ->latest('tanggal')
            ->take(3)
            ->get();
        $ekskul = Ektrakurikuler::latest()->take(3)->get();
        $guru = Guru::latest()->take(4)->get();
        $galeri = Galeri::latest()->take(3)->get();


        $totalSiswa  = Siswa::count();
        $totalGuru   = Guru::count();
        $totalEkskul = Ektrakurikuler::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();

        return view('public.beranda', compact(
            'berita',
            'ekskul',
            'guru',
            'galeri',
            'totalSiswa',
            'totalGuru',
            'totalEkskul',
            'totalBerita',
            'totalGaleri',
            'title'
        ));
    }
}
