<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
  <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm p-4" style="min-width: 350px; max-width: 400px; width: 100%;">
      <h3 class="mb-4 text-center">Register</h3>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('admin.register.submit') }}">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
            autofocus
          >
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Alamat Email</label>
          <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
          >
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password"
            name="password"
            required
          >
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
          <input
            type="password"
            class="form-control @error('password_confirmation') is-invalid @enderror"
            id="password_confirmation"
            name="password_confirmation"
            required
          >
          @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Daftar</button>

        <div class="mt-3 text-center">
          <small>
            Sudah punya akun?
            <a href="{{ route('admin.login') }}">Login disini</a>
          </small>
        </div>
      </form>
    </div>
  </div>
</x-layout>
