@extends('layouts.admin')

@section('title', isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa')

@section('content')
    <style>
        /* Hanya menyisakan style untuk hover, transisi, dan state focus */
        .form-modern .form-control:focus,
        .form-modern .custom-select:focus {
            background-color: #ffffff;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }
        .btn-purple-pill:hover {
            background-color: #4338ca;
            color: #ffffff;
            transform: translateY(-1px);
        }
        .btn-light-pill:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            border-color: #94a3b8;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">

            <!-- Header Tanpa Background Dark -->
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                <div>
                    <h3 class="font-weight-bold text-dark mb-1">
                        {{ isset($siswa) ? 'Edit Data Siswa' : 'Tambah Data Siswa' }}
                    </h3>
                    <p class="text-muted small mb-0">
                        {{ isset($siswa) ? 'Perbarui informasi data siswa di dalam sistem.' : 'Tambahkan data siswa baru ke dalam sistem.' }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.siswa.index') }}" 
                       class="btn d-inline-flex align-items-center btn-light-pill" 
                       style="background-color: #ffffff; color: #475569; border: 1px solid #cbd5e1; border-radius: 2rem; padding: 0.6rem 1.4rem; font-weight: 600; font-size: 0.875rem; transition: all 0.2s ease; text-decoration: none !important;">
                        <i data-feather="arrow-left" width="16" class="mr-1.5"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Main Form Card Container -->
            <div class="card p-4 mb-4" style="background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px -5px rgba(0, 0, 0, 0.03);">
                <form action="{{ isset($siswa) ? route('admin.siswa.save', Crypt::encrypt($siswa->id_siswa)) : route('admin.siswa.save') }}"
                      method="POST" class="form-modern">
                    @csrf

                    <div class="row">
                        <!-- NISN -->
                        <div class="col-md-6 mb-4">
                            <label for="nisn" class="form-label" style="color: #475569; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 0.5rem; display: block;">NISN</label>
                            <input type="text" 
                                   name="nisn" 
                                   id="nisn" 
                                   class="form-control @error('nisn') is-invalid @enderror" 
                                   style="border-radius: 0.625rem; border: 1px solid #cbd5e1; padding: 0.65rem 1rem; font-size: 0.875rem; color: #1e293b; background-color: #f8fafc; transition: all 0.2s ease; height: auto;"
                                   value="{{ old('nisn', $siswa->nisn ?? '') }}" 
                                   placeholder="Masukkan NISN siswa">
                            @error('nisn')
                                <div class="invalid-feedback mt-1 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Siswa -->
                        <div class="col-md-6 mb-4">
                            <label for="nama_siswa" class="form-label" style="color: #475569; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 0.5rem; display: block;">Nama Siswa <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nama_siswa" 
                                   id="nama_siswa" 
                                   class="form-control @error('nama_siswa') is-invalid @enderror" 
                                   style="border-radius: 0.625rem; border: 1px solid #cbd5e1; padding: 0.65rem 1rem; font-size: 0.875rem; color: #1e293b; background-color: #f8fafc; transition: all 0.2s ease; height: auto;"
                                   value="{{ old('nama_siswa', $siswa->nama_siswa ?? '') }}" 
                                   placeholder="Masukkan nama lengkap siswa" 
                                   required>
                            @error('nama_siswa')
                                <div class="invalid-feedback mt-1 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Jenis Kelamin -->
                        <div class="col-md-6 mb-4">
                            <label for="jenis_kelamin" class="form-label" style="color: #475569; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 0.5rem; display: block;">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" 
                                    id="jenis_kelamin" 
                                    class="custom-select form-control @error('jenis_kelamin') is-invalid @enderror" 
                                    style="border-radius: 0.625rem; border: 1px solid #cbd5e1; padding: 0.65rem 1rem; padding-right: 2.5rem; font-size: 0.875rem; color: #1e293b; background-color: #f8fafc; transition: all 0.2s ease; height: auto; background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e&quot;); background-repeat: no-repeat; background-position: right 1rem center; background-size: 16px 12px;"
                                    required>
                                <option value="" disabled {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback mt-1 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tahun Masuk -->
                        <div class="col-md-6 mb-4">
                            <label for="tahun_masuk" class="form-label" style="color: #475569; font-size: 0.8125rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 0.5rem; display: block;">Tahun Masuk</label>
                            <input type="text" 
                                   name="tahun_masuk" 
                                   id="tahun_masuk" 
                                   class="form-control @error('tahun_masuk') is-invalid @enderror" 
                                   style="border-radius: 0.625rem; border: 1px solid #cbd5e1; padding: 0.65rem 1rem; font-size: 0.875rem; color: #1e293b; background-color: #f8fafc; transition: all 0.2s ease; height: auto;"
                                   value="{{ old('tahun_masuk', $siswa->tahun_masuk ?? '') }}" 
                                   placeholder="Contoh: 2024">
                            @error('tahun_masuk')
                                <div class="invalid-feedback mt-1 font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="pt-3 border-top d-flex justify-content-end align-items-center">
                        <button type="submit" 
                                class="btn btn-primary d-inline-flex align-items-center">
                            <i data-feather="save" width="16" class="mr-1.5"></i>
                            {{ isset($siswa) ? 'Simpan Perubahan' : 'Simpan Data' }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection