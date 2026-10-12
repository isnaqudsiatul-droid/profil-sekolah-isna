@extends('layouts.umum')
@section('title', 'Profil Sekolah - MTs Bahrul Hidayah')
@section('content')

    <style>
        .hover-card {
            transition: all 0.35s ease-in-out;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1) !important;
        }

        .img-zoom-container {
            overflow: hidden;
            border-radius: 25px;
        }

        .img-zoom-container img {
            transition: transform 0.5s ease;
        }

        .hover-card:hover .img-zoom-container img {
            transform: scale(1.05);
        }
    </style>

    <div class="container-fluid biru-header text-center py-5 my-3" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <span class="badge bg-warning text-dark px-3 py-2 mb-3 rounded-pill fw-bold" style="font-size: 0.85rem;">
                <i class="fa-solid fa-school me-1"></i> INFORMASI RESMI MADRASAH
            </span>
            <h1 class="fw-bold display-5 display-md-4 mb-2">Profil Madrasah</h1>
            <p class="lead fs-6 fs-md-5 mb-0">Mengenal lebih dekat sejarah, visi, misi, dan informasi MTs Bahrul Hidayah</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row align-items-center gy-4">
            
            <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="100">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-card">
                    <div class="img-zoom-container" style="height: 380px;">
                        @if($profil && $profil->foto)
                            <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Sekolah" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/admin/images/skl.jpg') }}" alt="Default Sekolah" class="w-100 h-100" style="object-fit: cover;">
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-7 ps-lg-4" data-aos="fade-left" data-aos-delay="100">
                <span class="badge bg-primary text-white px-3 py-1 mb-2 rounded-pill fw-semibold">Tentang Kami</span>
                <h2 class="fw-bold mb-3 text-dark fs-3 fs-md-2">
                    {{ $profil->nama_sekolah ?? 'MTs Bahrul Hidayah' }}
                </h2>

                <div class="d-flex flex-wrap gap-3 mb-3">
                    <span class="badge bg-light text-dark border px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-hashtag text-warning me-1"></i> NPSN: {{ $profil->npsn ?? '20261945' }}
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-calendar-days text-warning me-1"></i> Berdiri: {{ $profil->tahun_berdiri ?? '1978' }}
                    </span>
                </div>

                <p class="text-muted mb-2 small text-md-normal">
                    <i class="fa-solid fa-location-dot text-danger me-2"></i> {{ $profil->alamat ?? 'Alamat belum diatur.' }}
                </p>

                <p class="text-muted mb-4 small text-md-normal">
                    <i class="fa-solid fa-phone text-success me-2"></i> {{ $profil->kontak ?? '-' }}
                    @if(!empty($profil->email))
                        <span class="ms-3"><i class="fa-solid fa-envelope text-primary me-2"></i> {{ $profil->email }}</span>
                    @endif
                </p>

                <div class="mb-3">
                    <h5 class="fw-bold text-dark mb-2">Sejarah & Profil Singkat</h5>
                    <div class="text-secondary small text-md-normal" style="text-align: justify; line-height: 1.7;">
                        {!! $profil->deskripsi ?? 'Belum ada deskripsi.' !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-4 border-top gy-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-4">
                <div class="card p-4 shadow-sm border-0 bg-white rounded-4 text-center h-100 hover-card">
                    <div class="img-zoom-container mx-auto mb-3" style="width: 160px; height: 160px; border-radius: 50%;">
                        @if($profil && $profil->foto_kepala_sekolah)
                            <img src="{{ asset('storage/' . $profil->foto_kepala_sekolah) }}" alt="Kepala Sekolah" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/admin/images/default-user.jpg') }}" alt="Default Kepsek" class="w-100 h-100" style="object-fit: cover;">
                        @endif
                    </div>
                    <h5 class="fw-bold mb-1 text-dark">{{ $profil->nama_kepala_sekolah ?? 'Nama Kepala Sekolah' }}</h5>
                    <p class="text-warning fw-semibold small mb-0">Kepala Madrasah</p>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="p-4 border-0 rounded-4 bg-white shadow-sm hover-card border-start border-primary border-4">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="fa-solid fa-eye me-2"></i>Visi Madrasah
                            </h5>
                            <p class="mb-0 text-secondary" style="line-height: 1.6;">{{ $profil->visi ?? 'Visi belum diatur.' }}</p>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="p-4 border-0 rounded-4 bg-white shadow-sm hover-card border-start border-warning border-4">
                            <h5 class="fw-bold text-dark mb-3">
                                <i class="fa-solid fa-bullseye me-2 text-warning"></i>Misi Madrasah
                            </h5>
                            <div class="text-secondary small text-md-normal" style="line-height: 1.7;">
                                {!! $profil->misi ?? 'Misi belum diatur.' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection