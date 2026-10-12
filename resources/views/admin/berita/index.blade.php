@extends('layouts.admin')

@section('title', $title)

@section('content')
    <style>
        .news-row:hover .news-thumbnail {
            transform: scale(1.08) rotate(-2deg);
        }

        .btn-action-circle.btn-view:hover {
            background: #e0f2fe;
            color: #0284c7 !important;
            transform: translateY(-2px);
        }

        .btn-action-circle.btn-edit:hover {
            background: #e0e7ff;
            color: #4338ca !important;
            transform: translateY(-2px);
        }

        .btn-action-circle.btn-delete:hover {
            background: #fee2e2;
            color: #dc2626 !important;
            transform: translateY(-2px);
        }

        .table-modern tbody tr {
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:hover {
            background-color: #f8fafc !important;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="font-weight-bold mb-1">Data Berita & Artikel</h3>
                    <p class="small mb-0">Kelola dan publikasikan berita terbaru untuk informasi sekolah Anda.</p>
                </div>
                <a href="{{ route('admin.berita.addEdit') }}"
                    class="btn btn-primary px-4 py-2 d-inline-flex align-items-center font-weight-bold">
                    <i data-feather="plus" width="18" class="mr-2"></i> Tambah Berita Baru
                </a>
            </div>

            <!-- Main Data Table Card -->
            <div class="card border-0 overflow-hidden mb-4"
                style="border-radius: 1.75rem !important; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(226, 232, 240, 0.8); box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05) !important;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern align-middle mb-0">
                            <thead>
                                <tr class="bg-light border-bottom">
                                    <th class="pl-4 py-3 text-secondary text-uppercase small font-weight-bold"
                                        width="6%">#</th>
                                    <th class="py-3 text-secondary text-uppercase small font-weight-bold" width="10%">
                                        Cover</th>
                                    <th class="py-3 text-secondary text-uppercase small font-weight-bold">Judul & Ringkasan
                                    </th>
                                    <th class="py-3 text-secondary text-uppercase small font-weight-bold" width="15%">
                                        Tanggal</th>
                                    <th class="py-3 text-secondary text-uppercase small font-weight-bold" width="15%">
                                        Penulis</th>
                                    <th class="py-3 text-secondary text-uppercase small font-weight-bold" width="12%">
                                        Status</th>
                                    <th class="pr-4 py-3 text-center text-secondary text-uppercase small font-weight-bold"
                                        width="14%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @if(count($berita) > 0)
                                    @foreach($berita as $item)
                                        <tr class="news-row border-bottom">
                                            <td class="pl-4 font-weight-bold text-muted small">{{ $loop->iteration }}</td>
                                            <td class="py-3">
                                                @if ($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                                        class="news-thumbnail shadow-sm"
                                                        style="width: 52px; height: 52px; object-fit: cover; border-radius: 14px; transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                                @else
                                                    <div class="news-thumbnail bg-light text-muted d-flex align-items-center justify-content-center shadow-sm"
                                                        style="width: 52px; height: 52px; object-fit: cover; border-radius: 14px; transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                                        <i data-feather="image" width="20"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-3">
                                                <div class="font-weight-bold text-dark h6 mb-1" style="line-height: 1.4;">
                                                    {{ $item->judul }}</div>
                                                <p class="text-muted small mb-0 d-none d-lg-block" style="font-size: 0.825rem;">
                                                    {{ Str::limit(strip_tags($item->isi), 80) }}
                                                </p>
                                            </td>
                                            <td class="py-3">
                                                <span class="badge rounded-pill px-3 py-2 small font-weight-normal"
                                                    style="background-color: #eef2ff; color: #4f46e5; border: 1px solid rgba(79, 70, 229, 0.15);">
                                                    <i data-feather="calendar" width="12" class="mr-1"></i>
                                                    {{ date('d M Y', strtotime($item->tanggal)) }}
                                                </span>
                                            </td>
                                            <td class="py-3">
                                                <span class="badge rounded-pill px-3 py-2 small font-weight-normal"
                                                    style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;">
                                                    <i data-feather="user" width="12" class="mr-1"></i>
                                                    {{ $item->user->name ?? 'admin' }}
                                                </span>
                                            </td>
                                            <td class="py-3">
                                                @if (isset($item->status) && $item->status == 'public')
                                                    <span class="badge rounded-pill px-3 py-2 small font-weight-normal"
                                                        style="background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">
                                                        <i data-feather="globe" width="12" class="mr-1"></i> Public
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill px-3 py-2 small font-weight-normal"
                                                        style="background-color: #fef9c3; color: #854d0e; border: 1px solid #fef08a;">
                                                        <i data-feather="file-text" width="12" class="mr-1"></i> Draft
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="pr-4 py-3 text-center">
                                                <div class="d-flex justify-content-center align-items-center" style="gap: 6px;">
                                                    <a href="{{ route('admin.berita.show', Crypt::encrypt($item->id_berita)) }}"
                                                        class="btn-action-circle btn-view text-secondary" title="Lihat Detail"
                                                        style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; transition: all 0.25s ease; border: 1px solid transparent; background: #f8fafc; text-decoration: none !important;">
                                                        <i data-feather="eye" width="16"></i>
                                                    </a>

                                                    @if (Auth::user()->role === 'admin' || $item->id_user === Auth::id())
                                                        <a href="{{ route('admin.berita.addEdit', Crypt::encrypt($item->id_berita)) }}"
                                                            class="btn-action-circle btn-edit text-secondary" title="Edit Data"
                                                            style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; transition: all 0.25s ease; border: 1px solid transparent; background: #f8fafc; text-decoration: none !important;">
                                                            <i data-feather="edit-3" width="16"></i>
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.berita.destroy', Crypt::encrypt($item->id_berita)) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn-action-circle btn-delete text-secondary"
                                                                title="Hapus Berita"
                                                                style="width: 38px; height: 38px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; transition: all 0.25s ease; border: 1px solid transparent; background: #f8fafc; cursor: pointer;">
                                                                <i data-feather="trash-2" width="16"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted small font-italic px-2">Milik Operator Lain</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="py-4">
                                                <div class="p-3 bg-light rounded-circle d-inline-flex mb-3 text-muted">
                                                    <i data-feather="inbox" width="36"></i>
                                                </div>
                                                <h5 class="font-weight-bold text-dark mb-1">Belum Ada Berita</h5>
                                                <p class="text-muted small mb-3">Mulai buat konten berita pertama Anda dengan menekan tombol di bawah.</p>
                                                <a href="{{ route('admin.berita.addEdit') }}"
                                                    class="btn btn-sm btn-outline-primary rounded-pill px-4 font-weight-bold">
                                                    <i data-feather="plus" width="14" class="mr-1"></i> Tambah Berita Baru
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (method_exists($berita, 'hasPages') && $berita->hasPages())
                    <div class="card-footer bg-transparent border-top-0 py-3 px-4">
                        {{ $berita->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection