@extends('layouts.umum')
@section('title', $galeri->judul . ' - MTs Bahrul Hidayah')

@section('content')
    <style>
        .hover-card {
            transition: all 0.35s ease-in-out;
        }

        .hover-card:hover {
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1) !important;
        }

        .table-detail-info th {
            color: #64748b;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.85rem 0;
            border-bottom: 1px dashed #e2e8f0;
        }

        .table-detail-info td {
            color: #1e293b;
            font-size: 0.875rem;
            padding: 0.85rem 0;
            border-bottom: 1px dashed #e2e8f0;
        }

        .table-detail-info tr:last-child th,
        .table-detail-info tr:last-child td {
            border-bottom: none;
        }
    </style>

    <div class="container-fluid py-5 mt-3" data-aos="fade-down" data-aos-delay="100">
        <div class="container py-3">
            <span class="badge bg-warning text-dark px-3 py-2 mb-2 rounded-pill fw-bold" style="font-size: 0.85rem;">
                <i class="fa-solid fa-images me-1"></i> DOKUMENTASI KEGIATAN
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

        <div class="row g-4">
            <!-- Kartu Preview Media -->
            <div class="col-lg-4">
                <div class="card border-0 rounded-4 shadow-sm text-center p-4 h-100 bg-white hover-card">
                    <div class="card-body d-flex flex-column justify-content-between align-items-center p-2 w-100">
                        <div class="w-100 mb-3 overflow-hidden rounded-4 shadow-sm border bg-light">
                            @if (!empty($galeri->link_video))
                                <!-- Pemutar Video YouTube Responsif (16:9) -->
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $galeri->link_video }}" title="{{ $galeri->judul }}" class="border-0 rounded-4" allowfullscreen></iframe>
                                </div>
                            @elseif ($galeri->file && (str_ends_with($galeri->file, '.mp4') || str_ends_with($galeri->file, '.mov')))
                                <!-- Pemutar File Video Lokal -->
                                <video class="w-100 rounded-4" style="max-height: 260px; object-fit: cover;" controls>
                                    <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutar video.
                                </video>
                            @elseif ($galeri->file && file_exists(public_path('storage/' . $galeri->file)))
                                <!-- Tampilan Foto -->
                                <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}"
                                    class="w-100 h-100" style="object-fit: cover; min-height: 200px; max-height: 260px;">
                            @else
                                <div class="d-flex flex-column align-items-center justify-content-center py-5">
                                    <i class="fa-solid fa-image fa-3x text-muted mb-2 opacity-50"></i>
                                    <span class="text-muted small">Media tidak ditemukan</span>
                                </div>
                            @endif
                        </div>

                        <h5 class="fw-bold text-dark mb-2 fs-5">{{ $galeri->judul }}</h5>
                        <p class="text-muted small mb-0 d-inline-flex align-items-center bg-light px-3 py-2 rounded-pill border">
                            <i class="fa-regular fa-calendar-days me-2 text-primary"></i>
                            Tanggal: {{ $galeri->tanggal ? date('d M Y', strtotime($galeri->tanggal)) : '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left" data-aos-delay="150">
                <div class="card border-0 rounded-4 shadow-sm h-100 bg-white hover-card">
                    <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-circle-info text-primary me-2"></i> Informasi Lengkap Dokumentasi
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-borderless table-detail-info mb-0">
                                <tbody>
                                    <tr>
                                        <th width="32%">Judul Galeri</th>
                                        <td class="fw-bold text-dark">{{ $galeri->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori Dokumentasi</th>
                                        <td>
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-1 rounded-pill fw-bold">
                                                {{ $galeri->kategori ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @if(!empty($galeri->link_video))
                                    <tr>
                                        <th>Sumber Media</th>
                                        <td><span class="text-primary fw-bold">Link YouTube (Embed)</span></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Tanggal Kegiatan</th>
                                        <td>{{ $galeri->tanggal ? date('d F Y', strtotime($galeri->tanggal)) : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="align-top">Keterangan / Deskripsi</th>
                                        <td class="text-secondary" style="line-height: 1.7; text-align: justify;">
                                            {!! $galeri->keterangan
                                                ? nl2br(e($galeri->keterangan))
                                                : '<em class="text-muted">Tidak ada keterangan tambahan.</em>' !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection