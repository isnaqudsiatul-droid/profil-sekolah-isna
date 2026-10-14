@extends('layouts.umum')
@section('title', $title)
@section('content')

    <style>
        .hover-card {
            transition: 0.3s;
        }

        .hover-card:hover {
            transform: translateY(-8px);
        }
    </style>

    <div class="container-fluid py-5 mt-3" data-aos="fade-down" data-aos-delay="100">
        <div class="container py-3">
            <span class="badge bg-warning text-dark px-3 py-2 mb-2 rounded-pill fw-bold" style="font-size: 0.85rem;">
                <i class="fa-solid fa-newspaper me-1"></i> BACA ARTIKEL
            </span>
        </div>
    </div>

    <div class="container pb-5" data-aos="fade-up" data-aos-delay="150">
        <div class="mb-4">
            <a href="javascript:history.back()"
                class="btn rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center shadow-sm"
                style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; text-decoration: none !important;">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <!-- SATU CARD UTAMA -->
        <div class="card border-0 rounded-4 shadow-sm bg-white hover-card overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <div class="row g-4 align-items-start">
                    
                    <!-- Kolom Kiri: Gambar Utama Artikel -->
                    <div class="col-lg-5">
                        <div class="p-3 bg-light rounded-4 border shadow-sm w-100 overflow-hidden" style="max-height: 380px;">
                            @if ($berita->gambar && file_exists(public_path('storage/' . $berita->gambar)))
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="w-100 rounded-3 object-fit-cover shadow-sm" style="height: 320px;">
                            @else
                                <div class="w-100 d-flex flex-column align-items-center justify-content-center text-secondary py-5 bg-secondary bg-opacity-10 rounded-3" style="height: 320px;">
                                    <i class="fa-solid fa-image fa-3x mb-2 opacity-50"></i>
                                    <span class="small text-muted">Gambar tidak tersedia</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Kanan: Judul, Meta, dan Isi Artikel -->
                    <div class="col-lg-7" data-aos="fade-left" data-aos-delay="150">
                        <div class="mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-2 rounded-pill">
                                <i class="fa-solid fa-tag me-1"></i> Informasi Sekolah
                            </span>
                        </div>

                        <h1 class="fw-bold text-dark mb-3 fs-3 lh-sm">
                            {{ $berita->judul }}
                        </h1>

                        <div class="d-flex align-items-center text-muted small mb-4 pb-3 border-bottom flex-wrap gap-3">
                            <div class="d-flex align-items-center me-2">
                                <i class="fa-solid fa-user me-1 text-primary"></i>
                                <span>{{ $berita->user->name ?? ($berita->penulis ?? 'Admin Sekolah') }}</span>
                            </div>
                            <div class="d-flex align-items-center me-2">
                                <i class="fa-solid fa-calendar me-1 text-primary"></i>
                                <span>{{ date('d F Y', strtotime($berita->tanggal)) }}</span>
                            </div>
                            @if ($berita->created_at)
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-clock me-1 text-muted"></i>
                                    <span>{{ $berita->created_at->translatedFormat('H:i') }} WIB</span>
                                </div>
                            @endif
                        </div>

                        <div class="fs-6 lh-lg text-secondary" style="text-align: justify;">
                            {!! nl2br(e($berita->isi)) !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection