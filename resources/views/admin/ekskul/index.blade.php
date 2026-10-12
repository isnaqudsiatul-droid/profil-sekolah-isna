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
                    <h2 class="font-weight-bold text-dark mb-1">Data Ekstrakurikuler</h2>
                    <p class="small mb-0">Kelola daftar kegiatan ekstrakurikuler, pembina, serta jadwal latihan siswa.</p>
                </div>
                <a href="{{ route('admin.ekskul.addEdit') }}"
                    class="btn btn-primary px-4 py-2 font-weight-bold d-inline-flex align-items-center shadow-sm">
                    <i data-feather="plus" width="16" class="mr-2"></i> Tambah Ekstrakurikuler
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
                                    <th width="10%">Gambar</th>
                                    <th>Nama Ekstrakurikuler</th>
                                    <th>Pembina</th>
                                    <th>Jadwal Latihan</th>
                                    <th class="pr-4 text-center" width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($ekstrakurikuler) > 0)
                                    @foreach($ekstrakurikuler as $item)
                                        <tr>
                                            <td class="pl-4 text-muted small font-weight-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                                                    <img src="{{ asset('storage/' . $item->gambar) }}"
                                                        alt="{{ $item->nama_ekskul }}" class="rounded-circle shadow-sm"
                                                        style="width: 44px; height: 44px; object-fit: cover; border: 2px solid #e2e8f0;">
                                                @else
                                                    <div class="bg-light rounded-circle text-center d-inline-flex align-items-center justify-content-center shadow-sm border"
                                                        style="width: 44px; height: 44px;">
                                                        <i data-feather="image" class="text-muted" width="18"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-dark mb-0">{{ $item->nama_ekskul }}</div>
                                                <small class="text-muted d-none d-lg-block"
                                                    style="font-size: 0.78rem;">{{ Str::limit(strip_tags($item->deskripsi), 50) }}</small>
                                            </td>
                                            <td>
                                                <div
                                                    class="d-inline-flex align-items-center text-dark small font-weight-medium px-2 py-1 bg-light rounded-pill border">
                                                    <i data-feather="user" width="12" class="mr-1 text-primary"></i>
                                                    {{ $item->guru->nama ?? ($item->guru->nama_guru ?? '-') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="small font-weight-bold text-dark d-inline-flex align-items-center">
                                                    <i data-feather="calendar" width="13" class="mr-1 text-muted"></i>
                                                    {{ $item->jadwal_latihan }}
                                                </div>
                                            </td>
                                            <td class="pr-4 text-center">
                                                <div class="d-flex justify-content-center align-items-center" style="gap: 6px;">
                                                    {{-- Tombol Detail --}}
                                                    <a href="{{ route('admin.ekskul.show', Crypt::encrypt($item->id_ekskul)) }}"
                                                        class="btn btn-action-icon btn-light text-info shadow-sm"
                                                        title="Detail">
                                                        <i data-feather="eye" width="15"></i>
                                                    </a>

                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('admin.ekskul.addEdit', Crypt::encrypt($item->id_ekskul)) }}"
                                                        class="btn btn-action-icon btn-light text-primary shadow-sm"
                                                        title="Edit">
                                                        <i data-feather="edit-2" width="15"></i>
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <form
                                                        action="{{ route('admin.ekskul.destroy', Crypt::encrypt($item->id_ekskul)) }}"
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
                                                    <i data-feather="folder-minus" width="36"></i>
                                                </div>
                                                <h6 class="font-weight-bold text-dark mb-1">Belum ada data</h6>
                                                <p class="small mb-0">Belum ada data ekstrakurikuler yang tersimpan di dalam sistem.</p>
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