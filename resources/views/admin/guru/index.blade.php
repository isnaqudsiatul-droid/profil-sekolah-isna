@extends('layouts.admin')
@section('title', $title)

@section('content')
    <style>
        .table-modern tbody tr:hover {
            background-color: #f8fafc;
        }

        .btn-action-icon:hover {
            transform: translateY(-2px);
        }

        .btn-glow-primary:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px -4px rgba(79, 70, 229, 0.5);
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="font-weight-bold text-dark mb-1">Data Guru</h2>
                    <p class="small">Kelola daftar tenaga pengajar, staf pengajar, dan mata pelajaran sekolah.
                    </p>
                </div>
                <a href="{{ route('admin.guru.addEdit') }}"
                    class="btn btn-primary px-4 py-2 font-weight-bold d-inline-flex align-items-center shadow-sm">
                    <i data-feather="plus" width="16" class="mr-2"></i> Tambah Guru
                </a>
            </div>

            <!-- Card Tabel Utama -->
            <div class="card border-0 modern-shadow overflow-hidden mb-4"
                style="border-radius: 1.75rem !important; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(226, 232, 240, 0.8);">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="pl-4" width="5%"
                                        style="font-weight: 700; text-transform: uppercase; font-size: 0.725rem; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; padding-top: 1rem; padding-bottom: 1rem;">
                                        No</th>
                                    <th width="8%"
                                        style="font-weight: 700; text-transform: uppercase; font-size: 0.725rem; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; padding-top: 1rem; padding-bottom: 1rem;">
                                        Foto</th>
                                    <th
                                        style="font-weight: 700; text-transform: uppercase; font-size: 0.725rem; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; padding-top: 1rem; padding-bottom: 1rem;">
                                        NIP</th>
                                    <th
                                        style="font-weight: 700; text-transform: uppercase; font-size: 0.725rem; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; padding-top: 1rem; padding-bottom: 1rem;">
                                        Nama Guru</th>
                                    <th
                                        style="font-weight: 700; text-transform: uppercase; font-size: 0.725rem; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; padding-top: 1rem; padding-bottom: 1rem;">
                                        Mata Pelajaran</th>
                                    <th class="pr-4 text-center" width="18%"
                                        style="font-weight: 700; text-transform: uppercase; font-size: 0.725rem; letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0; padding-top: 1rem; padding-bottom: 1rem;">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($guru) > 0)
                                    @foreach ($guru as $item)
                                        <tr>
                                            <td class="pl-4 text-muted small font-weight-bold"
                                                style="vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #f1f5f9; color: #334155;">
                                                {{ $loop->iteration }}</td>
                                            <td
                                                style="vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #f1f5f9; color: #334155;">
                                                @if ($item->foto && file_exists(public_path('storage/' . $item->foto)))
                                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                                        alt="Foto {{ $item->nama_guru }}" class="rounded-circle shadow-sm"
                                                        style="width: 44px; height: 44px; object-fit: cover; border: 2px solid #e2e8f0;">
                                                @else
                                                    <div class="bg-light rounded-circle text-center d-inline-flex align-items-center justify-content-center shadow-sm border"
                                                        style="width: 44px; height: 44px;">
                                                        <i data-feather="user" class="text-muted" width="18"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td
                                                style="vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #f1f5f9; color: #334155;">
                                                <span>
                                                    {{ $item->nip ?? '-' }}
                                                </span>
                                            </td>
                                            <td
                                                style="vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #f1f5f9; color: #334155;">
                                                <div class="font-weight-bold text-dark">{{ $item->nama_guru }}</div>
                                            </td>
                                            <td
                                                style="vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #f1f5f9; color: #334155;">
                                                <span class="badge px-3 py-1 rounded-pill font-weight-bold"
                                                    style="font-size: 0.75rem; background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;">
                                                    {{ $item->mapel ?? '-' }}
                                                </span>
                                            </td>

                                            @if (Auth::check() && strcasecmp(Auth::user()->role, 'admin') == 0)
                                                <td class="pr-4 text-center"
                                                    style="vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #f1f5f9; color: #334155;">
                                                    <div class="d-flex justify-content-center align-items-center"
                                                        style="gap: 6px;">
                                                        <a href="{{ route('admin.guru.show', Crypt::encrypt($item->id_guru)) }}"
                                                            class="btn btn-light text-info shadow-sm btn-action-icon"
                                                            style="width: 34px; height: 34px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: all 0.2s ease;"
                                                            title="Detail">
                                                            <i data-feather="eye" width="15"></i>
                                                        </a>

                                                        <a href="{{ route('admin.guru.addEdit', Crypt::encrypt($item->id_guru)) }}"
                                                            class="btn btn-light text-primary shadow-sm btn-action-icon"
                                                            style="width: 34px; height: 34px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: all 0.2s ease;"
                                                            title="Edit">
                                                            <i data-feather="edit-2" width="15"></i>
                                                        </a>

                                                        <form action="{{ route('admin.guru.destroy', $item->id_guru) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-light text-danger shadow-sm btn-action-icon"
                                                                style="width: 34px; height: 34px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; transition: all 0.2s ease;"
                                                                title="Hapus">
                                                                <i data-feather="trash-2" width="15"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="pr-4 text-center text-muted small"
                                                    style="vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #f1f5f9;">
                                                    -
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-5"
                                            style="vertical-align: middle; padding: 1rem 0.75rem; border-bottom: 1px solid #f1f5f9;">
                                            <div class="p-3 text-muted">
                                                <div class="mb-2 text-secondary">
                                                    <i data-feather="users" width="36"></i>
                                                </div>
                                                <h6 class="font-weight-bold text-dark mb-1">Belum ada data guru</h6>
                                                <p class="small mb-0">Belum ada data tenaga pengajar yang tersimpan di dalam
                                                    sistem.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (method_exists($guru, 'hasPages') && $guru->hasPages())
                    <div class="card-footer bg-white border-top-0 py-3 px-4">
                        {{ $guru->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
