@extends('layouts.admin')
@section('title', $title)

@section('content')
    <style>
        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .nav-tabs-modern .nav-link:hover {
            color: #435ebe;
        }

        .nav-tabs-modern .nav-link.active {
            background-color: #0d6efd !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(67, 94, 190, 0.25);
        }

        .info-list-item:last-child {
            border-bottom: none;
        }

        .btn-modern-edit:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 94, 190, 0.4);
        }
    </style>

    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="font-weight-bold text-dark mb-1">Profil Sekolah</h4>
                <p class="text-muted small mb-0">Kelola informasi identitas dan profil resmi sekolah.</p>
            </div>

            @if (Auth::check() && strcasecmp(Auth::user()->role, 'admin') == 0)
                <a href="{{ route('admin.profil.edit', Crypt::encrypt($profilSekolah->id_profil)) }}"
                    class="btn-modern-edit btn btn-primary">
                    <i data-feather="edit" width="18"></i>
                    Edit Profil
                </a>
            @endif
        </div>

        <!-- Header Card Overview -->
        <div class="glass-card p-4 shadow-sm mb-4"
            style="background: #ffffff; border-radius: 16px; border: 1px solid #eef2f5;">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="profile-avatar-box"
                        style="width: 100px; height: 100px; border-radius: 20px; background: #f8fafc; display: flex; align-items: center; justify-content: center; border: 2px dashed #e2e8f0;">
                        <img src="{{ !empty($profilSekolah->logo) ? asset('storage/' . $profilSekolah->logo) : asset('assets/admin/images/mts.png') }}"
                            alt="Logo Sekolah" style="max-width: 80px; max-height: 80px; object-fit: contain;">
                    </div>
                </div>
                <div class="col mt-3 mt-md-0">
                    <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                        <span class="meta-badge"
                            style="background: #f1f5f9; color: #475569; font-weight: 600; font-size: 0.8rem; padding: 6px 14px; border-radius: 8px;">
                            <i data-feather="shield" width="14" class="mr-1 text-primary"></i> NPSN:
                            {{ $profilSekolah->npsn ?? '-' }}
                        </span>
                        <span class="meta-badge"
                            style="background: #f1f5f9; color: #475569; font-weight: 600; font-size: 0.8rem; padding: 6px 14px; border-radius: 8px;">
                            <i data-feather="calendar" width="14" class="mr-1 text-warning"></i> Berdiri
                            {{ $profilSekolah->tahun_berdiri ?? '-' }}
                        </span>
                    </div>
                    <h3 class="font-weight-bold text-dark mb-1">
                        {{ $profilSekolah->nama_sekolah ?? 'Nama Sekolah Belum Diisi' }}</h3>
                    <p class="text-muted small mb-0 d-flex align-items-center">
                        <i data-feather="map-pin" width="14" class="mr-1"></i>
                        {{ $profilSekolah->alamat ?? 'Alamat belum dikonfigurasi' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar Informasi Kontak & Foto Kepala Sekolah -->
            <div class="col-lg-4 col-12 mb-4">
                <div class="glass-card p-4 shadow-sm mb-4"
                    style="background: #ffffff; border-radius: 16px; border: 1px solid #eef2f5;">
                    <h6 class="font-weight-bold text-dark mb-3 pb-2 border-bottom">Foto Kepala Sekolah</h6>

                    <div class="mb-3 text-center">
                        @if (!empty($profilSekolah->foto_kepala_sekolah))
                            <div class="rounded-lg overflow-hidden border d-inline-block shadow-sm" style="width: 100%;">
                                <img src="{{ asset('storage/' . $profilSekolah->foto_kepala_sekolah) }}"
                                    alt="Foto Kepala Sekolah" class="img-fluid w-100"
                                    style="max-height: 250px; object-fit: cover; border-radius: 12px;">
                            </div>
                        @else
                            <div class="bg-light rounded p-4 text-center border text-muted small">
                                <i data-feather="user" width="32"
                                    class="mb-2 text-secondary d-block mx-auto opacity-50"></i>
                                Foto kepala sekolah belum diunggah
                            </div>
                        @endif
                    </div>

                    <div
                        class="info-list-item d-flex align-items-center justify-content-between py-2 border-bottom border-dashed">
                        <span class="text-muted small d-flex align-items-center">
                            <i data-feather="user" width="16" class="mr-2 text-primary"></i>Nama Kepala Sekolah
                        </span>
                        <span
                            class="font-weight-semibold text-dark small">{{ $profilSekolah->nama_kepala_sekolah ?? '-' }}</span>
                    </div>

                    <div
                        class="info-list-item d-flex align-items-center justify-content-between py-2 border-bottom border-dashed">
                        <span class="text-muted small d-flex align-items-center">
                            <i data-feather="phone" width="16" class="mr-2 text-success"></i> Telepon / WA
                        </span>
                        <span class="font-weight-semibold text-dark small">{{ $profilSekolah->kontak ?? '-' }}</span>
                    </div>

                    <div class="info-list-item d-flex align-items-center justify-content-between py-2">
                        <span class="text-muted small d-flex align-items-center">
                            <i data-feather="check-circle" width="16" class="mr-2 text-info"></i> Status
                        </span>
                        <span class="badge badge-light-success text-success font-weight-semibold">Aktif Terdaftar</span>
                    </div>
                </div>

                <!-- Foto Gedung Preview -->
                <div class="glass-card p-3 shadow-sm mb-4"
                    style="background: #ffffff; border-radius: 16px; border: 1px solid #eef2f5;">
                    <h6 class="font-weight-bold text-dark mb-3 px-2 pt-2">Gedung Sekolah</h6>
                    @if (!empty($profilSekolah->foto))
                        <div class="rounded-lg overflow-hidden border">
                            <img src="{{ asset('storage/' . $profilSekolah->foto) }}" alt="Gedung Sekolah"
                                class="img-fluid w-100" style="max-height: 180px; object-fit: cover; border-radius: 12px;">
                        </div>
                    @else
                        <div class="bg-light rounded p-4 text-center border text-muted small">
                            <i data-feather="image" width="28"
                                class="mb-2 text-secondary d-block mx-auto opacity-50"></i>
                            Foto gedung sekolah belum diunggah
                        </div>
                    @endif
                </div>

                <!-- Tautan Media Sosial Card -->
                <div class="glass-card p-4 shadow-sm"
                    style="background: #ffffff; border-radius: 16px; border: 1px solid #eef2f5;">
                    <h6 class="font-weight-bold text-dark mb-3 pb-2 border-bottom">Tautan Media Sosial</h6>

                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom border-dashed">
                            <span class="text-muted small d-flex align-items-center">
                                <i data-feather="video" width="16" class="mr-2 text-dark"></i> TikTok
                            </span>
                            @if (!empty($profilSekolah->tiktok))
                                <a href="{{ $profilSekolah->tiktok }}" target="_blank"
                                    class="small font-weight-semibold text-primary">Kunjungi <i data-feather="external-link"
                                        width="12"></i></a>
                            @else
                                <span class="small text-muted">-</span>
                            @endif
                        </div>

                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom border-dashed">
                            <span class="text-muted small d-flex align-items-center">
                                <i data-feather="instagram" width="16" class="mr-2 text-danger"></i> Instagram
                            </span>
                            @if (!empty($profilSekolah->instagram))
                                <a href="{{ $profilSekolah->instagram }}" target="_blank"
                                    class="small font-weight-semibold text-primary">Kunjungi <i
                                        data-feather="external-link" width="12"></i></a>
                            @else
                                <span class="small text-muted">-</span>
                            @endif
                        </div>

                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom border-dashed">
                            <span class="text-muted small d-flex align-items-center">
                                <i data-feather="facebook" width="16" class="mr-2 text-primary"></i> Facebook
                            </span>
                            @if (!empty($profilSekolah->facebook))
                                <a href="{{ $profilSekolah->facebook }}" target="_blank"
                                    class="small font-weight-semibold text-primary">Kunjungi <i
                                        data-feather="external-link" width="12"></i></a>
                            @else
                                <span class="small text-muted">-</span>
                            @endif
                        </div>

                        <div class="d-flex align-items-center justify-content-between py-2">
                            <span class="text-muted small d-flex align-items-center">
                                <i data-feather="youtube" width="16" class="mr-2 text-danger"></i> YouTube
                            </span>
                            @if (!empty($profilSekolah->youtube))
                                <a href="{{ $profilSekolah->youtube }}" target="_blank"
                                    class="small font-weight-semibold text-primary">Kunjungi <i
                                        data-feather="external-link" width="12"></i></a>
                            @else
                                <span class="small text-muted">-</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-12 mb-4">
                <div class="glass-card p-4 shadow-sm h-100"
                    style="background: #ffffff; border-radius: 16px; border: 1px solid #eef2f5;">
                    <ul class="nav nav-tabs nav-tabs-modern mb-4" id="profilTab" role="tablist"
                        style="border-bottom: 2px solid #f1f5f9; gap: 8px;">
                        <li class="nav-item">
                            <a class="nav-link active" id="visi-tab" data-toggle="tab" href="#visi" role="tab"
                                aria-selected="true"
                                style="border: none !important; color: #64748b; font-weight: 600; padding: 10px 18px; border-radius: 10px;">
                                <i data-feather="target" width="16" class="mr-2"></i> Visi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="misi-tab" data-toggle="tab" href="#misi" role="tab"
                                aria-selected="false"
                                style="border: none !important; color: #64748b; font-weight: 600; padding: 10px 18px; border-radius: 10px;">
                                <i data-feather="list" width="16" class="mr-2"></i> Misi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" role="tab"
                                aria-selected="false"
                                style="border: none !important; color: #64748b; font-weight: 600; padding: 10px 18px; border-radius: 10px;">
                                <i data-feather="file-text" width="16" class="mr-2"></i> Deskripsi Sekolah
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="profilTabContent">
                        <!-- Tab Visi -->
                        <div class="tab-pane fade show active" id="visi" role="tabpanel"
                            aria-labelledby="visi-tab">
                            <div class="p-3 bg-light rounded-lg border-0 text-dark"
                                style="white-space: pre-line; line-height: 1.8; font-size: 0.95rem;">
                                {{ $profilSekolah->visi ?? 'Belum ada Visi yang dikonfigurasi.' }}
                            </div>
                        </div>

                        <!-- Tab Misi -->
                        <div class="tab-pane fade" id="misi" role="tabpanel" aria-labelledby="misi-tab">
                            <div class="p-3 bg-light rounded-lg border-0 text-dark"
                                style="white-space: pre-line; line-height: 1.8; font-size: 0.95rem;">
                                {{ $profilSekolah->misi ?? 'Belum ada Misi yang dikonfigurasi.' }}
                            </div>
                        </div>

                        <!-- Tab Deskripsi -->
                        <div class="tab-pane fade" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
                            <div class="p-3 bg-light rounded-lg border-0 text-dark"
                                style="white-space: pre-line; line-height: 1.8; font-size: 0.95rem;">
                                {{ $profilSekolah->deskripsi ?? 'Belum ada deskripsi sekolah yang diatur.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
