@extends('layouts.admin')
@section('title', $title)

@section('content')
<style>
    /* Styling Clean / Modern Minimalis Detail */
    .rounded-2xl { border-radius: 1.25rem !important; }
    .rounded-3xl { border-radius: 1.5rem !important; }

    .modern-shadow {
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05) !important;
    }

    /* Tag Soft Indigo */
    .tag-category-pill {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* Soft Badges */
    .badge-soft-info {
        background-color: #e0f2fe;
        color: #0369a1;
        border: 1px solid rgba(3, 105, 161, 0.15);
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

    /* Detail List Table Styling */
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

<div class="page-content">
    <div class="container-fluid p-0">
        
        <!-- Header Clean Simple -->
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <h2 class="font-weight-bold text-dark mb-1">Detail Data Galeri</h2>
                <p class="text-muted small mb-0">Informasi lengkap mengenai berkas dokumentasi foto/video sekolah.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-soft-secondary shadow-sm d-inline-flex align-items-center">
                    <i data-feather="arrow-left" width="15" class="mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Kartu Preview Media -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 rounded-3xl modern-shadow text-center p-4 h-100" style="background: #ffffff;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-2">
                        <div class="w-100 mb-3 overflow-hidden rounded-2xl shadow-sm border bg-light">
                            @if(!empty($galeri->link_video))
                                <!-- Pemutar Video YouTube Responsif -->
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $galeri->link_video }}" title="{{ $galeri->judul }}" class="border-0 rounded-2xl" allowfullscreen></iframe>
                                </div>
                            @elseif($galeri->file && file_exists(public_path('storage/' . $galeri->file)))
                                @if($galeri->kategori == 'Video')
                                    <!-- Pemutar File Video Lokal -->
                                    <video class="w-100 rounded-2xl" style="max-height: 240px; object-fit: cover;" controls>
                                        <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                        Browser Anda tidak mendukung pemutar video.
                                    </video>
                                @else
                                    <!-- Tampilan Foto -->
                                    <img src="{{ asset('storage/' . $galeri->file) }}" 
                                         alt="{{ $galeri->judul }}" 
                                         class="w-100 h-100" 
                                         style="object-fit: cover; min-height: 200px; max-height: 240px;">
                                @endif
                            @else
                                <div class="d-flex flex-column align-items-center justify-content-center py-5">
                                    <i data-feather="image" class="text-muted mb-2" width="48"></i>
                                    <span class="text-muted small">Media tidak ditemukan</span>
                                </div>
                            @endif
                        </div>
                        
                        <h5 class="font-weight-bold text-dark mb-2">{{ $galeri->judul }}</h5>
                        
                        <div class="mb-3">
                            <span class="badge badge-soft-info px-3 py-1 rounded-pill font-weight-bold" style="font-size: 0.75rem;">
                                {{ $galeri->kategori ?? 'Umum' }}
                            </span>
                        </div>

                        <p class="text-muted small mb-0 d-inline-flex align-items-center bg-light px-3 py-1.5 rounded-pill border">
                            <i data-feather="calendar" width="13" class="mr-1.5 text-indigo"></i>
                            Tanggal Kegiatan: {{ $galeri->tanggal ? date('d M Y', strtotime($galeri->tanggal)) : '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kartu Informasi Detail -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 rounded-3xl modern-shadow h-100" style="background: #ffffff;">
                    <div class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i data-feather="file-text" width="18" class="mr-2 text-indigo"></i> Informasi Lengkap
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-borderless table-detail-info mb-0">
                               <tbody>
                                    <tr>
                                        <th width="32%">Judul Galeri</th>
                                        <td class="font-weight-bold text-dark">{{ $galeri->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori Dokumentasi</th>
                                        <td>
                                            <span class="badge badge-soft-info px-3 py-1 rounded-pill font-weight-bold">
                                                {{ $galeri->kategori ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @if(!empty($galeri->link_video))
                                    <tr>
                                        <th>Sumber Video</th>
                                        <td><span class="text-primary font-weight-bold">Link YouTube (Embed)</span></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Tanggal Kegiatan</th>
                                        <td>{{ $galeri->tanggal ? date('d F Y', strtotime($galeri->tanggal)) : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Ditambahkan</th>
                                        <td>{{ $galeri->created_at ? $galeri->created_at->translatedFormat('d F Y H:i') : '-' }} WIB</td>
                                    </tr>
                                    <tr>
                                        <th>Terakhir Diperbarui</th>
                                        <td>{{ $galeri->updated_at ? $galeri->updated_at->translatedFormat('d F Y H:i') : '-' }} WIB</td>
                                    </tr>
                                    <tr>
                                        <th class="align-top">Keterangan / Deskripsi</th>
                                        <td class="text-secondary leading-relaxed">
                                            {!! $galeri->keterangan ? nl2br(e($galeri->keterangan)) : '<em class="text-muted">Tidak ada keterangan tambahan.</em>' !!}
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
</div>
@endsection