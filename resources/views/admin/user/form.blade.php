@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
            <div>
                <h3 class="font-weight-bold text-dark mb-1">
                    {{ isset($user) ? 'Edit Data Pengelola' : 'Tambah Data Pengelola' }}
                </h3>
                <p class="text-muted small mb-0">
                    {{ isset($user) ? 'Perbarui informasi data pegelola di dalam sistem.' : 'Tambahkan data pengelola baru ke dalam sistem.' }}
                </p>
            </div>
            <div>
                <a href="{{ route('admin.user.index') }}" class="btn d-inline-flex align-items-center btn-light-pill"
                    style="background-color: #ffffff; color: #475569; border: 1px solid #cbd5e1; border-radius: 2rem; padding: 0.6rem 1.4rem; font-weight: 600; font-size: 0.875rem; transition: all 0.2s ease; text-decoration: none !important;">
                    <i data-feather="arrow-left" width="16" class="mr-1.5"></i> Kembali
                </a>
            </div>
        </div>
        <div class="row">

            <div class="col-12">

                <div class="card card-custom">



                    <div class="card-body">

                        <form
                            action="{{ isset($user) ? route('admin.user.save', Crypt::encrypt($user->id_user)) : route('admin.user.save') }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="row">

                                <!-- Nama Lengkap -->
                                <div class="col-md-6 mb-3">

                                    <label for="name" class="form-label-custom">

                                        NAMA LENGKAP
                                        <span class="text-danger">*</span>

                                    </label>

                                    <input type="text"
                                        class="form-control form-control-custom @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
                                        placeholder="Masukkan nama lengkap">

                                    @error('name')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <!-- Username -->
                                <div class="col-md-6 mb-3">

                                    <label for="username" class="form-label-custom">

                                        USERNAME
                                        <span class="text-danger">*</span>

                                    </label>

                                    <input type="text"
                                        class="form-control form-control-custom @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username', $user->username ?? '') }}"
                                        placeholder="Masukkan username">

                                    @error('username')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <!-- Email -->
                                <div class="col-md-6 mb-3">

                                    <label for="email" class="form-label-custom">

                                        EMAIL
                                        <span class="text-danger">*</span>

                                    </label>

                                    <input type="email"
                                        class="form-control form-control-custom @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                                        placeholder="Masukkan alamat email">

                                    @error('email')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <!-- Role / Hak Akses -->
                                <div class="col-md-6 mb-3">

                                    <label for="role" class="form-label-custom">

                                        ROLE / HAK AKSES
                                        <span class="text-danger">*</span>

                                    </label>

                                    <select class="form-select form-select-custom @error('role') is-invalid @enderror"
                                        id="role" name="role">

                                        <option value="" disabled
                                            {{ !old('role', $user->role ?? '') ? 'selected' : '' }}>

                                            -- Pilih Role --

                                        </option>

                                        <option value="admin"
                                            {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>

                                            Admin

                                        </option>

                                        <option value="operator"
                                            {{ old('role', $user->role ?? '') == 'operator' ? 'selected' : '' }}>

                                            Operator

                                        </option>

                                    </select>

                                    @error('role')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>


                                <!-- Status Pengguna -->
                                <div class="col-md-6 mb-3">

                                    <label for="status" class="form-label-custom">

                                        STATUS AKUN
                                        <span class="text-danger">*</span>

                                    </label>

                                    <select class="form-select form-select-custom @error('status') is-invalid @enderror"
                                        id="status" name="status">

                                        <option value="aktif"
                                            {{ old('status', $user->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>

                                            Aktif

                                        </option>

                                        <option value="tidak_aktif"
                                            {{ old('status', $user->status ?? '') == 'tidak_aktif' ? 'selected' : '' }}>
                                            Tidak Aktif
                                        </option>
                                    </select>

                                    @error('status')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label-custom">
                                        PASSWORD
                                        {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '*' }}
                                    </label>
                                    <input type="password"
                                        class="form-control form-control-custom @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Masukkan password">

                                    @error('password')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="foto" class="form-label-custom">FOTO PROFIL
                                    </label>
                                    <input type="file"
                                        class="form-control form-control-custom @error('foto') is-invalid @enderror"
                                        id="foto" name="foto" accept=".jpg,.jpeg,.png,.gif">

                                    @error('foto')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($user) ? 'Simpan Perubahan' : 'Tambah Pengguna' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
