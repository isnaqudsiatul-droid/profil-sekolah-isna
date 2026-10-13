<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EktrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UjikomController;

Route::get('/', [DashboardController::class, 'landing'])->name('public.beranda');
Route::get('/profil', [ProfilSekolahController::class, 'profilPublic'])->name('public.profil');

Route::get('/ujikom', [UjikomController::class, 'index'])->name('public.ujikom');
Route::post('/ujikom/hitung', [UjikomController::class, 'hitung'])->name('ujikom.hitung');

Route::prefix('guru')->name('public.guru.')->group(function () {
    Route::get('/', [GuruController::class, 'guruPublic'])->name('index');
    Route::get('/{slug}', [GuruController::class, 'showPublic'])->name('show');
});

Route::prefix('berita')->name('public.berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'beritaPublic'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'showPublic'])->name('show');
});

Route::prefix('ekskul')->name('public.ekskul.')->group(function () {
    Route::get('/', [EktrakurikulerController::class, 'ekskulPublic'])->name('index');
    Route::get('/{slug}', [EktrakurikulerController::class, 'showPublic'])->name('show');
});

Route::prefix('galeri')->name('public.galeri.')->group(function () {
    Route::get('/', [GaleriController::class, 'galeriPublic'])->name('index');
    Route::get('/{slug}', [GaleriController::class, 'showPublic'])->name('show');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.login');
    Route::post('/login-proses', [AuthController::class, 'processLogin'])->name('proses.login');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('akun')->name('akun.')->group(function () {
        Route::get('/', [ProfilController::class, 'index'])->name('index');
        Route::get('/edit', [ProfilController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfilController::class, 'update'])->name('update');
    });

    Route::prefix('ujikom')->name('ujikom.')->group(function () {

        Route::prefix('guru')->name('guru.')->group(function () {
            Route::get('/', [GuruController::class, 'index'])->name('index');
            Route::get('/form/{id_guru?}', [GuruController::class, 'addEdit'])->name('addEdit');
            Route::post('/save/{id_guru?}', [GuruController::class, 'save'])->name('save');
            Route::get('/{id_guru}', [GuruController::class, 'show'])->name('show');
            Route::delete('/{id_guru}', [GuruController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/', [SiswaController::class, 'index'])->name('index');
            Route::get('/form/{id_siswa?}', [SiswaController::class, 'addEdit'])->name('addEdit');
            Route::post('/save/{id_siswa?}', [SiswaController::class, 'save'])->name('save');
            Route::get('/{id_siswa}', [SiswaController::class, 'show'])->name('show');
            Route::delete('/{id_siswa}', [SiswaController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('profil')->name('profil.')->group(function () {
            Route::get('/', [ProfilSekolahController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [ProfilSekolahController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [ProfilSekolahController::class, 'update'])->name('update');
        });

        Route::prefix('berita')->name('berita.')->group(function () {
            Route::get('/', [BeritaController::class, 'index'])->name('index');
            Route::get('/form/{id_berita?}', [BeritaController::class, 'addEdit'])->name('addEdit');
            Route::post('/save/{id_berita?}', [BeritaController::class, 'save'])->name('save');
            Route::get('/{id_berita}', [BeritaController::class, 'show'])->name('show');
            Route::delete('/{id_berita}', [BeritaController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('ekskul')->name('ekskul.')->group(function () {
            Route::get('/', [EktrakurikulerController::class, 'index'])->name('index');
            Route::get('/form/{id_ekskul?}', [EktrakurikulerController::class, 'addEdit'])->name('addEdit');
            Route::post('/save/{id_ekskul?}', [EktrakurikulerController::class, 'save'])->name('save');
            Route::get('/{id_ekskul}', [EktrakurikulerController::class, 'show'])->name('show');
            Route::delete('/{id_ekskul}', [EktrakurikulerController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('galeri')->name('galeri.')->group(function () {
            Route::get('/', [GaleriController::class, 'index'])->name('index');
            Route::get('/form/{id_galeri?}', [GaleriController::class, 'addEdit'])->name('addEdit');
            Route::post('/save/{id_galeri?}', [GaleriController::class, 'save'])->name('save');
            Route::get('/{id_galeri}', [GaleriController::class, 'show'])->name('show');
            Route::delete('/{id_galeri}', [GaleriController::class, 'destroy'])->name('destroy');
        });

        Route::middleware('role:admin')->group(function () {
            Route::prefix('user')->name('user.')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/form/{id_user?}', [UserController::class, 'addEdit'])->name('addEdit');
                Route::post('/save/{id_user?}', [UserController::class, 'save'])->name('save');
                Route::patch('/{id_user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggleStatus');
                Route::get('/{id_user}', [UserController::class, 'show'])->name('show');
                Route::delete('/{id_user}', [UserController::class, 'destroy'])->name('destroy');
            });
        });
    });
});