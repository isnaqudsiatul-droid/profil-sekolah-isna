@extends('layouts.umum')
@section('title', 'Berita & Artikel - MTs Bahrul Hidayah')
@section('content')

    <style>
        .hover-card {
            transition: 0.3s;
        }

        .hover-card:hover {
            transform: translateY(-8px);
        }
    </style>

    <div class="container-fluid text-center py-5 my-3" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <span class="badge bg-warning text-dark px-3 py-2 mb-3 rounded-pill fw-bold" style="font-size: 0.85rem;">
                <i class="fa-solid fa-newspaper me-1"></i> INFORMASI & KEGIATAN
            </span>
            <h1 class="fw-bold display-5 display-md-4 mb-2">Berita & Artikel</h1>
            <p class="lead text-white-50 fs-6 fs-md-5 mb-0">Berita menarik dan informasi terbaru seputar kegiatan di MTs Bahrul Hidayah</p>
        </div>
    </div>

    <div class="container pb-5" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            @if(isset($berita) && count($berita) > 0)
                @foreach ($berita as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card bg-white border-0 h-100 shadow rounded-4 overflow-hidden hover-card d-flex flex-column justify-content-between">
                            <div>
                                <div style="position: relative; height: 200px; background: #0f172a;">
                                    @if (!empty($item->gambar))
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Foto {{ $item->judul }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                                            style="background: #1e293b;">
                                            <i data-feather="image" width="40" class="mb-2 text-secondary"></i>
                                            <span class="small text-white">Tidak ada gambar</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="card-title font-weight-bold mb-2 text-dark" style="font-size: 1.1rem;">
                                        {{ $item->judul }}
                                    </h5>
                                    <p class="card-text small text-muted mb-0">
                                        {{ Str::limit(strip_tags($item->isi), 80) }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 p-4 pt-0">
                                <a href="{{ route('public.berita.show', $item->slug) }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border shadow-sm p-4 d-inline-block rounded-4">
                        <i class="fa-solid fa-triangle-exclamation text-warning fa-2x mb-2"></i>
                        <h5 class="fw-bold text-muted">Belum ada berita yang diterbitkan.</h5>
                        <p class="text-muted small mb-0">Silakan tambahkan data berita melalui halaman admin.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection