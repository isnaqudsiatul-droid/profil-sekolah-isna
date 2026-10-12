@extends('layouts.admin')

@section('title', $title ?? 'Data Pengguna')

@section('content')

    <style>
        .card-clean {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        /* Header Tabel Style */
        .table-custom {
            margin-bottom: 0;
            width: 100%;
        }

        .table-custom thead th {
            background-color: #cbd5e1;
            color: #334155;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-bottom: 1px solid #cbd5e1;
            padding: 1.1rem 1.25rem;
        }

        .table-custom tbody td {
            padding: 1.1rem 1.25rem;
            vertical-align: middle;
            color: #334155;
            font-size: 0.875rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Soft Pill Badges */
        .badge-soft-pill {
            background-color: #f1f5f9;
            color: #475569;
            padding: 0.4rem 0.9rem;
            border-radius: 2rem;
            font-size: 0.8125rem;
            font-weight: 500;
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

        /* STATUS */
        .badge-soft-pill.status-aktif {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .badge-soft-pill.status-tidak-aktif {
            background-color: #fee2e2;
            color: #dc2626;
        }

        /* Styling Tombol Aksi */
        .btn-action-square {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background-color: #cbd5e1;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
            padding: 0;
            text-decoration: none !important;
        }

        .btn-action-square:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
        }

        .btn-action-square.view {
            color: #06b6d4;
        }

        .btn-action-square.edit {
            color: #3b82f6;
        }

        .btn-action-square.delete {
            color: #ef4444;
        }

        /* Tombol status */
        .btn-action-square.status-button {
            color: #f59e0b;
        }

        .btn-action-square.status-button-active {
            color: #16a34a;
        }

        /* Avatar Box */
        .avatar-box {
            width: 44px;
            height: 44px;
            border-radius: 0.75rem;
            overflow: hidden;
            background-color: #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="font-weight-bold text-dark mb-1">Data Pengguna</h3>
                    <p class="small">Kelola dan atur akses akun pengguna sistem sekolah Anda.</p>
                </div>
                <a href="{{ route('admin.user.addEdit') }}" class="btn btn-primary d-inline-flex align-items-center"><i
                        data-feather="plus" width="16" class="mr-2"></i>Tambah Pengguna Baru</a>
            </div>

            <!-- Card Table Section -->
            <section class="section">

                <div class="card card-clean">

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-custom">

                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">
                                            #
                                        </th>

                                        <th width="8%">
                                            FOTO
                                        </th>

                                        <th width="27%">
                                            NAMA & USERNAME
                                        </th>

                                        <th width="22%">
                                            EMAIL
                                        </th>

                                        <th width="13%">
                                            ROLE
                                        </th>

                                        <th width="12%" class="text-center">
                                            STATUS
                                        </th>

                                        <th width="13%" class="text-center">
                                            AKSI
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @if(count($user) > 0)
                                        @foreach ($user as $index => $item)
                                            <tr>

                                                <!-- Nomor -->
                                                <td class="text-center text-muted font-weight-bold">
                                                    {{ $user->firstItem() + $index }}
                                                </td>

                                                <!-- Foto -->
                                                <td>
                                                    <div class="avatar-box">

                                                        @if ($item->foto)
                                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                                alt="Foto {{ $item->name }}">
                                                        @else
                                                            <i data-feather="image" class="text-white" width="20"></i>
                                                        @endif

                                                    </div>
                                                </td>

                                                <!-- Nama & Username -->
                                                <td>

                                                    <div class="font-weight-bold text-dark mb-1" style="font-size: 0.95rem;">

                                                        {{ $item->name }}

                                                    </div>

                                                    <div class="text-muted small">

                                                        <i data-feather="at-sign" width="12" class="mr-0.5"></i>

                                                        {{ $item->username }}

                                                    </div>

                                                </td>

                                                <!-- Email -->
                                                <td>

                                                    <span class="badge-soft-pill">

                                                        <i data-feather="mail" width="13"></i>

                                                        {{ $item->email }}

                                                    </span>

                                                </td>

                                                <!-- Role -->
                                                <td>

                                                    @php
                                                        $roleLower = strtolower($item->role);
                                                    @endphp

                                                    <span
                                                        class="badge-soft-pill
                                                    {{ $roleLower == 'admin' ? 'primary' : ($roleLower == 'operator' ? 'info' : '') }}">

                                                        <i data-feather="user-check" width="13"></i>

                                                        {{ ucfirst($item->role) }}

                                                    </span>

                                                </td>

                                                <!-- STATUS -->
                                                <td class="text-center">

                                                    @if ($item->status === 'aktif')
                                                        <span class="badge-soft-pill status-aktif">

                                                            <i data-feather="check-circle" width="13"></i>

                                                            Aktif

                                                        </span>
                                                    @else
                                                        <span class="badge-soft-pill status-tidak-aktif">

                                                            <i data-feather="x-circle" width="13"></i>

                                                            Tidak Aktif

                                                        </span>
                                                    @endif

                                                </td>

                                                <!-- AKSI -->
                                                <td class="text-center">

                                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                                        <!-- Tombol Aktif / Nonaktif -->
                                                        <form
                                                            action="{{ route('admin.user.toggleStatus', Crypt::encrypt($item->id_user)) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('{{ $item->status === 'aktif' ? 'Apakah Anda yakin ingin menonaktifkan pengguna ini?' : 'Apakah Anda ingin mengaktifkan pengguna ini?' }}')">

                                                            @csrf

                                                            @method('PATCH')

                                                            @if ($item->status === 'aktif')
                                                                <button type="submit" class="btn-action-square status-button"
                                                                    title="Nonaktifkan">

                                                                    <i data-feather="user-x" width="18" height="18"></i>

                                                                </button>
                                                            @else
                                                                <button type="submit"
                                                                    class="btn-action-square status-button-active"
                                                                    title="Aktifkan">

                                                                    <i data-feather="user-check" width="18"
                                                                        height="18"></i>

                                                                </button>
                                                            @endif

                                                        </form>

                                                        <!-- Tombol Detail -->
                                                        <a href="{{ route('admin.user.show', Crypt::encrypt($item->id_user)) }}"
                                                            class="btn-action-square view mr-1" title="Detail">

                                                            <i data-feather="eye" width="18" height="18"></i>

                                                        </a>

                                                        <!-- Tombol Edit -->
                                                        <a href="{{ route('admin.user.addEdit', Crypt::encrypt($item->id_user)) }}"
                                                            class="btn-action-square edit mr-1" title="Edit">

                                                            <i data-feather="edit-2" width="18" height="18"></i>

                                                        </a>

                                                        <!-- Tombol Hapus -->
                                                        <form
                                                            action="{{ route('admin.user.destroy', Crypt::encrypt($item->id_user)) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">

                                                            @csrf

                                                            @method('DELETE')

                                                            <button type="submit" class="btn-action-square delete"
                                                                title="Hapus">

                                                                <i data-feather="trash-2" width="18" height="18"></i>

                                                            </button>

                                                        </form>

                                                    </div>

                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                Belum ada data pengguna yang terdaftar.
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </section>

        </div>
    </div>

@endsection