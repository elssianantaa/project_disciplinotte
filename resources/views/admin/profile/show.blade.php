@extends('layouts.admin')
@section('content')
<div class="container mt-5">
    <h3 class="mb-4 fw-semibold text-center text-dark">Profil Admin</h3>

    <div class="card shadow-lg border-0 rounded-5 mx-auto" style="max-width: 800px;">
        <div class="card-body p-5 text-center">

            {{-- Foto Profil --}}
            @if($user->foto)
                <img src="{{ asset('storage/foto_user/' . $user->foto) }}" 
                    alt="Foto Profil" 
                    class="rounded-circle mb-4 shadow" 
                    style="width: 150px; height: 150px; object-fit: cover;">
            @else
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto mb-4 shadow" 
                    style="width: 150px; height: 150px; font-size: 50px;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            {{-- Info Profil --}}
            <div class="text-start px-3 px-md-5">
                <div class="mb-3"><strong>Nama:</strong> {{ $user->name }}</div>
                <div class="mb-3"><strong>Email:</strong> {{ $user->email }}</div>
                <div class="mb-3"><strong>No HP:</strong> {{ $user->nohp }}</div>
                <div class="mb-3"><strong>Alamat:</strong> {{ $user->address }}</div>
            </div>

            {{-- Tombol Edit --}}
            <a href="{{ route('admin.profile.edit', $user->id) }}" 
               class="btn btn-dark px-4 py-2 rounded-5 mt-4 shadow-sm">
                 Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
