<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $profilSekolah->nama_sekolah ?? 'MTs Bahrul Hidayah' }} | @yield('title', 'Dashboard')</title>

    <link rel="stylesheet" href="{{ asset('assets/admin/fonts/Raleway-Regular.ttf') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 99;
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .user-avatar-img,
        .user-avatar-icon {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        table.dataTable thead th {
            background-color: #f8faee;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
    </style>

    @if (!empty($profilSekolah && $profilSekolah->logo))
        <link rel="shortcut icon" href="{{ asset('storage/' . $profilSekolah->logo) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/mts.png') }}" type="image/x-icon">
    @endif
</head>

<body class="bg-light text-dark">
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active shadow-sm border-right bg-white">
                <div class="sidebar-header text-center p-4">
                    @if (!empty($profilSekolah && $profilSekolah->logo))
                        <img src="{{ asset('storage/' . $profilSekolah->logo) }}" alt="Logo Sekolah"
                            class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center py-2 bg-dark rounded">
                            <i data-feather="image" width="30" class="mb-1 text-secondary"></i>
                            <span class="small text-white" style="font-size: 0.75rem;">Logo Kosong</span>
                        </div>
                    @endif
                </div>
                <div class="sidebar-menu px-3">
                    <ul class="menu list-unstyled">
                        <li class='small font-weight-bold text-uppercase text-muted my-3 px-2'>Main Menu</li>

                        <li class="sidebar-item mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link d-flex align-items-center rounded p-2 text-decoration-none">
                                <i data-feather="grid" width="18" class="mr-2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item mb-1 {{ request()->routeIs('admin.profil.*') || request()->segment(2) == 'profil' ? 'active' : '' }}">
                            <a href="{{ route('admin.profil.index') }}" class="sidebar-link d-flex align-items-center rounded p-2 text-decoration-none">
                                <i data-feather="home" width="18" class="mr-2"></i>
                                <span>Profil Sekolah</span>
                            </a>
                        </li>

                        <li class="sidebar-item mb-1 {{ request()->routeIs('admin.guru.*') || request()->segment(2) == 'guru' ? 'active' : '' }}">
                            <a href="{{ route('admin.guru.index') }}" class="sidebar-link d-flex align-items-center rounded p-2 text-decoration-none">
                                <i data-feather="briefcase" width="18" class="mr-2"></i>
                                <span>Data Guru</span>
                            </a>
                        </li>

                        <li class="sidebar-item mb-1 {{ request()->routeIs('admin.siswa.*') || request()->segment(2) == 'siswa' ? 'active' : '' }}">
                            <a href="{{ route('admin.siswa.index') }}" class="sidebar-link d-flex align-items-center rounded p-2 text-decoration-none">
                                <i data-feather="user-check" width="18" class="mr-2"></i>
                                <span>Data Siswa</span>
                            </a>
                        </li>

                        <li class='small font-weight-bold text-uppercase text-muted my-3 px-2'>Konten & Media</li>

                        <li class="sidebar-item mb-1 {{ request()->routeIs('admin.berita.*') || request()->segment(2) == 'berita' ? 'active' : '' }}">
                            <a href="{{ route('admin.berita.index') }}" class="sidebar-link d-flex align-items-center rounded p-2 text-decoration-none">
                                <i data-feather="file-text" width="18" class="mr-2"></i>
                                <span>Data Berita</span>
                            </a>
                        </li>

                        <li class="sidebar-item mb-1 {{ request()->routeIs('admin.ekskul.*') || request()->segment(2) == 'ekskul' ? 'active' : '' }}">
                            <a href="{{ route('admin.ekskul.index') }}" class="sidebar-link d-flex align-items-center rounded p-2 text-decoration-none">
                                <i data-feather="activity" width="18" class="mr-2"></i>
                                <span>Ekstrakurikuler</span>
                            </a>
                        </li>

                        <li class="sidebar-item mb-1 {{ request()->routeIs('admin.galeri.*') || request()->segment(2) == 'galeri' ? 'active' : '' }}">
                            <a href="{{ route('admin.galeri.index') }}" class="sidebar-link d-flex align-items-center rounded p-2 text-decoration-none">
                                <i data-feather="image" width="18" class="mr-2"></i>
                                <span>Data Galeri</span>
                            </a>
                        </li>

                        @if (Auth::check() && strcasecmp(Auth::user()->role, 'admin') == 0)
                            <li class='small font-weight-bold text-uppercase text-muted my-3 px-2'>Pengaturan</li>
                            <li class="sidebar-item mb-1 {{ request()->routeIs('admin.user.*') || request()->segment(2) == 'user' ? 'active' : '' }}">
                                <a href="{{ route('admin.user.index') }}" class="sidebar-link d-flex align-items-center rounded p-2 text-decoration-none">
                                    <i data-feather="users" width="18" class="mr-2"></i>
                                    <span>Data Pengelola</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        <div id="main" class="d-flex flex-column min-vh-100">
            <nav class="navbar navbar-header navbar-expand navbar-light sticky-header bg-white border-bottom px-4 py-2">
                <a class="sidebar-toggler mr-3 text-dark" href="#"><span class="navbar-toggler-icon"></span></a>

                <button class="btn navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user d-flex align-items-center text-decoration-none">
                                @if (Auth::check() && Auth::user()->foto)
                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil"
                                        class="user-avatar-img rounded-circle shadow-sm mr-2">
                                @else
                                    <div class="user-avatar-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow-sm mr-2">
                                        <i data-feather="user" width="20" height="20"></i>
                                    </div>
                                @endif

                                <div class="d-none d-md-block text-left">
                                    <div class="font-weight-bold text-dark" style="line-height: 1.2;">
                                        {{ Auth::user()->name }}</div>
                                    <small class="text-muted"
                                        style="font-size: 0.75rem;">{{ ucfirst(Auth::user()->role) }}</small>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 rounded p-2">
                                <a class="dropdown-item d-flex align-items-center rounded py-2 px-3 text-dark"
                                    href="{{ route('admin.akun.index') }}">
                                    <i data-feather="user" class="mr-2" width="16"></i> Profil Akun
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item d-flex align-items-center rounded py-2 px-3 text-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit(); return confirm('Apakah Anda yakin ingin keluar?')">
                                    <i data-feather="log-out" class="mr-2" width="16"></i> Keluar
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content-wrapper p-4 flex-grow-1">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4 rounded"
                            role="alert">
                            <div class="d-flex align-items-center">
                                <i data-feather="check-circle" class="mr-2" width="18"></i>
                                <span class="font-weight-medium">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show mb-4 rounded"
                            role="alert">
                            <div class="d-flex align-items-center">
                                <i data-feather="alert-circle" class="mr-2" width="18"></i>
                                <span class="font-weight-medium">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <script>
                        setTimeout(() => {
                            document.querySelector('.alert')?.remove();
                        }, 3000);
                    </script>
                </div>

                @yield('content')
            </main>

            <footer class="bg-white border-top py-3 px-4">
                <div class="footer clearfix text-muted d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 small">&copy; {{ date('Y') }} SMK SEJAHTERA. All rights reserved.</p>
                    </div>
                    <div>
                        <p class="mb-0 small">Crafted with <span class='text-danger'><i data-feather="heart"
                                    width="14"></i></span>
                            by <a href="#" class="font-weight-bold text-primary text-decoration-none">Isna Qudsiatul Aulia</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('DataTables/jquery-4.0.0.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    <script src="{{ asset('assets/admin/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>

    <script src="{{ asset('DataTables/datatables.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
    @stack('scripts')
</body>

</html>