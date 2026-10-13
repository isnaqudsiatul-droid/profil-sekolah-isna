@extends('layouts.admin')
@section('title', isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri')

@section('content')
<style>
    /* Styling Clean / Modern Minimalis Form */
    .rounded-2xl { border-radius: 1.25rem !important; }
    .rounded-3xl { border-radius: 1.5rem !important; }

    /* Tag Soft Indigo */
    .tag-category-pill {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* Input Custom Focus Style */
    .form-control-modern {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.65rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background-color: #f8fafc;
    }
    .form-control-modern:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Tombol Kembali Soft */
    .btn-soft-secondary {
        background-color: #ffffff;
        color: #64748b;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-soft-secondary:hover {
        background-color: #f8fafc;
        color: #1e293b;
        border-color: #cbd5e1;
    }
</style>

<div class="page-content">
    <div class="container-fluid p-0">
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <h2 class="font-weight-bold text-dark mb-1">
                    {{ isset($galeri) ? 'Edit Data Galeri' : 'Tambah Data Galeri' }}
                </h2>
                <p class="text-muted small mb-0">
                    {{ isset($galeri) ? 'Perbarui rincian informasi galeri dokumentasi sekolah.' : 'Unggah foto atau video baru ke dalam galeri sekolah.' }}
                </p>
            </div>
            <div>
                <a href="{{ route('admin.galeri.index') }}" class="btn btn-soft-secondary shadow-sm d-inline-flex align-items-center">
                    <i data-feather="arrow-left" width="15" class="mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Card Form Utama -->
        <div class="card border-0 rounded-3xl shadow-sm overflow-hidden mb-4" style="background: #ffffff;">
            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($galeri) ? route('admin.galeri.save', Crypt::encrypt($galeri->id_galeri)) : route('admin.galeri.save') }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        
                        <!-- Judul Galeri -->
                        <div class="col-md-6 mb-3">
                            <label for="judul" class="form-label font-weight-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                Judul Galeri <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   id="judul" 
                                   class="form-control form-control-modern @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $galeri->judul ?? '') }}" 
                                   placeholder="Contoh: Perayaan HUT RI ke-79" required>
                            @error('judul')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label font-weight-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="kategori" 
                                    id="kategori" 
                                    class="form-control form-control-modern @error('kategori') is-invalid @enderror" required>
                                <option value="" disabled {{ old('kategori', $galeri->kategori ?? '') == '' ? 'selected' : '' }}>-- Pilih Kategori --</option>
                                <option value="Foto" {{ old('kategori', $galeri->kategori ?? '') == 'Foto' ? 'selected' : '' }}>Foto</option>
                                <option value="Video" {{ old('kategori', $galeri->kategori ?? '') == 'Video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Kegiatan -->
                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label font-weight-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                Tanggal Kegiatan <span class="text-danger">*</span>
                            </label>
                            <input type="date" 
                                   name="tanggal" 
                                   id="tanggal" 
                                   class="form-control form-control-modern @error('tanggal') is-invalid @enderror" 
                                   value="{{ old('tanggal', $galeri->tanggal ?? '') }}" 
                                   required>
                            @error('tanggal')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pilihan Sumber Video (Hanya muncul jika kategori Video dipilih) -->
                        <div class="col-md-6 mb-3" id="sumberVideoContainer" style="display: none;">
                            <label for="sumber_video" class="form-label font-weight-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                Sumber Video <span class="text-danger">*</span>
                            </label>
                            <select name="sumber_video" id="sumberVideoSelect" class="form-control form-control-modern">
                                <option value="file" {{ (isset($galeri) && !empty($galeri->file) && empty($galeri->link_video)) ? 'selected' : '' }}>Upload File Video (MP4)</option>
                                <option value="link" {{ (isset($galeri) && !empty($galeri->link_video)) ? 'selected' : '' }}>Link YouTube</option>
                            </select>
                        </div>

                        <!-- Upload File (Foto / Video Lokal) -->
                        <div class="col-md-6 mb-3" id="inputFileContainer">
                            <label for="file" class="form-label font-weight-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                {{ isset($galeri) ? 'Ganti File Media' : 'Upload File Media' }}
                            </label>
                            <input type="file" 
                                   name="file" 
                                   id="file" 
                                   class="form-control form-control-modern @error('file') is-invalid @enderror" 
                                   accept="image/*,video/mp4,video/mov">
                            <small class="form-text text-muted mt-1" id="fileHelpText">Format Foto: JPG, PNG | Format Video: MP4 (Maks: 10MB).</small>
                            @error('file')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror

                            <!-- Preview file jika mode edit -->
                            @if(isset($galeri) && $galeri->file && file_exists(public_path('storage/' . $galeri->file)))
                                <div class="mt-3 p-2 bg-light rounded-2xl d-inline-block border">
                                    @if($galeri->kategori == 'Video')
                                        <video width="140" class="rounded-xl img-fluid" controls>
                                            <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                        </video>
                                    @else
                                        <img src="{{ asset('storage/' . $galeri->file) }}" 
                                             alt="{{ $galeri->judul }}" 
                                             class="rounded-xl img-fluid" 
                                             style="max-width: 140px; height: auto; max-height: 100px; object-fit: cover;">
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Input Link YouTube (Hanya muncul jika sumber video adalah Link) -->
                        <div class="col-md-6 mb-3" id="inputLinkContainer" style="display: none;">
                            <label for="link_video" class="form-label font-weight-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                Link YouTube <span class="text-danger">*</span>
                            </label>
                            <input type="url" 
                                   name="link_video" 
                                   id="link_video" 
                                   class="form-control form-control-modern @error('link_video') is-invalid @enderror" 
                                   value="{{ old('link_video', $galeri->link_video ?? '') }}" 
                                   placeholder="Contoh: https://www.youtube.com/watch?v=xxxxxx">
                            <small class="form-text text-muted mt-1">Tempel tautan video YouTube secara lengkap.</small>
                            @error('link_video')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Keterangan / Deskripsi -->
                        <div class="col-12 mb-3">
                            <label for="keterangan" class="form-label font-weight-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                Keterangan / Deskripsi
                            </label>
                            <textarea class="form-control form-control-modern @error('keterangan') is-invalid @enderror" 
                                      name="keterangan" 
                                      id="keterangan" 
                                      rows="4" 
                                      placeholder="Tuliskan keterangan singkat atau rincian kegiatan mengenai dokumentasi galeri ini...">{{ old('keterangan', $galeri->keterangan ?? '') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Tombol Aksi Form -->
                    <div class="d-flex justify-content-end align-items-center mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                            <i data-feather="save" width="16" class="mr-2"></i>
                            {{ isset($galeri) ? 'Simpan Perubahan' : 'Simpan Data' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<!-- Script JavaScript untuk interaksi form dinamis kategori & sumber video -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const kategoriSelect = document.getElementById('kategori');
        const sumberVideoContainer = document.getElementById('sumberVideoContainer');
        const sumberVideoSelect = document.getElementById('sumberVideoSelect');
        const inputFileContainer = document.getElementById('inputFileContainer');
        const inputLinkContainer = document.getElementById('inputLinkContainer');
        const fileHelpText = document.getElementById('fileHelpText');

        function updateFormVisibility() {
            if (kategoriSelect.value === 'Video') {
                sumberVideoContainer.style.display = 'block';
                if (sumberVideoSelect.value === 'link') {
                    inputFileContainer.style.display = 'none';
                    inputLinkContainer.style.display = 'block';
                } else {
                    inputFileContainer.style.display = 'block';
                    inputLinkContainer.style.display = 'none';
                    fileHelpText.textContent = 'Format Video: MP4, MOV (Maks: 10MB).';
                }
            } else {
                sumberVideoContainer.style.display = 'none';
                inputFileContainer.style.display = 'block';
                inputLinkContainer.style.display = 'none';
                fileHelpText.textContent = 'Format: JPG, JPEG, PNG (Maks: 2MB).';
            }
        }

        kategoriSelect.addEventListener('change', updateFormVisibility);
        sumberVideoSelect.addEventListener('change', updateFormVisibility);
        
        // Jalankan fungsi saat halaman dimuat (berguna saat mode edit)
        updateFormVisibility();
    });
</script>
@endsection