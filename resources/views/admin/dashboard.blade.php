@extends('layouts.admin')
@section('title', $title ?? 'Dashboard Admin')

@section('content')
    <style>
        .card-dash-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px -5px rgba(0, 0, 0, 0.08);
            transition: all 0.25s ease-in-out;
        }
        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">
            <div class="mb-4">
                <h3 class="font-weight-bold text-dark mb-1">Dashboard</h3>
                <p class="text-muted small mb-0">Ringkasan statistik data sistem informasi portal sekolah.</p>
            </div>

            <div class="card text-white mb-4" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); border-radius: 1.25rem; border: none; box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.3);">
                <div class="card-body p-4 p-md-5 d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="font-weight-bold text-white mb-2">
                            Selamat Datang, {{ Auth::user()->name ?? (Auth::user()->username ?? 'Admin') }}! 
                        </h4>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Anda masuk sebagai <span style="padding: 0.4rem 0.9rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; background-color: rgba(255, 255, 255, 0.2); color: #ffffff; backdrop-filter: blur(4px);">{{ ucfirst(Auth::user()->role ?? 'Administrator') }}</span>. 
                            Selamat mengelola statistik dan konten sistem portal sekolah.
                        </p>
                    </div>
                    <div class="d-none d-lg-block ml-3">
                        <i data-feather="user-check" style="width: 56px; height: 56px; opacity: 0.85;"></i>
                    </div>
                </div>
            </div>

            <section class="section">
                <div class="row g-4 mb-4">
                    
                    {{-- @if (Auth::check() && strcasecmp(Auth::user()->role, 'admin') == 0) --}}
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card card-dash card-dash-stat h-100" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04); overflow: hidden; transition: all 0.25s ease-in-out;">
                            <div class="card-body p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div style="width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; background-color: #e0e7ff; color: #4f46e5;">
                                        <i data-feather="users" width="24" height="24"></i>
                                    </div>
                                    <span style="padding: 0.4rem 0.9rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; background-color: #e0e7ff; color: #4f46e5;">Guru</span>
                                </div>
                                <div class="text-uppercase text-muted font-weight-bold mb-1" style="letter-spacing: 0.6px; font-size: 0.75rem;">
                                    Data Guru
                                </div>
                                <h2 class="font-weight-bold text-dark mb-1">{{ $totalGuru ?? 0 }}</h2>
                                <div class="text-muted small d-flex align-items-center gap-1">
                                    <i data-feather="users" width="13"></i> Total guru terdaftar
                                </div>
                                <i data-feather="users" style="position:absolute; right:-15px; bottom:-20px; width:120px; height:120px; opacity: 0.05; color: #4f46e5;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card card-dash card-dash-stat h-100" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04); overflow: hidden; transition: all 0.25s ease-in-out;">
                            <div class="card-body p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div style="width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; background-color: #dcfce7; color: #16a34a;">
                                        <i data-feather="user-check" width="24" height="24"></i>
                                    </div>
                                    <span style="padding: 0.4rem 0.9rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; background-color: #dcfce7; color: #16a34a;">Siswa</span>
                                </div>
                                <div class="text-uppercase text-muted font-weight-bold mb-1" style="letter-spacing: 0.6px; font-size: 0.75rem;">
                                    Data Siswa
                                </div>
                                <h2 class="font-weight-bold text-dark mb-1">{{ $totalSiswa ?? 0 }}</h2>
                                <div class="text-muted small d-flex align-items-center gap-1">
                                    <i data-feather="user-check" width="13"></i> Total siswa terdaftar
                                </div>
                                <i data-feather="user-check" style="position:absolute; right:-15px; bottom:-20px; width:120px; height:120px; opacity: 0.05; color: #16a34a;"></i>
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card card-dash card-dash-stat h-100" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04); overflow: hidden; transition: all 0.25s ease-in-out;">
                            <div class="card-body p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div style="width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; background-color: #fef3c7; color: #d97706;">
                                        <i data-feather="file-text" width="24" height="24"></i>
                                    </div>
                                    <span style="padding: 0.4rem 0.9rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; background-color: #fef3c7; color: #d97706;">Berita</span>
                                </div>
                                <div class="text-uppercase text-muted font-weight-bold mb-1" style="letter-spacing: 0.6px; font-size: 0.75rem;">
                                    Berita & Artikel
                                </div>
                                <h2 class="font-weight-bold text-dark mb-1">{{ $totalBerita ?? 0 }}</h2>
                                <div class="text-muted small d-flex align-items-center gap-1">
                                    <i data-feather="file-text" width="13"></i> Total berita tersedia
                                </div>
                                <i data-feather="file-text" style="position:absolute; right:-15px; bottom:-20px; width:120px; height:120px; opacity: 0.05; color: #d97706;"></i>
                            </div>
                        </div>
                    </div>

                    <!-- EKSTRAKURIKULER -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card card-dash card-dash-stat h-100" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04); overflow: hidden; transition: all 0.25s ease-in-out;">
                            <div class="card-body p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div style="width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; background-color: #f3e8ff; color: #9333ea;">
                                        <i data-feather="activity" width="24" height="24"></i>
                                    </div>
                                    <span style="padding: 0.4rem 0.9rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; background-color: #f3e8ff; color: #9333ea;">Ekskul</span>
                                </div>
                                <div class="text-uppercase text-muted font-weight-bold mb-1" style="letter-spacing: 0.6px; font-size: 0.75rem;">
                                    Ekstrakurikuler
                                </div>
                                <h2 class="font-weight-bold text-dark mb-1">{{ $totalEkstrakurikuler ?? 0 }}</h2>
                                <div class="text-muted small d-flex align-items-center gap-1">
                                    <i data-feather="activity" width="13"></i> Total kegiatan ekskul
                                </div>
                                <i data-feather="activity" style="position:absolute; right:-15px; bottom:-20px; width:120px; height:120px; opacity: 0.05; color: #9333ea;"></i>
                            </div>
                        </div>
                    </div>

                    <!-- GALERI -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card card-dash card-dash-stat h-100" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04); overflow: hidden; transition: all 0.25s ease-in-out;">
                            <div class="card-body p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div style="width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; background-color: #ffe4e6; color: #e11d48;">
                                        <i data-feather="image" width="24" height="24"></i>
                                    </div>
                                    <span style="padding: 0.4rem 0.9rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; background-color: #ffe4e6; color: #e11d48;">Galeri</span>
                                </div>
                                <div class="text-uppercase text-muted font-weight-bold mb-1" style="letter-spacing: 0.6px; font-size: 0.75rem;">
                                    Galeri Foto
                                </div>
                                <h2 class="font-weight-bold text-dark mb-1">{{ $totalGaleri ?? 0 }}</h2>
                                <div class="text-muted small d-flex align-items-center gap-1">
                                    <i data-feather="image" width="13"></i> Total foto galeri
                                </div>
                                <i data-feather="image" style="position:absolute; right:-15px; bottom:-20px; width:120px; height:120px; opacity: 0.05; color: #e11d48;"></i>
                            </div>
                        </div>
                    </div>

                    @if (Auth::check() && strcasecmp(Auth::user()->role, 'admin') == 0)
                    <!-- PENGELOLA -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card card-dash card-dash-stat h-100" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04); overflow: hidden; transition: all 0.25s ease-in-out;">
                            <div class="card-body p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div style="width: 52px; height: 52px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; background-color: #cffaff; color: #0891b2;">
                                        <i data-feather="briefcase" width="24" height="24"></i>
                                    </div>
                                    <span style="padding: 0.4rem 0.9rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; background-color: #cffaff; color: #0891b2;">Pengelola</span>
                                </div>
                                <div class="text-uppercase text-muted font-weight-bold mb-1" style="letter-spacing: 0.6px; font-size: 0.75rem;">
                                    Pengelola Sistem
                                </div>
                                <h2 class="font-weight-bold text-dark mb-1">{{ $totalPengelola ?? 0 }}</h2>
                                <div class="text-muted small d-flex align-items-center gap-1">
                                    <i data-feather="briefcase" width="13"></i> Total pengelola sistem
                                </div>
                                <i data-feather="briefcase" style="position:absolute; right:-15px; bottom:-20px; width:120px; height:120px; opacity: 0.05; color: #0891b2;"></i>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </section>

            <div class="row">
                <div class="col-12">
                    <div class="card" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04); overflow: hidden;">
                        <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 font-weight-bold text-dark">Berita & Informasi Terbaru</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-middle" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th class="pl-4" style="background-color: #f8fafc; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; border-bottom: 1px solid #e2e8f0; padding: 1rem 1.25rem;">Judul Berita</th>
                                            <th style="background-color: #f8fafc; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; border-bottom: 1px solid #e2e8f0; padding: 1rem 1.25rem;">Tanggal Published</th>
                                            <th class="pr-4 text-right" style="background-color: #f8fafc; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; border-bottom: 1px solid #e2e8f0; padding: 1rem 1.25rem;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $beritaList = $beritaTerbaru ?? [];
                                        @endphp
                                        @if(count($beritaList) > 0)
                                            @foreach($beritaList as $item)
                                                <tr>
                                                    <td class="pl-4 font-weight-bold text-dark" style="padding: 1rem 1.25rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 0.9rem;">
                                                        {{ $item->judul }}
                                                    </td>
                                                    <td class="text-muted" style="padding: 1rem 1.25rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 0.9rem;">
                                                        <i data-feather="calendar" width="14" class="mr-1"></i>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                                    </td>
                                                    <td class="pr-4 text-right" style="padding: 1rem 1.25rem; vertical-align: middle; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 0.9rem;">
                                                        <span style="padding: 0.4rem 0.9rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; background-color: #dcfce7; color: #15803d;">
                                                            <i data-feather="check-circle" width="13"></i> Diterbitkan
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center py-4 text-muted" style="padding: 1rem 1.25rem; vertical-align: middle; border-bottom: none;">
                                                    Belum ada data berita terbaru.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection