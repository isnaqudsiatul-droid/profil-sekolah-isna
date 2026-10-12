@extends('layouts.admin')

@section('title', $title)

@section('content')
<style>
    /* Hanya menyisakan style untuk hover states dan transisi */
    .info-tile:hover {
        background: #ffffff;
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }
    .btn-back-clean:hover {
        background-color: #f8fafc;
        color: #0f172a;
        transform: translateX(-2px);
    }
</style>

<div class="page-content">
    <div class="container-fluid p-0">
        
        <!-- Header Clean & Action -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="font-weight-bold text-dark mb-1">
                    Detail Data Guru
                </h2>
                <p class="text-muted small mb-0">
                    Informasi lengkap dan rincian data pengajar di lingkungan sekolah.
                </p>
            </div>
            <a href="{{ route('admin.guru.index') }}" class="btn shadow-sm d-inline-flex align-items-center btn-back-clean" style="background-color: #ffffff; border: 1px solid #e2e8f0; color: #475569; font-weight: 600; border-radius: 2rem; padding: 0.5rem 1.25rem; transition: all 0.2s ease; font-size: 0.875rem; text-decoration: none !important;">
                <i data-feather="arrow-left" width="15" class="mr-2"></i> Kembali
            </a>
        </div>

        <div class="row">
            <!-- Left Panel: Card Profile Avatar -->
            <div class="col-lg-4 mb-4">
                <div class="overflow-hidden text-center pb-4" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), 0 8px 10px -6px rgba(0, 0, 0, 0.02); transition: all 0.3s ease;">
                    <!-- Top Cover Banner -->
                    <div style="height: 90px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #3730a3 100%); border-radius: 1.25rem 1.25rem 0 0; position: relative;"></div>

                    <!-- Avatar Image -->
                    <div class="mb-2" style="margin-top: -55px; position: relative; display: inline-block;">
                        @if($guru->foto && file_exists(public_path('storage/' . $guru->foto)))
                            <img src="{{ asset('storage/' . $guru->foto) }}" 
                                 alt="Foto {{ $guru->nama_guru }}" 
                                 style="width: 110px; height: 110px; object-fit: cover; border-radius: 50%; border: 4px solid #ffffff; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($guru->nama_guru) }}&background=6366f1&color=ffffff&size=128" 
                                 alt="Foto {{ $guru->nama_guru }}" 
                                 style="width: 110px; height: 110px; object-fit: cover; border-radius: 50%; border: 4px solid #ffffff; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);">
                        @endif
                    </div>

                    <!-- Nama & Detail Singkat -->
                    <h5 class="font-weight-bold text-dark mb-1 px-3">{{ $guru->nama_guru }}</h5>
                    <p class="text-muted small mb-3">
                        <i data-feather="credit-card" width="13" class="mr-1"></i>
                        {{ $guru->nip ? 'NIP. ' . $guru->nip : 'Belum Ada NIP' }}
                    </p>

                    <div class="d-flex justify-content-center px-3">
                        <span class="d-inline-flex align-items-center" style="background: #eef2ff; color: #4f46e5; border: 1px solid rgba(79, 70, 229, 0.2); font-weight: 600; padding: 0.45em 0.85em; border-radius: 0.5rem; font-size: 0.8rem;">
                            <i data-feather="book-open" width="14" class="mr-1.5"></i>
                            {{ $guru->mapel ?? 'Mata Pelajaran Belum Set' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Grid Bento Information -->
            <div class="col-lg-8 mb-4">
                <div class="p-4" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), 0 8px 10px -6px rgba(0, 0, 0, 0.02); transition: all 0.3s ease;">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i data-feather="sliders" width="16" class="text-indigo mr-2"></i> Rincian Informasi
                        </h6>
                        <span class="text-muted small">Terakhir diperbarui: {{ $guru->updated_at ? $guru->updated_at->diffForHumans() : '-' }}</span>
                    </div>

                    <!-- Grid Layout (Bento Style) -->
                    <div class="row">
                        <!-- Box 1: Nama Lengkap -->
                        <div class="col-md-6 mb-3">
                            <div class="info-tile" style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 0.875rem; padding: 1rem 1.25rem; height: 100%; transition: all 0.2s ease;">
                                <div style="width: 36px; height: 36px; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; background: #eef2ff; color: #4f46e5;">
                                    <i data-feather="user" width="18"></i>
                                </div>
                                <span class="text-muted d-block small text-uppercase font-weight-bold mb-1" style="letter-spacing: 0.5px; font-size: 0.7rem;">Nama Lengkap Guru</span>
                                <h6 class="font-weight-bold text-dark mb-0">{{ $guru->nama_guru }}</h6>
                            </div>
                        </div>

                        <!-- Box 2: NIP -->
                        <div class="col-md-6 mb-3">
                            <div class="info-tile" style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 0.875rem; padding: 1rem 1.25rem; height: 100%; transition: all 0.2s ease;">
                                <div style="width: 36px; height: 36px; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; background: #f1f5f9; color: #475569;">
                                    <i data-feather="hash" width="18"></i>
                                </div>
                                <span class="text-muted d-block small text-uppercase font-weight-bold mb-1" style="letter-spacing: 0.5px; font-size: 0.7rem;">Nomor Induk Pegawai (NIP)</span>
                                <h6 class="font-weight-bold text-dark mb-0">{{ $guru->nip ?? '-' }}</h6>
                            </div>
                        </div>

                        <!-- Box 3: Mata Pelajaran -->
                        <div class="col-md-6 mb-3">
                            <div class="info-tile" style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 0.875rem; padding: 1rem 1.25rem; height: 100%; transition: all 0.2s ease;">
                                <div style="width: 36px; height: 36px; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; background: #e0f2fe; color: #0284c7;">
                                    <i data-feather="book-open" width="18"></i>
                                </div>
                                <span class="text-muted d-block small text-uppercase font-weight-bold mb-1" style="letter-spacing: 0.5px; font-size: 0.7rem;">Mata Pelajaran Utama</span>
                                <h6 class="font-weight-bold text-dark mb-0">{{ $guru->mapel ?? '-' }}</h6>
                            </div>
                        </div>

                        <!-- Box 4: Ekstrakurikuler -->
                        <div class="col-md-6 mb-3">
                            <div class="info-tile" style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 0.875rem; padding: 1rem 1.25rem; height: 100%; transition: all 0.2s ease;">
                                <div style="width: 36px; height: 36px; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; background: #ecfdf5; color: #059669;">
                                    <i data-feather="activity" width="18"></i>
                                </div>
                                <span class="text-muted d-block small text-uppercase font-weight-bold mb-1" style="letter-spacing: 0.5px; font-size: 0.7rem;">Ekskul yang Diampu</span>
                                <div class="mt-1">
                                    @if(isset($guru->ekstrakurikuler) && $guru->ekstrakurikuler->count() > 0)
                                        @foreach($guru->ekstrakurikuler as $ekskul)
                                            <span class="mr-1 mb-1 d-inline-block" style="background: #ecfdf5; color: #059669; border: 1px solid rgba(16, 185, 129, 0.2); font-weight: 600; padding: 0.45em 0.85em; border-radius: 0.5rem; font-size: 0.8rem;">{{ $ekskul->nama_ekskul }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small font-weight-medium">Tidak mengampu ekstrakurikuler</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Box 5: Tanggal Input -->
                        <div class="col-md-6 mb-3">
                            <div class="info-tile" style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 0.875rem; padding: 1rem 1.25rem; height: 100%; transition: all 0.2s ease;">
                                <div style="width: 36px; height: 36px; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; background: #fef3c7; color: #d97706;">
                                    <i data-feather="calendar" width="18"></i>
                                </div>
                                <span class="text-muted d-block small text-uppercase font-weight-bold mb-1" style="letter-spacing: 0.5px; font-size: 0.7rem;">Tanggal Ditambahkan</span>
                                <span class="font-weight-bold text-dark d-block small">
                                    {{ $guru->created_at ? $guru->created_at->translatedFormat('d F Y - H:i') : '-' }} WIB
                                </span>
                            </div>
                        </div>

                        <!-- Box 6: Tanggal Update -->
                        <div class="col-md-6 mb-3">
                            <div class="info-tile" style="background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 0.875rem; padding: 1rem 1.25rem; height: 100%; transition: all 0.2s ease;">
                                <div style="width: 36px; height: 36px; border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem; background: #f3e8ff; color: #9333ea;">
                                    <i data-feather="clock" width="18"></i>
                                </div>
                                <span class="text-muted d-block small text-uppercase font-weight-bold mb-1" style="letter-spacing: 0.5px; font-size: 0.7rem;">Terakhir Diperbarui</span>
                                <span class="font-weight-bold text-dark d-block small">
                                    {{ $guru->updated_at ? $guru->updated_at->translatedFormat('d F Y - H:i') : '-' }} WIB
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection