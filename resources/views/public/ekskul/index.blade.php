@extends('layouts.umum')
@section('title', 'Ekstrakurikuler - MTs Bahrul Hidayah')
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
            <span class="badge bg-warning text-dark px-3 py-2 mb-3 rounded-pill fw-bold" style="font-size: 13px;">
                <i class="fa-solid fa-chart-line me-1"></i> PENGEMBANGAN DIRI
            </span>
            <h1 class="fw-bold display-5 display-md-4 mb-2">Ekstrakurikuler</h1>
            <p class="fs-6 fs-md-5 mb-0">Data Ekstrakurikuler dan kegiatan siswa di MTs Bahrul Hidayah</p>
        </div>
    </div>

    <div class="container pb-5" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            @if(isset($ekskul) && count($ekskul) > 0)
                @foreach ($ekskul as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card border-0 h-100 shadow rounded-4 overflow-hidden hover-card d-flex flex-column justify-content-between">
                            <div>
                                <div style="position: relative; height: 200px;">
                                    @if (!empty($item->gambar))
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                            alt="Foto {{ $item->nama_ekskul }}"
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
                                    <h5 class="card-title font-weight-bold mb-2 fs-5">{{ $item->nama_ekskul }}</h5>
                                    <p class="card-text small mb-0">
                                        <i class="fa-regular fa-calendar-days me-1"></i> Jadwal: {{ $item->jadwal_latihan ?? 'Menyesuaikan' }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 p-4 pt-0">
                                <a href="{{ route('public.ekskul.show', $item->slug) }}"
                                    class="btn btn-sm btn-outline-dark rounded-pill px-3">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border shadow-sm p-4 d-inline-block rounded-4">
                        <i class="fa-solid fa-triangle-exclamation text-warning fa-2x mb-2"></i>
                        <h5 class="fw-bold text-muted">Belum ada data ekstrakurikuler.</h5>
                        <p class="text-muted small mb-0">Silakan tambahkan data ekstrakurikuler melalui halaman admin.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection