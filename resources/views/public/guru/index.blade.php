@extends('layouts.umum')
@section('title', 'Daftar Guru - MTs Bahrul Hidayah')
@section('content')

    <style>
        /*Efek Hover & Transisi Kartu Modern */
        .hover-card {
            transition: all 0.35s ease-in-out;
        }

        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.12) !important;
        }

        .img-zoom-container {
            overflow: hidden;
        }

        .img-zoom-container img {
            transition: transform 0.5s ease;
        }

        .hover-card:hover .img-zoom-container img {
            transform: scale(1.08);
        }
    </style>

    <!-- HEADER / BANNER DAFTAR GURU -->
    <div class="container-fluid biru-header text-center py-5 my-3" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <span class="badge bg-warning text-dark px-3 py-2 mb-3 rounded-pill fw-bold" style="font-size: 0.85rem;">
                <i class="fa-solid fa-chalkboard-user me-1"></i> TENAGA PENDIDIK
            </span>
            <h1 class="fw-bold display-5 display-md-4 mb-2">Dewan Guru & Staf</h1>
            <p class="lead fs-6 fs-md-5 mb-0">Tenaga pendidik profesional dan berdedikasi tinggi di MTs Bahrul Hidayah</p>
        </div>
    </div>

    <!-- KONTEN DAFTAR GURU -->
    <div class="container pb-5" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            @if(isset($guru) && count($guru) > 0)
                @foreach ($guru as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card border-0 shadow-sm h-100 text-center overflow-hidden rounded-4 bg-white hover-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="w-100 img-zoom-container" style="height: 280px;">
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                            alt="Foto {{ $item->nama ?? $item->nama_guru }}" class="w-100 h-100"
                                            style="object-fit: cover;">
                                    @else
                                        <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user text-white" style="font-size: 60px;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body py-3">
                                    <h5 class="card-title fw-bold mb-1 text-dark" style="font-size: 1.1rem;">
                                        {{ $item->nama ?? $item->nama_guru }}
                                    </h5>
                                    <p class="card-text text-muted small mb-0">
                                        {{ $item->mapel ?? 'Pengajar' }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 pb-3 pt-0">
                                <a href="{{ route('public.guru.show', $item->slug) }}" class="btn btn-sm btn-outline-dark rounded-pill px-4">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border shadow-sm p-4 d-inline-block rounded-4">
                        <i class="fa-solid fa-triangle-exclamation text-warning fa-2x mb-2"></i>
                        <h5 class="fw-bold text-muted">Belum ada data guru yang ditambahkan.</h5>
                        <p class="text-muted small mb-0">Silakan tambahkan data guru melalui halaman admin.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection