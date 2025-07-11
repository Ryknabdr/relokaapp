<x-layout>
    <div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 80vh;">
        <div class="card shadow-sm p-4 border-0" style="min-width: 350px; max-width: 400px; width: 100%; background: #fff;">
            <h3 class="mb-4 text-center" style="font-family: 'Playfair Display', serif;">Masuk ke Akun</h3>

            @if(session('errorMessage'))
                <div class="alert alert-danger">
                    {{ session('errorMessage') }}
                </div>
            @endif

            @if(session('successMessage'))
                <div class="alert alert-success">
                    {{ session('successMessage') }}
                </div>
            @endif

            <form method="POST" action="{{ route('customer.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Alamat Email</label>
                    <input 
                        type="email" 
                        class="form-control rounded-3 @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                    <input 
                        type="password" 
                        class="form-control rounded-3 @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-3" style="background-color: #6f4e37; border-color: #6f4e37;">
                    Masuk
                </button>

                <div class="mt-3 text-center">
                    <small class="text-muted">
                        Belum punya akun? <a href="{{ route('customer.register') }}" class="text-decoration-none">Daftar disini</a>
                    </small>
                </div>
            </form>
        </div>
    </div>

    {{-- Tambahan gaya --}}
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f6f2;
        }

        .card h3 {
            color: #6f4e37;
        }

        .btn-dark:hover {
            background-color: #5a3f2b !important;
            border-color: #5a3f2b !important;
        }
    </style>
</x-layout>
