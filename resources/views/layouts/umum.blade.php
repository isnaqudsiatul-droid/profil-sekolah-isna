<!DOCTYPE html>
<html lang="id" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/aos/aos.css') }}">

    <title>{{ $profilSekolah->nama_sekolah ?? 'MTs Bahrul Hidayah' }} | @yield('title', 'Dashboard')</title>

    <style>
        .navbar {
            background-color: #123F66;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #123F66;
        }

        .nav-link {
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffc107 !important;
        }

        /* Styling logo & brand agar sejajar rapi di semua layar */
        .brand-logo-container img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Hover efek pada link footer */
        .footer a.nav-link {
            padding-left: 0;
            padding-right: 0;
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .footer a.nav-link:hover {
            color: #ffc107 !important;
            background-color: transparent !important;
            padding-left: 5px;
        }
    </style>

    @if ($profilSekolah && $profilSekolah->logo)
        <link rel="shortcut icon" href="{{ asset('storage/' . $profilSekolah->logo) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/mts.png') }}" type="image/x-icon">
    @endif
</head>

<body class="d-flex flex-column min-vh-100 overflow-x-hidden bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-white"
                href="{{ route('public.beranda') }}">
                <div class="brand-logo-container">
                    @if (!empty($profilSekolah->logo))
                        <img src="{{ asset('storage/' . $profilSekolah->logo) }}" alt="Logo Sekolah"
                            class="border border-white border-2">
                    @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-secondary text-white"
                            style="width: 45px; height: 45px;">
                            <i class="fa-solid fa-school"></i>
                        </div>
                    @endif
                </div>
                <span class="fs-5 text-truncate"
                    style="max-width: 220px;">{{ $profilSekolah->nama_sekolah ?? 'MTs Bahrul Hidayah' }}</span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ms-auto gap-1 gap-lg-2 mt-3 mt-lg-0 text-center text-lg-start">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ request()->routeIs('public.beranda') ? 'active text-warning fw-bold' : 'text-white' }}"
                            href="{{ route('public.beranda') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ request()->routeIs('public.profil') ? 'active text-warning fw-bold' : 'text-white' }}"
                            href="{{ route('public.profil') }}">
                            Profil Sekolah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ request()->routeIs('public.guru.*') || request()->segment(2) == 'guru' ? 'active text-warning fw-bold' : 'text-white' }}"
                            href="{{ route('public.guru.index') }}">
                            Guru
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ request()->routeIs('public.berita.*') || request()->segment(2) == 'berita' ? 'active text-warning fw-bold' : 'text-white' }}"
                            href="{{ route('public.berita.index') }}">
                            Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ request()->routeIs('public.ekskul.*') || request()->segment(2) == 'ekskul' ? 'active text-warning fw-bold' : 'text-white' }}"
                            href="{{ route('public.ekskul.index') }}">
                            Ekstrakurikuler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ request()->routeIs('public.galeri.*') || request()->segment(2) == 'galeri' ? 'active text-warning fw-bold' : 'text-white' }}"
                            href="{{ route('public.galeri.index') }}">
                            Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ request()->routeIs('login.*') ? 'active text-warning fw-bold' : 'text-white' }}"
                            href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ request()->routeIs('public.ujikom')  ? 'active text-warning fw-bold' : 'text-white' }}"
                            href="{{ route('public.ujikom') }}">
                            Ujikom
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <main class="content-wrapper flex-grow-1" style="margin-top: 76px;">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer text-white pt-5 pb-3 mt-auto shadow-lg">
        <div class="container">
            <div class="row g-4">

                <!-- Kolom 1: Profil Singkat -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        @if (!empty($profilSekolah->logo))
                            <img src="{{ asset('storage/' . $profilSekolah->logo) }}" alt="Logo"
                                class="rounded-circle border border-white border-2"
                                style="width: 40px; height: 40px; object-fit: cover;">
                        @endif
                        <h5 class="fw-bold mb-0 text-white">{{ $profilSekolah->nama_sekolah ?? 'MTs Bahrul Hidayah' }}
                        </h5>
                    </div>
                    <p class="text-white-50 small mb-3" style="text-align: justify; line-height: 1.6;">
                        {!! Str::limit(strip_tags($profilSekolah->deskripsi ?? 'Belum ada deskripsi.'), 140) !!}
                    </p>
                    <a href="{{ route('public.profil') }}"
                        class="btn btn-warning btn-sm text-dark fw-bold px-3 py-2 rounded-pill shadow-sm">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <!-- Kolom 2: Navigasi Halaman -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-3 border-bottom border-secondary pb-2">Navigasi Halaman</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="{{ url('/#beranda-profil') }}" class="nav-link small">Beranda</a></li>
                                <li><a href="{{ url('/#beranda-profil') }}" class="nav-link small">Profil Sekolah</a></li>
                                <li><a href="{{ url('/#guru') }}" class="nav-link small">Guru & Staf</a></li>
                                <li><a href="{{ url('/#berita') }}" class="nav-link small">Berita</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="{{ url('/#ekskul') }}" class="nav-link small">Ekstrakurikuler</a></li>
                                <li><a href="{{ url('/#galeri') }}" class="nav-link small">Galeri</a></li>
                                <li><a href="{{ route('login') }}" class="nav-link small">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Kolom 3: Kontak & Media Sosial -->
                <div class="col-lg-4 col-md-12">
                    <h5 class="fw-bold mb-3 border-bottom border-secondary pb-2">Kontak & Informasi</h5>
                    <ul class="list-unstyled mb-3 small text-white-50">
                        <li class="mb-2">
                            <a href="https://wa.me/{{ $profilSekolah?->kontak }}" target="_blank"
                                class="nav-link d-inline text-white-50">
                                <i class="fa-brands fa-whatsapp text-success me-2 fs-5"></i>
                                {{ $profilSekolah?->kontak ?? '-' }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="fa-solid fa-location-dot text-danger me-2 fs-5"></i>
                            <span>{{ $profilSekolah->alamat ?? 'Jl. Pendidikan Vokasi No. 45' }}</span>
                        </li>
                    </ul>

                    <h6 class="fw-bold mb-2 text-white small">Media Sosial</h6>
                    <div class="d-flex gap-3 fs-5">
                        @if ($profilSekolah)
                            @if ($profilSekolah->tiktok)
                                <a href="{{ $profilSekolah->tiktok }}" target="_blank"
                                    class="text-white transition-hover" aria-label="TikTok"><i
                                        class="fa-brands fa-tiktok"></i></a>
                            @endif
                            @if ($profilSekolah->instagram)
                                <a href="{{ $profilSekolah->instagram }}" target="_blank"
                                    class="text-white transition-hover" aria-label="Instagram"><i
                                        class="fa-brands fa-instagram"></i></a>
                            @endif
                            @if ($profilSekolah->facebook)
                                <a href="{{ $profilSekolah->facebook }}" target="_blank"
                                    class="text-white transition-hover" aria-label="Facebook"><i
                                        class="fa-brands fa-facebook"></i></a>
                            @endif
                            @if ($profilSekolah->youtube)
                                <a href="{{ $profilSekolah->youtube }}" target="_blank"
                                    class="text-white transition-hover" aria-label="YouTube"><i
                                        class="fa-brands fa-youtube"></i></a>
                            @endif
                        @endif
                    </div>
                </div>

            </div>

            <hr class="border-secondary my-4">

            <div class="text-center text-white-50 small">
                &copy; {{ date('Y') }}
                <strong>{{ $profilSekolah->nama_sekolah ?? 'MTs Bahrul Hidayah' }}</strong>. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <!-- SCRIPT JS -->
    <script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/aos/aos.js') }}"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>
</body>

</html>
