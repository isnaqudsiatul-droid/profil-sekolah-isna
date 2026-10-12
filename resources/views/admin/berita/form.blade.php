@extends('layouts.admin')

@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')

@section('content')
    <style>
        /* Menyisakan style untuk interaksi hover, transisi, dan state khusus */
        .form-control-modern:focus {
            background-color: #ffffff !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
        }

        .upload-zone:hover {
            border-color: #4f46e5 !important;
            background: #f1f5f9 !important;
        }

        .btn-glow-primary:hover {
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px -4px rgba(79, 70, 229, 0.5) !important;
        }

        .btn-action-back:hover {
            background: #e2e8f0 !important;
            color: #1e293b !important;
            transform: translateY(-2px);
        }
    </style>

    <div class="page-content">
        <div class="container-fluid p-0">
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                <div>
                    <h3 class="font-weight-bold text-dark mb-1">
                        {{ isset($berita) ? 'Edit Data Berita' : 'Tambah Berita Baru' }}
                    </h3>
                    <p class="text-muted small mb-0">
                        {{ isset($berita) ? 'Perbarui informasi dan isi materi berita di dalam sistem.' : 'Lengkapi formulir di bawah ini untuk menerbitkan berita sekolah.' }}
                    </p>
                </div>
                <a href="{{ route('admin.berita.index') }}"
                    class="btn rounded-pill px-4 py-2 font-weight-bold d-inline-flex align-items-center shadow-sm"
                    style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; transition: all 0.25s ease; text-decoration: none !important;">
                    <i data-feather="arrow-left" width="16" class="mr-2"></i> Kembali
                </a>
            </div>

            <!-- Form Card Utama -->
            <div class="card border-0 overflow-hidden mb-4"
                style="border-radius: 1.75rem !important; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(226, 232, 240, 0.8); box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05) !important;">
                <div class="card-body p-4 p-md-5">
                    <form
                        action="{{ isset($berita) ? route('admin.berita.save', Crypt::encrypt($berita->id_berita)) : route('admin.berita.save') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <!-- Kolom Kiri: Konten Utama -->
                            <div class="col-lg-8">
                                <!-- Judul Berita -->
                                <div class="form-group mb-4">
                                    <label for="judul" class="form-label font-weight-bold text-dark mb-2">
                                        Judul Berita <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="judul" id="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        style="border-radius: 12px; border: 1px solid #e2e8f0; background-color: #f8fafc; padding: 0.75rem 1rem; transition: all 0.25s ease; font-size: 0.925rem;"
                                        value="{{ old('judul', $berita->judul ?? '') }}"
                                        placeholder="Tuliskan judul berita yang menarik..." required>
                                    @error('judul')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Isi Berita -->
                                <div class="form-group mb-4">
                                    <label for="isi" class="form-label font-weight-bold text-dark mb-2">
                                        Isi Berita Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="isi" rows="12"
                                        style="border-radius: 12px; border: 1px solid #e2e8f0; background-color: #f8fafc; padding: 0.75rem 1rem; transition: all 0.25s ease; font-size: 0.925rem;"
                                        placeholder="Tuliskan isi berita atau artikel secara rinci di sini..." required>{{ old('isi', $berita->isi ?? '') }}</textarea>
                                    @error('isi')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan: Pengaturan Media & Tanggal -->
                            <div class="col-lg-4">
                                <div class="p-3 bg-light border mb-4" style="border-radius: 1.5rem !important;">
                                    <!-- Tanggal Berita -->
                                    <div class="form-group mb-4">
                                        <label for="tanggal" class="form-label font-weight-bold text-dark mb-2">
                                            <i data-feather="calendar" width="14" class="mr-1 text-primary"></i> Tanggal
                                            Publikasi <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" name="tanggal" id="tanggal"
                                            class="form-control @error('tanggal') is-invalid @enderror"
                                            style="border-radius: 12px; border: 1px solid #e2e8f0; background-color: #f8fafc; padding: 0.75rem 1rem; transition: all 0.25s ease; font-size: 0.925rem;"
                                            value="{{ old('tanggal', $berita->tanggal ?? date('Y-m-d')) }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status Berita -->
                                    <div class="form-group mb-4">
                                        <label for="status" class="form-label font-weight-bold text-dark mb-2">
                                            <i data-feather="check-circle" width="14" class="mr-1 text-primary"></i>
                                            Status Publikasi <span class="text-danger">*</span>
                                        </label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror"
                                            style="border-radius: 12px; border: 1px solid #e2e8f0; background-color: #f8fafc; padding: 0.75rem 1rem; transition: all 0.25s ease; font-size: 0.925rem;"
                                            required>
                                            <option value="draft"
                                                {{ old('status', $berita->status ?? '') == 'draft' ? 'selected' : '' }}>
                                                Draft (Disimpan)</option>
                                            <option value="public"
                                                {{ old('status', $berita->status ?? '') == 'public' ? 'selected' : '' }}>
                                                Public (Terbitkan)</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Upload Foto Sampul / Gambar -->
                                    <div class="form-group mb-2">
                                        <label class="form-label font-weight-bold text-dark mb-2">
                                            <i data-feather="image" width="14" class="mr-1 text-primary"></i> Foto
                                            Sampul / Header
                                        </label>

                                        <!-- Upload Area -->
                                        <div class="upload-zone mb-2"
                                            style="border: 2px dashed #cbd5e1; border-radius: 16px; background: #f8fafc; padding: 1.5rem; text-align: center; cursor: pointer; transition: all 0.25s ease; position: relative;">
                                            <input type="file" name="gambar" id="gambar" accept="image/*"
                                                onchange="previewImage(event)"
                                                style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer;">
                                            <div class="p-2">
                                                <div class="p-2 rounded-circle d-inline-flex mb-2"
                                                    style="background: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                                                    <i data-feather="upload-cloud" width="22"></i>
                                                </div>
                                                <div class="small font-weight-bold text-dark">Klik atau tarik foto ke sini
                                                </div>
                                                <span class="text-muted small d-block" style="font-size: 0.75rem;">JPG,
                                                    JPEG, PNG (Maks: 2MB)</span>
                                            </div>
                                        </div>
                                        @error('gambar')
                                            <div class="invalid-feedback d-block mb-2">{{ $message }}</div>
                                        @enderror

                                        <!-- Image Live / Existing Preview -->
                                        <div id="preview-wrapper"
                                            class="{{ isset($berita) && $berita->gambar ? '' : 'd-none' }} mt-3">
                                            <span class="small font-weight-bold text-muted d-block mb-1">Pratinjau
                                                Gambar:</span>
                                            <div class="preview-container shadow-sm"
                                                style="position: relative; border-radius: 16px; overflow: hidden; max-height: 200px; background: #0f172a;">
                                                <img id="img-preview"
                                                    src="{{ isset($berita) && $berita->gambar ? asset('storage/' . $berita->gambar) : '' }}"
                                                    alt="Preview Image"
                                                    style="width: 100%; height: 200px; object-fit: cover;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Divider & Action Buttons -->
                        <hr class="my-4 border-light">

                        <div class="d-flex justify-content-end align-items-center" style="gap: 10px;">
                            <button type="submit"
                                class="btn btn-primary px-4 py-2 font-weight-bold d-inline-flex align-items-center">
                                <i data-feather="save" width="16" class="mr-2"></i>
                                {{ isset($berita) ? 'Simpan Perubahan' : 'Terbitkan Berita' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- JavaScript untuk Live Preview Gambar -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const previewWrapper = document.getElementById('preview-wrapper');
            const imgPreview = document.getElementById('img-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                    previewWrapper.classList.remove('d-none');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
