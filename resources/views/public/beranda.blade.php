@extends('layouts.umum')
@section('title', 'Beranda - MTs Bahrul Hidayah')
@section('content')
    <style>
        /* Agar animasi scroll terasa halus */
        html {
            scroll-behavior: smooth;
        }

        .biru {
            background-color: #123F66;
        }

        .hero-section {
            background: linear-gradient(rgba(18, 63, 102, 0.88), rgba(71, 162, 242, 0.88)),
                url('{{ $profilSekolah && $profilSekolah->foto ? asset('storage/' . $profilSekolah->foto) : asset('assets/admin/images/skl.jpg') }}') no-repeat center center;
            background-size: cover;
            width: 100vw;
            height: 100vh;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        @media (max-width: 768px) {
            .hero-section {
                height: auto !important;
                padding-top: 60px;
                padding-bottom: 60px;
            }
        }

        .stats-container {
            background: linear-gradient(135deg, #123F66 0%, #1f5f94 100%);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
        }

        .stats-item {
            padding: 25px 15px;
            color: white;
            position: relative;
            transition: all 0.3s ease;
        }

        @media (min-width: 768px) {
            .stats-item:not(:last-child) {
                clip-path: polygon(0 0, 88% 0, 100% 100%, 0% 100%);
            }

            .stats-item:not(:first-child) {
                clip-path: polygon(12% 0, 100% 0, 100% 100%, 0% 100%);
                margin-left: -5px;
            }
        }

        .stats-item:hover {
            background-color: rgba(255, 255, 255, 0.08);
            transform: translateY(-3px);
        }

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

    <!-- HERO SECTION -->
    <div id="beranda-profil"
        class="container-fluid py-5 my-n4 text-white position-relative d-flex align-items-center hero-section">
        <div class="container py-4 w-100">
            <div class="row">
                <div class="col-lg-8 col-md-10" data-aos="fade-up" data-aos-delay="100">
                    <span class="badge bg-warning text-dark px-3 py-2 mb-3 rounded-pill fw-bold" style="font-size: 0.85rem;">
                        <i class="fa-solid fa-school me-1"></i> WEBSITE RESMI SEKOLAH
                    </span>

                    <span class="badge bg-warning text-dark px-3 py-2 mb-3 rounded-pill fw-bold d-inline-block"
                        style="font-size: 0.85rem;">
                        NPSN: {{ $profilSekolah->npsn ?? '20261945' }} | Berdiri Sejak
                        {{ $profilSekolah->tahun_berdiri ?? '1978' }}
                    </span>
                    <h2 class="fw-bold mb-3 display-6 display-md-5">
                        {{ $profilSekolah->nama_sekolah ?? 'MTs Bahrul Hidayah' }}
                    </h2>
                    <p class="lead mb-4 fs-6 fs-md-5">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        {{ $profilSekolah->alamat ?? 'Jl. Pendidikan Vokasi No. 45' }}
                    </p>

                    <div class="d-flex flex-wrap gap-3 pt-2">
                        <a href="{{ route('public.profil') }}"
                            class="btn btn-warning px-4 py-2 fw-bold rounded-pill shadow-sm">
                            Profil Sekolah
                        </a>
                        <a href="{{ route('public.berita.index') }}"
                            class="btn btn-outline-light px-4 py-2 rounded-pill fw-semibold">
                            Lihat Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KOTAK STATISTIK DINAMIS -->
    <div class="container position-relative px-3 px-md-0" style="margin-top: -40px; z-index: 10;" data-aos="fade-up"
        data-aos-delay="150">
        <div class="row g-0 stats-container text-center">
            <div class="col-6 col-md stats-item border-bottom border-md-0 border-secondary">
                <h2 class="fw-bold display-6 mb-1 text-warning">{{ $totalSiswa ?? 0 }}</h2>
                <p class="mb-0 text-white-50 fw-semibold small text-uppercase">Siswa Aktif</p>
            </div>
            <div class="col-6 col-md stats-item">
                <h2 class="fw-bold display-6 mb-1 text-warning">{{ $totalGuru ?? 0 }}</h2>
                <p class="mb-0 text-white-50 fw-semibold small text-uppercase">Guru & Staf</p>
            </div>
            <div class="col-6 col-md stats-item">
                <h2 class="fw-bold display-6 mb-1 text-warning">{{ $totalEkskul ?? 0 }}</h2>
                <p class="mb-0 text-white-50 fw-semibold small text-uppercase">Ekstrakurikuler</p>
            </div>
            <div class="col-6 col-md stats-item">
                <h2 class="fw-bold display-6 mb-1 text-warning">{{ $totalBerita ?? 0 }}</h2>
                <p class="mb-0 text-white-50 fw-semibold small text-uppercase">Berita</p>
            </div>
            <div class="col-6 col-md stats-item">
                <h2 class="fw-bold display-6 mb-1 text-warning">{{ $totalGaleri ?? 0 }}</h2>
                <p class="mb-0 text-white-50 fw-semibold small text-uppercase">Galeri</p>
            </div>
        </div>
    </div>

    <div class="container py-5 my-4">
        <div class="row align-items-center gy-4">
            <div class="col-lg-5 col-md-6 text-center" data-aos="fade-right" data-aos-delay="100">
                <div class="position-relative d-inline-block shadow-lg rounded-4 overflow-hidden w-100 hover-card">
                    @if ($profilSekolah && !empty($profilSekolah->foto_kepala_sekolah))
                        <img src="{{ asset('storage/' . $profilSekolah->foto_kepala_sekolah) }}" alt="Foto Kepala Sekolah"
                            class="w-100 img-fluid img-zoom-container" style="height: 400px; object-fit: cover;">
                    @else
                        <img src="{{ asset('assets/admin/images/default-user.jpg') }}" alt="Default Kepsek"
                            class="w-100 img-fluid img-zoom-container" style="height: 400px; object-fit: cover;">
                    @endif
                    <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                        style="background: linear-gradient(to top, rgba(18, 63, 102, 0.9), transparent);">
                        <h5 class="fw-bold mb-0 fs-6 fs-md-5">
                            {{ $profilSekolah->nama_kepala_sekolah ?? 'Kepala Madrasah' }}</h5>
                        <small class="text-warning">Kepala MTs Bahrul Hidayah</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-6 ps-lg-4" data-aos="fade-left" data-aos-delay="100">
                <span class="badge bg-primary text-white px-3 py-1 mb-2 rounded-pill fw-semibold">Sambutan Pimpinan</span>
                <h2 class="fw-bold mb-3 text-dark fs-3 fs-md-2">Sambutan Kepala Madrasah</h2>
                <p class="text-muted fst-italic">Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
                <p class="text-secondary small text-md-normal">Puji syukur kita panjatkan ke hadirat Allah SWT, karena atas
                    rahmat dan karunia-Nya website resmi MTs Bahrul Hidayah dapat hadir sebagai sarana informasi dan
                    transparansi pendidikan madrasah.</p>
                <p class="text-secondary small text-md-normal">Kami berkomitmen untuk terus mencetak generasi yang cerdas,
                    religius, berkarakter luhur, serta mampu bersaing di era digital melalui pembelajaran yang berkualitas.
                </p>
                <div class="mt-4">
                    <a href="{{ route('public.profil') }}"
                        class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-semibold w-100 w-md-auto text-center">
                        <i class="fa-solid fa-arrow-right me-2"></i> Lihat Selengkapnya Profil Sekolah
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- BERITA TERBARU -->
    <div id="berita" class="biru py-5 mt-4" data-aos="fade-up" data-aos-delay="100"
        style="width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw;">
        <div class="container px-4 px-md-3">
            <div class="row mb-4">
                <div
                    class="border-bottom border-secondary pb-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                    <h3 class="font-weight-bold m-0 text-white fs-4 fs-md-3">
                        <i class="fa-solid fa-newspaper text-warning me-2"></i>Berita & Informasi Terbaru
                    </h3>
                    <a href="{{ route('public.berita.index') }}"
                        class="text-warning text-decoration-none small fw-semibold">Lihat Semua <i
                            class="fa-solid fa-chevron-right ms-1"></i></a>
                </div>
            </div>
            <div class="row">
                @if (isset($berita) && count($berita) > 0)
                    @foreach ($berita as $item)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-0 h-100 shadow rounded-4 overflow-hidden bg-white hover-card">
                                <div class="img-zoom-container"
                                    style="position: relative; height: 200px; background: #0f172a;">
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
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title font-weight-bold mb-2 text-dark fs-5"
                                            style="font-size: 1.1rem;">
                                            {{ $item->judul }}</h5>
                                        <p class="card-text small mb-3 text-muted">
                                            {{ Str::limit(strip_tags($item->isi), 80) }}</p>
                                    </div>
                                    <a href="{{ route('public.berita.show', $item->slug) }}"
                                        class="btn btn-sm btn-outline-dark rounded-pill px-3 align-self-start">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-4">
                        <p class="text-white">Belum ada berita terbaru.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- EKSTRAKURIKULER -->
    <div id="ekskul" class="py-5 my-4" data-aos="fade-up" data-aos-delay="100">
        <div class="container">
            <div class="row mb-4">
                <div
                    class="border-bottom pb-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                    <h3 class="font-weight-bold m-0 text-dark fs-4 fs-md-3">
                        <i class="fa-solid fa-chart-line text-warning me-2"></i>Ekstrakurikuler Pilihan
                    </h3>
                    <a href="{{ route('public.ekskul.index') }}"
                        class="text-primary text-decoration-none small fw-semibold">Lihat Semua <i
                            class="fa-solid fa-chevron-right ms-1"></i></a>
                </div>
            </div>
            <div class="row">
                @if (isset($ekskul) && count($ekskul) > 0)
                    @foreach ($ekskul as $item)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-0 h-100 shadow-sm rounded-4 overflow-hidden border hover-card">
                                <div class="img-zoom-container" style="position: relative; height: 200px;">
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
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title font-weight-bold mb-2 text-dark fs-5">
                                            {{ $item->nama_ekskul }}</h5>
                                        <p class="card-text small mb-3 text-muted">
                                            <i class="fa-regular fa-calendar-days me-1"></i> Jadwal:
                                            {{ $item->jadwal_latihan ?? 'Menyesuaikan' }}
                                        </p>
                                    </div>
                                    <a href="{{ route('public.ekskul.show', $item->slug) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-3 align-self-start">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">Belum ada data ekstrakurikuler.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- GURU & STAF -->
    <div id="guru" class="biru py-5" data-aos="fade-up" data-aos-delay="100"
        style="width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw;">
        <div class="container px-4 px-md-3">
            <div class="row mb-4">
                <div
                    class="border-bottom border-secondary pb-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                    <h3 class="font-weight-bold m-0 text-white fs-4 fs-md-3">
                        <i class="fa-solid fa-chalkboard-user text-warning me-2"></i>Tenaga Pendidik & Kependidikan
                    </h3>
                    <a href="{{ route('public.guru.index') }}"
                        class="text-warning text-decoration-none small fw-semibold">Lihat Semua <i
                            class="fa-solid fa-chevron-right ms-1"></i></a>
                </div>
            </div>
            <div class="row">
                @if (isset($guru) && count($guru) > 0)
                    @foreach ($guru as $item)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100 overflow-hidden rounded-4 bg-white hover-card">
                                <div class="w-100 img-zoom-container" style="height: 250px;">
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                            alt="Foto {{ $item->nama ?? $item->nama_guru }}" class="w-100 h-100"
                                            style="object-fit: cover;">
                                    @else
                                        <div
                                            class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-user text-white" style="font-size: 60px;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body py-3 text-center">
                                    <h5 class="card-title fw-bold mb-1 text-dark" style="font-size: 1rem;">
                                        {{ $item->nama ?? $item->nama_guru }}
                                    </h5>
                                    <p class="card-text mb-0 text-muted small">
                                        {{ $item->mapel ?? 'Pengajar' }}
                                    </p>
                                </div>
                                <div class="p-3">
                                    <a href="{{ route('public.guru.show', $item->slug) }}"
                                        class="align-self-start btn btn-sm btn-outline-dark rounded-pill px-4">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-4">
                        <p class="text-white">Belum ada data guru.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- GALERI -->
    <div id="galeri" class="py-5 my-4" data-aos="fade-up" data-aos-delay="100">
        <div class="container">
            <div class="row mb-4">
                <div
                    class="border-bottom pb-2 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                    <h3 class="font-weight-bold m-0 text-dark fs-4 fs-md-3">
                        <i class="fa-solid fa-images text-warning me-2"></i>Galeri Kegiatan Madrasah
                    </h3>
                    <a href="{{ route('public.galeri.index') }}"
                        class="text-primary text-decoration-none small fw-semibold">Lihat Semua <i
                            class="fa-solid fa-chevron-right ms-1"></i></a>
                </div>
            </div>
            <div class="row">
                @if (isset($galeri) && count($galeri) > 0)
                    @foreach ($galeri as $item)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-0 h-100 shadow-sm rounded-4 overflow-hidden border hover-card">
                                <div class="img-zoom-container bg-dark" style="position: relative; height: 200px;">
                                    @if (!empty($item->link_video))
                                        <iframe src="{{ $item->link_video }}" class="w-100 h-100 border-0"
                                            allowfullscreen></iframe>
                                    @elseif (!empty($item->file) && (str_ends_with($item->file, '.mp4') || str_ends_with($item->file, '.mov')))
                                        <video class="w-100 h-100" style="object-fit: cover;" controls>
                                            <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                        </video>
                                    @elseif (!empty($item->file) && file_exists(public_path('storage/' . $item->file)))
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
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <h5 class="card-title font-weight-bold m-0 mb-3 text-dark" style="font-size: 1rem;">
                                        {{ $item->judul }}
                                    </h5>
                                    <a href="{{ route('public.galeri.show', $item->slug) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-3 align-self-start">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">Belum ada data galeri.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
