@extends('layouts.umum')
@section('title', $title)

@section('content')

<div class="container py-5 mt-4">
    <div class="row justify-content-center text-center mb-4">
        <div class="col-lg-7">
            <h1 class="font-weight-bold text-dark">Simulasi Uji Kompetensi (Ujikom)</h1>
            <p class="text-muted">Masukkan ketiga nilai komponen Anda di bawah ini untuk menguji rata-rata nilai dan melihat status kelulusan secara langsung.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3xl p-4 p-md-5 bg-white">
                <form action="{{ route('ujikom.hitung') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-uppercase">Nilai 1</label>
                        <input type="number" step="any" name="nilai_1" class="form-control form-control-modern @error('nilai_1') is-invalid @enderror" value="{{ old('nilai_1') }}" required>
                        @error('nilai_1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-uppercase">Nilai 2</label>
                        <input type="number" step="any" name="nilai_2" class="form-control form-control-modern @error('nilai_2') is-invalid @enderror" value="{{ old('nilai_2') }}" required>
                        @error('nilai_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold small text-uppercase">Nilai 3</label>
                        <input type="number" step="any" name="nilai_3" class="form-control form-control-modern @error('nilai_3') is-invalid @enderror" value="{{ old('nilai_3') }}" required>
                        @error('nilai_3') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold rounded-pill w-100">
                            Hitung Kelulusan Ujikom
                        </button>
                    </div>
                </form>

                @if(session('ujikom_success'))
                    <div class="mt-4 p-4 bg-light rounded-2xl text-center border">
                        <span class="text-muted small text-uppercase d-block mb-1">Rata-Rata Nilai Anda</span>
                        <h1 class="font-weight-bold text-primary display-4 mb-3">{{ session('rata_rata') }}</h1>
                        
                        <div>
                            <span class="text-muted small text-uppercase d-block mb-1">Status Kelulusan</span>
                            @if(session('status') == 'Lulus')
                                <span class="badge bg-success text-white px-4 py-2 rounded-pill fs-5">LULUS</span>
                            @else
                                <span class="badge bg-danger text-white px-4 py-2 rounded-pill fs-5">TIDAK LULUS</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection