@extends('layouts.admin')

@section('title', $title)

@section('content')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #435ebe 0%, #25396f 100%);
    }
    .rounded-xl {
        border-radius: 1.25rem !important; /* Lengkungan halus dan modern */
    }
    .rounded-2xl {
        border-radius: 1.75rem !important;
    }
    .soft-shadow {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
    }
    .profile-avatar-wrapper {
        margin-top: -60px;
    }
    .info-card {
        transition: all 0.25s ease;
        border: 1px solid rgba(0,0,0,0.03);
    }
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(67, 94, 190, 0.08) !important;
    }
    /* Style kustom untuk tombol aksi agar berefek sama saat di-hover/diklik */
    .btn-header-action {
        transition: all 0.25s ease-in-out;
    }
    .btn-header-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2) !important;
    }
    .btn-header-action:active {
        transform: translateY(0);
    }
</style>

<div class="page-content">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            
            <!-- Banner Header & Profil Card -->
            <div class="card border-0 rounded-2xl soft-shadow overflow-hidden mb-4">
                <!-- Header Banner Gradien -->
                <div class="bg-gradient-primary p-4 p-md-5 position-relative">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <span class="badge bg-white text-primary px-3 py-2 rounded-pill font-weight-bold shadow-sm">
                            <i data-feather="shield" width="14" class="mr-1"></i> {{ ucfirst($user->role ?? 'Admin') }}
                        </span>

                        <!-- Tombol Aksi (Kembali & Edit Profil dengan Efek Sama & Jarak Rapi) -->
                        <div class="d-flex align-items-center" style="gap: 12px;">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-header-action rounded-pill px-3 py-2 font-weight-bold shadow-sm">
                                <i data-feather="arrow-left" width="15" class="mr-1"></i> Kembali
                            </a>
                            <a href="{{ route('admin.akun.edit') }}" class="btn btn-outline-light btn-header-action rounded-pill px-4 py-2 font-weight-bold shadow-sm">
                                <i data-feather="edit-3" width="15" class="mr-1"></i> Edit Profil
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bagian Isi Profil Utama -->
                <div class="card-body px-4 px-md-5 pb-5 pt-0">
                    <div class="row align-items-end">
                        <div class="col-md-auto text-center text-md-left">
                            <div class="profile-avatar-wrapper position-relative d-inline-block">
                                <img src="{{ $user->foto && Storage::disk('public')->exists($user->foto) ? asset('storage/' . $user->foto) : asset('assets/images/faces/1.jpg') }}"
                                     alt="Avatar" 
                                     class="rounded-circle shadow-md" 
                                     width="130" 
                                     height="130" 
                                     style="object-fit: cover; border: 5px solid #ffffff;">
                            </div>
                        </div>
                        <div class="col-md mt-3 mt-md-0 text-center text-md-left">
                            <h3 class="font-weight-bold text-dark mb-1">{{ $user->name }}</h3>
                            <p class="text-muted mb-0 d-flex align-items-center justify-content-center justify-content-md-start">
                                <i data-feather="mail" width="15" class="mr-2 text-primary"></i> {{ $user->email ?? 'Email belum diatur' }}
                            </p>
                        </div>
                    </div>

                    <!-- Divider Lembut -->
                    <hr class="my-4 border-light">

                    <!-- Detail Informasi dengan Kotak Membulat (Soft Cards) -->
                    <h5 class="font-weight-bold text-dark mb-3">Rincian Akun</h5>
                    <div class="row g-3">
                        
                        <!-- Nama Lengkap -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded-xl info-card d-flex align-items-center">
                                <div class="p-3 bg-white rounded-circle shadow-sm mr-3 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i data-feather="user" width="20"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Nama Lengkap</small>
                                    <strong class="text-dark h6 mb-0">{{ $user->name }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded-xl info-card d-flex align-items-center">
                                <div class="p-3 bg-white rounded-circle shadow-sm mr-3 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i data-feather="at-sign" width="20"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Username</small>
                                    <strong class="text-dark h6 mb-0">{{ $user->username ?? '-' }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Hak Akses -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded-xl info-card d-flex align-items-center">
                                <div class="p-3 bg-white rounded-circle shadow-sm mr-3 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i data-feather="key" width="20"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Hak Akses / Role</small>
                                    <strong class="text-dark h6 mb-0 text-capitalize">{{ $user->role ?? 'Admin' }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Dibuat -->
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded-xl info-card d-flex align-items-center">
                                <div class="p-3 bg-white rounded-circle shadow-sm mr-3 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i data-feather="calendar" width="20"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Terdaftar Sejak</small>
                                    <strong class="text-dark h6 mb-0">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</strong>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End Row -->

                </div>
            </div>

        </div>
    </div>
</div>
@endsection