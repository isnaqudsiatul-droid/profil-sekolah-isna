@extends('layouts.admin')
@section('title', $title)

@section('content')
    <style>
        .form-control:focus {
            border-color: #435ebe;
            box-shadow: 0 0 0 3px rgba(67, 94, 190, 0.15);
        }

        .upload-box:hover {
            border-color: #435ebe;
            background: #f1f5f9;
        }

        .btn-modern-save:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 94, 190, 0.4);
        }

        .btn-modern-back:hover {
            background: #e2e8f0;
            color: #1e293b;
        }
    </style>

    <div class="main-content container-fluid p-0">
        <!-- Page Header -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
            <div>
                <h4 class="font-weight-bold text-dark mb-1">Edit Profil Sekolah</h4>
                <p class="text-muted small mb-0">Perbarui data profil lembaga sesuai dengan informasi terbaru.</p>
            </div>
            <div>
                <a href="{{ route('admin.profil.index') }}" class="btn btn-light btn-modern-back">
                    <i data-feather="arrow-left" width="16"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="glass-card shadow-sm" style="background: #ffffff; border-radius: 16px; border: 1px solid #eef2f5;">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.profil.update', $profilSekolah->id_profil) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Section 1: Informasi Utama -->
                    <div class="form-section-title"
                        style="font-size: 0.95rem; font-weight: 700; color: #343a40; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i data-feather="info" width="18" class="text-primary"></i> Informasi Utama & Pimpinan
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;"
                                value="{{ old('nama_sekolah', $profilSekolah->nama_sekolah ?? '') }}" required>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Nama Kepala Sekolah</label>
                            <input type="text" name="nama_kepala_sekolah" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;"
                                value="{{ old('nama_kepala_sekolah', $profilSekolah->nama_kepala_sekolah ?? '') }}">
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">NPSN</label>
                            <input type="text" name="npsn" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;"
                                value="{{ old('npsn', $profilSekolah->npsn ?? '') }}" required>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Kontak / No. Telepon</label>
                            <input type="text" name="kontak" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;"
                                value="{{ old('kontak', $profilSekolah->kontak ?? '') }}">
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Tahun Berdiri</label>
                            <input type="number" name="tahun_berdiri" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;"
                                value="{{ old('tahun_berdiri', $profilSekolah->tahun_berdiri ?? '') }}">
                        </div>
                    </div>

                    <!-- Section 2: Berkas & Media (Logo, Foto Kepsek, Foto Gedung) -->
                    <div class="form-section-title"
                        style="font-size: 0.95rem; font-weight: 700; color: #343a40; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i data-feather="image" width="18" class="text-primary"></i> Berkas Foto & Logo
                    </div>
                    <div class="row mb-4">
                        <!-- Upload Logo -->
                        <div class="col-md-4 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Logo Sekolah</label>
                            <div class="upload-box"
                                style="border: 2px dashed #cbd5e1; border-radius: 12px; background: #f8fafc; padding: 16px; text-align: center;">
                                <input type="file" name="logo" class="form-control-file mb-2">
                                @if (isset($profilSekolah->logo) && $profilSekolah->logo)
                                    <div class="mt-2 p-2 bg-white rounded border d-inline-block">
                                        <img src="{{ asset('storage/' . $profilSekolah->logo) }}" alt="Logo"
                                            style="max-height: 60px; object-fit: contain;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Upload Foto Kepala Sekolah -->
                        <div class="col-md-4 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Foto Kepala Sekolah</label>
                            <div class="upload-box"
                                style="border: 2px dashed #cbd5e1; border-radius: 12px; background: #f8fafc; padding: 16px; text-align: center;">
                                <input type="file" name="foto_kepala_sekolah" class="form-control-file mb-2">
                                @if (isset($profilSekolah->foto_kepala_sekolah) && $profilSekolah->foto_kepala_sekolah)
                                    <div class="mt-2 p-2 bg-white rounded border d-inline-block">
                                        <img src="{{ asset('storage/' . $profilSekolah->foto_kepala_sekolah) }}"
                                            alt="Foto Kepsek" style="max-height: 60px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Upload Foto Gedung -->
                        <div class="col-md-4 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Foto Gedung Sekolah</label>
                            <div class="upload-box"
                                style="border: 2px dashed #cbd5e1; border-radius: 12px; background: #f8fafc; padding: 16px; text-align: center;">
                                <input type="file" name="foto" class="form-control-file mb-2">
                                @if (isset($profilSekolah->foto) && $profilSekolah->foto)
                                    <div class="mt-2 p-2 bg-white rounded border d-inline-block">
                                        <img src="{{ asset('storage/' . $profilSekolah->foto) }}" alt="Foto Gedung"
                                            style="max-height: 60px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Detail Alamat & Narasi Terpisah -->
                    <div class="form-section-title"
                        style="font-size: 0.95rem; font-weight: 700; color: #343a40; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i data-feather="file-text" width="18" class="text-primary"></i> Alamat & Narasi Profil
                    </div>

                    <div class="row mb-4">
                        <div class="col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;" rows="2">{{ old('alamat', $profilSekolah->alamat ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Visi Sekolah</label>
                            <textarea name="visi" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;" rows="3">{{ old('visi', $profilSekolah->visi ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Misi Sekolah</label>
                            <textarea name="misi" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;" rows="3">{{ old('misi', $profilSekolah->misi ?? '') }}</textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="font-weight-bold text-dark small mb-2">Deskripsi Sekolah</label>
                            <textarea name="deskripsi" class="form-control"
                                style="border-radius: 10px; border: 1.5px solid #e2e8f0; padding: 10px 14px;" rows="4">{{ old('deskripsi', $profilSekolah->deskripsi ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="fw-bold mb-3">Tautan Media Sosial</h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Link TikTok</label>
                            <input type="text" name="tiktok" class="form-control"
                                value="{{ $profilSekolah->tiktok ?? '' }}" placeholder="https://tiktok.com/@username">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Link Instagram</label>
                            <input type="text" name="instagram" class="form-control"
                                value="{{ $profilSekolah->instagram ?? '' }}" placeholder="https://instagram.com/username">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Link Facebook</label>
                            <input type="text" name="facebook" class="form-control"
                                value="{{ $profilSekolah->facebook ?? '' }}" placeholder="https://facebook.com/namapage">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Link YouTube</label>
                            <input type="text" name="youtube" class="form-control"
                                value="{{ $profilSekolah->youtube ?? '' }}" placeholder="https://youtube.com/@channel">
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
