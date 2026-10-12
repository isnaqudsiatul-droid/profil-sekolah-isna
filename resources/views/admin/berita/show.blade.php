@extends('layouts.admin')

@section('title', $title)

@section('content')
<style>
    /* Menyisakan style untuk interaksi hover, transisi, dan state khusus */
    .meta-card:hover {
        background: #ffffff !important;
        border-color: #cbd5e1 !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03) !important;
    }
    .btn-glow-primary:hover {
        color: #ffffff !important;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px -4px rgba(79, 70, 229, 0.5) !important;
    }
    .btn-action-back:hover {
        background: #e2e8f0 !important;
        color: #1e293b !important;
        transform: translateY(-2px);
    }
</style>

<div class="page-content">
    <div class="container-fluid p-0">
        
        <!-- Header Banner & Action Buttons -->
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <h3 class="font-weight-bold text-dark mb-1">Detail Informasi Berita</h3>
                <p class="text-muted small mb-0">Pratinjau konten berita dan informasi rinci terkait publikasi.</p>
            </div>
            <div class="d-flex align-items-center" style="gap: 10px;">
                <a href="{{ route('admin.berita.index') }}" class="btn rounded-pill px-4 py-2 font-weight-bold d-inline-flex align-items-center shadow-sm" style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; transition: all 0.25s ease; text-decoration: none !important;">
                    <i data-feather="arrow-left" width="16" class="mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Kolom Utama: Sampul Foto & Isi Berita -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 p-4" style="border-radius: 1.75rem !important; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(226, 232, 240, 0.8); box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05) !important;">
                    
                    <!-- Cover Image -->
                    <div class="mb-4" style="position: relative; border-radius: 20px; overflow: hidden; background: #0f172a; max-height: 380px;">
                        @if($berita->gambar && file_exists(public_path('storage/' . $berita->gambar)))
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Foto {{ $berita->judul }}" style="width: 100%; height: 380px; object-fit: cover;">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-white-50" style="min-height: 280px; background: #1e293b;">
                                <i data-feather="image" width="60" class="mb-2 text-secondary"></i>
                                <span class="small text-muted">Tidak ada gambar sampul</span>
                            </div>
                        @endif
                    </div>

                    <!-- Judul Utama -->
                    <h2 class="font-weight-bold text-dark mb-3" style="letter-spacing: -0.5px;">
                        {{ $berita->judul }}
                    </h2>

                    <hr class="my-3 border-light">

                    <!-- Isi/Konten Berita -->
                    <div class="py-2" style="font-size: 1.025rem; line-height: 1.8; color: #334155;">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>

                </div>
            </div>

            <!-- Kolom Samping: Metadata Berita -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 overflow-hidden" style="border-radius: 1.75rem !important; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(226, 232, 240, 0.8); box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05) !important;">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i data-feather="info" width="18" class="mr-2 text-primary"></i> Meta Informasi
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- List Metadata -->
                        <div class="d-flex flex-column gap-3">
                            
                            <!-- Status Publikasi (BARU) -->
                            <div class="mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1.1rem; transition: all 0.25s ease;">
                                <span class="text-muted small d-block font-weight-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Status Publikasi</span>
                                <div class="d-flex align-items-center mt-1">
                                    @if(isset($berita->status) && $berita->status == 'public')
                                        <span class="badge rounded-pill px-3 py-1.5 small font-weight-bold" style="background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">
                                            <i data-feather="globe" width="12" class="mr-1"></i> Public
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-1.5 small font-weight-bold" style="background-color: #fef9c3; color: #854d0e; border: 1px solid #fef08a;">
                                            <i data-feather="file-text" width="12" class="mr-1"></i> Draft
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Tanggal Publikasi -->
                            <div class="mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1.1rem; transition: all 0.25s ease;">
                                <span class="text-muted small d-block font-weight-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Tanggal Publikasi</span>
                                <div class="d-flex align-items-center mt-1 text-dark font-weight-bold">
                                    <i data-feather="calendar" width="16" class="mr-2 text-primary"></i>
                                    {{ date('d F Y', strtotime($berita->tanggal)) }}
                                </div>
                            </div>

                            <!-- Penulis / Author -->
                            <div class="mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1.1rem; transition: all 0.25s ease;">
                                <span class="text-muted small d-block font-weight-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Penulis / Publisher</span>
                                <div class="d-flex align-items-center mt-1 text-dark font-weight-bold">
                                    <i data-feather="user" width="16" class="mr-2 text-primary"></i>
                                    {{ $berita->user->name ?? $berita->penulis ?? 'Admin' }}
                                </div>
                            </div>

                            <!-- Tanggal Dibuat -->
                            <div class="mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1.1rem; transition: all 0.25s ease;">
                                <span class="text-muted small d-block font-weight-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Waktu Dibuat</span>
                                <div class="d-flex align-items-center mt-1 text-dark font-weight-bold">
                                    <i data-feather="clock" width="16" class="mr-2 text-muted"></i>
                                    {{ $berita->created_at ? $berita->created_at->translatedFormat('d F Y, H:i') . ' WIB' : '-' }}
                                </div>
                            </div>

                            <!-- Terakhir Diperbarui -->
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 0.85rem 1.1rem; transition: all 0.25s ease;">
                                <span class="text-muted small d-block font-weight-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Terakhir Diperbarui</span>
                                <div class="d-flex align-items-center mt-1 text-dark font-weight-bold">
                                    <i data-feather="refresh-cw" width="16" class="mr-2 text-muted"></i>
                                    {{ $berita->updated_at ? $berita->updated_at->translatedFormat('d F Y, H:i') . ' WIB' : '-' }}
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