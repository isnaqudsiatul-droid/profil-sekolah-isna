@extends('layouts.umum')
@section('title', 'Galeri Kegiatan - MTs Bahrul Hidayah')
@section('content')

    <style>
        .hover-card {
            transition: all 0.35s ease-in-out;
        }

        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.2) !important;
        }

        .img-zoom-container {
            overflow: hidden;
        }

        .img-zoom-container img, 
        .img-zoom-container video {
            transition: transform 0.5s ease;
        }

        .hover-card:hover .img-zoom-container img {
            transform: scale(1.08);
        }
    </style>

    <div class="container-fluid biru-header text-center py-5 my-3" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <span class="badge bg-warning text-dark px-3 py-2 mb-3 rounded-pill fw-bold" style="font-size: 0.85rem;">
                <i class="fa-solid fa-images me-1"></i> DOKUMENTASI MADRASAH
            </span>
            <h1 class="fw-bold display-5 display-md-4 mb-2">Galeri Kegiatan</h1>
            <p class="lead fs-6 fs-md-5 mb-0">Dokumentasi foto dan galeri kegiatan di MTs Bahrul Hidayah</p>
        </div>
    </div>

    <div class="container pb-5" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            @if(isset($galeri) && count($galeri) > 0)
                @foreach ($galeri as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card border-0 h-100 shadow rounded-4 overflow-hidden hover-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="img-zoom-container bg-dark" style="position: relative; height: 200px;">
                                    @if (!empty($item->link_video))
                                        <!-- Tampilkan Video YouTube Embed -->
                                        <iframe src="{{ $item->link_video }}" class="w-100 h-100 border-0" allowfullscreen></iframe>
                                    @elseif (!empty($item->file) && (str_ends_with($item->file, '.mp4') || str_ends_with($item->file, '.mov')))
                                        <!-- Tampilkan File Video Lokal -->
                                        <video class="w-100 h-100" style="object-fit: cover;" controls>
                                            <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                        </video>
                                    @elseif (!empty($item->file) && file_exists(public_path('storage/' . $item->file)))
                                        <!-- Tampilkan Foto -->
                                        <img src="{{ asset('storage/' . $item->file) }}" alt="Foto {{ $item->judul }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                                            style="background: #1e293b;">
                                            <i data-feather="image" width="40" class="mb-2 text-secondary"></i>
                                            <span class="small text-white">Tidak ada media</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title font-weight-bold m-0 fs-5" style="font-size: 1rem;">
                                        {{ $item->judul }}
                                    </h5>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                                <a href="{{ route('public.galeri.show', $item->slug) }}"
                                    class="btn btn-sm btn-outline-dark rounded-pill px-3">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border shadow-sm p-4 d-inline-block rounded-4">
                        <i class="fa-solid fa-triangle-exclamation text-warning fa-2x mb-2"></i>
                        <h5 class="fw-bold text-muted">Belum ada data galeri.</h5>
                        <p class="text-muted small mb-0">Silakan tambahkan data galeri melalui halaman admin.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection