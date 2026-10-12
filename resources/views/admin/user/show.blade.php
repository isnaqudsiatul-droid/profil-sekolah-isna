@extends('layouts.admin')

@section('title', $title ?? 'Detail Pengguna')

@section('content')
    <style>
        /* Card Detail Container */
        .card-detail {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        /* Profile Header Box (Sisi Kiri) */
        .profile-sidebar {
            background-color: #f8fafc;
            border-radius: 1rem;
            padding: 2rem 1.5rem;
            text-align: center;
            border: 1px solid #e2e8f0;
        }

        .avatar-detail-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        /* Label & Value Styling */
        .detail-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #64748b;
            margin-bottom: 0.25rem;
        }

        .detail-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.25rem;
        }

        /* Soft Pill Badges */
        .badge-soft-pill {
            background-color: #f1f5f9;
            color: #475569;
            padding: 0.4rem 0.9rem;
            border-radius: 2rem;
            font-size: 0.8125rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-soft-pill.primary {
            background-color: #e0e7ff;
            color: #4f46e5;
        }

        .badge-soft-pill.info {
            background-color: #e0f2fe;
            color: #0284c7;
        }

        .btn-light-pill {
            background-color: #ffffff;
            color: #475569;
            border: 1px solid #cbd5e1;
            border-radius: 2rem;
            padding: 0.6rem 1.4rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .btn-light-pill:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            border-color: #94a3b8;
        }

        /* Action Edit Button */
        .btn-gradient-purple {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: #ffffff;
            border: none;
            border-radius: 2rem;
            padding: 0.65rem 1.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.35);
            transition: all 0.2s ease;
            text-decoration: none !important;
        }

        .btn-gradient-purple:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45);
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">

            <!-- Header Title Area -->
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                <div>
                    <h3 class="font-weight-bold text-dark mb-1">Detail Pengguna</h3>
                    <p class="text-muted small mb-0">Rincian informasi lengkap akun pengguna sistem.</p>
                </div>
                <a href="{{ route('admin.user.index') }}" class="btn btn-light-pill d-inline-flex align-items-center">
                    <i data-feather="arrow-left" width="16" class="mr-1.5"></i> Kembali
                </a>
            </div>

            <!-- Content Card -->
            <section class="section">
                <div class="card card-detail">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center">
                            
                            <!-- Sidebar Profile (Foto & Name Badge) -->
                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <div class="profile-sidebar d-flex flex-column align-items-center">
                                    <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/images/faces/1.jpg') }}"
                                         alt="Foto {{ $user->name }}"
                                         class="avatar-detail-img mb-3">
                                    
                                    <h5 class="font-weight-bold text-dark mb-1">{{ $user->name }}</h5>
                                    <p class="text-muted small mb-3">
                                        <i data-feather="at-sign" width="13"></i>{{ $user->username }}
                                    </p>

                                    @php $roleLower = strtolower($user->role); @endphp
                                    <span class="badge-soft-pill {{ $roleLower == 'admin' ? 'primary' : ($roleLower == 'guru' ? 'info' : '') }}">
                                        <i data-feather="user-check" width="14"></i> Hak Akses: {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Detail Rincian Informasi -->
                            <div class="col-lg-8 pl-lg-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-label">NAMA LENGKAP</div>
                                        <div class="detail-value">{{ $user->name }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="detail-label">USERNAME</div>
                                        <div class="detail-value"><code>{{ $user->username }}</code></div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="detail-label">ALAMAT EMAIL</div>
                                        <div class="detail-value d-flex align-items-center gap-1">
                                            <i data-feather="mail" width="15" class="text-muted"></i>
                                            {{ $user->email }}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="detail-label">ROLE / HAK AKSES</div>
                                        <div class="detail-value">
                                            <span class="badge-soft-pill {{ $roleLower == 'admin' ? 'primary' : ($roleLower == 'guru' ? 'info' : '') }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="detail-label">TANGGAL DIBUAT</div>
                                        <div class="detail-value text-muted">
                                            <i data-feather="calendar" width="14" class="mr-1"></i>
                                            {{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }} WIB
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="detail-label">TERAKHIR DIPERBARUI</div>
                                        <div class="detail-value text-muted">
                                            <i data-feather="clock" width="14" class="mr-1"></i>
                                            {{ $user->updated_at ? $user->updated_at->format('d M Y, H:i') : '-' }} WIB
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4" style="border-top: 1px solid #f1f5f9;">
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection