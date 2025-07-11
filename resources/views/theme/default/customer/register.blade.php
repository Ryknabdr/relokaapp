<x-layout>
    <div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 80vh;">
        <div class="card shadow-sm p-4 border-0" style="min-width: 350px; max-width: 400px; width: 100%; background: #fff;">
            <h3 class="mb-4 text-center" style="font-family: 'Playfair Display', serif; color: #6f4e37;">
                Daftar Akun Baru
            </h3>

            @if(session('errorMessage'))
                <div class="alert alert-danger">{{ session('errorMessage') }}</div>
            @endif

            <form method="POST" action="{{ route('customer.store_register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                    <input 
                        type="text" 
                        class="form-control rounded-3 @error('name') is-invalid @enderror"  
                        id="name" 
                        name="name"  
                        value="{{ old('name') }}" 
                        required
                        autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input 
                        type="email" 
                        class="form-control rounded-3 @error('email') is-invalid @enderror" 
                        id="email" 
                        value="{{ old('email') }}" 
                        required
                        name="email">
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
                        required
                        name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi</label>
                    <input 
                        type="password" 
                        class="form-control rounded-3 @error('password_confirmation') is-invalid @enderror"   
                        id="password_confirmation" 
                        required 
                        name="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn w-100 text-white" style="background-color: #6f4e37; border: none;">
                    Daftar
                </button>
            </form>

            <div class="mt-3 text-center">
                <small class="text-muted">
                    Sudah memiliki akun? <a href="{{ route('customer.login') }}" class="text-decoration-none">Masuk di sini</a>
                </small>
            </div>
        </div>
    </div>

    {{-- Tambahan style inline --}}
    <style>
        body {
            background-color: #f7f6f2;
        }

        .btn:hover {
            background-color: #5c3d2e !important;
        }
    </style>
</x-layout>
