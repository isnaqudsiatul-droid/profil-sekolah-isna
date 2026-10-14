@extends('layouts.umum')
@section('title', $ekstrakurikuler->nama_ekskul . ' - MTs Bahrul Hidayah')

@section('content')
    <style>
        .hover-card {
            transition: all 0.35s ease-in-out;
        }

        .hover-card:hover {
            transform: translateY(-8px);
        }

        .info-card-item {
            background-color: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            padding: 16px;
            transition: 0.2s;
        }

        .info-card-item:hover {
            border-color: #cbd5e1;
            background-color: #ffffff;  
        }
    </style>

    <div class="container-fluid py-5 mt-3" data-aos="fade-down" data-aos-delay="100">
        <div class="container py-3">
            <span class="badge bg-warning text-dark px-3 py-2 mb-2 rounded-pill fw-bold" style="font-size: 14px;">
                <i class="fa-solid fa-chart-line me-1"></i> PENGEMBANGAN DIRI
            </span>
        </div>
    </div>

    <div class="container pb-5" data-aos="fade-up" data-aos-delay="150">
        <div class="mb-4">
            <a href="javascript:history.back()"
                class="btn rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center shadow-sm"
                style="color: #475569; border: 1px solid #e2e8f0; text-decoration: none !important;">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
        </div>

        <div class="card border-0 rounded-4 shadow-sm overflow-hidden mb-4 bg-white hover-card">
            <div class="card-body p-4 p-md-5">
                <div class="row g-4 align-items-start">
                    <div class="col-lg-4 text-center">
                        <div class="p-3 bg-light rounded-4 d-inline-block border shadow-sm w-100" style="max-width: 320px;">
                            @if ($ekstrakurikuler->gambar && file_exists(public_path('storage/' . $ekstrakurikuler->gambar)))
                                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}"
                                    alt="{{ $ekstrakurikuler->nama_ekskul }}" class="img-fluid rounded-3 w-100"
                                    style="max-height: 280px; object-fit: cover;">
                            @else
                                <div class="py-5 text-center text-muted">
                                    <div class="mb-2">
                                        <i class="fa-solid fa-image fa-3x text-secondary opacity-50"></i>
                                    </div>
                                    <p class="mb-0 small fw-semibold">Tidak ada foto / logo</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="mb-4">
                            <h2 class="fw-bold text-dark mb-2 fs-3 fs-md-2">{{ $ekstrakurikuler->nama_ekskul }}</h2>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="info-card-item">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="fa-solid fa-user text-primary"></i>
                                        <span class="text-muted small fw-bold text-uppercase"
                                            style="font-size: 12px;">Pembina / Pendamping</span>
                                    </div>
                                    <div class="fw-semibold text-dark" style="font-size: 14px;">
                                        {{ $ekstrakurikuler->guru->nama ?? ($ekstrakurikuler->guru->nama_guru ?? '-') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-card-item">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="fa-regular fa-calendar-days text-primary"></i>
                                        <span class="text-muted small fw-bold text-uppercase"
                                            style="font-size: 12px;">Jadwal Latihan</span>
                                    </div>
                                    <div class="fw-semibold text-dark" style="font-size: 14px;">
                                        {{ $ekstrakurikuler->jadwal_latihan ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-card-item">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fa-solid fa-file-lines text-primary"></i>
                                <span class="text-muted small fw-bold text-uppercase" style="font-size: 12px;">Deskripsi
                                    Kegiatan</span>
                            </div>
                            <div class="text-secondary small"
                                style="line-height: 1.7; font-size: 14px; text-align: justify;">
                                {!! nl2br(e($ekstrakurikuler->deskripsi)) ?? '<span class="text-muted">Tidak ada deskripsi.</span>' !!}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection