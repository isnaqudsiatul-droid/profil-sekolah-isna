@extends('layouts.admin')
@section('title', $title)

@section('content')
    <style>
        /* Styling Konsisten Dark Gradient Header & Glassmorphism Table */
        .bg-gradient-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        .rounded-2xl {
            border-radius: 1.25rem !important;
        }

        .rounded-3xl {
            border-radius: 1.75rem !important;
        }

        .modern-shadow {
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05) !important;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Custom Soft Badges */
        .badge-soft-primary {
            background-color: #eef2ff;
            color: #4f46e5;
            border: 1px solid rgba(79, 70, 229, 0.15);
        }

        .badge-soft-info {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid rgba(3, 105, 161, 0.15);
        }

        /* Custom Table Style */
        .table-modern thead th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.725rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .table-modern tbody td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        .table-modern tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Action Buttons (Square Rounded Icon) */
        .btn-action-icon {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-action-icon:hover {
            transform: translateY(-2px);
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="font-weight-bold text-dark mb-1">Data Galeri</h2>
                    <p class="small mb-0">Kelola dokumentasi foto dan video kegiatan operasional sekolah.</p>
                </div>
                <a href="{{ route('admin.galeri.addEdit') }}"
                    class="btn btn-primary px-4 py-2 font-weight-bold d-inline-flex align-items-center shadow-sm">
                    <i data-feather="plus" width="16" class="mr-2"></i> Tambah Galeri
                </a>
            </div>

            <!-- Card Tabel Utama -->
            <div class="card border-0 rounded-3xl glass-card modern-shadow overflow-hidden mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="pl-4" width="5%">No</th>
                                    <th width="10%">Preview</th>
                                    <th>Judul Dokumentasi</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Upload</th>
                                    <th class="pr-4 text-center" width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($galeri) > 0)
                                    @foreach($galeri as $item)
                                        <tr>
                                            <td class="pl-4 text-muted small font-weight-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                @if (!empty($item->link_video))
                                                    <div class="bg-dark rounded-circle text-center d-inline-flex align-items-center justify-content-center shadow-sm border"
                                                        style="width: 44px; height: 44px;" title="Video YouTube">
                                                        <i class="fa-brands fa-youtube text-danger" style="font-size: 20px;"></i>
                                                    </div>
                                                @elseif ($item->file && file_exists(public_path('storage/' . $item->file)))
                                                    @if($item->kategori == 'Video')
                                                        <div class="bg-dark rounded-circle text-center d-inline-flex align-items-center justify-content-center shadow-sm border"
                                                            style="width: 44px; height: 44px;" title="Video Lokal">
                                                            <i class="fa-solid fa-video text-white" style="font-size: 16px;"></i>
                                                        </div>
                                                    @else
                                                        <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->judul }}"
                                                            class="rounded-circle shadow-sm"
                                                            style="width: 44px; height: 44px; object-fit: cover; border: 2px solid #e2e8f0;">
                                                    @endif
                                                @else
                                                    <div class="bg-light rounded-circle text-center d-inline-flex align-items-center justify-content-center shadow-sm border"
                                                        style="width: 44px; height: 44px;">
                                                        <i data-feather="image" class="text-muted" width="18"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-dark mb-0">{{ $item->judul }}</div>
                                                <small class="text-muted d-none d-lg-block"
                                                    style="font-size: 0.78rem;">{{ Str::limit(strip_tags($item->keterangan), 50) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-info px-3 py-1 rounded-pill font-weight-bold"
                                                    style="font-size: 0.75rem;">
                                                    {{ $item->kategori ?? 'Umum' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="small font-weight-bold text-dark d-inline-flex align-items-center">
                                                    <i data-feather="calendar" width="13" class="mr-1 text-muted"></i>
                                                    {{ $item->tanggal ? date('d M Y', strtotime($item->tanggal)) : '-' }}
                                                </div>
                                            </td>
                                            <td class="pr-4 text-center">
                                                <div class="d-flex justify-content-center align-items-center" style="gap: 6px;">
                                                    {{-- Tombol Detail --}}
                                                    <a href="{{ route('admin.galeri.show', Crypt::encrypt($item->id_galeri)) }}"
                                                        class="btn btn-action-icon btn-light text-info shadow-sm"
                                                        title="Detail">
                                                        <i data-feather="eye" width="15"></i>
                                                    </a>

                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('admin.galeri.addEdit', Crypt::encrypt($item->id_galeri)) }}"
                                                        class="btn btn-action-icon btn-light text-primary shadow-sm"
                                                        title="Edit">
                                                        <i data-feather="edit-2" width="15"></i>
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <form
                                                        action="{{ route('admin.galeri.destroy', Crypt::encrypt($item->id_galeri)) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-action-icon btn-light text-danger shadow-sm"
                                                            title="Hapus">
                                                            <i data-feather="trash-2" width="15"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="p-3 text-muted">
                                                <div class="mb-2 text-secondary">
                                                    <i data-feather="image" width="36"></i>
                                                </div>
                                                <h6 class="font-weight-bold text-dark mb-1">Belum ada foto/video</h6>
                                                <p class="small mb-0">Belum ada data galeri yang tersimpan di dalam sistem.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection