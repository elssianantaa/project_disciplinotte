@extends('layouts.siswa')

@section('content')
<div class="container d-flex justify-content-center align-items-center mt-5" style="min-height: 70vh;">
    <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 500px;">
        <h4 class="text-center mb-4">
            <i class="bi bi-shield-lock-fill me-2 text-primary"></i>Ubah Password
        </h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('updatePassword.post') }}" method="POST">
            @csrf

            {{-- Password Lama --}}
            <div class="mb-3">
                <label for="current_password" class="form-label">Password Lama</label>
                <div class="input-group">
                    <input type="password" name="current_password" class="form-control" id="current_password" required>
                    <span class="input-group-text">
                        <i class="bi bi-eye-slash toggle-password" data-target="#current_password" style="cursor: pointer;"></i>
                    </span>
                </div>
                @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Password Baru --}}
            <div class="mb-3">
                <label for="new_password" class="form-label">Password Baru</label>
                <div class="input-group">
                    <input type="password" name="new_password" class="form-control" id="new_password" required>
                    <span class="input-group-text">
                        <i class="bi bi-eye-slash toggle-password" data-target="#new_password" style="cursor: pointer;"></i>
                    </span>
                </div>
                @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-4">
                <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" required>
                    <span class="input-group-text">
                        <i class="bi bi-eye-slash toggle-password" data-target="#new_password_confirmation" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 rounded-pill">
                <i class="bi bi-arrow-repeat me-1"></i> Update Password
            </button>
        </form>
    </div>
</div>

{{-- Script show/hide password --}}
<script>
    document.querySelectorAll('.toggle-password').forEach(item => {
        item.addEventListener('click', function () {
            const target = document.querySelector(this.getAttribute('data-target'));
            const type = target.getAttribute('type') === 'password' ? 'text' : 'password';
            target.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    });
</script>
@endsection
