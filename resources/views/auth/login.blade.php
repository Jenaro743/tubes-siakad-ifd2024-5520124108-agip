<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember_me">Ingat saya</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
            <button class="btn btn-primary px-4" type="submit">Login</button>
        </div>
        <div class="alert alert-info mt-4 mb-0 small">
            <div><strong>Admin:</strong> admin@gmail.com / 12345678</div>
            <div><strong>Mahasiswa:</strong> mahasiswa1@siakad.test / 12345678</div>
            <div><strong>Dosen:</strong> dosen1@siakad.test / 12345678</div>
        </div>
    </form>
</x-guest-layout>
