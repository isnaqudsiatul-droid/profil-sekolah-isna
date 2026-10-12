@extends('layouts.admin')
@section('title', isset($ekstrakurikuler) ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler')

@section('content')
<style>
    /* Custom Styling Form Clean & Modern */
    .rounded-2xl { border-radius: 1.25rem !important; }
    .rounded-3xl { border-radius: 1.5rem !important; }

    /* Badge Tag Header */
    .tag-category-pill {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
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
c
    /* Label Styling */
    .form-label-modern {
        font-size: 0.8rem;
        font-weight: 700;
        color: #334155;
        letter-spacing: 0.3px;
        margin-bottom: 8px;
        display: block;
    }

    /* Input & Select Custom */
    .form-control-modern, .form-select-modern {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 12px 16px;
        color: #1e293b;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .form-control-modern:focus, .form-select-modern:focus {
        background-color: #ffffff;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Upload Box Kustom */
    .upload-area-clean {
        background-color: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 24px;
        transition: all 0.2s ease;
    }
    .upload-area-clean:hover {
        border-color: #6366f1;
        background-color: #eef2ff;
    }

    /* Tombol Simpan Utama */
    .btn-primary-glow {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
        color: #ffffff;
        border: none;
        border-radius: 50px;
        padding: 10px 28px;
        font-weight: 600;
        box-shadow: 0 8px 18px -4px rgba(79, 70, 229, 0.35);
        transition: all 0.2s ease;
    }
    .btn-primary-glow:hover {
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 12px 22px -4px rgba(79, 70, 229, 0.45);
    }
</style>

<div class="page-content">
    <div class="container-fluid p-0">
        
        <!-- Header Halaman Minimalis (Tanpa Banner Gelap) -->
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
            <div>
                <h2 class="font-weight-bold text-dark mb-1">
                    {{ isset($ekstrakurikuler) ? 'Edit Data Ekstrakurikuler' : 'Tambah Ekstrakurikuler Baru' }}
                </h2>
                <p class="text-muted small mb-0">Isi formulir berikut untuk {{ isset($ekstrakurikuler) ? 'memperbarui informasi' : 'menambahkan kegiatan' }} ekstrakurikuler sekolah.</p>
            </div>
            <a href="{{ route('admin.ekskul.index') }}" class="btn btn-soft-secondary shadow-sm d-inline-flex align-items-center">
                <i data-feather="arrow-left" width="15" class="mr-2"></i> Kembali
            </a>
        </div>

        <!-- Form Card Utama -->
        <div class="card border-0 rounded-3xl shadow-sm overflow-hidden mb-4" style="background: #ffffff;">
            <div class="card-body p-4 p-md-5">
                <form action="{{ isset($ekstrakurikuler) ? route('admin.ekskul.save', Crypt::encrypt($ekstrakurikuler->id_ekskul ?? $ekstrakurikuler->id)) : route('admin.ekskul.save') }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <!-- Nama Ekstrakurikuler -->
                        <div class="col-md-6 mb-3">
                            <label for="nama_ekskul" class="form-label-modern">
                                NAMA EKSTRAKURIKULER <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_ekskul" 
                                   id="nama_ekskul" 
                                   class="form-control form-control-modern @error('nama_ekskul') is-invalid @enderror" 
                                   value="{{ old('nama_ekskul', $ekstrakurikuler->nama_ekskul ?? '') }}" 
                                   placeholder="Contoh: Pramuka, Paskibra, Basket" 
                                   required>
                            @error('nama_ekskul')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pembina / Guru Pendamping -->
                        <div class="col-md-6 mb-3">
                            <label for="id_guru" class="form-label-modern">
                                PEMBINA / GURU PENDAMPING <span class="text-danger">*</span>
                            </label>
                            <select name="id_guru" id="id_guru" class="form-control form-select-modern @error('id_guru') is-invalid @enderror" required>
                                <option value="" disabled {{ old('id_guru', $ekstrakurikuler->id_guru ?? '') == '' ? 'selected' : '' }}>-- Pilih Pembina --</option>
                                @foreach($guru as $guruItem)
                                    <option value="{{ $guruItem->id_guru }}" {{ old('id_guru', $ekstrakurikuler->id_guru ?? '') == $guruItem->id_guru ? 'selected' : '' }}>
                                        {{ $guruItem->nama ?? $guruItem->nama_guru }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_guru')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- Jadwal Latihan -->
                        <div class="col-md-6 mb-3">
                            <label for="jadwal_latihan" class="form-label-modern">
                                JADWAL LATIHAN <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="jadwal_latihan" 
                                   id="jadwal_latihan" 
                                   class="form-control form-control-modern @error('jadwal_latihan') is-invalid @enderror" 
                                   value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan ?? '') }}" 
                                   placeholder="Contoh: Setiap Jumat, 15:00 WIB" 
                                   required>
                            @error('jadwal_latihan')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto / Logo -->
                        <div class="col-md-6 mb-3">
                            <label for="gambar" class="form-label-modern">
                                FOTO / LOGO EKSTRAKURIKULER
                            </label>
                            <div class="upload-area-clean d-flex align-items-center gap-3">
                                @if(isset($ekstrakurikuler) && $ekstrakurikuler->gambar && file_exists(public_path('storage/' . $ekstrakurikuler->gambar)))
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" 
                                             alt="Preview" 
                                             class="rounded-circle shadow-sm border" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="flex-shrink-0 bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 50px; height: 50px;">
                                        <i data-feather="image" class="text-muted" width="20"></i>
                                    </div>
                                @endif

                                <div class="flex-grow-1">
                                    <input type="file" 
                                           name="gambar" 
                                           id="gambar" 
                                           class="form-control-file @error('gambar') is-invalid @enderror" 
                                           accept="image/*">
                                    <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                        Format: JPG, JPEG, PNG (Maks: 2MB). {{ isset($ekstrakurikuler) ? 'Biarkan kosong jika tidak diubah.' : '' }}
                                    </small>
                                </div>
                            </div>
                            @error('gambar')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi Ekstrakurikuler -->
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="deskripsi" class="form-label-modern">
                                DESKRIPSI EKSTRAKURIKULER <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control form-control-modern @error('deskripsi') is-invalid @enderror" 
                                      name="deskripsi" 
                                      id="deskripsi" 
                                      rows="5" 
                                      placeholder="Tuliskan penjelasan kegiatan ekstrakurikuler ini..." 
                                      required>{{ old('deskripsi', $ekstrakurikuler->deskripsi ?? '') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4" style="border-top: 1px solid #f1f5f9;">

                    <!-- Tombol Aksi Bawah -->
                    <div class="d-flex justify-content-end align-items-center gap-2">
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                            <i data-feather="save" width="16" class="mr-2"></i>
                            {{ isset($ekstrakurikuler) ? 'Simpan Perubahan' : 'Simpan Data' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection