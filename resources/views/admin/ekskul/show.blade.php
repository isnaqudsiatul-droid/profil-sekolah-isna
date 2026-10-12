@extends('layouts.admin')
@section('title', 'Detail Ekstrakurikuler')

@section('content')
<style>
    /* Styling Clean / Modern Minimalis Detail */
    .rounded-2xl { border-radius: 1.25rem !important; }
    .rounded-3xl { border-radius: 1.5rem !important; }

    /* Badge Tag Soft Indigo */
    .tag-category-pill {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* Tombol Kembali Soft */
    .btn-soft-secondary {
        background-color: #ffffff;
        color: #64748b;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-soft-secondary:hover {
        background-color: #f8fafc;
        color: #1e293b;
        border-color: #cbd5e1;
    }

    /* Tombol Edit Soft */
    .btn-soft-primary {
        background-color: #eef2ff;
        color: #4f46e5;
        border: 1px solid rgba(79, 70, 229, 0.2);
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-soft-primary:hover {
        background-color: #4f46e5;
        color: #ffffff;
    }

    /* Info Badge Box */
    .info-card-item {
        background-color: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
        padding: 16px;
        transition: all 0.2s ease;
    }
    .info-card-item:hover {
        border-color: #e2e8f0;
        background-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }

    .info-label {
        font-size: 0.725rem;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #1e293b;
    }
</style>

<div class="page-content">
    <div class="container-fluid p-0">
        
        <!-- Header Clean Simple (Tanpa Banner Gelap) -->
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <h2 class="font-weight-bold text-dark mb-1">Detail Ekstrakurikuler</h2>
                <p class="text-muted small mb-0">Rincian lengkap kegiatan ekstrakurikuler siswa.</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.ekskul.index') }}" class="btn btn-soft-secondary shadow-sm d-inline-flex align-items-center">
                    <i data-feather="arrow-left" width="15" class="mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Main Card Detail -->
        <div class="card border-0 rounded-3xl shadow-sm overflow-hidden mb-4" style="background: #ffffff;">
            <div class="card-body p-4 p-md-5">
                <div class="row g-4 align-items-start">
                    
                    <!-- Kolom Foto / Logo -->
                    <div class="col-lg-4 text-center mb-4 mb-lg-0">
                        <div class="p-3 bg-light rounded-3xl d-inline-block border shadow-sm w-100" style="max-width: 320px;">
                            @if($ekstrakurikuler->gambar && file_exists(public_path('storage/' . $ekstrakurikuler->gambar)))
                                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" 
                                     alt="{{ $ekstrakurikuler->nama_ekskul }}" 
                                     class="img-fluid rounded-2xl w-100" 
                                     style="max-height: 280px; object-fit: cover;">
                            @else
                                <div class="py-5 text-center text-muted">
                                    <div class="mb-2">
                                        <i data-feather="image" width="48" class="text-secondary opacity-50"></i>
                                    </div>
                                    <p class="mb-0 small font-weight-medium">Tidak ada foto / logo</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Informasi Detail -->
                    <div class="col-lg-8">
                        
                        <!-- Nama Ekstrakurikuler -->
                        <div class="mb-4">
                            <h3 class="font-weight-bold text-dark mb-1">{{ $ekstrakurikuler->nama_ekskul }}</h3>
                            <span class="badge badge-light border text-muted px-3 py-1 rounded-pill small">ID: #{{ $ekstrakurikuler->id_ekskul }}</span>
                        </div>

                        <!-- Grid Info Singkat -->
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="info-card-item">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i data-feather="user" width="15" class="text-primary"></i>
                                        <span class="info-label mb-0">Pembina / Pendamping</span>
                                    </div>
                                    <div class="info-value">
                                        {{ $ekstrakurikuler->guru->nama ?? $ekstrakurikuler->guru->nama_guru ?? '-' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-card-item">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i data-feather="calendar" width="15" class="text-primary"></i>
                                        <span class="info-label mb-0">Jadwal Latihan</span>
                                    </div>
                                    <div class="info-value">
                                        {{ $ekstrakurikuler->jadwal_latihan ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi Lengkap -->
                        <div class="info-card-item">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i data-feather="file-text" width="15" class="text-primary"></i>
                                <span class="info-label mb-0">Deskripsi Kegiatan</span>
                            </div>
                            <div class="text-secondary small leading-relaxed" style="line-height: 1.7; font-size: 0.9rem;">
                                {!! nl2br(e($ekstrakurikuler->deskripsi)) ?? '<span class="text-muted">Tidak ada deskripsi.</span>' !!}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection