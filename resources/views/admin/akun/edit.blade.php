@extends('layouts.admin')

@section('title', $title)

@section('content')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #435ebe 0%, #25396f 100%);
    }
    .rounded-xl {
        border-radius: 1.25rem !important;
    }
    .rounded-2xl {
        border-radius: 1.75rem !important;
    }
    .soft-shadow {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
    }
    .btn-header-action {
        transition: all 0.25s ease-in-out;
    }
    .btn-header-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2) !important;
    }
    .btn-header-action:active {
        transform: translateY(0);
    }
    .form-control-soft {
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    .form-control-soft:focus {
        background-color: #fff;
        border-color: #435ebe;
        box-shadow: 0 0 0 4px rgba(67, 94, 190, 0.1);
    }
    .avatar-upload {
        position: relative;
        max-width: 130px;
        margin: 0 auto;
    }
    .avatar-edit {
        position: absolute;
        right: 0;
        bottom: 0;
        z-index: 1;
    }
    .avatar-edit input {
        display: none;
    }
    .avatar-edit label {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        margin-bottom: 0;
        border-radius: 50%;
        background: #435ebe;
        color: #ffffff;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(67, 94, 190, 0.3);
        transition: all 0.2s ease;
    }
    .avatar-edit label:hover {
        transform: scale(1.08);
        background: #25396f;
    }
</style>

<div class="page-content">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            
            <!-- Banner Header & Edit Form Card -->
            <div class="card border-0 rounded-2xl soft-shadow overflow-hidden mb-4">
                
                <!-- Header Banner Gradien -->
                <div class="bg-gradient-primary p-4 p-md-5 position-relative">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h4 class="text-white font-weight-bold mb-1">Edit Profil Akun</h4>
                            <p class="text-white-50 small mb-0">Perbarui informasi data pribadi dan kata sandi akun Anda.</p>
                        </div>
                    </div>
                </div>

                <!-- Card Form Body -->
                <div class="card-body px-4 px-md-5 py-5">
                    <form action="{{ route('admin.akun.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Bagian Upload Foto Profil dengan Live Preview -->
                        <div class="text-center mb-5">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="fotoUpload" name="foto" accept=".png, .jpg, .jpeg" onchange="previewImage(event)" />
                                    <label for="fotoUpload" title="Ubah Foto">
                                        <i data-feather="camera" width="18"></i>
                                    </label>
                                </div>
                                <div class="avatar-preview">
                                    <img id="imagePreview" 
                                         src="{{ $user->foto && Storage::disk('public')->exists($user->foto) ? asset('storage/' . $user->foto) : asset('assets/images/faces/1.jpg') }}"
                                         alt="Avatar" 
                                         class="rounded-circle shadow-sm" 
                                         width="130" 
                                         height="130" 
                                         style="object-fit: cover; border: 4px solid #ffffff;">
                                </div>
                            </div>
                            <small class="text-muted d-block mt-2">Klik ikon kamera untuk mengubah foto (JPG, PNG, max 2MB)</small>
                            @error('foto')
                                <span class="text-danger small d-block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Informasi Data Diri -->
                        <div class="mb-4">
                            <h6 class="font-weight-bold text-dark mb-3">
                                <i data-feather="user" width="16" class="mr-1 text-primary"></i> Data Diri
                            </h6>
                            
                            <div class="row">
                                <!-- Nama Lengkap -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label font-weight-bold text-muted small">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-soft @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama lengkap">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Username -->
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label font-weight-bold text-muted small">Username</label>
                                    <input type="text" name="username" id="username" class="form-control form-control-soft @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required placeholder="Masukkan username">
                                    @error('username')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 border-light">

                        <!-- Keamanan / Password -->
                        <div class="mb-4">
                            <h6 class="font-weight-bold text-dark mb-1">
                                <i data-feather="lock" width="16" class="mr-1 text-primary"></i> Ubah Password
                            </h6>
                            <p class="text-muted small mb-3">Kosongkan kolom di bawah jika Anda tidak ingin mengganti password saat ini.</p>

                            <div class="row">
                                <!-- Password Baru -->
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label font-weight-bold text-muted small">Password Baru</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-soft @error('password') is-invalid @enderror" placeholder="••••••••">
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label font-weight-bold text-muted small">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-soft" placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi Simpan -->
                        <div class="d-flex justify-content-end align-items-center pt-3" style="gap: 12px;">
                            <a href="{{ route('admin.akun.index') }}" class="btn btn-light rounded-pill px-4 py-2 font-weight-bold text-muted">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 font-weight-bold shadow-sm">
                                <i data-feather="save" width="16" class="mr-1"></i> Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script untuk Live Preview Gambar -->
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
        }
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection 