@extends('layouts.admin')

@section('title', $title)

@section('content')
    <style>
        /* Hanya menyisakan style untuk hover, transisi, dan warna ikon khusus */
        .btn-purple-pill:hover {
            background-color: #4338ca;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-action-squircle:hover {
            opacity: 0.85;
            transform: scale(1.05);
        }

        .btn-action-squircle.view i,
        .btn-action-squircle.view svg {
            color: #00bcd4 !important;
            stroke: #00bcd4 !important;
        }

        .btn-action-squircle.edit i,
        .btn-action-squircle.edit svg {
            color: #4285f4 !important;
            stroke: #4285f4 !important;
        }

        .btn-action-squircle.delete i,
        .btn-action-squircle.delete svg {
            color: #ff5252 !important;
            stroke: #ff5252 !important;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h2 class="font-weight-bold mb-1">
                        Data Siswa
                    </h2>
                    <p class="small mb-0">
                        Daftar siswa siswi sekolah.
                    </p>
                </div>
                <a href="{{ route('admin.siswa.addEdit') }}" class="btn btn-primary d-inline-flex align-items-center">
                    <i data-feather="plus" width="16" class="mr-1.5"></i> Tambah Siswa
                </a>
            </div>
            <!-- Main Card Container -->
            <div class="card p-4 mb-4"
                style="background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.03);">

                <!-- Table Responsive -->
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="pl-4" width="5%"
                                    style="background-color: transparent; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding: 1rem 1.25rem;">
                                    NO</th>
                                <th
                                    style="background-color: transparent; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding: 1rem 1.25rem;">
                                    NISN</th>
                                <th
                                    style="background-color: transparent; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding: 1rem 1.25rem;">
                                    NAMA SISWA</th>
                                <th
                                    style="background-color: transparent; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding: 1rem 1.25rem;">
                                    JENIS KELAMIN</th>
                                <th
                                    style="background-color: transparent; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding: 1rem 1.25rem;">
                                    TAHUN MASUK</th>
                                <th class="pr-4 text-center" width="18%"
                                    style="background-color: transparent; color: #475569; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; border-bottom: 2px solid #f1f5f9; padding: 1rem 1.25rem;">
                                    AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($siswa) > 0)
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td class="pl-4 text-muted small"
                                            style="padding: 1rem 1.25rem; color: #1e293b; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem;">
                                            {{ $loop->iteration }}</td>
                                        <td>{{ $item->nisn ?? '-' }}</td>
                                        <td class="small font-weight-bold text-dark"
                                            style="padding: 1rem 1.25rem; color: #1e293b; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem;">
                                            {{ $item->nama_siswa }}</td>
                                        <td class="small font-weight-bold text-dark"
                                            style="padding: 1rem 1.25rem; color: #1e293b; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem;">
                                            {{ $item->jenis_kelamin }}</td>
                                        <td class="small font-weight-bold text-dark"
                                            style="padding: 1rem 1.25rem; color: #1e293b; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem;">
                                            {{ $item->tahun_masuk ?? '-' }}</td>

                                        @if (Auth::check() && strcasecmp(Auth::user()->role, 'admin') == 0)
                                            <td class="pr-4 text-center"
                                                style="padding: 1rem 1.25rem; color: #1e293b; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem;">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    {{-- Tombol Detail --}}
                                                    <a href="{{ route('admin.siswa.show', Crypt::encrypt($item->id_siswa)) }}"
                                                        class="btn-action-squircle view" title="Detail"
                                                        style="width: 38px; height: 38px; border-radius: 12px; background-color: #b0bec5; display: inline-flex; align-items: center; justify-content: center; border: none; outline: none; padding: 0; margin: 0 2px; transition: all 0.2s ease-in-out; cursor: pointer;">
                                                        <i data-feather="eye" width="18" height="18"
                                                            stroke-width="2"></i>
                                                    </a>

                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('admin.siswa.addEdit', Crypt::encrypt($item->id_siswa)) }}"
                                                        class="btn-action-squircle edit" title="Edit"
                                                        style="width: 38px; height: 38px; border-radius: 12px; background-color: #b0bec5; display: inline-flex; align-items: center; justify-content: center; border: none; outline: none; padding: 0; margin: 0 2px; transition: all 0.2s ease-in-out; cursor: pointer;">
                                                        <i data-feather="edit-2" width="18" height="18"
                                                            stroke-width="2"></i>
                                                    </a>

                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('admin.siswa.destroy', $item->id_siswa) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action-squircle delete"
                                                            title="Hapus"
                                                            style="width: 38px; height: 38px; border-radius: 12px; background-color: #b0bec5; display: inline-flex; align-items: center; justify-content: center; border: none; outline: none; padding: 0; margin: 0 2px; transition: all 0.2s ease-in-out; cursor: pointer;">
                                                            <i data-feather="trash-2" width="18" height="18"
                                                                stroke-width="2"></i>
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
                                    <td colspan="6" class="text-center py-4 text-muted small"
                                        style="padding: 1rem 1.25rem; color: #1e293b; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem;">
                                        Belum ada data siswa yang tersimpan.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if (method_exists($siswa, 'hasPages') && $siswa->hasPages())
                    <div class="pt-3 border-top d-flex justify-content-end">
                        {{ $siswa->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
