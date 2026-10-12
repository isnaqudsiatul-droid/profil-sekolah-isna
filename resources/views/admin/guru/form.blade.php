@extends('layouts.admin')

@section('title', isset($guru) ? 'Edit Guru' : 'Tambah Guru')

@section('content')
<style>
    /* Hanya menyisakan style untuk hover, focus states, dan transisi */
    .form-control-modern:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }
    .dashed-upload-box:hover {
        border-color: #6366f1;
        background-color: #eef2ff;
    }
    .btn-back-clean:hover {
        background-color: #f8fafc;
        color: #0f172a;
    }
    .btn-glow-primary:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 12px 22px -4px rgba(79, 70, 229, 0.45);
    }
</style>

<div class="page-content">
    <div class="container-fluid p-0">
        
        <!-- Header Atas -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="font-weight-bold text-dark mb-1">
                    {{ isset($guru) ? 'Edit Data Guru' : 'Tambah Guru Baru' }}
                </h2>
                <p class="text-muted small mb-0">
                    {{ isset($guru) ? 'Perbarui informasi data guru di dalam sistem.' : 'Isi formulir berikut untuk menambahkan data guru sekolah.' }}
                </p>
            </div>
            <a href="{{ route('admin.guru.index') }}" class="btn shadow-sm d-inline-flex align-items-center btn-back-clean" style="background-color: #ffffff; border: 1px solid #e2e8f0; color: #475569; font-weight: 600; border-radius: 2rem; padding: 0.5rem 1.25rem; transition: all 0.2s ease; font-size: 0.875rem; text-decoration: none !important;">
                <i data-feather="arrow-left" width="15" class="mr-2"></i> Kembali
            </a>
        </div>

        <!-- Single Card Form Utuh -->
        <div class="card p-4 p-md-5 mb-4" style="background: #ffffff; border-radius: 1.25rem; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.03);">
            <form action="{{ isset($guru) ? route('admin.guru.save', Crypt::encrypt($guru->id_guru)) : route('admin.guru.save') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf

                <!-- Baris 1: NIP & Mata Pelajaran -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="nip" class="form-label font-weight-bold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">
                            NIP (NOMOR INDUK PEGAWAI)
                        </label>
                        <input type="text" 
                               name="nip" 
                               id="nip" 
                               class="form-control form-control-modern @error('nip') is-invalid @enderror" 
                               style="border-radius: 0.75rem; border: 1px solid #f1f5f9; padding: 0.75rem 1rem; transition: all 0.2s ease; background-color: #f8fafc; color: #1e293b; font-size: 0.875rem;"
                               value="{{ old('nip', $guru->nip ?? '') }}" 
                               placeholder="Contoh: 198203102008011002">
                        @error('nip')
                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="mapel" class="form-label font-weight-bold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">
                            MATA PELAJARAN / AMBUM
                        </label>
                        <input type="text" 
                               name="mapel" 
                               id="mapel" 
                               class="form-control form-control-modern @error('mapel') is-invalid @enderror" 
                               style="border-radius: 0.75rem; border: 1px solid #f1f5f9; padding: 0.75rem 1rem; transition: all 0.2s ease; background-color: #f8fafc; color: #1e293b; font-size: 0.875rem;"
                               value="{{ old('mapel', $guru->mapel ?? '') }}" 
                               placeholder="Contoh: Matematika, Pemrograman Web">
                        @error('mapel')
                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Baris 2: Nama Guru & Upload Foto -->
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4">
                        <label for="nama_guru" class="form-label font-weight-bold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">
                            NAMA LENGKAP GURU <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="nama_guru" 
                               id="nama_guru" 
                               class="form-control form-control-modern @error('nama_guru') is-invalid @enderror" 
                               style="border-radius: 0.75rem; border: 1px solid #f1f5f9; padding: 0.75rem 1rem; transition: all 0.2s ease; background-color: #f8fafc; color: #1e293b; font-size: 0.875rem;"
                               value="{{ old('nama_guru', $guru->nama_guru ?? '') }}" 
                               placeholder="Tuliskan nama lengkap beserta gelar..." 
                               required>
                        @error('nama_guru')
                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="foto" class="form-label font-weight-bold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">
                            FOTO PROFIL / PAS FOTO
                        </label>
                        
                        <!-- Box Upload Putus-Putus Sesuai Acuan -->
                        <div class="dashed-upload-box" style="background-color: #f8fafc; border: 2px dashed #c7d2fe; border-radius: 0.875rem; padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem; transition: all 0.2s ease;">
                            <div class="bg-white p-2 rounded-circle border shadow-sm flex-shrink-0">
                                <img id="imagePreview" 
                                     src="{{ isset($guru) && $guru->foto && file_exists(public_path('storage/' . $guru->foto)) ? asset('storage/' . $guru->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($guru->nama_guru ?? 'Guru') . '&background=f1f5f9&color=475569' }}" 
                                     alt="Preview Foto"
                                     class="rounded-circle"
                                     style="width: 38px; height: 38px; object-fit: cover;">
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <input type="file" 
                                       name="foto" 
                                       id="foto" 
                                       class="form-control-file text-muted small @error('foto') is-invalid @enderror" 
                                       accept="image/png, image/jpeg, image/jpg"
                                       onchange="previewFile(this)">
                                <div class="text-muted" style="font-size: 0.725rem;">Format: JPG, JPEG, PNG (Maks. 2MB)</div>
                            </div>
                        </div>

                        @error('foto')
                            <div class="text-danger small font-weight-bold mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="d-flex justify-content-end align-items-center mt-3 pt-3 border-top">
                    <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                        <i data-feather="save" width="16" class="mr-2"></i>
                        {{ isset($guru) ? 'Simpan Perubahan' : 'Simpan Data Guru' }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    function previewFile(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection