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
        :root {
            --primary-color: #435ebe;
            --primary-hover: #394eea;
            --bg-light: #f2f7ff;
            --text-dark: #25396f;
            --text-muted: #7c8db5;
            --border-color: #eef2f5;
            --radius-md: 10px;
            --radius-lg: 16px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            background-color: var(--bg-light) !important;
            color: var(--text-dark);
        }

        #main {
            padding-top: 0 !important;
            background-color: var(--bg-light);
        }

        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 99;
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 1.5rem !important;
        }

        .user-profile-link {
            display: flex !important;
            align-items: center !important;
            gap: 12px;
            text-decoration: none !important;
            padding: 4px 8px;
            border-radius: 30px;
            transition: all 0.2s ease;
        }

        .user-profile-link:hover {
            background-color: rgba(67, 94, 190, 0.05);
        }

        .user-avatar-img,
        .user-avatar-icon {
            width: 40px;
            height: 40px;
            border-radius: 50px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(67, 94, 190, 0.2);
        }

        .user-avatar-icon {
            background: linear-gradient(135deg, #435ebe, #6078ea);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .dropdown-menu {
            border: none !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
            border-radius: var(--radius-md) !important;
            padding: 8px !important;
            margin-top: 10px !important;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f0f4ff;
            color: var(--primary-color);
        }

        .sidebar-wrapper {
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.02) !important;
            border-right: 1px solid var(--border-color);
        }

        .sidebar-header {
            padding: 1.5rem 1.5rem 0.5rem 1.5rem !important;
        }

        .sidebar-header img {
            max-height: 45px;
            width: auto;
        }

        .sidebar-menu .menu {
            padding: 0 1rem !important;
        }

        .sidebar-title {
            font-size: 0.75rem !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin: 1.5rem 0 0.5rem 0.5rem !important;
            font-weight: 700;
        }

        .sidebar-item {
            margin-bottom: 4px !important;
            list-style: none;
        }

        .sidebar-link {
            border-radius: var(--radius-md) !important;
            padding: 10px 14px !important;
            font-weight: 500;
            color: #55607c !important;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease-in-out !important;
        }

        .sidebar-link i,
        .sidebar-link svg {
            color: #8896b3;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #f0f4ff !important;
            color: var(--primary-color) !important;
        }

        .sidebar-link:hover i,
        .sidebar-link:hover svg {
            color: var(--primary-color);
        }

        .card {
            border: none !important;
            border-radius: var(--radius-lg) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
            background: #ffffff;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: transparent !important;
            border-bottom: 1px solid var(--border-color) !important;
            padding: 1.25rem 1.5rem !important;
            font-weight: 700;
            color: var(--text-dark);
        }

        .card-body {
            padding: 1.5rem !important;
        }

        table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0 !important;
            width: 100% !important;
            margin-top: 1rem !important;
        }

        table.dataTable thead th {
            background-color: #f8faee;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            border-bottom: 2px solid var(--border-color) !important;
            padding: 12px 16px !important;
        }

        table.dataTable tbody td {
            padding: 14px 16px !important;
            vertical-align: middle !important;
            border-bottom: 1px solid var(--border-color) !important;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        table.dataTable tbody tr:hover {
            background-color: #f9fbff !important;
        }

        .dt-container .dt-search input,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #dce7f1;
            border-radius: var(--radius-md);
            padding: 8px 14px;
            outline: none;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .dt-container .dt-search input:focus,
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 94, 190, 0.15);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dt-container .dt-paging .dt-paging-button.current {
            background: var(--primary-color) !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: var(--radius-md) !important;
        }

        .alert-custom {
            border: none;
            border-radius: var(--radius-md);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            padding: 1rem 1.25rem;
        }

        .alert-custom-success {
            background-color: #eaf8f0;
            color: #1e7e44;
            border-left: 4px solid #2ecc71;
        }

        .alert-custom-danger {
            background-color: #fdeaea;
            color: #ab2e2e;
            border-left: 4px solid #e74c3c;
        }

        footer {
            background-color: #ffffff;
            border-top: 1px solid var(--border-color);
            font-size: 0.875rem;
        }
    </style>

    @if (!empty($profilSekolah && $profilSekolah->logo))
        <link rel="shortcut icon" href="{{ asset('storage/' . $profilSekolah->logo) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/mts.png') }}" type="image/x-icon">
    @endif
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header text-center" style="position: relative;">
                    @if (!empty($profilSekolah && $profilSekolah->logo))
                        <img src="{{ asset('storage/' . $profilSekolah->logo) }}" alt="Logo Sekolah"
                            style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center py-2"
                            style="background: #1e293b; border-radius: 8px;">
                            <i data-feather="image" width="30" class="mb-1 text-secondary"></i>
                            <span class="small text-white" style="font-size: 0.75rem;">Logo Kosong</span>
                        </div>
                    @endif
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>

                        <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                                <i data-feather="grid" width="18"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ request()->routeIs('admin.profil.*') || request()->segment(2) == 'profil' ? 'active' : '' }}">
                            <a href="{{ route('admin.profil.index') }}" class="sidebar-link">
                                <i data-feather="home" width="18"></i>
                                <span>Profil Sekolah</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ request()->routeIs('admin.guru.*') || request()->segment(2) == 'guru' ? 'active' : '' }}">
                            <a href="{{ route('admin.guru.index') }}" class="sidebar-link">
                                <i data-feather="briefcase" width="18"></i>
                                <span>Data Guru</span>
                            </a>
                        </li>

                        {{-- @if (Auth::check() && strcasecmp(Auth::user()->role, 'admin') == 0) --}}
                            <li
                                class="sidebar-item {{ request()->routeIs('admin.siswa.*') || request()->segment(2) == 'siswa' ? 'active' : '' }}">
                                <a href="{{ route('admin.siswa.index') }}" class="sidebar-link">
                                    <i data-feather="user-check" width="18"></i>
                                    <span>Data Siswa</span>
                                </a>
                            </li>
                        {{-- @endif --}}

                        <li class="sidebar-title">Konten & Media</li>

                        <li
                            class="sidebar-item {{ request()->routeIs('admin.berita.*') || request()->segment(2) == 'berita' ? 'active' : '' }}">
                            <a href="{{ route('admin.berita.index') }}" class="sidebar-link">
                                <i data-feather="file-text" width="18"></i>
                                <span>Data Berita</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ request()->routeIs('admin.ekskul.*') || request()->segment(2) == 'ekskul' ? 'active' : '' }}">
                            <a href="{{ route('admin.ekskul.index') }}" class="sidebar-link">
                                <i data-feather="activity" width="18"></i>
                                <span>Ekstrakurikuler</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ request()->routeIs('admin.galeri.*') || request()->segment(2) == 'galeri' ? 'active' : '' }}">
                            <a href="{{ route('admin.galeri.index') }}" class="sidebar-link">
                                <i data-feather="image" width="18"></i>
                                <span>Data Galeri</span>
                            </a>
                        </li>

                        @if (Auth::check() && strcasecmp(Auth::user()->role, 'admin') == 0)
                            <li class="sidebar-title">Pengaturan</li>
                            <li
                                class="sidebar-item {{ request()->routeIs('admin.user.*') || request()->segment(2) == 'user' ? 'active' : '' }}">
                                <a href="{{ route('admin.user.index') }}" class="sidebar-link">
                                    <i data-feather="users" width="18"></i>
                                    <span>Data Pengelola</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        <!-- Main Content -->
        <div id="main" class="d-flex flex-column min-vh-100">

            <!-- Navbar -->
            <nav class="navbar navbar-header navbar-expand navbar-light sticky-header">
                <a class="sidebar-toggler mr-3" href="#"><span class="navbar-toggler-icon"></span></a>

                <button class="btn navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user user-profile-link">
                                @if (Auth::check() && Auth::user()->foto)
                                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil"
                                        class="user-avatar-img">
                                @else
                                    <div class="user-avatar-icon">
                                        <i data-feather="user" width="20" height="20"></i>
                                    </div>
                                @endif

                                <div class="d-none d-md-block text-left">
                                    <div class="font-weight-bold style-user-name" style="line-height: 1.2;">
                                        {{ Auth::user()->name }}</div>
                                    <small class="text-muted"
                                        style="font-size: 0.75rem;">{{ ucfirst(Auth::user()->role) }}</small>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('admin.akun.index') }}">
                                    <i data-feather="user" class="mr-2" width="16"></i> Profil Akun
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item d-flex align-items-center text-danger"
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

            <!-- Main Body -->
            <main class="content-wrapper p-4 flex-grow-1">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-custom alert-custom-success alert-dismissible fade show mb-4"
                            role="alert">
                            <div class="d-flex align-items-center">
                                <i data-feather="check-circle" class="mr-2" width="18"></i>
                                <span class="font-weight-medium">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-custom alert-custom-danger alert-dismissible fade show mb-4"
                            role="alert">
                            <div class="d-flex align-items-center">
                                <i data-feX ather="alert-circle" class="mr-2" width="18"></i>
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

            <footer>
                <div class="footer clearfix text-muted px-4 py-3">
                    <div class="float-left">
                        <p class="mb-0">&copy; {{ date('Y') }} SMK SEJAHTERA. All rights reserved.</p>
                    </div>
                    <div class="float-right">
                        <p class="mb-0">Crafted with <span class='text-danger'><i data-feather="heart"
                                    width="14"></i></span>
                            by <a href="#" class="font-weight-bold text-primary">Isna Qudsiatul Aulia</a>
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
