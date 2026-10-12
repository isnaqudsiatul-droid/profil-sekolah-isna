@extends('layouts.admin')

@section('title', 'Detail Siswa')

@section('content')
    <style>
        /* Hanya menyisakan selector untuk pseudo-class dan hover */
        .detail-item:last-child {
            border-bottom: none;
        }
        .btn-purple-pill:hover {
            background-color: #4338ca;
            color: #ffffff;
            transform: translateY(-1px);
        }
        .btn-light-pill:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            border-color: #94a3b8;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">

            <!-- Header Tanpa Background Dark -->
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                <div>
                    <h3 class="font-weight-bold text-dark mb-1">Detail Data Siswa</h3>
                    <p class="text-muted small mb-0">Informasi lengkap mengenai siswa yang terdaftar.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.siswa.index') }}" 
                       class="btn btn-light-pill mr-2 d-inline-flex align-items-center" 
                       style="background-color: #ffffff; color: #475569; border: 1px solid #cbd5e1; border-radius: 2rem; padding: 0.6rem 1.4rem; font-weight: 600; font-size: 0.875rem; transition: all 0.2s ease; text-decoration: none !important;">
                        <i data-feather="arrow-left" width="16" class="mr-1.5"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Card Detail Container -->
            <div class="card p-4 mb-4" style="background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.03);">
                <div class="border-bottom pb-3 mb-2">
                    <h5 class="font-weight-bold text-dark mb-0">Informasi Pribadi Siswa</h5>
                </div>

                <div class="row">
                    <!-- NISN -->
                    <div class="col-md-6">
                        <div class="detail-item" style="padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
                            <div class="detail-label mb-1" style="color: #64748b; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">NISN</div>
                            <div class="detail-value" style="color: #0f172a; font-size: 0.9375rem; font-weight: 600;">{{ $siswa->nisn ?? '-' }}</div>
                        </div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="col-md-6">
                        <div class="detail-item" style="padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
                            <div class="detail-label mb-1" style="color: #64748b; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">Nama Lengkap</div>
                            <div class="detail-value text-capitalize" style="color: #0f172a; font-size: 0.9375rem; font-weight: 600;">{{ $siswa->nama_siswa }}</div>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-md-6">
                        <div class="detail-item" style="padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
                            <div class="detail-label mb-1" style="color: #64748b; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">Jenis Kelamin</div>
                            <div class="detail-value" style="color: #0f172a; font-size: 0.9375rem; font-weight: 600;">
                                <span class="badge-soft-info d-inline-block" style="background-color: #e0f2fe; color: #0284c7; padding: 0.35rem 0.85rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600;">
                                    {{ $siswa->jenis_kelamin }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Tahun Masuk -->
                    <div class="col-md-6">
                        <div class="detail-item" style="padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
                            <div class="detail-label mb-1" style="color: #64748b; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">Tahun Masuk</div>
                            <div class="detail-value" style="color: #0f172a; font-size: 0.9375rem; font-weight: 600;">
                                <span class="badge-soft-primary d-inline-block" style="background-color: #e0e7ff; color: #4f46e5; padding: 0.35rem 0.85rem; border-radius: 2rem; font-size: 0.8125rem; font-weight: 600;">
                                    {{ $siswa->tahun_masuk ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Didaftarkan Pada -->
                    <div class="col-md-6">
                        <div class="detail-item" style="padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
                            <div class="detail-label mb-1" style="color: #64748b; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">Didaftarkan Pada</div>
                            <div class="detail-value text-muted font-weight-normal" style="color: #0f172a; font-size: 0.9375rem; font-weight: 600;">
                                {{ $siswa->created_at ? $siswa->created_at->format('d F Y H:i') : '-' }}
                            </div>
                        </div>
                    </div>

                    <!-- Terakhir Diperbarui -->
                    <div class="col-md-6">
                        <div class="detail-item" style="padding: 1rem 0; border-bottom: 1px solid #f1f5f9;">
                            <div class="detail-label mb-1" style="color: #64748b; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700;">Terakhir Diperbarui</div>
                            <div class="detail-value text-muted font-weight-normal" style="color: #0f172a; font-size: 0.9375rem; font-weight: 600;">
                                {{ $siswa->updated_at ? $siswa->updated_at->format('d F Y H:i') : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection