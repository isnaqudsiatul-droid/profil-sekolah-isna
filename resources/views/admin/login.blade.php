<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin | MTs Bahrul Hidayah</title>
    
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">

    @php
        $profil = \App\Models\ProfilSekolah::first();
    @endphp
    @if($profil && $profil->logo)
        <link rel="shortcut icon" href="{{ asset('storage/' . $profil->logo) }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/pp.png') }}" type="image/x-icon">
    @endif

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #2582ff;
            background-image: linear-gradient(135deg, #1c71f2 0%, #3a97ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #auth {
            width: 100%;
        }

        .card-login {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            background: #ffffff;
        }

        .auth-logo img {
            max-height: 45px;
            width: auto;
            object-fit: contain;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .form-control {
            height: 42px;
            border-radius: 8px !important;
            padding-left: 40px;
            padding-right: 40px;
            font-size: 0.875rem;
            background-color: #f4f6f9;
            border: 1px solid #e2e8f0;
        }

        .input-group-custom .form-control:focus {
            background-color: #ffffff;
            border-color: #3a97ff;
            box-shadow: 0 0 0 0.2rem rgba(58, 151, 255, 0.2);
        }

        .input-group-custom .icon-left {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: #8898aa;
            pointer-events: none;
        }

        .input-group-custom .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            color: #8898aa;
            cursor: pointer;
            border: none;
            background: transparent;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .input-group-custom .toggle-password:hover {
            color: #3a97ff;
        }

        .btn-primary {
            background-color: #438bf7;
            border-color: #438bf7;
            height: 42px;
            font-weight: 600;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2b74e2;
            border-color: #2b74e2;
            box-shadow: 0 4px 12px rgba(43, 116, 226, 0.3);
        }
    </style>
</head>

<body>
    <div id="auth">    
        <div class="container">
            <div class="row">
                <div class="col-11 col-sm-8 col-md-6 col-lg-4 mx-auto">
                    <div class="card card-login p-3 p-md-4">
                        <div class="card-body p-2">
                            
                            <!-- Logo & Judul -->
                            <div class="text-center mb-4">
                                <div class="auth-logo mb-2">
                                    @if($profil && $profil->logo)
                                        <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo {{ $profil->nama_sekolah ?? 'SMK SEJAHTERA' }}">
                                    @else
                                        <img src="{{ asset('assets/admin/images/pp.png') }}" alt="Logo SMK SEJAHTERA">
                                    @endif
                                </div>
                                <h5 class="font-weight-bold text-dark mb-0">Sign In</h5>
                            </div>

                            {{-- Pesan error dari backend/session --}}
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show border-0 small py-2 px-3 mb-3" style="font-size: 0.8rem;" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="alert-circle" width="14" class="mr-2"></i>
                                        <span>{{ session('error') }}</span>
                                    </div>
                                    <button type="button" class="close py-2" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('proses.login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="username" class="small font-weight-bold text-uppercase text-muted mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Username</label>
                                    <div class="input-group-custom">
                                        <i data-feather="user" width="18" class="icon-left"></i>
                                        <input type="text" 
                                               name="username" 
                                               id="username" 
                                               class="form-control @error('username') is-invalid @enderror" 
                                               value="{{ old('username') }}"
                                               placeholder="Masukkan username"
                                               required>
                                    </div>
                                    @error('username')
                                        <small class="text-danger mt-1 d-block" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="small font-weight-bold text-uppercase text-muted mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px;">Password</label>
                                    <div class="input-group-custom">
                                        <i data-feather="lock" width="18" class="icon-left"></i>
                                        <input type="password" 
                                               name="password" 
                                               id="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               placeholder="Masukkan password"
                                               required>
                                        <button type="button" class="toggle-password" id="togglePassword" title="Lihat/Sembunyikan Password">
                                            <i data-feather="eye" width="18" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <small class="text-danger mt-1 d-block" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary btn-block shadow-sm">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <small class="text-muted" style="font-size: 0.75rem;">&copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? 'MTs BAHIDA' }}</small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/admin/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    
    <script>
        feather.replace();

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.setAttribute('data-feather', 'eye-off');
            } else {
                eyeIcon.setAttribute('data-feather', 'eye');
            }
            feather.replace();
        });
    </script>
</body>
</html>