@extends('layouts.umum')

@section('title', $title)

@section('content')
    <style>
        .info-tile {
            transition: all 0.3s ease-in-out;
        }

        .info-tile:hover {
            background: #ffffff !important;
            border-color: #cbd5e1 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transform: translateY(-3px);
        }

        .hover-card {
            transition: all 0.35s ease-in-out;
        }

        .hover-card:hover {
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1) !important;
        }
    </style>

    <div class="container-fluid py-5 mt-3" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <span class="badge bg-warning text-dark px-3 py-2 mb-2 rounded-pill fw-bold" style="font-size: 0.85rem;">
                <i class="fa-solid fa-id-card me-1"></i> DETAIL INFORMASI PENDIDIK
            </span>
        </div>
    </div>

    <div class="container pb-5" data-aos="fade-up" data-aos-delay="150">

        <a href="javascript:history.back()"
            class="btn rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center shadow-sm mb-4"
            style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; text-decoration: none !important;">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>

        <!-- SATU CARD UTAMA -->
        <div class="card border-0 rounded-4 shadow-sm bg-white hover-card overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <div class="row g-4 align-items-center">
                    
                    <!-- Kolom Kiri: Foto & Nama Singkat -->
                    <div class="col-lg-4 text-center border-end-lg pe-lg-4">
                        <div class="p-4 bg-light rounded-4 border shadow-sm d-inline-block w-100">
                            <div class="mb-3">
                                @if ($guru->foto && file_exists(public_path('storage/' . $guru->foto)))
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto {{ $guru->nama_guru }}"
                                        class="rounded-circle object-fit-cover border border-white border-4 shadow-sm"
                                        style="width: 130px; height: 130px;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($guru->nama_guru) }}&background=123F66&color=ffffff&size=128"
                                        alt="Foto {{ $guru->nama_guru }}"
                                        class="rounded-circle object-fit-cover border border-white border-4 shadow-sm"
                                        style="width: 130px; height: 130px;">
                                @endif
                            </div>
                            <h5 class="fw-bold text-dark mb-1">{{ $guru->nama_guru }}</h5>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill small fw-semibold">Pendidik / Guru</span>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Rincian Informasi Detail -->
                    <div class="col-lg-8" data-aos="fade-left" data-aos-delay="150">
                        <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
                            <h5 class="fw-bold text-dark mb-0 d-flex align-items-center">
                                <i class="fa-solid fa-circle-info text-primary me-2"></i> Rincian Informasi Pendidik
                            </h5>
                        </div>

                        <div class="row g-3">
                            <!-- Box 1: Nama Lengkap -->
                            <div class="col-md-6">
                                <div class="info-tile bg-light border rounded-4 p-3 h-100">
                                    <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mb-3"
                                        style="width: 38px; height: 38px;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <span class="text-muted d-block small text-uppercase fw-bold mb-1"
                                        style="font-size: 0.7rem;">Nama Lengkap Guru</span>
                                    <h6 class="fw-bold text-dark mb-0">{{ $guru->nama_guru }}</h6>
                                </div>
                            </div>

                            <!-- Box 2: NIP -->
                            <div class="col-md-6">
                                <div class="info-tile bg-light border rounded-4 p-3 h-100">
                                    <div class="rounded-3 bg-secondary bg-opacity-10 text-secondary d-flex align-items-center justify-content-center mb-3"
                                        style="width: 38px; height: 38px;">
                                        <i class="fa-solid fa-hashtag"></i>
                                    </div>
                                    <span class="text-muted d-block small text-uppercase fw-bold mb-1"
                                        style="font-size: 0.7rem;">Nomor Induk Pegawai (NIP)</span>
                                    <h6 class="fw-bold text-dark mb-0">{{ $guru->nip ?? '-' }}</h6>
                                </div>
                            </div>

                            <!-- Box 3: Mata Pelajaran -->
                            <div class="col-md-6">
                                <div class="info-tile bg-light border rounded-4 p-3 h-100">
                                    <div class="rounded-3 bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center mb-3"
                                        style="width: 38px; height: 38px;">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <span class="text-muted d-block small text-uppercase fw-bold mb-1"
                                        style="font-size: 0.7rem;">Mata Pelajaran Utama</span>
                                    <h6 class="fw-bold text-dark mb-0">{{ $guru->mapel ?? '-' }}</h6>
                                </div>
                            </div>

                            <!-- Box 4: Ekstrakurikuler -->
                            <div class="col-md-6">
                                <div class="info-tile bg-light border rounded-4 p-3 h-100">
                                    <div class="rounded-3 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center mb-3"
                                        style="width: 38px; height: 38px;">
                                        <i class="fa-solid fa-people-group"></i>
                                    </div>
                                    <span class="text-muted d-block small text-uppercase fw-bold mb-1"
                                        style="font-size: 0.7rem;">Ekskul yang Diampu</span>
                                    <div class="mt-1">
                                        @if (isset($guru->ekstrakurikuler) && $guru->ekstrakurikuler->count() > 0)
                                            @foreach ($guru->ekstrakurikuler as $ekskul)
                                                <span
                                                    class="badge bg-success bg-opacity-10 text-success fw-semibold me-1 mb-1 px-2 py-1">{{ $ekskul->nama_ekskul }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted small">Tidak mengampu ekstrakurikuler</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection